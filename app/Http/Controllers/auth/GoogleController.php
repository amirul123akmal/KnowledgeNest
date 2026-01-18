<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redirect to Google for authentication.
    public function redirectToGoogle()
    {
        // Request offline access to get refresh_token. prompt=consent ensures refresh_token is returned again if needed.
        return Socialite::driver('google')
            ->setScopes(['openid', 'profile', 'email'])
            ->with(['access_type' => 'offline', 'prompt' => 'consent'])
            ->redirect();
    }

    // Handle callback from Google.
    public function handleGoogleCallback()
    {
        try {
            // If you use normal web session, omit stateless(). If you face state problems in tests or APIs, use stateless().
            $googleUser = Socialite::driver('google')->user();

            $providerName = 'google';
            $providerId = $googleUser->id;
            $email = $googleUser->email;

            // 1) Find existing social account
            $social = SocialAccount::where('provider_name', $providerName)
                ->where('provider_id', $providerId)
                ->first();

            if ($social) {
                $user = $social->user;
                // Update tokens and profile if necessary
                $social->update([
                    'access_token' => $googleUser->token ?? null,
                    'refresh_token' => $googleUser->refreshToken ?? $social->refresh_token,
                    'token_expires_at' => isset($googleUser->expiresIn) ? Carbon::now()->addSeconds($googleUser->expiresIn) : $social->token_expires_at,
                    'profile' => $googleUser->user,
                ]);

            } else {
                // 2) No social record: try to find user by email
                $user = $email ? User::where('email', $email)->first() : null;

                if (!$user) {
                    // Download avatar for new user
                    $localAvatarPath = $googleUser->avatar;
                    if ($googleUser->avatar) {
                        try {
                            $response = Http::get($googleUser->avatar);
                            if ($response->successful()) {
                                $extension = pathinfo(parse_url($googleUser->avatar, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                                $filename = 'headers/' . Str::random(40) . '.' . $extension;
                                Storage::disk('public')->put($filename, $response->body());
                                $localAvatarPath = $filename;
                            }
                        } catch (\Exception $e) {
                            Log::warning('Failed to download Google avatar: ' . $e->getMessage());
                        }
                    }

                    // 3) Create user. Set password to random string (user authenticates via Google)
                    $user = User::create([
                        'name' => $googleUser->name ?? $googleUser->nickname ?? 'No Name',
                        'email' => $email,
                        'password' => bcrypt(Str::random(24)), // Dummy password just to fill in 
                        // if your users table has an avatar column:
                        'phone' => '99' . mt_rand(1000000, 9999999),
                        'picture' => $localAvatarPath,
                        'role' => 'user',
                        'status' => 'active',
                        'verified' => true,
                        // optionally set email_verified_at if you consider Google-verified email trusted:
                        'email_verified_at' => now(),
                    ]);
                }

                // 4) Create social account link
                $user->socialAccounts()->create([
                    'provider_name' => $providerName,
                    'provider_id' => $providerId,
                    'access_token' => $googleUser->token ?? null,
                    'refresh_token' => $googleUser->refreshToken ?? null,
                    'token_expires_at' => isset($googleUser->expiresIn) ? Carbon::now()->addSeconds($googleUser->expiresIn) : null,
                    'profile' => $googleUser->user,
                ]);
            }

            // 5) Log the user in
            Auth::login($user, true);

            return redirect()->intended('/');

        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/login')->with('error', 'Failed to login with Google.');
        }
    }
}
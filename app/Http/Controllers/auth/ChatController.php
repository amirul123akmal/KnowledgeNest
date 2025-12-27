<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\ChatUsage;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'message' => 'required|string|max:1000',
        ]);

        $postId = $request->post_id;
        $userMessage = $request->message;
        $userId = auth()->id();

        // Per-user, per-post isolated session key
        $sessionKey = "chat_h_u{$userId}_p{$postId}";
        $history = session($sessionKey, []);

        $post = Post::with('author')->find($postId);

        // Initialize history with strict post context if empty
        if (empty($history)) {
            $authorName = $post->author ? $post->author->name : 'Unknown';

            $history[] = [
                'role' => 'system',
                'content' => "You are a specialized assistant for the post titled: \"{$post->title}\".\n" .
                    "Author: {$authorName}\n" .
                    "POST CONTENT:\n\"\"\"\n{$post->content}\n\"\"\"\n\n" .
                    "STRICT RULES:\n" .
                    "1. Answer ONLY based on the POST CONTENT provided above.\n" .
                    "2. If the user asks something not found in the content, politely say you don't know as you are restricted to this post's context.\n" .
                    "3. DO NOT use external knowledge.\n" .
                    "4. DO NOT disclose any private information about the author or user.\n" .
                    "5. Keep answers concise and helpful." .
                    "6. Do not explain what already is, just answer the question." .
                    "7. Be playful with fun tone and emojis."
            ];
        }

        // Add user message to history
        $history[] = [
            'role' => 'user',
            'content' => $userMessage
        ];

        $apiKey = config('services.openai.api_key');
        if (!$apiKey) {
            return response()->json(['error' => 'AI Service config error'], 500);
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$apiKey}",
            ])->timeout(30)->post('https://api.openai.com/v1/responses', [
                        'model' => 'gpt-5-nano', // Actual model for execution, logged as gpt-5-nano
                        'input' => $history,
                        'reasoning' => [
                            "effort" => "low",
                        ]
                    ]);

            if ($response->failed()) {
                Log::channel('response')->error($response->json());
                return response()->json(['error' => 'AI Service currently busy'], 502);
            }

            $data = $response->json();

            // Find the message in the output array
            $aiMessage = null;
            if (isset($data['output']) && is_array($data['output'])) {
                foreach ($data['output'] as $item) {
                    if (isset($item['type']) && $item['type'] === 'message' && isset($item['content'][0]['text'])) {
                        $aiMessage = $item['content'][0]['text'];
                        break;
                    }
                }
            }

            if (!$aiMessage) {
                Log::channel('response')->error('Invalid AI response structure', ['data' => $data]);
                return response()->json(['error' => 'Invalid AI response'], 502);
            }

            $usage = $data['usage'] ?? [
                'input_tokens' => 0,
                'output_tokens' => 0,
                'total_tokens' => 0
            ];

            // Add AI response to history
            $history[] = [
                'role' => 'assistant',
                'content' => $aiMessage
            ];

            // Store updated history back to session (max 10 turns to save space/session size)
            session([$sessionKey => array_slice($history, -21)]);

            // Track usage
            ChatUsage::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'model' => 'gpt-5-nano',
                'prompt_tokens' => $usage['input_tokens'] ?? 0,
                'completion_tokens' => $usage['output_tokens'] ?? 0,
                'total_tokens' => $usage['total_tokens'] ?? 0,
                'input_text' => substr($userMessage, 0, 255),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => $aiMessage,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Communication error'], 500);
        }
    }

    public function clear(Request $request)
    {
        $postId = $request->post_id;
        $userId = auth()->id();
        $sessionKey = "chat_h_u{$userId}_p{$postId}";

        session()->forget($sessionKey);

        return response()->json(['status' => 'success']);
    }
}

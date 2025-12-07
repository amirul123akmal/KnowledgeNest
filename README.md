<p align="center">
  <h1 align="center">KnowledgeNest</h1>
  <p align="center">A Community-Driven Knowledge Sharing Platform</p>
  <p align="center">
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"></a>
    <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS 4"></a>
    <a href="https://alpinejs.dev"><img src="https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js"></a>
    <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License"></a>
  </p>
</p>

## About KnowledgeNest

KnowledgeNest is a modern platform designed for developers and learners to share insights, tutorials, and knowledge in a collaborative environment. Built with the latest web technologies, it emphasizes a clean reading experience and community interaction.

## Key Features

-   **Rich Content Creation**: Write and edit posts using Markdown with real-time preview, powered by EasyMDE and syntax highlighting.
-   **Community Interaction**: Engage with content through an upvote/downvote system, comments, and bookmarking/saving posts for later.
-   **Smart Organization**: Content is organized with an advanced tagging system and difficulty levels (Beginner, Intermediate, Advanced).
-   **Users Dashboard**: Visualize your activity and engagement stats with integrated Chart.js analytics.
-   **Modern UI/UX**: Strict adherence to aesthetic principles with a polished interface built using Tailwind CSS 4, featuring responsive design and micro-interactions.
-   **Robust Tech Foundation**: Leveraging Laravel 12 for backend reliability and Alpine.js for lightweight frontend interactivity.

## Tech Stack

-   **Framework**: Laravel 12
-   **Styling**: Tailwind CSS 4
-   **Frontend**: Vite, Alpine.js
-   **Components**: EasyMDE, SweetAlert2, Tagify, Chart.js
-   **Utilities**: Spatie Sluggable
-   etc...

## Getting Started

1. **Clone the repository**

    ```bash
    git clone https://github.com/amirul123akmal/KnowledgeNest.git
    cd KnowledgeNest
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment Setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database Setup**
   Configure your `.env` file with your database credentials, then run:

    ```bash
    php artisan migrate --seed
    ```

5. **Run the Application**
    ```bash
    composer run dev
    ```

## Screenshots

_(Coming Soon)_

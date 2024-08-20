<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    // Policy
    protected $policies = [
        Post::class => PostsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Định nghĩa gate
        // Gate::define('posts.add', function (User $user) {
        //     // Xử lí logic
        //     return false;
        // });

        // Sử dụng callback array sử dụng với policy
        // Gate::define('posts.add', [PostsPolicy::class, 'add']);
        // Gate::define('posts.edit', function (User $user, Post $post) {
        //     return $user->id == $post->user_id;
        // });


        // Đăng ký policy
        // $this->registerPolicies();
    }
}

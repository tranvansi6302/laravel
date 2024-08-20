<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Group;
use App\Models\Module;
use App\Models\Post;
use App\Models\User;
use App\Policies\GroupPolicy;
use App\Policies\PostPolicy;
use App\Policies\PostsPolicy;
use App\Policies\UserPolicy;
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
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        Group::class => GroupPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        /**
         * 1 Lấy danh sách module
         */
        $moduleList = Module::all(['*']);
        if ($moduleList->count() > 0) {
            foreach ($moduleList as $module) {
                Gate::define($module->name, function (User $user) use ($module) {
                    $roleJson = $user->group->permission;

                    if (!empty($roleJson)) {
                        $roleArray = json_decode($roleJson, true);
                        $check = isRole($roleArray, $module->name);
                        return $check;
                    }
                    return false;
                });
                // Add
                Gate::define($module->name . '.add', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;

                    if (!empty($roleJson)) {
                        $roleArray = json_decode($roleJson, true);
                        $check = isRole($roleArray, $module->name, 'add');
                        return $check;
                    }
                    return false;
                });
                // Xử lí update cho Route get edit
                Gate::define($module->name . '.edit', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;

                    if (!empty($roleJson)) {
                        $roleArray = json_decode($roleJson, true);
                        $check = isRole($roleArray, $module->name, 'edit');
                        return $check;
                    }
                    return false;
                });

                // Xử lí delete cho Route delete get
                Gate::define($module->name . '.delete', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;

                    if (!empty($roleJson)) {
                        $roleArray = json_decode($roleJson, true);
                        $check = isRole($roleArray, $module->name, 'delete');
                        return $check;
                    }
                    return false;
                });
                // Check permission
                Gate::define($module->name . '.permission', function (User $user) use ($module) {
                    $roleJson = $user->group->permission;

                    if (!empty($roleJson)) {
                        $roleArray = json_decode($roleJson, true);
                        $check = isRole($roleArray, $module->name, 'permission');
                        return $check;
                    }
                    return false;
                });
            }
        }
    }
}

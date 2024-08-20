<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $roleJson = $user->group->permission;
        if (!empty($roleJson)) {
            $roleArray = json_decode($roleJson, true);
            $check = isRole($roleArray, 'groups', 'add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Group $group): bool
    {
        // Biến group phải giống với Route::get('/edit/{group})
        return $user->id === $group->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Group $group): bool
    {
        return $user->id === $group->user_id;
    }

    /**
     * Phân quyền
     */
    public function permission(User $user, Group $group)
    {
        //  Xử lí trường hợp không phân quyền được tài khoản ban đầu
        return ($user->id === $group->user_id) || $group->user_id == $user->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group): bool
    {
        //
    }
}

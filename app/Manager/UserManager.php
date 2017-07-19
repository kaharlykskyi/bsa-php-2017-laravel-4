<?php

namespace App\Manager;

use App\Entity\User;
use App\Manager\Contract\UserManager as UserManagerContract;
use App\Request\Contract\SaveUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class UserManager implements UserManagerContract
{
    /**
     * Find all users
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return User::all();
    }

    /**
     * Get user model by ID.
     *
     * @param int $id
     * @return mixed|null
     */
    public function findById(int $id)
    {
        return is_numeric($id) ? User::find($id) : null;
    }

    /**
     * Find Users that has `is_active` field true.
     *
     * @return Collection
     */
    public function findActive(): Collection
    {
        return User::where('is_active', true)->get();
    }

    /**
     * Create or update user.
     *
     * @param SaveUserRequest $request
     * @return User|null
     */
    public function saveUser(SaveUserRequest $request): User
    {
        $user = $request->getUser();
        $user->first_name = $request->getFirstName();
        $user->last_name = $request->getLastName();
        $user->is_active = $request->getIsActive();

        return $user->save() ? $user : null;
    }

    /**
     * @param int $userId
     * @return string
     */
    public function deleteUser(int $userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->delete();
        } catch (ModelNotFoundException $e) {
            return "Error: {$e->getMessage()}";
        }
    }
}
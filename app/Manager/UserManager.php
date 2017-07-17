<?php

namespace App\Manager;


use App\Entity\User;
use App\Manager\Contract\UserManager as UserManagerContract;
use App\Request\Contract\SaveUserRequest;
use Illuminate\Support\Collection;

class UserManager implements UserManagerContract
{
    /**
     * Method returns a collection of all users.
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return User::all();
    }

    /**
     * Method returns data about user with $id.
     *
     * @param int $id
     * @return mixed|null
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Method returns a collection of all users with is_active field.
     *
     * @return Collection
     */
    public function findActive(): Collection
    {
        return User::where('is_active', 1)->get();
    }

    /**
     * @param SaveUserRequest $request
     * @return User|null
     */
    public function saveUser(SaveUserRequest $request): User
    {
        $user = $request->getUser();
        $user->first_name = $request->getFirstName() ?? $user->first_name;
        $user->last_name = $request->getLastName() ?? $user->last_name;
        $user->is_active = $request->getIsActive() ?? $user->is_active;
        return $user->save() ? $user : null;
    }

    public function deleteUser(int $userId)
    {
        $user = $this->findById($userId);
        if ($user === null) {
            return;
        }
        $user->delete();
    }
}
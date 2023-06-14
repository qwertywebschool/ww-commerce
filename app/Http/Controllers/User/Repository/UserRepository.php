<?php

namespace App\Http\Controllers\User\Repository;

use App\Http\Controllers\User\Contract\UserInterface;
use App\Http\Controllers\User\Model\User;
use Illuminate\Support\Collection;

class UserRepository implements UserInterface
{
    public function __construct(public User $model)
    {
    }

    public function userUpdateOrCreate(array $columns): User
    {
        return $this->model
            ->firstOrCreate($columns);
    }

    public function userByEmail($email): ?User
    {
        return $this->model
            ->whereEmail($email)
            ->first();
    }

    public function userById($id): ?User
    {
        return $this->model
            ->whereId($id)
            ->first();
    }

    public function update($id, $name, $email, array $roleId): bool
    {
        $user = $this->modelById($id);

        return $user && $user->update([
            'name' => $name,
            'email' => $email,
        ]) && $user->syncRoles($roleId);
    }

    public function destroy($id): bool
    {
        $user = $this->modelById($id);

        return $user && $user->delete();
    }

    public function usersByRoleName(array $roleNames): Collection|array
    {
        return $this->model
            ->role($roleNames)
            ->get();
    }

    public function users(array $columns = []): mixed
    {
        return $this->model
            ->when(count($columns),
                fn ($eloquent) => $eloquent->select($columns),
                fn ($eloquent) => $eloquent->get()
            );
    }

    public function profileUpdate($name, $password): bool
    {
        $user = $this->modelById(auth()->id());

        return $user && $user->update([
            'name' => $name,
            'password' => bcrypt($password),
        ]);
    }
}

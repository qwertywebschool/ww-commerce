<?php

namespace App\Http\Controllers\User\Relation\Permission\Contract;

use Spatie\Permission\Models\Permission;

interface PermissionInterface
{
    public function permissions(array $columns = []): mixed;

    public function firstOrCreate(array $columns): Permission;
}

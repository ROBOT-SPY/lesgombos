<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingsService
{
    /**
     * property :
     * - data : array 
     *      - name
     */
    public function createRole($data): void
    {
        Role::create($data);
    }

    /**
     * property :
     * - data : array
     *      - name
     */
    public function createPermission($data)
    {
        Permission::create($data);
    }

    public function syncPermissionToRole($roleId, $permissionIds): void
    {
        $role = Role::findById($roleId);
        $role->givePermissionTo($permissionIds);
    }

    public function revokePermissionFromRole($roleId, $permissionIds): void
    {
        $role = Role::findById($roleId);
        $role->revokePermissionTo($permissionIds);
    }

    public function revokeRoleFromPermission($roleId, $permissionId)
    {
        $role = Role::findById($roleId);
        $permission = Permission::findById($permissionId);
        $permission->removeRole($role);
    }
}

<?php

namespace App\Permissions;


use App\{Role, Permission};

trait HasPermissionsTrait
{
	// giving permission to user
	public function givePermissionTo(...$permissions)
	{
		$permissions = $this->getAllPermissions(array_flatten($permissions));

		if ($permissions === null) {
			return $this;
		}

		$this->permissions()->saveMany($permissions);

		return $this;
	}

	// delete permission
	public function withdrawPermissionTo(...$permissions)
	{
		$permissions = $this->getAllPermissions(array_flatten($permissions));

		$this->permissions()->detach($permissions);

		return $this;
	}

	// refresh permission
	public function updatePermissions(...$permissions)
	{
		$this->permissions()->detach();

		return $this->givePermissionTo($permissions);
	}

	public function hasRole(...$roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('name', $role)) {
				return true;
			}
		}
		return false;
	}

	public function hasPermissionTo($permission)
	{
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	protected function hasPermissionThroughRole($permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains($role)) {
					return true;
			}
		}

		return false;
	}

	// return as a collection
	protected function getAllPermissions(array $permissions)
	{
		return Permission::whereIn('name', $permissions)->get();
	}

	public function hasPermission($permission)
	{
		return (bool) $this->permissions->where('name', $permission->name)->count();
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'users_permissions');
	}
}
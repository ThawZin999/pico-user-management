<?php

namespace App\Traits;

use App\Models\Feature;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

trait HasPermissionsTrait
{
    public function getPermissionId($featureName, $permissionName)
    {
        $feature = Feature::where('name', $featureName)->first();
        if ($feature) {
            $permission = $feature->permissions->where('name', $permissionName)->first();
            if ($permission) {
                return $permission->id;
            }
        }
        return null;
    }

    public function checkPermission($permissionId)
    {
        $user = Auth::user();
        if ($user) {
            return $user->role->permissions->contains('id', $permissionId);
        }
        return false;
    }

    public function authorizeUser($featureName, $permissionName)
    {
        $permissionId = $this->getPermissionId($featureName, $permissionName);
        if ($permissionId === null) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
        }
        $isAuthorized = $this->checkPermission($permissionId);
        if (!$isAuthorized) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
        }
        return true;
    }
}

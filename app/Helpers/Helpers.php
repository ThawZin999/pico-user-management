<?php
    use App\Traits\HasPermissionsTrait;

    function showContent($featureName, $permissionName){
        $pHelper = new class{ use HasPermissionsTrait;};
        $permissionId = $pHelper->getPermissionId($featureName,$permissionName);
        if ($permissionId === null) {
            return false;
        }
        $isAuthorized = $pHelper->checkPermission($permissionId);
        if (!$isAuthorized) {
            return false;
        }
        return true;
    }

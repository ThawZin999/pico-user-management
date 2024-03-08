<?php

    use App\Helpers\PermissionHelper;

    function showContent($featureName, $permissionName){
        $pHelper = new PermissionHelper();
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

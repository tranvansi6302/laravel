<?php
function isRole($dataArray, $moduleName, $role = 'view')
{
    if (!empty($dataArray[$moduleName])) {
        $roleArray = $dataArray[$moduleName];
        if (!empty($roleArray) && in_array($role, $roleArray)) {
            return true;
        }
    }
    return false;
}

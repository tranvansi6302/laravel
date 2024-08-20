<?php

use App\Models\Groups;


function getAllGroup()
{
    $groups = new Groups();
    return $groups->getAllGroup();
}

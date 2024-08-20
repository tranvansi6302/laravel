<?php

namespace App\Http\Controllers;

use App\Models\Mechanics;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    public function index()
    {
        $owner = Mechanics::find(1)->carOwner;
        dd($owner);
    }
}

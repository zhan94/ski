<?php

namespace App\Http\Controllers\Api;
use App\Models\Navbar;

use App\Http\Controllers\Controller;

class NavbarController extends Controller
{
    public function index(): array
    {
        return Navbar::orderBy('ordering')->get()->toArray();
    }
}

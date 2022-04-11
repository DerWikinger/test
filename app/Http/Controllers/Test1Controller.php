<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class Test1Controller extends Controller
{
    public function index() {
        return Inertia::render('Test1/Index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\MyModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Test1Controller extends Controller
{
    public function index() {
        return Inertia::render('Test1/Index', ['myModels' => MyModel::all()]);
    }
}

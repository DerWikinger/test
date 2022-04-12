<?php

namespace App\Http\Controllers;

use App\Models\MyModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Test1Controller extends Controller
{
    public function index() {
        $data = json_decode(file_get_contents('/home/vitaly/PhpstormProjects/test/resources/js/collection.json'));
        return Inertia::render('Test1/Index', [ 'collectionData' => $data->data->collectionData ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class Test2Controller extends Controller
{
    public function index() {
//        $collectionData = json_decode('{"id":1,"name":"test","description":"test","tags":"test","views_count":12548,"likes_count":1890,"dislikes_count":149,"image_path":"\/storage\/collections\/01fywd0hzp107e8db24y0byx9x-1\/1649412317.png"}');
//        $collectionModels = json_decode('[
//            {"id":10,"model_name":"Rapier","price":0,"user_name":"Andrey Kovalev","image":"\/storage\/images\/image_11.png"},
//            {"id":8,"model_name":"Rapier","price":0,"user_name":"Andrey Kovalev","image":"\/storage\/images\/image_12.png"},
//            {"id":12,"model_name":"Rapier","price":0,"user_name":"Vitaly Miytofanov","image":"\/storage\/images\/image_13.png"}
//        ]');
//        dump($collectionModels);
        return Inertia::render('Test2/Index', [
//            'collectionData' => $collectionData,
//            'collectionModels' => $collectionModels,
        ]);
    }
}

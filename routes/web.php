<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
// use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload-image', [ImageController::class, 'upload']);



// Route::post('/create-post', [PostController::class, 'store']);

Route::get('/users', function () {
    //  $name ="ayesha";
    // return view('example.users',[
    //     'user'=> $name, 
    //     'city'=> 'gujranwala', //for default value check the view file 
    // ]);    

    // return view('example.users')
    // ->with('user', $name)
    // ->with('city','gujranwala', );

    // return view('example.users')->withUser($name)->withCity("gujranwala");
    
    $names = [
        1 =>['name'=>'ayesha' , 'phone'=>'030029345','city'=>'gujranwala'],
        2 =>['name'=>'ajddk' , 'phone'=>'030029345','city'=>'gujranwala'],
        3 =>['name'=>'ayesha' , 'phone'=>'030029345','city'=>'gujranwala'],
        4 =>['name'=>'ayesha']
    ];

    return view('example.users',[
        'user'=> $names, 
       'city'=> 'gujranwala'
    ]);
});




Route::get('/create-post', function () {
    return view('create-post');
});
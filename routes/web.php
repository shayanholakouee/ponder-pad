<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//home
Route::get('/', function () {

    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach ($files as $file){
        $documents = YamlFrontMatter::parseFile($file);

        $posts[] = new Post(
            $documents->title,
            $documents->excerpt,
            $documents->date,
            $documents->body(),
            $documents->slug
        );
    }
    return view('posts',[
      'posts' => $posts
    ]);
});

//about
Route::get('/about', function(){
   return view('about');
});

//post
Route::get('posts/{post}', function($slug){
    return view('post',[
        'post' => Post::find($slug)
    ]);
})->where('post', '[A-z_\-]+') ;

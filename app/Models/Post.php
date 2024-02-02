<?php


namespace App\Models;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\throwException;

class Post
{

    public static function all(){
       $files = File::files(resource_path("posts/"));

        return array_map(function($file){
            return $file->getcontents();
        },$files);
    }


    
    public static function find($slug){
        if (! file_exists($path = resource_path("posts/{$slug}.html"))){
            throw new ModelNotFoundException();
        }

        return cache()->remember("posts.{$slug}",now()->addMinutes(20), function () use($path){
            return file_get_contents($path);
        });

    }
}

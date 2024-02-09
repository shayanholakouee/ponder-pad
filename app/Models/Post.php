<?php


namespace App\Models;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use function PHPUnit\Framework\throwException;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    /**
     * Post constructor.
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all(){
       $files = File::files(resource_path("posts/"));

       foreach ($files as $file){
         YamlFrontMatter::parseFile(resource_path('posts/my-forth-post.html'));
       }
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

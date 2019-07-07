<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';
    protected $guarede = [];

    public static function post_save($request, $id = null, $type = null)
    {
        $post = Post::where([
            ['type',$type],
            ['id',$id]
        ])->first();
        if (!isset($post)) {
            $post = new Post();
        }
        $post->name = $request->name;
        $post->slug = str_slug($request->name);
        $post->content_short = $request->content_short;
        $post->content_main = $request->content_main;
        $post->type = $type;
        $post->status = $request->status;
        $post->parent_id = $request->parent_id;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keyword = $request->meta_keyword;;
        $result = $post->save();

        return $result ? $post : false;
    }
}

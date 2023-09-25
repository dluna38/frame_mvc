<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;


class PostControllerApi extends Controller{

    use ApiResponse;

    public function index(){

        //Post::join('categories','categories.id','=','posts.category_id')->orderBy('created_at','desc')->paginate(1);

        $posts = Post::join('categories','categories.id','=','posts.category_id')
        ->select('posts.*','categories.name as category_name','categories.description as category_descr')
        ->orderBy('posts.created_at','desc')->paginate(10);
        return $this->sucessResponse($posts);
        //return response()->json($posts);

    }
    public function show(Post $post){
        
        $post->category_id = Category::where('id',$post->category_id)->first();
        return $this->sucessResponse($post);

    }

    public function store(Request $request){
        $data = $request->all();
        if(!array_key_exists("category_id",$data)){
            return $this->errorResponse($data,500,"No se indico la categoria");
        }

        $result = Post::create($request->validate(StorePost::rules()));
        return $this->sucessResponse($result);
    }

    public function update(Request $request, Post $post){
        $data = $request->all();
        if(array_key_exists("name",$data)){
            $post->name = $data["name"];
        }
        if(array_key_exists("description",$data)){
            $post->description = $data["description"];
        }
        //check if the category exists
        if(array_key_exists("category_id",$data)){
            $post->category_id = $data["category_id"];
        }
        if(array_key_exists("state",$data)){
            $post->state = $data["state"];
        }

        $result = $post->save();
        //$post->update($request->validated(StorePost::rules()));
        return $this->sucessResponse($result);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return $this->sucessResponse(); 
    }
} 

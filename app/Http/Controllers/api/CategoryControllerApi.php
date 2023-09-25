<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;


class CategoryControllerApi extends Controller{

    use ApiResponse;

    public function index(){

        //Post::join('categories','categories.id','=','posts.category_id')->orderBy('created_at','desc')->paginate(1);

        $posts = Category::orderBy('created_at','desc')->paginate(10);
        return $this->sucessResponse($posts);
        //return response()->json($posts);

    }
    public function show(Category $category){
    
        return $this->sucessResponse($category);
    }

    public function store(Request $request)
    {
        
        $data = $request->all();
        if(!array_key_exists("name",$data)){
            return $this->errorResponse($data,400,"No se indico el nombre");
        }
        if(!array_key_exists("description",$data)){
            return $this->errorResponse($data,400,"No se indico la descripcion");
        }

        $categoryExist = Category::where('name',$data["name"])->first();

        if($categoryExist){
            return $this->errorResponse($data,400,"ya existe la categoria");
        }

        $result = Category::create([
            "name"=>strtoupper($data["name"]),
            "description"=>$data["description"]
        ]); 
        return $this->sucessResponse($result);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        if(array_key_exists("name",$data)){
            $categoryExist = Category::where('name',$data["name"])->first();

            if($categoryExist){
                return $this->errorResponse($data,400,"ya existe esa categoria");
            }

            $category->name = $data["name"];
        }
        if(array_key_exists("description",$data)){
            $category->description = $data["description"];
        }


        $result = $category->save();
        //$post->update($request->validated(StorePost::rules()));
        return $this->sucessResponse($result);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sucessResponse(); 
    }
} 

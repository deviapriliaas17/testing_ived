<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ category, blog};
use App\Http\Controllers\MediaController;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Crypt;


class BlogController extends Controller
{
    public function __construct(MediaController $MediaController)
    {
        $this->MediaController = $MediaController;
    }
    public function index()
    {
        $blogs = blog::with('category')->orderBy('id','DESC')->get();
        return response()->json([
            'blogs' => $blogs,
            'message' => 'success'
        ]);
    }
    public function getData($id)
    {
        $blog = blog::with('category')->find(decrypt($id));
        return response()->json([
            'blog' => $blog
        ]);
    }
    public function update(Request $request, $id)
    {
        $blog = blog::find(decrypt($id));
        $data = $request->all();
        if($request->file('image') != null){
            $data['image'] = $this->MediaController->saveImage($request->file('image'));
        }else{
            $data['image'] = $blog->image;
        }
        $blog->fill($data)->save();
        return response()->json([
            'message' => 'success'
        ]);
    }
    public function store(Request $request)
    {
        $blog = new blog();
        $data = $request->all();
        if($request->file('image')){
            $data['image'] = $this->MediaController->saveImage($request->file('image'));
        }else{
            $data['image'] = 'images-default.jpg';
        }

        $data['slug'] = Str::slug('-',$request->title);
        $blog->fill($data)->save();

        return response()->json([
            'message' => 'success'
        ]);
    }
    public function destroy($id)
    {
        $blog = blog::find(decrypt($id));
        $blog->delete();

        $blogs = blog::with('category')->orderBy('id','DESC')->get();
        return response()->json([
            'message' => 'success',
            'blogs' => $blogs
        ]);
    }
}

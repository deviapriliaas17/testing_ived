<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;

class CategoryController extends Controller
{
    public function index(){
        $categories = category::orderBy('id','DESC')->get();
        return response()->json([
            'categories' => $categories,
            'message' => 'success'
        ],200);
    }
    public function getData($id){
        $category = category::find($id);
        return response()->json([
            'category' => $category,
            'message' => 'success'
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $category = category::find($id);
        $data = $request->all();

        $category->fill($data)->save();

        return response()->json([
            'message' => 'success'
        ],200);
    }
    public function store(Request $request)
    {
        $category = new category();
        $data = $request->all();
        $category->fill($data)->save();

        return response()->json([
            'message' => 'success'
        ],200);
    }
    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete();
        $categories = category::orderBy('id','DESC')->get();
        return response()->json([
            'message' => 'success',
            'categories' => $categories
        ]);
    }
    
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    public function index(){
        $tags = Tag::all();
        $data = [
            'data'=> $tags
        ];
        return response()->json($data,200);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'string'
        ]);
        $tag = new Tag();
        $tag->name = $validated['name'];
        $tag->save();
        return response()->json($tag,200);
    }
    public function show($id){
        $tag =Tag::findOrFail($id);
        $data =[
            'data'=> $tag
        ];
        return response()->json($data,200);
    }
    public function update(Request $request, $id){
        $tag = Tag::findOrFail($id);
        $validated = $request->validate([
            'name' => 'string'
        ]);
        $tag->name = $request->name;
        $tag->save();
        $data = [
            'data' => $tag
        ];
        return response()->json($data, 201);
    }
    public function destroy($id){
        $tag = Tag::findOrFail($id);
        $tag->delete();
        $data = [
            'data' => $tag
        ];
        return response()->json($data);
    }
}

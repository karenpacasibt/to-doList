<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    public function index()
    {
        $tags = Tag::all();
        $data = [
            "data" => $tags
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|unique:tags,name"
        ]);
        $tag = new Tag();
        $tag->name = $validated["name"];
        $tag->user_id = auth()->id();
        $tag->save();
        return response()->json(['data' => $tag], 200);
    }

    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return response()->json(['data' => $tag], 200);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'string',
            Rule::unique('tags')->ignore($id),
        ]);
        $tag->name = $validated['name'];
        $tag->save();
        return response()->json(['data' => $tag], 201);
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return response()->json(['data' => $tag], 201);
    }
}
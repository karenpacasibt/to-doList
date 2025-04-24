<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $data = [
            'data' => $categories
        ];
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string'
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->save();
        return response()->json(['data' => $category], 201);

    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $data = [
            'data' => $category
        ];
        return response()->json($data, 200);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(404);
        }
        $validated = $request->validate([
            'name' => 'string'
        ]);
        $category->name = $request->name;
        $category->save();
        $data = [
            'data' => $category
        ];
        return response()->json($data, 201);
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $data = [
            'data' => $category
        ];
        return response()->json($data);
    }
}

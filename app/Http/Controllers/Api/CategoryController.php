<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name'
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
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('categories')->ignore($id)
            ]
        ]);
        $category->name = $validated['name'];
        $category->save();
        $data = [
            'data' => $category
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $data = [
            'data' => $category
        ];
        return response()->json($data, 201);
    }
}

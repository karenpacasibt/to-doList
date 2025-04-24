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
        try {
            $category = new Category();
            $category->name = $validated['name'];
            $category->save();
            return response()->json(['data' => $category], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la categoria'], 500);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            $data = [
                'message' => 'Estudiante no encontrado'
            ];
            return response()->json($data, 404);
        }
        $data = [
            'category' => $category
        ];
        return response()->json($data, 200);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            $data = [
                'message' => 'Estudiante no encontrado'
            ];
            return response()->json($data, 404);
        }
        $validated = $request->validate([
            'name' => 'string'
        ]);
        $category->name = $request->name;
        $category->save();
        $data = [
            'message' => 'Categoria actualizado',
            'data' => $category
        ];
        return response()->json($data, 200);
    }
}

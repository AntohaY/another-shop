<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(),200);
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'category_name' => $request->category_name,
        ]);



        return response()->json([
            'status' => (bool) $category,
            'data'   => $category,
            'message' => $category ? 'Category Created!' : 'Error Creating Category'
        ]);
    }

    /// Returning all products in a certain category.
    ///

    public function show(Category $category)
    {
        $category_name = $category->only('category_name');


        $products = DB::table('products')->where('category_name', $category_name)->get();


        return response()->json($products,200);
    }


    public function update(Request $request, Category $category)
    {
        $status = $category->update(
            $request->only(['category_name'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Category Updated!' : 'Error Updating Category'
        ]);
    }

    public function destroy(Category $category)
    {
        $status = $category->delete();

        return response()->json([
            'data' => Category::all(),
            'status' => $status,
            'message' => $status ? 'Category Deleted!' : 'Error Deleting Category'
        ]);
    }
}

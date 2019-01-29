<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Order;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'category_name' => $request->category_name,
            'description' => $request->description,
            'units' => $request->units,
            'price' => $request->price,
            'image' => $request->image
        ]);

        $category = Category::where('category_name', '=', $request->category_name)->first();
        if ($category === null) {
            Category::create([
               'category_name' => $request->category_name
            ]);
        }

        return response()->json([
            'status' => (bool) $product,
            'data' => Product::all(),
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }


    public function show(Product $product)
    {
        return response()->json($product,200);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('image')){
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"),201);
    }

    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name','category_name','description', 'units', 'price', 'image'])
        );

        $category = Category::where('category_name', '=', $request->category_name)->first();
        if ($category === null) {
            Category::create([
                'category_name' => $request->category_name
            ]);
        }

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }

    public function updateUnits(Request $request, Product $product)
    {
        $product->units = $product->units + $request->get('units');
        $status = $product->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
        ]);
    }

    public function destroy(Product $product)
    {
        $status = $product->delete();

        $product->delete();
        Order::where('product_id', $product->id)->delete();

        return response()->json([
            'data' => Product::all(),
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}

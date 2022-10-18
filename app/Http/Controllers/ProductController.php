<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use FileSaver;
    public function index() {
        $product = Product::with('product_images')->get();
        return response()->json([
            'status' => 200,
            'data' => $product
        ], 200);
    }

    public function insert(Request $request) {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'vat' => 'required',
            'discount' => 'required',
            'image' => 'required',
            'description' => 'required',
            'product_images' => 'nullable|array',
        ]);
        DB::beginTransaction();

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'vat' => $request->vat,
            'discount' => $request->discount,
            'image' => '',
            'description' => $request->description,
        ]);
        if ($request->image) {
            $this->upload_file($request->image, $product, 'image', 'products');
        }
        if ($request->product_images) {
            foreach ($request->product_images as $value) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $value,
                ]);
            }
        }

        DB::commit();

        return response()->json([
            'status' => 200,
            'data' => $product,
            'message' => 'Product inserted successfully'
        ], 200);
    }

    public function update(Request $request, Product $product) {
        DB::beginTransaction();

        $product->update($request->only([
            'name',
            'category_id',
            'brand_id',
            'price',
            'vat',
            'discount',
            'description',
        ]));
        if ($request->image) {
            $this->upload_file($request->image, $product, 'image', 'products');
        }

        DB::commit();

        return response()->json([
            'status' => 200,
            'data' => $product,
            'message' => 'Product updated successfully'
        ], 200);
    }

    public function delete($product) {
        $product = Product::find($product);
        if ($product) {
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted successfuly'
            ], 200);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Product not found'
        ], 404);
    }
}

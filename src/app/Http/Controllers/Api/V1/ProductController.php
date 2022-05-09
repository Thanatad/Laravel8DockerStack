<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Product\ProductCollection;
use App\Http\Resources\V1\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;

        if ($request->input('get') == 'all') (int)$perPage = 999999999;

        return response(new ProductCollection(Product::paginate($perPage)));
    }

    public function store(Request $request)
    {

        $user = auth()->user();

        if ($this->user->tokenCan("1")) {

            $request->validate([
                'name' => 'required|min:3',
                'slug' => 'required',
                'price' => 'required'
            ]);

            $data = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'slug' => $request->input('slug'),
                'price' => $request->input('price'),
                'user_id' => $user->id
            ];

            return response(new ProductResource(Product::create($data)));
        } else {
            return [
                'status' => 'permission denied to create',
            ];
        }
    }

    public function show($id)
    {
        return response(new ProductResource(Product::find($id)));
    }

    public function update(Request $request, $id)
    {

        if ($this->user->tokenCan('1')) {

            $product = Product::find($id);

            $request->has('name') ? $product->mobile = $request->name : '';
            $request->has('description') ? $product->description = $request->description : '';
            $request->has('slug') ? $product->slug = $request->slug : '';
            $request->has('price') ? $product->price = $request->price : '';
            $product->user_id = $this->user->id;

            $product->update();

            return response(new ProductResource($product));
        } else {
            return [
                'status' => 'Permission denied to update product'
            ];
        }
    }

    public function destroy($id)
    {
        if ($this->user->tokenCan('1')) {
            Product::destroy($id);
            return response(['success' => 'Successfully deleted'], 200);
        } else {
            return [
                'status' => 'Permission denied to delete product'
            ];
        }
    }
}

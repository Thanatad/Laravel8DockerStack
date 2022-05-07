<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {

        return Product::all();
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

            return Product::create($data);
        } else {
            return [
                'status' => 'permission denied to create',
            ];
        }
    }

    public function show($id)
    {
        return Product::find($id);
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

            return $product;
        } else {
            return [
                'status' => 'Permission denied to update product'
            ];
        }
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user **/

        if ($this->user->tokenCan('1')) {
            return Product::destroy($id);
        } else {
            return [
                'status' => 'Permission denied to delete product'
            ];
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\Product\ProductCreatedEvent;
use App\Events\Product\ProductRemovedEvent;
use App\Events\Product\ProductUpdatedEvent;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('products/index', [
            'data' => Product::orderBy('diamantes')->paginate(16)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return Inertia::render('products/edit', [
            'data' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->price = $request->input('price');
        $product->diamantes = $request->input('diamantes');
        $product->bonus = $request->input('bonus');
        $product->save();

        ProductCreatedEvent::dispatch($product);

        return Redirect::route('products.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->price = $request->input('price');
        $product->diamantes = $request->input('diamantes');
        $product->bonus = $request->input('bonus');
        $product->save();

        ProductUpdatedEvent::dispatch($product);

        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        ProductRemovedEvent::dispatch($product);

        $product->delete();

        return Redirect::route('products.index');
    }
}

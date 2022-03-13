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
            'data' => Product::orderBy('name')->paginate(16)
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
        $topic = Product::findOrFail($id);

        return Inertia::render('products/edit', [
            'data' => $topic
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
        $topic = new Product;
        $topic->name = $request->input('name');
        $topic->save();

        ProductCreatedEvent::dispatch($topic);

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
        $topic = Product::findOrFail($id);
        $topic->name = $request->input('name');
        $topic->save();

        ProductUpdatedEvent::dispatch($topic);

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
        $topic = Product::findOrFail($id);

        ProductRemovedEvent::dispatch($topic);

        $topic->delete();

        return Redirect::route('products.index');
    }
}

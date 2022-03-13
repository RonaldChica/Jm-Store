<?php

namespace App\Http\Controllers;

use App\Events\Recarga\RecargaCreatedEvent;
use App\Events\Recarga\RecargaRemovedEvent;
use App\Events\Recarga\RecargaUpdatedEvent;
use App\Http\Requests\RecargaRequest;
use App\Models\Product;
use App\Models\Recarga;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RecargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('recargas/index', [
            'data' => Product::orderBy('diamantes')->paginate(5)
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
        $recarga = Product::findOrFail($id);

        return Inertia::render('recargas/edit', [
            'data' => $recarga
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\RecargaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecargaRequest $request)
    {
        $recarga = new Recarga;
        $recarga->playerId = $request->input('playerId');
        $recarga->save();

        RecargaCreatedEvent::dispatch($recarga);

        return Redirect::route('recargas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recarga = Recarga::with(['products', 'users'])->find($id);

        return Inertia::render('recargas/show', [
            'data' => $recarga
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\RecargaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecargaRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);
        $recarga = new Recarga;

        $recarga->playerId = $request->input('playerId');
        $recarga->product_id = $id;
        $recarga->user_id = $user->id;

        $user->saldo -= $product->price;

        $user->save();
        $recarga->save();

        RecargaCreatedEvent::dispatch($recarga);

        return Redirect::route('recargas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recarga = Recarga::findOrFail($id);

        RecargaRemovedEvent::dispatch($recarga);

        $recarga->delete();

        return Redirect::route('recargas.index');
    }
}

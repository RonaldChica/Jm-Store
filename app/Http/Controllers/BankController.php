<?php

namespace App\Http\Controllers;

use App\Events\Bank\BankCreatedEvent;
use App\Events\Bank\BankRemovedEvent;
use App\Events\Bank\BankUpdatedEvent;
use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('banks/index', [
            'data' => Bank::orderBy('diamantes')->paginate(16)
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
        $deposit = Bank::findOrFail($id);

        return Inertia::render('banks/edit', [
            'data' => $deposit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {
        $deposit = new Bank;
        $deposit->price = $request->input('price');
        $deposit->diamantes = $request->input('diamantes');
        $deposit->bonus = $request->input('bonus');
        $deposit->save();

        BankCreatedEvent::dispatch($deposit);

        return Redirect::route('banks.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BankRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, $id)
    {
        $deposit = Bank::findOrFail($id);
        $deposit->price = $request->input('price');
        $deposit->diamantes = $request->input('diamantes');
        $deposit->bonus = $request->input('bonus');
        $deposit->save();

        BankUpdatedEvent::dispatch($deposit);

        return Redirect::route('banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deposit = Bank::findOrFail($id);

        BankRemovedEvent::dispatch($deposit);

        $deposit->delete();

        return Redirect::route('banks.index');
    }
}

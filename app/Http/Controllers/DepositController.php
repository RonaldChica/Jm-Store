<?php

namespace App\Http\Controllers;

use App\Events\Deposit\DepositCreatedEvent;
use App\Events\Deposit\DepositRemovedEvent;
use App\Events\Deposit\DepositUpdatedEvent;
use App\Http\Requests\DepositRequest;
use App\Models\Bank;
use App\Models\Deposit;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('deposits/index', [
            'data' => Deposit::orderBy('id')->paginate(16),
            'banks' => Bank::orderBy('name')->paginate(16),
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
        $deposit = Deposit::findOrFail($id);

        return Inertia::render('deposits/edit', [
            'data' => $deposit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DepositRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepositRequest $request)
    {
        $deposit = new Deposit;
        $deposit->price = $request->input('price');
        $deposit->diamantes = $request->input('diamantes');
        $deposit->bonus = $request->input('bonus');
        $deposit->save();

        DepositCreatedEvent::dispatch($deposit);

        return Redirect::route('deposits.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\DepositRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepositRequest $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->price = $request->input('price');
        $deposit->diamantes = $request->input('diamantes');
        $deposit->bonus = $request->input('bonus');
        $deposit->save();

        DepositUpdatedEvent::dispatch($deposit);

        return Redirect::route('deposits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deposit = Deposit::findOrFail($id);

        DepositRemovedEvent::dispatch($deposit);

        $deposit->delete();

        return Redirect::route('deposits.index');
    }
}

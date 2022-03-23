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
            'data' => Bank::orderBy('name')->paginate(16)
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
        $bank = Bank::findOrFail($id);

        return Inertia::render('banks/edit', [
            'data' => $bank
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
        $bank = new Bank;
        $bank->name = $request->input('name');
        $bank->save();

        BankCreatedEvent::dispatch($bank);

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
        $bank = Bank::findOrFail($id);
        $bank->name = $request->input('name');
        $bank->save();

        BankUpdatedEvent::dispatch($bank);

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
        $bank = Bank::findOrFail($id);

        BankRemovedEvent::dispatch($bank);

        $bank->delete();

        return Redirect::route('banks.index');
    }
}

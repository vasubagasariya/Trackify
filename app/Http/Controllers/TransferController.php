<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transfer;
use App\Services\BalanceService;


class TransferController extends Controller
{
    function show(){
        $transfers = Transfer::with(['fromAccount', 'toAccount'])->get();
        return view('transfer.show',compact('transfers'));
    }

    function create(){
        $data = Account::all();
        return view('transfer.create',compact('data'));
    }

    function store(Request $req){
        $req->validate([
            'amount' => 'required',
            'description' => 'required',
            'transfer_date' => 'required'
        ]);
        
        $from = Account::where('id',$req->from_account)->firstOrFail();
        $to = Account::where('id',$req->to_account)->firstOrFail();
        
        if($from->current_balance < $req->amount){
            return "Insufficien balance";
        }
        Transfer::create($req->all());
        
        BalanceService::updateCurrentBalance();
        return redirect()->route('transfers.show');
    }

    function edit($id){
        $transfer = Transfer::with(['fromAccount','toAccount'])->find($id);
        $data = Account::all();
        return view('transfer.edit',compact('data','transfer'));
    }

    function update(Request $req,$id){
        $req->validate([
            'amount' => 'required',
            'description' => 'required',
            'transfer_date' => 'required'
        ]);
        $transfer = Transfer::findOrFail($id);
        
        $transfer->from_account = $req->from_account;
        $transfer->to_account = $req->to_account;
        $transfer->amount = $req->amount;
        $transfer->description = $req->description;
        $transfer->transfer_date = $req->transfer_date;
        $transfer->save();
        BalanceService::updateCurrentBalance();
        return redirect()->route('transfers.show');    
    }

    function delete($id){
        Transfer::find($id)->delete();
        BalanceService::updateCurrentBalance();
        return redirect()->route('transfers.show');
    }
}


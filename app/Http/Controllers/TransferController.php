<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transfer;


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
        
        $from->current_balance = $from->current_balance - $req->amount;
        $to->current_balance = $to->current_balance + $req->amount;
        
        $from->save();
        $to->save();


        return redirect()->route('transfers.show');
    }
    function edit(){
        return 'edit';
    }
    function update(){

    }
    function delete($id){
        Transfer::find($id)->delete();
        $transfers = Transfer::with(['fromAccount', 'toAccount'])->get();

        return redirect()->route('transfers.show',compact('transfers'));
    }
}


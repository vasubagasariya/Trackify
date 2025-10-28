<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;

class TransactionController extends Controller
{
    // display transactions page
    function show(){
        $data = Transaction::with('account')->get();
        return view('transactions.show',compact('data'));
    }

    //dislay create page
    function create(){
        $data = Account::all();
        return view('transactions.create',compact('data'));
    }
    
    // create page stores
    function store(Request $req){
        $req->validate([
            'amount'=> 'required',
            'category' => 'required',
            'description' => 'required',
            'transaction_date' => 'required'
        ]);
        $account = Account::find($req->account_id);
        $lastTransaction = $account->transactions()->latest('id')->first();

        if($lastTransaction){
            $balance = $lastTransaction->remaining_balance;
        }
        else{
            $balance = $account->opening_balance;
        }

        if($req->input('credit/debit') == 'debit'){
            $remaining = $balance - $req->input('amount');
        }
        else{
            $remaining = $balance + $req->input('amount');
        }
        Transaction::create([
            'accounts_id' => $req->account_id,
            'amount' => $req->amount,
            'credit/debit' => $req->input('credit/debit'),
            'category' => $req->category,
            'description' => $req->description,
            'transaction_date' => $req->transaction_date,
            'remaining_balance' => $remaining
        ]);
        return redirect()->route('transactions.show');
    }
    
    //display update page
    function edit($id){
        $account = Account::all();
        $data = Transaction::find($id);
        return view('transactions.edit',compact('data','account'));
    }
    
    function update(Request $req, $id){
        return $req->all();
        $req->validate([
            'amount'=> 'required',
            'category' => 'required',
            'description' => 'required',
            'transaction_date' => 'required'
        ]);

        $transaction = Transaction::where('id',$id)->firstOrFail();
        $transaction->accounts_id = $req->account_id;
        $transaction->amount = $req->amount;
        $transaction->{'credit/debit'} = $req->input('credit/debit');
        $transaction->category = $req->category;
        $transaction->description = $req->description;
        $transaction->transaction_date = $req->transaction_date;
        $transaction->remaining_balance = $remaining;
        $transaction->save();
        return redirect()->route('transactions.show');
    }

    //delete
    function delete($id){
        // return $name;
        Account::where('name',$name)->delete();
        $data = Account::all();
        return view('transactions.show',compact('data'));
    }
}

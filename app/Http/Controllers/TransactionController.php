<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;

class TransactionController extends Controller
{
    // display transactions page
    function show(){
        $account = Account::all();
        $data = Transaction::with('account')->get();
        return view('transactions.show',compact('data','account'));
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
        $balance = $account->opening_balance;

        $rows = Transaction::where('accounts_id',$req->account_id)->get();
        foreach($rows as $row){
            $balance = $balance - $row->amount;
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
    
    // update data row
    function update(Request $req, $id){
        $req->validate([
            'amount'=> 'required',
            'category' => 'required',
            'description' => 'required',
            'transaction_date' => 'required'
        ]);

        // check transaction id in transaction table
        $transaction = Transaction::where('id',$id)->firstOrFail();

        // check debit or credit in previous table and manage remainning balance
        // netrual balnce of old account
        if($transaction->{'credit/debit'} == 'debit'){
            $transaction->remaining_balance = $transaction->remaining_balance + $transaction->amount;
        }
        else{
            $transaction->remaining_balance = $transaction->remaining_balance - $transaction->amount;
        }

        // check debit or credit in request
        if($req->input('credit/debit') == 'debit'){
            $remaining = $transaction->remaining_balance - $req->input('amount');
        }
        else{
            $remaining = $transaction->remaining_balance + $req->input('amount');
        }

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
        Transaction::find($id)->delete();
        $data = Transaction::with('account')->get();

        return redirect()->route('transactions.show',compact('data'));
    }
}

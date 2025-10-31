<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Transfer;
use App\Services\BalanceService;

class TransactionController extends Controller
{
    // display transactions page
    function show(){
        $transactions = Transaction::with('account')->get();
        return view('transactions.show',compact('transactions'));
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
        $lastTransaction = Transaction::where('account_id',$req->account_id)->latest('id')->first();
        if($lastTransaction){
            $balance = $lastTransaction->remaining_balance;
        }
        else{
            $balance = $account->opening_balance;
        }

        
        if($req->input('credit_debit') == 'Debit'){
            $remaining = $balance - $req->input('amount');
        }
        else{
            $remaining = $balance + $req->input('amount');
        }
        Transaction::create([
            'account_id' => $req->account_id,
            'amount' => $req->amount,
            'credit_debit' => $req->input('credit_debit'),
            'category' => $req->category,
            'description' => $req->description,
            'transaction_date' => $req->transaction_date,
            'remaining_balance' => $remaining
        ]);
        BalanceService::updateCurrentBalance();
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

        // return old record of id
        $transaction = Transaction::findOrFail($id);

        // reurn ols account d from transaction
        $oldAcccountId = $transaction->account_id;
        
        // save values
        $transaction->account_id = $req->account_id;
        $transaction->amount = $req->amount;
        $transaction->credit_debit = $req->credit_debit;
        $transaction->category = $req->category;
        $transaction->description = $req->description;
        $transaction->transaction_date = $req->transaction_date;
        $transaction->save();
    
        $account = Account::find($oldAcccountId);
            $balance = $account->opening_balance;
            $transactions = Transaction::where('account_id', $oldAcccountId)->get();
            
            foreach($transactions as $transaction){
                if($transaction->credit_debit == 'Debit'){
                    $balance = $balance - $transaction->amount;
                }
                else{
                    $balance = $balance + $transaction->amount;
                }
                $transaction->remaining_balance = $balance;
                $transaction->save();
            }

        // check debit or credit in previous table and manage remainning balance
        // netrual balnce of old account
        if($oldAcccountId != $req->account_id){
            $account = Account::find($req->account_id);
            $balance = $account->opening_balance;
            $transactions = Transaction::where('account_id', $req->account_id)->get();
            
            foreach($transactions as $transaction){
                if($transaction->credit_debit == 'Debit'){
                    $balance = $balance - $transaction->amount;
                }
                else{
                    $balance = $balance + $transaction->amount;
                }
                $transaction->remaining_balance = $balance;
                $transaction->save();
            }
        }
        BalanceService::updateCurrentBalance();
        
        return redirect()->route('transactions.show');
    }

    //delete
    function delete($id){
        Transaction::find($id)->delete();

        return redirect()->route('transactions.show');
    }
}

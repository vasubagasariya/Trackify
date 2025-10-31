<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\BalanceService;


class AccountController extends Controller
{
    // display accounts page
    function show(){
        BalanceService::updateCurrentBalance();
        $accounts = Account::all();
        return view('accounts.show',compact('accounts'));
    }

    //dislay create page
    function create(){
        return view('accounts.create');
    }

    // create page stores
    function store(Request $req){
        
        $req->validate([
            'name'=> 'required|alpha',
            'type'=> 'required',
            'opening_balance' => 'required | numeric',
            'opening_date' => 'required'
        ]);
        Account::create($req->all());
        return redirect()->route('accounts.show');
    }

    //display update page
    function edit($name){
        $data = Account::where('name',$name)->firstOrFail();
        return view('accounts.edit',compact('data'));
    }

    //update data
    function update(Request $req, $name){
        $req->validate([
            'name'=> 'required|alpha',
            'type'=> 'required',
            'opening_balance' => 'required',
            'opening_date' => 'required'
        ]);

        $account = Account::where('name',$name)->firstOrFail();
        $account->name = $req->name;
        $account->type = $req->type;
        $account->opening_balance = $req->opening_balance;
        $account->opening_date = $req->opening_date;

        $account->save();
        // Account::update();
        return redirect()->route('accounts.show');
    }

    //delete
    function delete($name){
        Account::where('name',$name)->delete();
        return redirect()->route('accounts.show');
    }



    
}

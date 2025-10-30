@extends('layout.main')
@section('title', 'Create new Transaction')
@section('main')

<form action="{{route('transactions.store')}}" method="post" class="bg-dark p-4 rounded text-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="account_id" class="form-label">Account : </label>
        <select name="account_id" class="form-select">
            @foreach($data as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label for="amount" class="form-label">Amount : </label>
        <input type="number" step="0.01" name="amount" class="form-control" placeholder="e.g. 1000.00">
    </div>

    <div class="mb-3">
        <label for="credit_debit" class="form-label">Credit / Debit : </label>
        <select name="credit_debit" class="form-select">
            <option value="Credit">Credit</option>
            <option value="Debit">Debit</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category : </label>
        <input type="text" name="category" class="form-control" placeholder="e.g. travel, food, home, recharge">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description : </label>
        <input type="text" name="description" class="form-control" placeholder="e.g. brts, metro, dosa, dabeli, vadapav">
    </div>
    
    <div class="mb-3">
        <label for="transaction_date" class="form-label">Transaction Date : </label>
        <input type="date" name="transaction_date" class="form-control">
    </div>
    
    
    <button class="btn btn-primary w-100 mt-3">Add Transaction</button>
    
</form>
@endsection 

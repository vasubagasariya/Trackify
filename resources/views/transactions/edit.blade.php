@extends('layout.main')
@section('title', 'Update transaction')
@section('main')

<form action="{{route('transactions.update',$data->id)}}" method="post" class="bg-dark p-4 rounded text-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="account_id" class="form-label">Account : </label>
        <select name="account_id" class="form-select">
            @foreach($account as $d)
                <option value="{{$d->id}}" 
                    @if( $data->accounts_id == $d->id) selected @endif>
                    {{$d->name}}
                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label for="amount" class="form-label">Amount : </label>
        <input type="number" step="0.01" name="amount" class="form-control" placeholder="e.g. 1000.00" value='{{$data->amount}}'>
    </div>

    <div class="mb-3">
        <label for="credit/debit" class="form-label">Credit / Debit : </label>
        <select name="credit/debit" class="form-select">
            <option value="credit" @if($data->{'credit/debit'} == 'credit') selected @endif>Credit</option>
            <option value="debit" @if($data->{'credit/debit'} == 'debit') selected @endif>Debit</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category : </label>
        <input type="text" name="category" class="form-control" placeholder="e.g. travel, food, home, recharge" value='{{$data->category}}'>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description : </label>
        <input type="text" name="description" class="form-control" placeholder="e.g. brts, metro, dosa, dabeli, vadapav" value='{{$data->description}}'>
    </div>
    
    <div class="mb-3">
        <label for="transaction_date" class="form-label">Transaction Date : </label>
        <input type="date" name="transaction_date" class="form-control" value='{{$data->transaction_date}}'>
    </div>
    
    
    <button class="btn btn-primary w-100 mt-3">Add Transaction</button>
    
</form>
@endsection 

@extends('layout.main')
@section('title', 'Create new account')
@section('main')

<form action="{{route('accounts.store')}}" method="post" class="bg-dark p-4 rounded text-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name : </label>
        <input type="text" name="name" class="form-control" placeholder="Enter account name">
    </div>
    
    <div class="mb-3">
        <label for="type" class="form-label">Type : </label>
        <select name="type" class="form-select">
            <option value="cash">Cash</option>
            <option value="bank">Bank</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="opening_balance" class="form-label">Opening balance : </label>
        <input type="number" step="0.01" name="opening_balance" class="form-control" placeholder="e.g. 1000.00">
    </div>
    
    <div class="mb-3">
        <label for="opening_date" class="form-label">Opening Date : </label>
        <input type="date" name="opening_date" class="form-control">
    </div>

    <button class="btn btn-primary w-100 mt-3">Add Account</button>
    
</form>

@endsection

@extends('layout.main')
@section('title', 'Update account')
@section('main')

<form action="{{route('accounts.update',$data->name)}}" method="post" class="bg-dark p-4 rounded text-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name : </label>
        <input type="text" name="name" value='{{$data->name}}' class="form-control" placeholder="Enter account name">
    </div>
    
    <div class="mb-3">
        <label for="type" class="form-label">Type : </label>
        <select name="type" class="form-select">
            <option value="Cash" @if($data->type == 'Cash') selected @endif> Cash</option>
            <option value="Bank" @if($data->type == 'Bank') selected @endif> Bank</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label for="opening_balance" class="form-label">Opening balance : </label>
        <input type="number" step="0.01" name="opening_balance" class="form-control" value='{{$data->opening_balance}}' >
    </div>
    
    <div class="mb-3">
        <label for="opening_date" class="form-label">Opening Date : </label>
        <input type="date" name="opening_date" class="form-control" value='{{$data->opening_date}}'>
    </div>

    <button class="btn btn-primary w-100 mt-3">Update Account</button>


</form>
@endsection
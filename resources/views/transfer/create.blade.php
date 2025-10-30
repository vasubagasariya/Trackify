@extends('layout.main')
@section('title', 'Create new Transaction')
@section('main')

<form action="{{route('transfers.store')}}" method="post" class="bg-dark p-4 rounded text-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="from_account" class="form-label">From Account : </label>
        <select name="from_account" class="form-select">
            @foreach($data as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="to_account" class="form-label">To Account : </label>
        <select name="to_account" class="form-select">
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
        <label for="description" class="form-label">Description : </label>
        <input type="text" name="description" class="form-control" placeholder="e.g. brts, metro, dosa, dabeli, vadapav">
    </div>
    
    <div class="mb-3">
        <label for="transfer_date" class="form-label">Transfer Date : </label>
        <input type="date" name="transfer_date" class="form-control">
    </div>
    
    
    <button class="btn btn-primary w-100 mt-3">Add Transfer</button>
    
</form>

@endsection 

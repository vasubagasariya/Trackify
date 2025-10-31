@extends('layout.main')
@section('title', 'Update Transfer')
@section('main')

<form action="{{route('transfers.update',$transfer->id)}}" method="post" class="bg-dark p-4 rounded text-light shadow-sm">
    @csrf
    <div class="mb-3">
        <label for="from_account" class="form-label">From Account : </label>
        <select name="from_account" class="form-select">
            @foreach($data as $d)
                <option value="{{$d->id}}" @if($transfer->from_account == $d->id) selected @endif>{{$d->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="to_account" class="form-label">To Account : </label>
        <select name="to_account" class="form-select">
            @foreach($data as $d)
                <option value="{{$d->id}}" @if($transfer->to_account == $d->id) selected @endif >{{$d->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label for="amount" class="form-label">Amount : </label>
        <input type="number" step="0.01" name="amount" class="form-control" placeholder="e.g. 1000.00" value="{{$transfer->amount}}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description : </label>
        <input type="text" name="description" class="form-control" placeholder="e.g. brts, metro, dosa, dabeli, vadapav" value="{{$transfer->description}}">
    </div>
    
    <div class="mb-3">
        <label for="transfer_date" class="form-label">Transfer Date : </label>
        <input type="date" name="transfer_date" class="form-control" value="{{$transfer->transfer_date}}">
    </div>
    
    
    <button class="btn btn-primary w-100 mt-3">Add Transfer</button>
    
</form>

@endsection 

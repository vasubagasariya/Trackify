@extends('layout.main')
@section('title', 'Transactions')
@section('main')
<a href="{{route('transactions.create')}}" class="btn btn-primary mb-3">Create New Transaction</a>
<table class="table table-dark table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>Accounts id</th>
        <th>Amount</th>
        <th>Credit / Debit</th>
        <th>Category</th>
        <th>Description</th>
        <th>Transaction date</th>
        <th>Remaining balance</th>
        <th>Actions</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->account->name}}</td>
        <td>{{$d->amount}}</td>
        <td>{{$d->{'credit/debit'} }}</td>
        <td>{{$d->category}}</td>
        <td>{{$d->description}}</td>
        <td>{{$d->transaction_date}}</td>
        <td>{{$d->remaining_balance}}</td>
        <td>
            <a href="{{route('transactions.edit',$d->id)}}" class="btn btn-sm btn-warning btn-action me-1">Edit</a>
            <a href="{{route('transactions.delete',$d->id)}}" class="btn btn-sm btn-danger btn-action">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
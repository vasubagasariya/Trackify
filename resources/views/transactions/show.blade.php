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
    @foreach($transactions as $transaction)
    <tr>
        <td>{{$transaction->id}}</td>
        <td>{{$transaction->account->name}}</td>
        <td>{{$transaction->amount}}</td>
        <td>{{$transaction->credit_debit }}</td>
        <td>{{$transaction->category}}</td>
        <td>{{$transaction->description}}</td>
        <td>{{$transaction->transaction_date}}</td>
        <td>{{$transaction->remaining_balance}}</td>
        <td>
            <a href="{{route('transactions.edit',$transaction->id)}}" class="btn btn-sm btn-warning btn-action me-1">Edit</a>
            <a href="{{route('transactions.delete',$transaction->id)}}" class="btn btn-sm btn-danger btn-action">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
<BR><BR><BR></BR></BR></BR>

@endsection
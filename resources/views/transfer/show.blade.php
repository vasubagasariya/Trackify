@extends('layout.main')
@section('title', 'Transfers')
@section('main')
<a href="{{route('transfers.create')}}" class="btn btn-primary mb-3">Create New Transaction</a>
<table class="table table-dark table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>From Account</th>
        <th>To Account</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Transfer Date</th>
        <th>Actions</th>
    </tr>
    @foreach($transfers as $transfer)
    <tr>
        <td>{{$transfer->id}}</td>
        <td>{{$transfer->fromAccount->name ?? 'N/A'}}</td>
        <td>{{$transfer->toAccount->name}}</td>
        <td>{{$transfer->amount }}</td>
        <td>{{$transfer->description}}</td>
        <td>{{$transfer->transfer_date}}</td>
        <td>
            <a href="{{route('transfers.edit',$transfer->id)}}" class="btn btn-sm btn-warning btn-action me-1">Edit</a>
            <a href="{{route('transfers.delete',$transfer->id)}}" class="btn btn-sm btn-danger btn-action">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
<BR><BR><BR></BR></BR></BR>

@endsection
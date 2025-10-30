@extends('layout.main')
@section('title', 'Accounts')
@section('main')
<a href="{{route('accounts.create')}}" class="btn btn-primary mb-3">Create New Account</a>
<table class="table table-dark table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Opening Balance</th>
        <th>Expence</th>
        <th>Current Balance</th>
        <th>Opening Date</th>
        <th>Actions</th>
    </tr>
    @foreach($accounts as $d)
    <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->name}}</td>
        <td>{{$d->type}}</td>
        <td>{{$d->opening_balance}}</td>
        <td>{{$d->expence}}</td>
        <td>{{$d->current_balance}}</td>
        <td>{{$d->opening_date}}</td>
        <td>
            <a href="{{route('accounts.edit',$d->name)}}" class="btn btn-sm btn-warning btn-action me-1">Edit</a>
            <a href="{{route('accounts.delete',$d->name)}}" class="btn btn-sm btn-danger btn-action">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
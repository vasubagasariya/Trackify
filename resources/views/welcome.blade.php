@extends('layout.main')
@section('title', 'Dashboard')
@section('main')

<div class="d-flex flex-column justify-content-center align-items-center vh-100 text-center">
    <h1 class="mb-5 text-light">Trackify Dashboard</h1>

    <div class="d-flex flex-wrap justify-content-center gap-5">
        <a href="{{ route('accounts.show') }}" class="btn btn-primary btn-lg">Accounts</a>
        <a href="{{ route('transactions.show')}}" class="btn btn-success btn-lg">Transactions</a>
        <a href="{{ route('transfers.show')}}" class="btn btn-warning btn-lg">Transfers</a>
    </div>
</div>

@endsection

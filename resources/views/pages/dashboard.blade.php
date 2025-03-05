@extends('layouts.app')
@section('titulo', 'Dashboard')
@section('content')
    <h2>Dashboard</h2>
    <a href="{{ route('logout') }}">
        <button>Logout</button>
    </a>
@endsection
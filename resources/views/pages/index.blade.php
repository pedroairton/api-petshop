@extends('layouts.app')
@section('titulo', 'Home')
@section('content')
    <section class="page-index">
        <h1>index</h1>
        @isset($hello)
            <h1> {{ $hello }} </h1>
        @endisset
        @isset($users)
            @dump($users)
        @endisset
    </section>
@endsection

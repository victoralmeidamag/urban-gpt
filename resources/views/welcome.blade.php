@extends('layouts.app')

@section('title', 'Login')

@section('additional-styles')
@endsection

@section('content')
    Olá, {{Auth::user()->name}}
@endsection

@extends('layouts.app')

@section('content')
    <index-component user_id="{{\Illuminate\Support\Facades\Auth::id()}}"></index-component>
@endsection
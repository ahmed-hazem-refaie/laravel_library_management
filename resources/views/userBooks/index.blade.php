@extends('layouts.app')

@section('content')
{{--    {{ dd($userBooks) }}--}}
    <my-books-component user_id="{{\Illuminate\Support\Facades\Auth::id()}}"></my-books-component>
@endsection

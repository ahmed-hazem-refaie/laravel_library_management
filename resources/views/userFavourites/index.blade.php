@extends('layouts.app')

@section('content')
    {{--    {{ dd($userBooks) }}--}}
    <favorite-component user_id="{{\Illuminate\Support\Facades\Auth::id()}}"></favorite-component>
@endsection
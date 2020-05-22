@extends('layouts.app')

@section('content')
<h1>Users Graphs</h1>

@forelse ($www as $item)
    {{$item->sum('price')}}
@empty

@endforelse
<div style="width: 50%">
    {!! $usersChart->container() !!}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
</script>
@endsection


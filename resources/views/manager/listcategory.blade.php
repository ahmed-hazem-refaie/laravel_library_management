{{-- @extends('manager.user.index') --}}
@extends('layouts.app')

@section('content')
@isset($obj)


    {{ Form::model($obj,['route' => ['manager.category.update',$obj],'method'=>'put'])}}

    <div class="input-group mb-3">
        {!! Form::text('name', null, ['required'=>'true','class'=>"form-control",'placeholder'=>"Recipient's username",'aria-label'=>"Recipient's username", 'aria-describedby'=>"button-addon2"]) !!}
        <div class="input-group-append">
      {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button> --}}

      {!! Form::submit('ADD Category', ['class'=>'btn btn-outline-secondary','placeholder'=>"Recipient's username"]) !!}

    </div>
  </div>
{{ Form::close() }}
@endisset
<table class="table table-hover table-primary">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">action§</th>

      </tr>
    </thead>
    <tbody>
        {{-- {{$data}} --}}
        @forelse ($data as $item)

      <tr>
      <th scope="row">{{$item->id}}</th>
        <td>{{$item->name}}</td>
      <td><a class="btn btn-primary" href="{{route('manager.category.edit',$item->id)}}">Edit</a></td>
      <td>       {!! Form::open(['route' => ['manager.category.destroy',$item->id],'method'=>'delete']) !!}
        {!! Form::submit('Delet', ['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}</td>


    </tr>
        @empty

        @endforelse

    </tbody>
  </table>

  {{ Form::open(['route' => 'manager.category.store'])}}

    <div class="input-group mb-3">
        {!! Form::text('name', null, ['required'=>'true','class'=>"form-control",'placeholder'=>"Recipient's username",'aria-label'=>"Recipient's username", 'aria-describedby'=>"button-addon2"]) !!}
        <div class="input-group-append">
      {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button> --}}

      {!! Form::submit('ADD Category', ['class'=>'btn btn-outline-secondary','placeholder'=>"Recipient's username"]) !!}

    </div>
  </div>
{{ Form::close() }}
@endsection


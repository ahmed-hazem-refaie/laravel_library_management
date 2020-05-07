
@extends('layouts.app')


@section('content')



{{ Form::open(['route' => 'category.store'])}}

    <div class="input-group mb-3">
        {!! Form::text('name', null, ['class'=>"form-control",'placeholder'=>"Recipient's username",'aria-label'=>"Recipient's username", 'aria-describedby'=>"button-addon2"]) !!}
        <div class="input-group-append">
      {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button> --}}
      {!! Form::submit('ADD Category', ['class'=>'btn btn-outline-secondary','placeholder'=>"Recipient's username"]) !!}

    </div>
  </div>
{{ Form::close() }}

@endsection

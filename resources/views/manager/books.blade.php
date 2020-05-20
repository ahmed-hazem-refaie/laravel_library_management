


@extends('layouts.app')


@section('content')

@forelse ($books as $user)

    <div class="card" style="width: 18rem;">
        <div class="card-body">
        <img src="/myimages/{{$user->image}}" alt="">
          <h5 class="card-title">Book  Name: <li>{{ $user->bookName }}</li></h5>

        <h5 class="card-title">Book  count: <li>{{ $user->count }}</li></h5>

        <h5 class="card-title">Book  Price: <li>{{ $user->pricePerDay }}</li></h5>


        {!! Form::open(['route' => ['manager.book.destroy',$user->id],'method'=>'delete']) !!}
        <a href="/manager/book/{{ $user->id}}/edit" class="btn btn-primary">Go Update</a>

            {!!Form::submit('Delete Me!',['class'=>["btn btn-danger"]])!!}
        {!! Form::close() !!}
        </div>
      </div>
@empty
    <p>No users</p>
@endforelse


{{-- {{$books}} --}}
@endsection

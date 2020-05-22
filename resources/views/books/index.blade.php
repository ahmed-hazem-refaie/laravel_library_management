@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session()->has('success'))
        <div class="alert alert-success"> {{ session()->get('success') }} </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> {{$book->bookName}} </div>

                <div class="card-body">
                    <div style="float:right;">
                        @if ($like->count() > 0)
                        <i class="like fa fa-heart" style="font-size: 25px;color:red" data-book="{{$book->id}}"
                            data-user="{{\Auth::id()}}"></i>
                        @else
                        <i class="like fa fa-heart-o" style="font-size: 25px;color:red" data-book="{{$book->id}}"
                            data-user="{{\Auth::id()}}"></i>
                        @endif

                    </div>
                    <div class="card mb-3" style="max-width: 540px; border: none;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="/upload/{{$book->image}}" class="card-img" alt="...">
                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$book->bookName}}</h5>
                                    <p class="card-text">{{$book->description}}</p>
                                    <p class="card-text"><small class="text-muted">Last updated
                                            {{\Carbon\Carbon::parse($book->created_at)->diffForHumans()}}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Comment Section -->
                    <div>

                        <div class="form-row">
                            {!! Form::open(['route' => 'bookComment.store']) !!}
                            <div class="col-md-9">
                                {!! Form::hidden('book_id', $book->id) !!}
                                {!! Form::hidden('user_id', Auth::id()) !!}
                                {!! Form::textarea('comment',null,['class'=>'form-control','rows'=>3,
                                'placeholder'=>'Please enter your comment']) !!}
                                {!! Form::submit('Add Comment',['class'=>'btn btn-success mt-3']) !!}
                            </div>
                            {!! Form::close() !!}
                            <div class="col-md-3 ml-5 mt-3">
                                @if ($rate->count() > 0)
                                @for ($i = 1; $i <= $rate[0]->rate; $i++)
                                    <i class="rate fa fa-star" style="font-size: 20px;color:gold" data-rate="{{$i}}"
                                        data-book="{{$book->id}}">
                                    </i>
                                    @endfor
                                    @for ($i = ($rate[0]->rate+1); $i <= 5; $i++) <i class="rate fa fa-star-o"
                                        style="font-size: 20px;color:gold" data-rate="{{$i}}" data-book="{{$book->id}}">
                                        </i>
                                        @endfor
                                        @else
                                        @for ($i = 0; $i < 5; $i++) <i class="rate fa fa-star-o"
                                            style="font-size: 20px;color:gold" data-rate="{{$i+1}}"
                                            data-book="{{$book->id}}">
                                            </i>
                                            @endfor
                                            @endif

                            </div>
                        </div>

                    </div>


                    <!-- List All Comments Section -->
                    <div class="mt-5">
                        <div class="list-group">
                            @forelse ($comments as $comment)
                            <span class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$comment->user->name}}</h5>
                                    <small>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</small>
                                </div>
                                <p class="mb-1">{{$comment->comment}}</p>
                            </span>
                            @empty
                            <p>There Is No Comments ... !</p>
                            @endforelse

                        </div>
                    </div>


                    <!-- Related Books Slider -->
                    <div class="mt-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                @foreach ($related as $index => $item)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$index +1}}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="/book/{{$book->id}}">
                                        <img src="/upload/{{$book->image}}" class="d-block w-100" alt="...">
                                    </a>
                                </div>
                                @foreach ($related as $item)
                                <div class="carousel-item">
                                    <a href="/book/{{$item->id}}">
                                        <img src="/upload/{{$item->image}}" class="d-block w-100" alt="...">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>




</script>
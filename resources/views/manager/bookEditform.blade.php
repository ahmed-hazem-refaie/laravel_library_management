
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" >

@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('css/scribt.js') }}"></script>
@endpush
@extends('layouts.app')


@section('content')


{{ Form::open(['route' => 'manager.category.store'])}}

    <div class="input-group mb-3">
        {!! Form::text('name', null, ['required'=>'true','class'=>"form-control",'placeholder'=>"Recipient's username",'aria-label'=>"Recipient's username", 'aria-describedby'=>"button-addon2"]) !!}
        <div class="input-group-append">
      {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button> --}}

      {!! Form::submit('ADD Category', ['class'=>'btn btn-outline-secondary','placeholder'=>"Recipient's username"]) !!}

    </div>
  </div>
{{ Form::close() }}

sssssss {{$mybook->image}}

{{ Form::model($mybook,['route' => ['manager.book.update',$mybook],'method'=>'put'])}}

<div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
                @if ($mybook->image)
                <img src="/myimages/{{ $mybook->image }}" alt="https://img.freepik.com/free-vector/abstract-book-pencil-logo_10724-10.jpg?size=338&ext=jpg" alt="image" class="imgweb" title="ggx">

                @else
                <img src="https://img.freepik.com/free-vector/abstract-book-pencil-logo_10724-10.jpg?size=338&ext=jpg" alt="image" class="imgweb" title="ggx"/>

                @endif

				<h2>Contact Us</h2>
				<h4>We would love to hear from you !</h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-3" for="fname">Book Name:</label>
				  <div class="col-sm-10">
                    {!! Form::text('bookName', null, ['required'=>'true','class'=>"form-control",'placeholder'=>"Book Name",'aria-label'=>"Book Nmae",'id'=>"fname"]) !!}

					{{-- <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname"> --}}
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-4" for="lname">Book Author Name:</label>
				  <div class="col-sm-10">
                    {!! Form::text('author', null, ['required'=>'true','class'=>"form-control",'placeholder'=>"Book Author",'aria-label'=>"Book Author Nmae",'id'=>"lname"]) !!}
                    <br>
                    <div class="row">
                        <label class="control-label col-sm-2" for="lname">Price/Day:</label>
                    <br>
                         {!! Form::number('pricePerDay', null, ['required'=>'true','class'=>"col-sm-2 form-control",'placeholder'=>"Price Day",'aria-label'=>"Book Nmae",'id'=>"lname1"]) !!}
                         {!! Form::number('count', null, ['required'=>'true','class'=>"col-offset-2 col-sm-2 form-control",'placeholder'=>"Count",'aria-label'=>"Book Nmae",'id'=>"count",'tybe'=>'number']) !!}

                    </div>
					{{-- <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname"> --}}
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="email">Category:</label>
				  <div class="col-sm-10">
                      {{ Form::select('category_id', $categories, null, ['class'=>'form-control','required'=>'true']) }}

					{{-- <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"> --}}
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="comment">Comment:</label>
				  <div class="col-sm-10">
                      {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>"5", 'id'=>"comment"]) !!}
				  </div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-10">
                    {{-- <button type="submit" class="btn btn-default">Submit</button> --}}
                    {!! Form::submit('Edit Book', ['class'=>'btn btn-default btn btn-outline-secondary']) !!}
                    <img src="/myimages/{{ $mybook->image }}" alt="jj" title="ggx">

				  </div>
				</div>
			</div>
		</div>
	</div>
</div>


{{ Form::close() }}




@endsection


{{-- $table->string('bookName')->nullable();

$table->unsignedInteger('pricePerDay')->nullable();

$table->string('author')->nullable();
$table->unsignedInteger('count')->nullable();

$table->text('description')->nullable();
$table->string('image')->nullable();






$table->unsignedBigInteger('category_id');
$table->unsignedBigInteger('user_id'); --}}

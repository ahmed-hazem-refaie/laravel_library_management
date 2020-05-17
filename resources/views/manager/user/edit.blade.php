@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header text-white bg-dark">Edit  <sapn class="font-weight-bold">{{ $user->name}}</sapn></div>

                <div class="card-body">
                    
                <form action="{{ route('manager.user.update',$user)}}" method="POST">
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
    
                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required  autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @csrf
                    {{ method_field('PUT')}} 
                    <div class="form-group row">
                        <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                        <div class="col-md-6">
                            @foreach ($roles as $role)
                            <div class="form-check">
                            <input type="checkbox" value="{{ $role->id }}" name="roles[]"
                            @if($user->roles->pluck('id')->contains($role->id)) checked @endif >
                                    <label>{{ $role->name}}</label>
                                    {{-- {{ dd($role)}} --}}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary ">update</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

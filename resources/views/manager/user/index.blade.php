@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-primary">Manager Control</div>

                <div class="card-body">
                    
                    <table class="table table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id}}</th>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>

                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    
                                    <td>
                                        @can('edit-users')
                                            <a href="{{ route('manager.user.edit',$user->id) }}">
                                                <button type="button" class="btn btn-primary float-left mr-3" >Edit</button>
                                            </a>
                                        @endcan
                                        @can('delete-users')
                                            <form action="{{ route('manager.user.destroy' , $user)}}" method="POST" class="float-left">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger ">Delete</button>
                                            </form>
                                        @endcan
                                        
                                        
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

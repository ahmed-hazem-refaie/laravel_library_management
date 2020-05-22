@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-12">
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
                            <th scope="col">isActive</th>
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
                                            <form action="{{ route('manager.user.destroy' , $user)}}" method="POST" class="float-left mr-3">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger ">Delete</button>

                                            </form>
                                        @endcan




                                    </td>
                                    {{-- <td>
                                        <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                                         data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive"
                                         {{ $user->isActive ? 'checked' : '' }}>
                                     </td> --}}
                                    <td class="bg-secondary">
                                        <span >
                                            <input type="checkbox" data-id="{{ $user->id }}" name="isActive" class="js-switch" {{ $user->isActive == 1 ? 'checked' : '' }}>
                                        </span>
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
<br>
<br>
<br>

@yield('name')

{{-- <script>
    $(function() {
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus',
              data: {'isActive': status, 'user_id': user_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script> --}}


@endsection


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'medium' });
    });

    $(document).ready(function(){
    $('.js-switch').change(function () {
        let isActive = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('users.update.status') }}',
            data: {'isActive': isActive, 'id': userId},
            success: function (data) {
                console.log(data.message);
                console.log( data);
            }
        });
        $.ajax('http://localhost:8000/status/update').then(a=>console.log(a))
        $.ajax('http://localhost:8000/status/update',{'isActive': isActive, 'id': userId}).then(a=>console.log(a))
    });
});

    </script>


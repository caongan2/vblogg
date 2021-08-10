@extends('layout.master')
@section('title', 'Danh sách người dùng')
@section('content')
    <div class="card">
        <div class="btn btn-secondary">
            <h3 class="card-title">Users</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr id="user-{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td><img src="{{asset('storage/'. $user->img)}}" style="width: 100px" alt="error"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            @forelse($user->roles as $role)
                                {{ $role->name . ', ' }}
                            @empty
                                User
                            @endforelse
                        </td>
                        <td>
                            <a href="{{route('user.profile', $user->id)}}" class="btn btn-primary form-control">View</a>
                            @can('crud')
                                <a href="{{route('user.edit', $user->id)}}"
                                   class="btn btn-primary form-control">Update</a>
                                <button type="button" data-id="{{$user->id}}" onclick="return confirm('Are you sure?')"
                                        class="delete-user btn btn-danger form-control">Delete
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    {{--    {{$users->links()}}--}}
@endsection

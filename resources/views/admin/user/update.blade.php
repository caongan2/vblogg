@extends('layout.master')
@section('title', 'Cập nhật thông tin người dùng')
@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Update Information</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <form action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Username</label>
                    <input type="text" value="{{$user->name}}" name="name" id="inputName"
                           class="@error('name')is-invalid @enderror form-control">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputClientCompany">Email</label>
                    <input type="email" value="{{$user->email}}" id="inputClientCompany" name="email"
                           class="@error('email')is-invalid @enderror form-control">
                    @error('email')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputDescription">Number phone</label>
                    <input type="number" value="{{$user->phone}}" name="phone" id="inputDescription"
                           class="@error('phone')is-invalid @enderror form-control">
                    @error('phone')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputDescription">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" value="{{$user->password}}" id="inputClientCompany" name="password"
                               class="@error('password')is-invalid @enderror form-control">
                        {{--                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">--}}
                        {{--                            <span class="fas fa-eye-slash"></span>--}}
                        {{--                        </button>--}}
                    </div>
                    @error('password')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputDescription">Address</label>
                    <input type="text" value="{{$user->address}}" name="address" id="inputDescription"
                           class="@error('address')is-invalid @enderror form-control">
                    @error('address')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputDescription">Image</label>
                    <input type="file" value="}" name="image" id="image"
                           class="form-control">
                </div>
                @can('crud')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10 ">
                        @foreach($roles as $role)
                            <div class="form-check mt-2">
                                <input class="form-check-input" name="roles[{{$role->id}}]" type="checkbox"
                                       value="{{$role->id}}" id="roleCheck{{$role->id}}">
                                <label class="form-check-label" for="roleCheck{{$role->id}}">
                                    {{ $role->name }}
                                </label>
                            </div>

                        @endforeach
                    </div>
                </div>
                @endcan
                <button type="submit" class="btn btn-success">Accept</button>
                <a href="{{route('home')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
@endsection

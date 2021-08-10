@extends('layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Products list</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @can('crud')
                    <h6 class="m-0 font-weight-bold text-primary">
                        <a class="btn btn-success" href="{{route('product.create')}}">Them moi</a>
                    </h6>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Shop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr id="product-{{$product->id}}">
                                <td>{{ $product->id }}</td>
                                <td><img src="{{asset('storage/'. $product->img)}}" style="width: 100px" alt="error">
                                </td>
                                <td><h4>{{ $product->name }}</h4></td>
                                <td>${{ $product->price}}</td>
                                <td>{{ $product->user->name}}</td>
                                <td>
                                    @cannot('crud')
                                    <button type="button" data-id="{{$product->id}}" class="addToCart btn btn-danger">Add To Cart</button>
                                    @endcannot
                                    @can('crud')
                                        <button data-id="{{$product->id}}" class="delete-product btn btn-danger">Delete</button>
                                        <a href="{{route('product.edit', $product->id)}}"
                                           class="btn btn-danger">edit</a>
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
@endsection

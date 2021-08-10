@extends('layout.master')
@section('title','Thêm giỏ hàng')
@section('content')
    <div class="card">
        <div class="btn btn-secondary">
            <h3 class="card-title">Cart</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $key => $product)
                    <tr class="product" id="cart-{{$key}}">
                        <td>{{$key}}</td>
                        <td><img src="{{asset('storage/'. $product['img'])}}" style="width: 200px" alt="error"></td>
                        <td>{{$product['name']}}</td>
                        <td>${{$product['price']}}</td>
                        <td>{{$product['quantity']}}</td>
                        <td>${{$product['quantity']*$product['price']}}</td>
                        <td>
                            <button type="button" data-id="{{$key}}" class="delete-cart btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
                <tr class="col-md-8">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total Price:</td>
                    <td id="totalPrice">${{$totalPrice}}</td>
                </tr>
                <tr class="col-md-8">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="btn-success">Payment</td>
                    <td class="btn-danger">Method Payment is create on the next day</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection


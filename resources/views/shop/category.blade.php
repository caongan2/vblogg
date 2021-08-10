@extends('layout.master')
@section('content')

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Customer</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <form action="{{route('addCategory')}}" enctype="multipart/form-data" method="post"  >
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" name="name" id="inputName" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Accept</button>
                <a href="{{route('product.list')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
@endsection

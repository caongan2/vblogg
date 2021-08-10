<?php
$categories =\App\Models\Categories::all();
?>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('storage/' . \Illuminate\Support\Facades\Auth::user()->img)}}" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
            <a href="{{route('myProfile', \Illuminate\Support\Facades\Auth::id())}}" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
        </div>
    </div>
    <!-- SidebarSearch Form -->
    <form action="{{route('user.search')}}" method="post">
        @csrf
        <div class="form-inline">
            <div class="input-group">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" name="name" aria-label="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Member
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('user.list')}}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @can('crud')
                        <a href="{{route('user.adduser')}}" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                        </a>
                        @endcan
                    </li>
                </ul>
            </li>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-shopping-bag"></i>
                    <p>
                        Shopping
                        <i class="fas fa-angle-left right"></i>
{{--                        <span class="badge badge-info right">6</span>--}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Categories
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Categories</p>
                                    <span class="badge badge-info right">{{count($categories)}}</span>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach($categories as $category)
                                        <li class="nav-item">
                                            <a href="{{route('productByCate', $category->id)}}" class="nav-link">
                                                <i class="fas fa-arrow-right"></i>
                                                <p>{{$category->name}}</p>
                                                <input type="hidden" value="{{$product = \App\Models\Product::where('category_id', $category->id)->get()}}">
                                                <span class="badge badge-info right">{{count($product)}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @can('crud')
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('addCate')}}" class="nav-link">
                                            <p>Add New</p>
                                        </a>
                                    </li>
                                </ul>
                                @endcan
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Products
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('product.list')}}" class="nav-link">
                                    <p>List</p>
                                    <input type="hidden" value="{{$product = \App\Models\Product::all()}}">
                                    <span class="badge badge-info right">{{count($product)}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        @can('crud')
                        <a href="{{route('productOfUser',\Illuminate\Support\Facades\Auth::user()->id)}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                My Products
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

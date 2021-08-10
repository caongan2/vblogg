@include('layout.header')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60"
             width="60">
    </div>

    <!-- Navbar -->
@include('layout.navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
    @include('layout.sidebar')
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
{{--    <div class="content-wrapper">--}}


<!-- Main content -->
{{--    <div class="content-wrapper col-md-3"></div>--}}
    <div class="content-wrapper col-md-12">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Website: LowBubGet Connecting Peoples</a>
                        </li>
                    </ul>
                </div>
                <div class="card-header p-2">
                    <form action="{{route('status.post')}}" method="post">
                        @csrf
                        <label for="">How do you feel today
                            {{\Illuminate\Support\Facades\Auth::user()->name}} ???</label>
                        <input type="text" name="title" class="form-control" value="Title" style="background-color: white; color: black">
                        <textarea name="post" id="" cols="145" placeholder="   Your Status..." rows="5"></textarea>
                        <input type="number" hidden name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                        <button type="submit" class="btn btn-success">Share</button>
                    </form>
                </div>
                <!-- /.card-header -->
                @foreach($allPosts as $post)
                    <div class="card-body" id="post-{{$post->id}}">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                             src="{{asset('storage/' . $post->user->img)}}" alt="">
                                        <span class="username">
                                            <a href="{{route('user.profile', $post->user->id)}}">{{$post->user->name}}</a>
                                            @if(\Illuminate\Support\Facades\Auth::user()->name == $post->user->name)
                                            <button type="button" data-id="{{$post->id}}" class="delete-post float-right btn-tool"><i class="fas fa-times"></i></a></button>
                                            @endif
                                        </span>
                                        <span class="description">{{$post->created_at}}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <label for="">{{$post->title}}</label>
                                    <p>
                                        {{$post->post}}
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i
                                                class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i
                                                class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                        <a href="{{route('commentByPost', $post->id)}}" class="link-black text-sm">
                                            <input type="hidden" value="{{$comment = \App\Models\Comment::where('post_id', $post->id)->get()}}">
                                        <i class="far fa-comments mr-1"></i> Comments ({{count($comment)}})
                                        </a>
                                        </span>
                                    </p>
                                    <form action="{{route('status.comment')}}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" name="comment" class="form-control" placeholder="Comment">
                                            <input type="text" hidden name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                            <input type="text" hidden name="post_id" value="{{$post->id}}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <button type="submit" class="far fa-comment-dots"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
            @endforeach
            </div>
        </div>

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
</div>

<!-- ./wrapper -->
@include('layout.footer')

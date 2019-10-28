@extends('admin.master')

@section('content')
    <header class="Hui-header cl" style="background-color: #00B83F;"><a class="Hui-logo" title="" href="{{url('/admin/index')}}">基于Laravel的微商城后台管理系统</a>
        <ul class="Hui-userbar">
            <li>{{$admin->username}}</li>
            <li><a href="{{url('/admin/exit')}}">退出</a></li>
        </ul>
        <a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>
@endsection
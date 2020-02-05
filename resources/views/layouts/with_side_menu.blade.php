@extends('layouts.app')

<head>
    <style>
        #SideMenu a:hover {
            text-decoration-line: none;
        }
    </style>
</head>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div id="SideMenu" class="col-12 col-md-3">
            <div class="container">
                <ul class="list-group">
                    <a href={{ url('admin/') }}>
                        <li class="list-group-item {{Request::path() == 'admin'?'active':''}}">
                            管理者首頁
                        </li>
                    </a>
                    <a href={{ url('admin/app-key-manage') }}>
                        <li class="list-group-item {{Request::path() == 'admin/app-key-manage'?'active':''}}">APP KEY 管理
                        </li>
                    </a>
                    <a href={{ url('admin/user-auth-limit') }}>
                        <li class="list-group-item {{Request::path() == 'admin/user-auth-limit'?'active':''}}">使用者權限管理
                        </li>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-9">@yield('right_content')</div>
    </div>
</div>
@endsection
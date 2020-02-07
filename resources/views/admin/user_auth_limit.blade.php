@extends('layouts.with_side_menu')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UDIC</title>
</head>
@section('right_content')

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/user-auth-limit')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="搜尋使用者 (Email)"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">搜尋</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        @foreach ($users as $user)
        <div class="card" style="margin-top:10px">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <div class="card-text">
                    <b>基本資訊</b>
                    <hr>
                    @if ($user->is_admin==1)
                    <span class="text-danger"><b>管理者權限</b></span><br>
                    @endif
                    <span><b>Email:</b> {{$user->email}}</span><br>
                    <span><b>API Token:</b> {{$user->api_token}}</span><br>
                    <span><b>創建日期:</b> {{$user->created_at}}</span><br>
                    <br>
                    <b>APP存取權限</b>
                    <hr>
                    <span><b>授予權限</b></span><br>
                    <form action="{{url('admin/user-auth-limit/add-auth')}}" method="post">
                        @csrf
                        <div class="input-group">
                            <select class="custom-select" name="giveAuth">
                                <option value="" selected>選擇服務...</option>
                                @foreach ($AKM as $akm)
                                <option value="{{$akm->id}}">{{$akm->name}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">授予權限</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <span><b>已授予權限</b></span><br>
                    @if (count($user->appAuth) == 0)
                    <span>沒有可存取的服務</span>
                    @endif
                    @foreach ($user->appAuth as $user_app)
                    <span>{{$user_app->appKeyManage->name}} 每日免費剩餘:{{$user_app->free_remain_request_times_pre_day}}
                        購買剩餘:{{$user_app->remain_request_times}}</span>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
@endsection
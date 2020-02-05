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
                    <ul>
                        <li><b>Email:</b> {{$user->email}}</li>
                        <li><b>API Token:</b> {{$user->api_token}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
@endsection
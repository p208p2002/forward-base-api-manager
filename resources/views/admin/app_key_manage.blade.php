@extends('layouts.with_side_menu')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UDIC</title>
    <style>
        #AppKeyManage .card-del {
            position: absolute !important;
            top: 5px;
            right: 5px;
        }
    </style>
</head>
@section('right_content')

<body>
    <div id="AppKeyManage" class="container">
        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">新增APP</h5> --}}
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">APP名稱</label>
                        <input type="text" class="form-control" placeholder="App name">
                        <small id="emailHelp" class="form-text text-muted">用於識別與查詢</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">APP密碼</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="App key">
                            <div class="input-group-append">
                                <button class="btn btn-primary">自動生成</button>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">自訂的密碼</small>
                    </div>
                </form>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">新增APP</button>
                </div>
            </div>
        </div>

        <hr>
        @foreach ($AppKeys as $Appkey)
        <div class="card" style="margin-top:10px">
            <button class="card-del btn btn-sm btn-danger" 
            onclick="event.preventDefault();document.getElementById('{{"AppKeyDel".$Appkey->id}}').submit();">
                del</button>
            <form id={{"AppKeyDel".$Appkey->id}} action="{{ url('admin/app-key-manage/'.$Appkey->id) }}" method="POST">
                @method('DELETE')
                @csrf
            </form>
            <div class="card-body">
                <h5 class="card-title">{{ $Appkey->name }}</h5>
                <span class="card-subtitle mb-2 text-muted">App Key</span>
                <div class="input-group">
                    <input class="form-control" type="text" name="" id="" value={{ $Appkey->key }}>
                    <div class="input-group-append">
                        <button class="btn btn-primary">複製</button>
                    </div>
                </div>
                <span class="card-text"></span>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
@endsection
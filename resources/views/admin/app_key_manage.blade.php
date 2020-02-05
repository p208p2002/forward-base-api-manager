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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
</head>
@section('right_content')

<body>
    <script>
        //
        new ClipboardJS('.btn');
        //
        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    </script>
    <div id="AppKeyManage" class="container">
        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">新增APP</h5> --}}
                <form action={{url('admin/app-key-manage')}} method="POST">
                    @csrf
                    <div class="form-group">
                        <label>APP名稱</label>
                        <input name="appName" type="text" class="form-control" placeholder="App name">
                        <small id="emailHelp" class="form-text text-muted">用於識別與查詢</small>
                    </div>
                    <div class="form-group">
                        <label>APP密碼</label>
                        <div class="input-group">
                            <input id="appPWD" name="appPWD" class="form-control" placeholder="App key">
                            <div class="input-group-append">
                                <button
                                    onclick="event.preventDefault();var pwd=document.getElementById('appPWD');pwd.value=makeid(32)"
                                    class="btn btn-primary">自動生成</button>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">自訂的密碼</small>
                    </div>
                    <div class="form-group">
                        <label>每日免費請求次數</label>
                        <div class="input-group">
                            <input id="freeReq" name="freeReq" class="form-control" placeholder="Free requests pre-day"
                                value="100">
                        </div>
                        <small id="emailHelp" class="form-text text-muted">每個帳號允許的每日免費呼叫次數</small>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">新增APP</button>
                    </div>
                </form>
            </div>
        </div>

        <hr>
        @foreach ($AppKeys as $Appkey)
        <div class="card" style="margin-top:10px">
            <button class="card-del btn btn-sm btn-danger"
                onclick="event.preventDefault();document.getElementById('{{"AppKeyDel".$Appkey->id}}').submit();">
                del</button>
            <form style="position:absolute;" id={{"AppKeyDel".$Appkey->id}}
                action="{{ url('admin/app-key-manage/'.$Appkey->id) }}" method="POST">
                @method('DELETE')
                @csrf
            </form>
            <div class="card-body">
                <form action={{url('admin/app-key-manage/'.$Appkey->id)}} method="POST">
                    @method('PUT')
                    @csrf
                    <h5 class="card-title">{{ $Appkey->name }}</h5>
                    <span class="card-subtitle mb-2 text-muted">App Key</span>
                    <div class="input-group">
                        <input class="form-control" type="text" id={{'AppkeyPwd'.$Appkey->id}}
                            name="appPWD"
                            value="{{ $Appkey->key }}" />
                        <div class="input-group-append">
                            <button data-clipboard-target={{'#AppkeyPwd'.$Appkey->id}}
                                class="btn btn-primary">複製</button>
                        </div>
                    </div>
                    <br>
                    <span class="card-subtitle mb-2 text-muted">每日免費請求次數</span>
                    <div class="input-group">
                        <input class="form-control" type="text" id={{'AppkeyPwd'.$Appkey->id}}
                            name="freeReq"
                            value="{{ $Appkey->free_request_times_pre_day }}">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">儲存</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>
@endsection
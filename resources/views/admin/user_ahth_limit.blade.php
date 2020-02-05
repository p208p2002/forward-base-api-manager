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
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="搜尋使用者" aria-label="Recipient's username"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">搜尋</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@endsection
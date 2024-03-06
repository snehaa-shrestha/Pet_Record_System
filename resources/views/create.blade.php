<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:20px;">
                        @if(session('status'))
                            <div class="alert alert-success">{{session('status')}}</div>
                        @endif
                        <h4>Add Users
                            <a href="{{url ('admindashboard')}}" class="btn btn-primary float-end">Back</a>
                        </h4>
                        <hr>
                        <form action="{{url ('admindashboard/create')}}" method="POST">
                            @csrf
                            <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old ('name')}}">
                            <span class="text-danger">@error('name') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{old ('email')}}">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="">
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
            </div>
        </div>
    </div>
</body>
</html>
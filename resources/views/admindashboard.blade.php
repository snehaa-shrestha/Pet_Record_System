<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-color: lightblue;
        }

        /* .btn{
            margin-left: 92%;
            margin-top: 10px;
        } */
    </style>
</head>
<body>
<a href="logout" class = "btn btn-primary float-end">Logout</a>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class=header>
                    <h4>Users
                        <a href = "{{url ('admindashboard/create')}}" class = "btn btn-primary float-end">Add Users</a>
                    </h4>
                </div>
                    <hr>
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($user as $users)
                            @if($users->email!="admin@admin.com")
                            <tr>
                                <td>{{$users->id}}</td>
                                <td>{{$users->name}}</td>
                                <td>{{$users->email}}</td>
                                <!-- <td><a href="logout">Logout</a></td> -->
                                <td>
                                    <a href="{{ url('admindashboard/'.$users->id.'/edit')}}" class="btn btn-success mx-2">Edit</a>
                                    <a href="{{ url('admindashboard/'.$users->id.'/delete')}}" class="btn btn-danger mx-1" onclick = "return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>

                    </table>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
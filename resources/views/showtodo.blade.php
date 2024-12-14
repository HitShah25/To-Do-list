<html>
<head>
    <style>
        .gradient-custom {
            background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
                        linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
                        linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
                        radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
                        radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
            background-blend-mode: screen, color-dodge, overlay, difference, normal;
        }
    </style>
    <!-- Include external stylesheets -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://mdbcdn.b-cdn.net/wp-content/plugins/wordpress-social-login/assets/css/style.css?ver=5.6.2'>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="card-body p-5">
                            <!-- Filter dropdown -->
                            <form class="d-flex justify-content-center align-items-center mb-4" action="/show" method="get">
                                <label for="filter">Filter:</label>
                                <select name="filter" id="filter" onchange="this.form.submit()" class="form-control mx-2">
                                    <option value="pending" {{ $filter === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All</option>
                                </select>
                            </form>

                            <!-- Add Button -->
                            <form class="d-flex justify-content-center align-items-center mb-4" action="/create" method="get">
                                <button type="submit" class="btn btn-info ms-2">Add</button>
                            </form>

                            <!-- To-Do Table -->
                            <div>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Desc</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($todos as $todo)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><a href="/todo/{{$todo->id}}/view">{{ $todo->name }}</a></td>
                                                <td>{{ $todo->description }}</td>
                                                <td><img src='images/{{$todo->image}}' width="50" height="50"/></td>
                                                <td>{{ $todo->completed ? 'Completed' : 'Pending' }}</td>
                                                <td>
                                                    <a href="/todo/{{$todo->id}}/edit" class="btn btn-dark btn-sm">Edit</a>
                                                    <a href="/todo/{{$todo->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

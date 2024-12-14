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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<link rel='stylesheet' id='wsl-widget-css'  href='https://mdbcdn.b-cdn.net/wp-content/plugins/wordpress-social-login/assets/css/style.css?ver=5.6.2' type='text/css' media='all' />
<link rel='stylesheet' id='compiled.css-css'  href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/css/compiled-4.19.2.min.css?ver=4.19.2' type='text/css' media='all' />
</head>
<body>
    
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
  
          <div class="card">
            <div class="card-body p-5">

                <form class="d-flex justify-content-center align-items-center mb-4" action="/create" method="get">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info ms-2">Add</button>
                  </form>
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
                            @foreach ( $todos as $todo )
                            <tr>
                              <th scope="row">{{$loop->index+1}}</th>
                              <td>{{$todo->name}}</td>
                              <td>{{$todo->description}}</td>
                              <td><img src='/images/{{$todo->image}}' width="50" height="50"/></td>
                              <td>{{$todo->completed?"completed":"pending"}}</td>
                              <td>
                                @if ($todo->user_id === $adminId)
                                    <!-- Show Edit and Delete for admin's own todos -->
                                    <a href="/todo/{{ $todo->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                                    <a href="/todo/{{ $todo->id }}/delete" class="btn btn-danger btn-sm">Delete</a>
                                @endif
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
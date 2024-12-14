
<html>
<head>

</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 mt-4">
            <div class="card p-4">
                
                <p>Title of TODO is :- {{$todo->name}}</p>
                
                <p>Description of TODO is :-{{$todo->description}}</p>
                <img src='/images/{{$todo->image}}' class="rounded" width="100%"/>

            </div>
        </div>
    </div>
</div>
</body>
</html>

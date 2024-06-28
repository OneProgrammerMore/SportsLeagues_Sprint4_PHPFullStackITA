


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>Leagues</title>
</head>
<body>
	
	
	
	
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand h1" href={{ route('leagues.index') }}>CRUDLeagues</a>
      <div class="justify-end ">
        <div class="col ">
          <a class="btn btn-sm btn-success" href={{ route('leagues.create') }}>Add League</a>
        </div>
      </div>
    </div>
  </nav>
  
  
  <div class="container h-100 mt-5">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-10 col-md-8 col-lg-6">
      <h3>Update League</h3>
      <form action="{{ route('leagues.update', $league->league_id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="title">League Type</label>
          <input type="text" class="form-control" id="league_type" name="league_type"
            value="{{ $league->league_type }}" required>
        </div>
        <div class="form-group">
          <label for="body">League Name</label>
          <textarea class="form-control" id="league_name" name="league_name" rows="3" required>{{ $league->league_name }}</textarea>
        </div>
        <button type="submit" class="btn mt-3 btn-primary">Update League</button>
      </form>
    </div>
  </div>
</div>
  
  
  
  
 
 
</body>
</html>

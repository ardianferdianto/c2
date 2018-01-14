<!doctype html>
<html lang="en">
<head>
  <title>C2</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
</head>
<body>
  <div id="app" class="container">
    <div class='row'>
      <h1 class="mx-auto" style="width: 200px;">Uploader</h1>
      <form action="/uploads" method="POST" enctype="multipart/form-data" class="col-sm-12">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="file" name="file" class="form-control">
        </div>
        <input type="submit" class="btn btn-success mb-4">
      </form>
      @foreach ($uploads as $upload)
        <ul id="upload-{{ $upload->id }}" class="col-sm-12">
          <li class="list-group-item">ID: {{ $upload->id }}</li>
          <li class="list-group-item">Name: <a href="{{ $upload->url }}">{{ $upload->name }}</a></li>
          <li class="list-group-item preview-url">
            <img src="{{ $upload->url }}" class="img-fluid">
          </li>
        </ul>
      @endforeach
    </div>
  </div>
</body>
</html>
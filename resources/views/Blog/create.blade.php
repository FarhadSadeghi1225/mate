<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

   title : <input type="text" name="title">
    <br>
    <br>
  content :  <input type="text" name="content">
    <br>
    <br>
  visit : <input type="number" name="visit">
  <br>
  <br>
  picture : <input type="file" name="picture">
  <br>
  <br>
 Tag : <select name="tag">
    @foreach ($tags as $tag)
    <option value="{{$tag->id}}">{{$tag->name}}</option>
    @endforeach
  </select>
  <br>
  <br>
 writer : <select name="writer">
    @foreach ($writers as $writer )
    <option value="{{$writer->id}}">{{$writer->name}}</option>
    @endforeach
  </select>
<br><br>
  <input type="submit">

 </form>


 @if ($errors->any())
 @foreach ($errors->all() as $error)
     <div>{{$error}}</div>
 @endforeach
@endif


 @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror



</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    @include('library.style')
</head>
<body>
       <div class="container">
        <div class="row">
            <div class="col-md-12">
            
    
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><h3>Pos system</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="{{route('category.index')}}">Category</a>
        <a class="nav-link active" aria-current="page" href="{{route('brand.index')}}">Brand</a>
        <a class="nav-link active" aria-current="page" href="{{route('product.index')}}">Products</a>
        <a class="nav-link active" aria-current="page" href="{{route('sale.index')}}">Sales</a>
       
      </div>
    </div>
  </div>
</nav>

   
<div>
      @yield('content')
</div>






            </div>
        </div>
       </div>
</body>
 



@include('library.script')
</html>
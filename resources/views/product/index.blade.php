@extends('layout')

@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
       {{ session('success') }}
        </div>
       @endif

        <h3 align="center" class="mt-5">Product</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('product.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Products Name</label>
                            <input type="text" class="form-control @error('productname') is-invalid @enderror" name="productname">
                            @error('productname')
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                               @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Category Status</label><br>
                            <select name="cat_id" id="cat_id" class="form-control">
                             @foreach ($categorys as $id => $name)
                             <option value="{{$id}}" >{{$name}}</option>                            
                             @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Brand Status</label><br>
                            <select name="brand_id" id="brand_id" class="form-control">
                             @foreach ($brands as $id => $name)
                             <option value="{{$id}}">{{$name}}</option>                            
                             @endforeach
                            </select>
                        </div>
                    
                    <div class="col-md-6">
                            <label>Products Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                  </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-info" value="Add">
                        </div>

                    </div>
                </form>
            </div>

                <table class="table mt-5">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ( $product as $key => $products )

                        <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $products->productname }}</td>
                            <td scope="col">{{ $products->category->catname }}</td>
                            <td scope="col">{{ $products->brand->brandname }}</td>
                            <td scope="col">{{ $products->price }}</td>
                            
                           
                            <td scope="col">

                            <a href="{{  route('product.edit', $products->id) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('product.destroy', $products->id) }}" method="POST" style ="display:inline">
                             @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td>

                          </tr>

                        @endforeach




                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection


@push('css')
    <style>
        .form-area{
            padding: 20px;
            margin-top: 20px;
              background-color:#FFFF00;
        }

        .bi-trash-fill{
            color:red;
            font-size: 18px;
        }

        .bi-pencil{
            color:green;
            font-size: 18px;
            margin-left: 20px;
        }
    </style>
@endpush
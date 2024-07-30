@extends('layout')

@section('content')

    <div class="container">

        <h3 align="center" class="mt-5">Product Update</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="post" action="{{ route('product.update',$products->id) }}">
                @method("PATCH")
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Products Name</label>
                            <input type="text" class="form-control @error('productname') is-invalid @enderror" value="{{$products->productname}}" name="productname">
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
                            <input type="text" class="form-control  @error('price') is-invalid @enderror" value="{{$products->price}}" name="price">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-info" value="Update">
                        </div>

                    </div>
                </form>
            </div>

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
    </style>
@endpush
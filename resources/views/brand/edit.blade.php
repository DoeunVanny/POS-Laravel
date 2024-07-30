@extends('layout')

@section('content')

    <div class="container">

        <h3 align="center" class="mt-5">Brand Update</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="post" action="{{ route('brand.update',$brands->id) }}">
                @method("PATCH")
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>brand Name</label>
                            <input type="text" class="form-control" name="brandname" value="{{$brands->brandname}}">
                        </div>
                        <div class="col-md-6">
                            <label>Category Status</label>
                            <select name="status" id="">
                              <option selected>selct menu</option>
                              <option value="1" {{$brands->status == 1 ?  'selected' : ''}}>True</option>
                              <option value="2"  {{$brands->status == 2 ?  'selected' : ''}}>False</option>
                            </select>
                        </div>
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
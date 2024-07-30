@extends('layout')

@section('content')

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
       {{ session('success') }}
        </div>
       @endif

        <h3 align="center" class="mt-5">Brand</h3>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">

            <div class="form-area">
                <form method="POST" action="{{ route('brand.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Brand Name</label>
                            <input type="text" class="form-control @error('brandname') is-invalid @enderror" name="brandname">
                            @error('brandname')
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                               @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Brand Status</label>
                            <select name="status" class="form-control  @error('status') is-invalid @enderror" id="">
                              <option selected>selct menu</option>
                              <option value="1">True</option>
                              <option value="2">False</option>
                            </select>
                            @error('status')
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
                        <th scope="col">Brand Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ( $brand as $key => $brands )

                        <tr>
                            <td scope="col">{{ ++$key }}</td>
                            <td scope="col">{{ $brands->brandname }}</td>
                            <td scope="col">
                              @if ($brands->status == 1)
                                    <p>True</p>
                              @else  
                              <p>False</p>
                              @endif
                        
                            </td>
                           
                            <td scope="col">

                            <a href="{{  route('brand.edit', $brands->id) }}">
                            <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                            </button>
                            </a>
                            
                            <form action="{{ route('brand.destroy', $brands->id) }}" method="POST" style ="display:inline">
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
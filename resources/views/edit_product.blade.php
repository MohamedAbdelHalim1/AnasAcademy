@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left;font-weight:bold;">Edit Product</h3>
                </div>

                <div class="card-body">

                    <form class="form-horizontal" action="{{route('upload' , $product->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name"><b>Name:</b><span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}"  placeholder="Enter Name" name="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="price"><b>Price:</b><span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}" id="price" placeholder="Enter Price" name="price">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="quantity"><b>Quantity:</b><span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ $product->quantity }}" id="quantity" placeholder="Enter Quantity" name="quantity">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="category"><b>Category ID:</b><span style="color:red;">*</span></label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control @error('category') is-invalid @enderror" value="{{ $product->category_id }}" id="category" placeholder="Enter Quantity" name="category">
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10 mt-2">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            </div>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

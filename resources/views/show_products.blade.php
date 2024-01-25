@extends('layouts.app')

@section('style')

<style>
    td > a{
            font-size:15px;
            text-decoration:none;
            color:black;
        }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left;font-weight:bold;">Products List</h3>
                    <a href="{{route('filter')}}" class="btn btn-primary" style="margin:0 0 0 280px;">Filter By Price</a>
                    <a href="{{route('create')}}" class="btn btn-primary" style="float:right;">Add New Product</a>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quntity</th>
                                <th>Category ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>
                                    {{$product->category_id}}
                                </td>
                            
                                <td>
                                <a href="{{route('edit_product',$product->id)}}">Edit</a> | <a href="#" onclick="delete_product({{$product->id}})">Delete</a>  <form action="{{route('checkout',$product->id)}}" method="post">@csrf<button type="submit" style="border:none;background:transparent;">Checkout</button></form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
        function delete_product(id){
            Swal.fire({
                title: "Delete this product! Are You Sure?",
                showCancelButton: true,

                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                        $.ajax({
                        type : "POST",
                        url : "delete_product/" + id,
                        data :{ "_token": "{{ csrf_token() }}",
                                },
                        success : function(response){
                            if (response.message) {
                                    swal({
                                        title:"403",
                                        text:response.message
                                    })
                                }else{
                                    location.reload();
                                }
                                    
                                    }
                        });




                }
                });
        }
    </script>
@endsection

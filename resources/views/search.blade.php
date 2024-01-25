<div class="filter-data">
    @if(count($products) > 0)
     <ul>
        @foreach($products as $product)
        <li>
            <b>{{$product->name}} </b> , <b>{{$product->price}}</b>
        </li>
        @endforeach
     </ul>  
     @else  
     <i>"No products price greater than this input value"</i>
    
     @endif
</div>
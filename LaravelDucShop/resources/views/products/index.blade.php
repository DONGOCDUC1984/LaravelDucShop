@extends('layouts.frontend')
@section('content')
<div class="container">
    <h3 class="text-center font-weight-bold text-uppercase">
        Products
    </h3>
    @if (count($products)==0 )
        <p>There are no products. </p>
    @endif
    @if (session('status'))
        <div class="alert alert-success" > {{session('status') }} </div>
    @endif
    <div class="d-flex flex-wrap justify-content-center bg-light">
        @foreach ($products as $val)
        <div class="card m-1 p-2 border" >
            <a class="mx-auto" href="/products/{{$val->id}}">
                <img class="card-img-top mx-auto"
                style="width:200px; height:300px "
                src="{{ asset($val->image_path )}}" alt="">
            </a>
            <div class="card-body">
              <h4 class="card-title"> {{$val->name }}</h4>
              <p class="card-text"> ID: {{$val->id }} </p>
              <p class="card-text"> Price: $ {{$val->price }} </p>
              <a  href="/products/{{$val->id}}" class="btn btn-success mb-2"> Details </a>
              <br>
              @auth
                @if ($val->cart==0)
                    <a href="/addtocart/{{$val->id}}" class="btn btn-primary">
                      <i class="fa-solid fa-cart-plus"></i> Add to cart
                    </a>
                @else
                    <a href="#" class="btn btn-primary disabled">
                        In cart already
                    </a>
                @endif
              @endauth


            </div>
        </div>
        @endforeach


    </div>

    <div class="mt-3">
        {{$products->links()}}
    </div>
</div>

@endsection

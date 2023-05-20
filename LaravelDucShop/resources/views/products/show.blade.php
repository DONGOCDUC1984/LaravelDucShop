@extends('layouts.frontend')

@section('content')

<div class="m-2">
    <h3 class="text-center font-weight-bold text-uppercase">
        Product's Detail
    </h3>
    <div class="d-flex flex-wrap justify-content-center">
        <img
            style="width: 250px; height: 400px"
            src="{{ asset($product->image_path )}}"
            alt=""
        />
        <div class="m-2">
            <p><b> ID: </b> {{$product["id"] }}</p>
            <p><b> Name: </b> {{$product['name'] }}</p>
            <p><b> Price: </b> $ {{$product["price"] }}</p>
            <p><b> Description: </b> {{$product[ "description"] }}</p>
            <p><b> Type: </b> {{$product["type"] }}</p>
            @if (Auth::check() && Auth::user()->isAdmin == 1)
            <a
                href="/products/edit/{{$product->id}}"
                type="button"
                class="btn btn-primary my-2"
            >
                <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <form method="POST" action="/products/{{$product->id}}">
                @csrf @method('Delete')
                <button class="btn btn-danger my-2">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

@endsection

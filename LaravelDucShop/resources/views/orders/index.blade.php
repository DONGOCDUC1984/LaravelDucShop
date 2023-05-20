@extends('layouts.frontend')

@section('content')

<div class="m-2">
    <h3 class="text-center font-weight-bold text-uppercase">
        Orders
    </h3>

    @if (session('status'))
       <div class="alert alert-success" > {{session('status') }} </div>
    @endif

    <h5 class="text-center font-weight-bold text-uppercase">
        Part 1: General Information
    </h5>
    <table class="table table-hover table-bordered table-dark mx-auto w-50">
        <thead>
          <tr>
            <th> ID </th>
            <th> Products </th>
            <th> Total Money </th>
            <th> User-ID </th>
            <th> User-Name </th>
            <th> Tel </th>
            <th> Address </th>
            <th> Delete </th>
          </tr>
        </thead>
        <tbody>
           @foreach ($orders as $val)
             <tr>
                <td>{{$val->id }}</td>
                <td> See the following table</td>
                <td> $ {{$val->totalmoney }}</td>
                <td>{{$val->user_id }}</td>
                <td>{{$val->user_name }}</td>
                <td>{{$val->tel }}</td>
                <td>{{$val->address }}</td>
                <td>
                    <form method="POST" action="/manage/orders/{{$val->id}}">
                        @csrf
                        @method('Delete')
                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                </td>

             </tr>
            @endforeach


        </tbody>
      </table>
      <br>
      <h5 class="text-center font-weight-bold text-uppercase">
        Part 2: Products' Details
      </h5>
      <table class="table table-hover table-bordered table-dark mx-auto w-50">
        <thead>
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Price </th>
            <th> Quantity </th>
            <th> $ </th>
          </tr>
        </thead>
        <tbody>
           @foreach (json_decode($val->cart) as $val)
             <tr>
                <td>{{$val->id }}</td>
                <td>{{$val->name }}</td>
                <td> $ {{$val->price }}</td>
                <td>{{$val->cart_quantity }}</td>
                <td> $ {{$val->price * $val->cart_quantity}}</td>
             </tr>
            @endforeach


        </tbody>
      </table>

      <div class="mt-3">
        {{$orders->links()}}
      </div>
</div>

@endsection

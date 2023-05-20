@extends('layouts.frontend')

@section('content')

<div class="m-2">
    <h3 class="text-center font-weight-bold text-uppercase">
        Users
    </h3>

    @if (session('status'))
       <div class="alert alert-success" > {{session('status') }} </div>
    @endif
    <table class="table table-hover table-dark mx-auto w-50">
        <thead>
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Email </th>
            <th> Delete </th>
          </tr>
        </thead>
        <tbody>
           @foreach ($users as $val)
             <tr>
                <td>{{$val->id }}</td>
                <td>{{$val->name }}</td>
                <td>{{$val->email }}</td>
                @if ($val->isAdmin==0)
                    <td>
                        <form method="POST" action="/manage/users/{{$val->id}}">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                @else
                    <td> Not Delete </td>
                @endif
             </tr>
            @endforeach


        </tbody>
      </table>
</div>

@endsection

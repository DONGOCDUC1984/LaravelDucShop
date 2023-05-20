<div class="offcanvas offcanvas-end" id="right-offcanvas">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title">
            <i class="fa-solid fa-cart-shopping"></i> Your Cart
        </h1>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
        ></button>
    </div>
    <div class="offcanvas-body">
        @if ((empty($cart)) )
        <p>The cart is empty</p>
        @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Remove</th>
                    <th>$</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $val)
                <tr>
                    <td>{{$val->id }}</td>
                    <td>{{$val->name }}</td>
                    <td> $ {{$val->price }}</td>
                    <td>
                        @if ($val->cart_quantity <=1)
                        <a href="#" class="btn btn-primary btn-sm disabled">
                            -
                        </a>
                        @else
                        <a
                            href="/cart/decreasequan/{{$val->id}}"
                            class="btn btn-primary btn-sm"
                        >
                            -
                        </a>
                        @endif {{$val->cart_quantity }}
                        <a
                            href="/cart/increasequan/{{$val->id}}"
                            class="btn btn-primary btn-sm"
                        >
                            +
                        </a>
                    </td>
                    <td>
                        <a
                            href="/cart/removeitem/{{$val->id}}"
                            class="btn btn-danger"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    <td>{{$val->price * $val->cart_quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p><b> Total: $ </b> {{ $totalmoney }}</p>
        @endif
        <form action="/order/post" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label class="form-label"> Tel:</label>
                <input type="text" class="form-control" name="tel" required />
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label"> Address:</label>
                <input
                    type="text"
                    class="form-control"
                    name="address"
                    required
                />
            </div>
            <button type="submit" class="btn btn-primary">Order</button>
        </form>
    </div>
</div>

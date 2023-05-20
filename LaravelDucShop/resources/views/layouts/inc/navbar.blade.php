<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"
style="background-color: black !important; "
>
    <div class="container-fluid">
        <span data-bs-toggle="offcanvas" data-bs-target="#left-offcanvas" style="font-size: 20px; cursor: pointer;
        float: left;color:white;margin:10px; "
        >&#9776</span
        >
        <a class="navbar-brand d-flex flex-row" href="#"  >
            <img src="{{ asset('shop1.png')}}" alt=""
               style="width:50px; height:50px ;
               text-shadow: 3px 3px 3px #ababab; "
               class="rounded border border-primary">
            <span  style="color: lightgreen ;
            text-shadow: 3px 3px 3px #ababab;
            font-family: 'Trirong', serif;
            "  class="mt-2">
               DUC-SHOP
            </span>
        </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/"> <i class="fa fa-fw fa-home"></i> Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/products/type/fruit and vegetable"> Fruit And Vegetable </a></li>
              <li><a class="dropdown-item" href="/products/type/bread and cake"> Bread And Cake </a></li>
              <li><a class="dropdown-item" href="/products/type/milk"> Milk </a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Filter Price
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/products/price/0/3"> $0-$3 </a></li>
              <li><a class="dropdown-item" href="/products/price/3/6"> $3-$6 </a></li>
              <li><a class="dropdown-item" href="/products/price/6/10"> $6-$10 </a></li>
            </ul>
          </li>
            @guest

                <li class="nav-item">
                    <a class="nav-link" href="/login"> Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/register"> Register </a>
                </li>

            @else
               @if (Auth::user()->isAdmin == 1)
                  <li class="nav-item">
                      <a class="nav-link" href="/products/create" > Post Product </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="/manage/users"> Manage Users </a></li>
                      <li><a class="dropdown-item" href="/manage/orders"> Manage Orders </a></li>
                    </ul>
                  </li>
               @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile">My Profile</a></li>
                        <li><a class="dropdown-item" href="/myorders">My Orders</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                            </form>
                        </li>

                    </ul>
                </li>
            @endguest
        </ul>

        <div style="width: 80px;"
            class="btn btn-primary rounded-3 "
            data-bs-toggle="offcanvas" data-bs-target="#right-offcanvas"
        >
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="badge bg-danger">
              @if ((empty($cart)) )
                  {{ 0 }}
              @else
                  {{ count($cart) }}
              @endif
          </span>
        </div>


        <form action="/search" class="d-flex">
          <input class="form-control me-2" type="text"  name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>


<div class="container">
    <div class="row d-flex">
        <div class="col-5">
            <h1>@yield('title-page')</h1>
        </div>
        <div class="col-7">
            <ul class="col-12 p-3 d-flex justify-content-end">
                <li class="m-1 p-3"><a href="{{ route('index') }}">Home</a></li>
                <li class="m-1 p-3"><a href="{{ route('checkout') }}">Checkout</a></li>
            </ul>
        </div>
    </div>
</div>

        @extends('layouts.basico')

        @section('title-page', 'Página Principal')
        @section('body')
        <header class="Header">
            @include('layouts._partials.topo')
        </header>
        <main class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <section class="Section">
                            <header class="Section-header">
                                <h2>Carrinho</h2>
                            </header>
                            <div class="Section-main">
                                <a href="{{ route('checkout') }}" class="btn btn-primary">Proceder para o Checkout</a>
                            </div>

                        </section>

                    </div>
                </div>
            </div>
        </main>        
        @endsection
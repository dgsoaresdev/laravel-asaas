
        @extends('layouts.basico')

        @section('title-page', 'Checkout')
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
                                <h2>Checkout</h2>
                            </header>
                            <div class="Section-main d-flex flex-column flex-sm-row col-12">
                                <div class="col-12 col-sm-7 p-3 p-sm-4">
                                
                                    <div class="row">

                                        <div class="mb-2">
                                            <h3>Dados Pessoais</h3>
                                        </div>
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title">Você já tem cadastro? <strong><a href="#">Faça o login</a></strong></h4>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title">Ainda não possui cadastro? <strong>Cadastre-se</strong></h4>
                                            </div>
                                            {{-- @component('layouts._components.form_cadastro')
                                            @endcomponent --}}
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-sm-5 p-3 p-sm-4">                              
                                    <div class="row">
                                        <h3>Resumo do pedido</h3>
                                        
                                          
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">                                         
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th escope="col" width="30%">Item</th>
                                                            <th escope="col" width="10%">Qt.</th>
                                                            <th escope="col" width="30%">R$</th>
                                                            <th escope="col" width="30%">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    {{-- @php $cart_total_price = 0 @endphp --}}
                                                   
                                                    {{-- @php $cart_total_price += $item_total_price @endphp --}}
                                                        <tr escope="row">
                                                            <td>111</td>
                                                            <td>1x</td>
                                                            <td>R$ 111</td>
                                                            <td>R$ 111</td>
                                                        </tr>
                                                   
                                                        <tr escope="row">
                                                            <td colspan="3">Total  </td>
                                                            <td>R$ 111</td>
                                                        </tr>
                                                 
                                                    </tbody>
                                                </table>

                                            </div>                                      
                                        </div>
                                    </div> 

                                    <div class="row mt-3">
                                        <h3>Pagamento</h3>
                                        <div class="mb-4 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>PIX</strong></h4>
                                                {{-- @component('layouts._components.form_payment_pix')
                                                @endcomponent --}}
                                            </div>
                                        </div>
                                        <div class="mb-4 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>Cartão de Crédito</strong></h4>
                                                {{-- @component('layouts._components.form_payment_card')
                                                @endcomponent --}}
                                            </div>
                                        </div>
                                        <div class="mb-4 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>Boleto</strong></h4>
                                                {{-- @component('layouts._components.form_payment_boleto')
                                                @endcomponent --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </main>        
        @endsection
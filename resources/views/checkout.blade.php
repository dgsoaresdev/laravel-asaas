
        @extends('layouts.basico')

        @section('title-page', 'Checkout')
        @section('body')
        {{-- Recupera dados do cadastro, no caso de um checkout com erro --}}
       
        
        @if( isset( $order_code ) && isset( $get_order_details ) && isset( $get_customer_details ) )
            @php
                $data_fields = array(
                    'name' => $get_customer_details->name,
                    'surname' => $get_customer_details->surname,
                    'email' => $get_customer_details->email,
                    'cpfCnpj' => $get_customer_details->cpfCnpj,
                    'telefone' => $get_customer_details->telefone,
                    'mobilePhone' => $get_customer_details->mobilePhone,
                    'address' => $get_customer_details->address,
                    'addressNumber' => $get_customer_details->addressNumber,
                    'complement' => $get_customer_details->complement,
                    'province' => $get_customer_details->province,
                    'city' => $get_customer_details->city,
                    'state' => $get_customer_details->state,
                    'postalCode' => $get_customer_details->postalCode,
                );

            @endphp
        @else
            @php
                $data_fields = array(
                    'name' => '',
                    'surname' => '',
                    'email' => '',
                    'cpfCnpj' => '',
                    'telefone' => '',
                    'mobilePhone' => '',
                    'address' => '',
                    'addressNumber' => '',
                    'complement' => '',
                    'province' => '',
                    'city' => '',
                    'state' => '',
                    'postalCode' => '',
                );
            @endphp
        @endif
        {{-- End - Recupera dados do cadastro, no caso de um checkout com erro --}}

        
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
                            <pre class="errorContainer rounded">
                                @foreach($errors->all() as $error_value)
                                {{ $error_value }} <br>
                                @endforeach
                            </pre>
                            <div class="Section-main d-flex flex-column flex-sm-row col-12">
                            <form action="{{ route('checkout') }}" class="d-flex flex-column flex-sm-row col-12" method="post">
                                @csrf
                                {{-- PRODUCT DATA --}}
                                {{-- END - PRODUCT DATA --}}
                                <div class="col-12 col-sm-7 p-3 p-sm-4">
                                
                                    <div class="row">

                                        <div class="mb-2">
                                            <h3>Dados Pessoais</h3>
                                        </div>
                                       

                                    </div>

                                    <div class="row">
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>Cadastre seus dados</strong></h4>
                                            </div>
                                            @component('layouts._components.form_cadastro', [ 'data_fields' =>  $data_fields ])
                                            @endcomponent
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
                                                    @forelse( $shoppingCart as $item_key => $item_details)
                                                    @php $item_total_price = $item_details['price'] * $item_details['amout'] @endphp
                                                    {{-- @php $cart_total_price += $item_total_price @endphp --}}
                                                        <tr escope="row">
                                                            <td>{{ $item_details['name'] }}</td>
                                                            <td>{{ $item_details['amout'] }}x</td>
                                                            <td>R$ {{ number_format($item_details['price'], 2, ',', '')  }}</td>
                                                            <td>R$ {{ number_format($item_total_price, 2, ',', '')  }}</td>
                                                        </tr>
                                                    @empty
                                                        Carrinho vazio.
                                                    @endforelse
                                                    @if ($cart_total_price > 0)
                                                        <tr escope="row">
                                                            <td colspan="3">Total  </td>
                                                            <td>R$ {{ number_format($cart_total_price, 2, ',', '')  }}</td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>

                                            </div>                                      
                                        </div>
                                    </div> 

                                    <div class="row mt-3">
                                        <h3>Pagamento</h3>
                                        <div class="mb-4 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title form-row"><strong>PIX</strong></h4>
                                                @if( isset($checkout_request_details) && $get_order_details->payment_method === 'pix' )
                                                    <div class="bg-warning form-row mb-3 p-2 rounded">
                                                        {{ $checkout_request_details }}
                                                    </div>
                                                @endif
                                                @component('layouts._components.form_payment_pix')
                                                @endcomponent
                                            </div>
                                        </div>
                                        <div class="mb-4 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>Cartão de Crédito</strong></h4>
                                                @if( isset($checkout_request_details) && $get_order_details->payment_method === 'cartao' )
                                                    <div class="bg-warning form-row mb-3 p-2 rounded">
                                                       <div class="bg-warning form-row mb-3 p-2 rounded d-flex flex-column">
                                                        <span class="error_code">Erro: <strong>{{ $checkout_request_details['code'] }}</strong></span>
                                                        <span class="error_msg">Mensagem: <strong>{{ $checkout_request_details['msg'] }}</strong></span>                                                        
                                                    </div>
                                                    </div>
                                                @endif
                                                @component('layouts._components.form_payment_card')
                                                @endcomponent
                                            </div>
                                        </div>
                                        <div class="mb-4 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title"><strong>Boleto</strong></h4>
                                                @if( isset($checkout_request_details) && $get_order_details->payment_method === 'boleto' )
                                                    
                                                @endif
                                                @component('layouts._components.form_payment_boleto')
                                                @endcomponent
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
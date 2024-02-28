
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
                                <h2>Finalizando pedido com o {{ $get_order_details['payment_method'] }}</h2>
                            </header>
                            <div class="Section-main d-flex flex-column flex-sm-row col-12">
                                <div class="col-12 col-sm-7 p-3 p-sm-4">
                                
                                    <div class="row">

                                        <div class="mb-2">
                                            <h3>{{ $get_order_details['payment_status'] == 'pending' ? 'Dados para pagamento' : 'Detalhes do pedido' }} </h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-2 card col-12">
                                            <div class="mt-3">
                                                <h4 class="card-title">Pague com o <strong>{{ $get_order_details['payment_method'] }}</strong></h4>
                                            </div>
                                            @if ( $get_order_details['payment_status'] == 'pending' )
                                                @component('layouts._components.form_payment_'.$get_order_details['payment_method'], ['order_code'=>$order_code, 'get_order_details'=>$get_order_details, 'get_customer_details'=>$get_customer_details, 'get_payment_details' => $get_payment_details])
                                                @endcomponent
                                            @endif  
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
                                                    @php
                                                        $get_order_details = json_decode($get_order_details);
                                                        $total_price = 0; 
                                                        $get_order_details_lineItems = json_decode($get_order_details->line_items);
                                                        //var_dump($get_order_details_lineItems);
                                                        @endphp

                                                        @foreach( $get_order_details_lineItems as $item_key => $item_value )
                                                            @php $total_price += $item_value->price @endphp
                                                            <tr escope="row">
                                                                <td>{{ $item_value->name }}</td>
                                                                <td>{{ $item_value->amout }}x</td>
                                                                <td>R$ {{ $item_value->price }}</td>
                                                                <td>R$ {{ $item_value->price * $item_value->amout }}</td>
                                                            </tr>
                                                        @endforeach
                                                   
                                                        <tr escope="row">
                                                            <td colspan="3">Total  </td>
                                                            <td>R$ {{ $total_price }}</td>
                                                        </tr>
                                                 
                                                    </tbody>
                                                </table>

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
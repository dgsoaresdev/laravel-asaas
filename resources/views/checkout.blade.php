
        @extends('layouts.basico')

        @section('title-page', 'Checkout')
        @section('body')
        <header class="Header">
            <div class="container">
                <div class="row">
                    @include('layouts._partials.topo')
                </div>
            </div>
        </header>
        <main class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <section class="Section">
                            <header class="Section-header">
                                <h2>Checkout</h2>
                            </header>
                            <div class="Section-main d-flex flex-column flex-sm-row">
                                <div class="col-12 col-sm-7">
                                
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
                                            @component('layouts._components.form_cadastro')
                                            @endcomponent
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-sm-5">                              
                                    <div class="row">
                                        <h3>Resumo do pedido</h3>  
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">                                         
                                                <table>
                                                    <thead>
                                                        <th>
                                                            <td>Item</td>
                                                            <td>Quant.</td>
                                                            <td>Preço</td>
                                                            <td>Total</td>
                                                        </th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Item teste</td>
                                                            <td>1x</td>
                                                            <td>R$ 500,00</td>
                                                            <td>R$ 500,00</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">Total</td>
                                                            <td>R$ 500,00</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>                                      
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <h3>Pagamento</h3>
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title">PIX</h4>
                                                <a href="#" class="btn btn-primary">Pagar com segurança</a>
                                            </div>
                                        </div>
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title">Cartão de Crédito</h4>
                                                <a href="#" class="btn btn-primary">Pagar com segurança</a>
                                            </div>
                                        </div>
                                        <div class="mb-2 card col-12">
                                            <div class="card-body">
                                                <h4 class="card-title">Boleto</h4>
                                                <a href="#" class="btn btn-primary">Pagar com segurança</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </main>        
        @endsection
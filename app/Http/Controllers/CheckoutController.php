<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Checkout;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Requests\UpdateCheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        
        // Get Shopping Cart Session
        $shoppingCart = session( 'shoppingCart' );
        $cart_total_price = session( 'cart_total_price' );

        return view('checkout', compact('shoppingCart', 'cart_total_price'));
    }

    /**
     * Parametriza todos os dados para a criação de novos registros.
     * Registra um novo usuário e também um novo pedido, este com status de "rescunho".
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {

        
        $status_request = null;
        $trans_code = null;
        $order_id = null;
        $order_code = null;
        $get_ip_user = $request->ip();

        if ( isset($request)) {
            //=========================================
            // Tratando os campos obrigatórios através do método nativo do Laravel
            //=========================================
            $request->validate([
                'name'            => 'required',
                'surname'         => 'required',
                'email'           => 'required|email',
                'cpfCnpj'         => 'required|min:11|max:18', 
                'telefone'        => 'required|min:10|max:15', 
                'mobilePhone'     => 'required|min:11|max:15',
                'address'         => 'required',
                'addressNumber'   => 'required',
                'complement'      => 'required',
                'province'        => 'required',
                'city'            => 'required',
                'state'           => 'required',
                'postalCode'      => 'required|min:8|max:10',
            ],
            [
                'name.required'              => 'O campo "nome" é obrigatório.',
                'surname.required'           => 'O campo "sobrenome" é obrigatório.',
                'email.required'             => 'O campo "E-mail" é obrigatório.',
                'email.email'                => 'Digite um "E-mail" válidono.',
                'cpfCnpj.required'           => 'O campo "CPF/CNPJ" é obrigatório.',
                'cpfCnpj.min'                => 'Preencha corretamente o campo "CPF/CNPJ".',
                'cpfCnpj.max'                => 'Preencha corretamente o campo "CPF/CNPJ".',
                'telefone.required'          => 'O campo "telefone" é obrigatório.',
                'telefone.min'               => 'Preencha corretamente o campo telefone.',
                'telefone.max'               => 'Preencha corretamente o campo telefone.',
                'mobilePhone.required'       => 'O campo "Celular" é obrigatório.',
                'mobilePhone.min'            => 'Preencha corretamente o campo "celular".',
                'mobilePhone.max'            => 'Preencha corretamente o campo "celular".',
                'address.required'           => 'O campo "Endereço" é obrigatório.',
                'addressNumber.required'     => 'O campo "Número" é obrigatório.',
                'province.required'          => 'O campo "Bairro" é obrigatório.',
                'city.required'              => 'O campo "Cidade" é obrigatório.',
                'state.required'             => 'O campo "Estado" é obrigatório.',
                'postalCode.required'        => 'O campo "CEP" é obrigatório.',
                'postalCode.min'             => 'Preencha corretamente o campo CEP.',
                'postalCode.max'             => 'Preencha corretamente o campo CEP.',
            ]
        );
        if ( $request->input('payment_method') == 'cartao' ) {
                //=================
                // Validações de campos do Cartão de Crédito
                //=================
                $request->validate([
                    'cartao_nome'     => 'required',
                    'cartao_numero'   => 'required|min:16|max:19',
                    'cartao_data_mes' => 'required|min:2|max:2',
                    'cartao_data_ano' => 'required|min:4|max:4',
                    'cartao_codigo'   => 'required|min:3|max:4',
                    'cartao_parcela'  => 'required',
                    'cartao_cpf'      => 'required|min:11|max:18',
                ],
                [
                    'cartao_nome.required'       => 'O campo "nome do titular do cartão" é obrigatório.',
                    'cartao_numero.required'     => 'O campo "número do cartão" é obrigatório.',
                    'cartao_numero.min'          => 'Preencha corretamente o campo número do cartão.',
                    'cartao_numero.max'          => 'Preencha corretamente o campo  número do cartão.',
                    'cartao_data_mes.required'   => 'O campo "Mês de  Validade" é obrigatório.',
                    'cartao_data_mes.min'        => 'Preencha corretamente o campo Mês de  Validade do cartão.',
                    'cartao_data_mes.max'        => 'Preencha corretamente o campo Mês de  Validade do cartão.',
                    'cartao_data_ano.required'   => 'O campo "Ano de Validade" é obrigatório.',
                    'cartao_data_ano.min'        => 'Preencha corretamente o campo Ano de Validade do cartão.',
                    'cartao_data_ano.max'        => 'Preencha corretamente o campo Ano de Validade do cartão.',
                    'cartao_codigo.required'     => 'O campo "CVV" é obrigatório.',
                    'cartao_codigo.min'          => 'Preencha corretamente o campo CVV do cartão.',
                    'cartao_codigo.max'          => 'Preencha corretamente o campo CVV do cartão.',
                    'cartao_parcela.required'    => 'O campo "número do cartão" é obrigatório.',
                    'cartao_cpf.required'        => 'O campo "CPF do titular do cartão" é obrigatório.',
                    'cartao_cpf.min'             => 'Preencha corretamente o campo CPF do titular do cartão.',
                    'cartao_cpf.max'             => 'Preencha corretamente o campo CPF do titular do cartão.',
                ]
            );
        }
            //==========
            // Retirando os caracteres especiais das strings
            //==========
            $customer_cpfCnpj          = $this->RemoveSpecialChar( $request->input('cpfCnpj') );
            $customer_telefone         = $this->RemoveSpecialChar( $request->input('telefone') );
            $customer_mobilePhone      = $this->RemoveSpecialChar( $request->input('mobilePhone') );
            $customer_postalCode       = $this->RemoveSpecialChar( $request->input('postalCode') );

            $customer_cartao_numero    = $this->RemoveSpecialChar( $request->input('cartao_numero') );
            $customer_cartao_data      = $this->RemoveSpecialChar( $request->input('cartao_data') );
            $customer_cartao_codigo    = $this->RemoveSpecialChar( $request->input('cartao_codigo') );
            $customer_cartao_cpf       = $this->RemoveSpecialChar( $request->input('cartao_cpf') );

            //==========
            // Atribuindo as carrinho às Strings.
            $shoppingCart = session( 'shoppingCart' );
            $cart_total_price = session( 'cart_total_price' );            
            
            /*==================
            #Create CUSTOMER
            1. Registra o cliente no banco de dados (sem autenticação)
            2. Faz uma requisição à API do gateway, criando um novo cliente
            3. Recupera o ID do novo cliente criado no gateway
            4. Salva o ID do novo cliente no banco de dados dentro da coluna "gateway_code".
            //==================
            */
            $customer = new Customer();

            $customer->name             = $request->input('name');
            $customer->surname          = $request->input('surname');
            $customer->email            = $request->input('email');
            $customer->cpfCnpj          = $customer_cpfCnpj;
            $customer->telefone         = $customer_telefone;
            $customer->mobilePhone      = $customer_mobilePhone;
            $customer->address          = $request->input('address');
            $customer->addressNumber    = $request->input('addressNumber');
            $customer->complement       = $request->input('complement');
            $customer->province         = $request->input('province');
            $customer->city             = $request->input('city');
            $customer->state            = $request->input('state');
            $customer->postalCode       = $customer_postalCode;
            

            $customer->save();
            $customer_id = $customer->id;

            if ($customer_id > 0) {

                 /*
                    Construindo o Array Json que será enviado na requisição de cadastro de cliente via API do Gateway.
                */
                $CURLOPT_POSTFIELDS_customer = '
                {
                    "name": "'.$customer->name.' '.$customer->surname.'",
                    "email": "'.$customer->email.'",
                    "phone": "'.$customer->telefone.'",
                    "mobilePhone": "'.$customer->mobilePhone.'",
                    "cpfCnpj": "'.$customer->cpfCnpj.'",
                    "postalCode": "'.$customer->postalCode.'",
                    "address": "'.$customer->address.'",
                    "addressNumber": "'.$customer->addressNumber.'",
                    "complement": "'.$customer->complement.'",
                    "province": "'.$customer->province.'",
                    "externalReference": "'.$customer_id.'",
                    "notificationDisabled": false,
                    "additionalEmails": "",
                    "municipalInscription": "",
                    "stateInscription": "",
                    "observations": "Origem: Checkout Laravel"
                }
                ';
                /*========================
                # CADATSTRO NOVO CLIENTE
                Request create customer in gateway API and get gateway customer ID.
                ==========================
                 */
                $gateway_customer = $this->request_gateway_api("customer", "POST", $CURLOPT_POSTFIELDS_customer, ""); // ($type, $verb, $data, $param1) // PROD
               // $gateway_customer = $this->request_gateway_api_debug("customer", "POST", $CURLOPT_POSTFIELDS_customer, ""); // DEBUG
                $gateway_customer = json_decode( $gateway_customer );
                
                //dd($gateway_customer->id);

                if ( isset( $gateway_customer->id ) ){
                    $customer->gateway_code  = $gateway_customer->id;
                    $customer->save(); // salva o ID (gateway) do cliente
                    $customer_id = $customer->id;
                } 
                // Save gateway customer ID in database
                
            // }

                /*==================
                #Create ORDER
                1. Registra o pedido no banco de dados
                2. Faz uma requisição à API do gateway, criando um novo pedido
                3. Recupera o ID do novo pedido criado no gateway
                4. Salva o ID do novo pedido no banco de dados dentro da coluna "gateway_code".
                //==================
                */
                $order = new Order();

                if ( $request->input('payment_method') == 'pix') {
                    
                    $order_status = 'draft';
                } else {
                    $order_status = 'pending';
                }

                $order->gateway_code        = '';
                $order->customer_id         = $customer_id;
                $order->line_items          = json_encode( $shoppingCart );
                $order->amout               = $cart_total_price;
                $order->status              = $order_status;
                $order->payment_status      = 'pending';
                $order->payment_method      = $request->input('payment_method');
                $order->payment_details     = '';
                $order->checkout_status     = 'open';
                $order->ip_user             = $get_ip_user;    

                $CurrentDate = date('Y-m-d');
                // Renomeando o valor da string do método de pagamento para o padrão do gateway.
                switch( $order->payment_method ) {
                    case 'cartao' :
                        $order_payment_method = 'CREDIT_CARD';
                        $due_date = date('Y-m-d', strtotime( $CurrentDate. ' + 2 days' ) );
                        break;

                    case 'pix' :
                        $order_payment_method = 'PIX';
                        $due_date = date('Y-m-d', strtotime( $CurrentDate. ' + 2 days' ) );
                        break;

                    case 'boleto' :
                        $order_payment_method = 'BOLETO';
                        $due_date = date('Y-m-d', strtotime( $CurrentDate. ' + 2 days' ) );
                        break;
                }

                $order->save();

                $order_id = $order->id;

                //if ($customer_id > 0) {
                /*
                    Construindo o Array Json que será enviado na requisição de cadastro de novo pedido via API do Gateway.
                */
                $CURLOPT_POSTFIELDS_order = '
                {
                    "billingType": "'.$order_payment_method.'",
                    "customer": "'.$gateway_customer->id.'",
                    "dueDate": "'.$due_date.'",
                    "value": '.$order->amout.',
                    "description": "Pedido: '.$order_id.'",
                    "externalReference": "'.$order_id.'"
                  }
                ';        
                
                // Request create order in gateway API and get gateway customer ID.
                $gateway_order = $this->request_gateway_api("order", "POST", $CURLOPT_POSTFIELDS_order, $order_payment_method, $request, $gateway_customer->id, $get_ip_user); // // PROD
                //$gateway_order = $this->request_gateway_api_debug("order", "POST", $CURLOPT_POSTFIELDS_order, $order_payment_method, $request, $gateway_customer->id, $get_ip_user); // DEBUG
                                
                $gateway_order = json_decode( $gateway_order );   
                

                if ( isset( $gateway_order->id ) ){


                    // Renomeando o valor da string de status do retorno do gateway para o padrão da plataforma.
                    switch( $gateway_order->status ) {
                        case 'PENDING' :
                            $status_order = 'pending';
                            break;
                        case 'RECEIVED' :
                            $status_order = 'received';
                            break;
                        case 'CONFIRMED' :
                            $status_order = 'confirmed';
                            break;    
                        default :
                            $status_order = 'pending';
                            break;
                    }

                    $order->gateway_code = $gateway_order->id;
                    
                    
                    //  dd($gateway_payment);

                    if ( $order->payment_method == 'pix' ) {

                        // Faz uma nova requisição para obter os dados do QRCode e Chave PIX
                        $gateway_payment = $this->request_gateway_api("payment", "GET", $gateway_order->id, $order_payment_method); // PROD
                        //$gateway_payment = $this->request_gateway_api_debug("payment", "GET", $gateway_order->id, $order_payment_method); // DEBUG
                        $gateway_payment = json_decode($gateway_payment);

                        
                        

                        // Build Strings
                        $payment_payment_auth        = null;
                        $payment_date_time           = null;
                        $payment_status              = 'pending';
                        $payment_payment_status      = 'pending';
                        $payment_date_due            = $gateway_payment->expirationDate;
                        $payment_payment_details     = $gateway_payment->payload;
                        $payment_payment_doc         = $gateway_payment->encodedImage;

                    } elseif ( $order->payment_method == 'boleto' ) {
                            

                            // Build Strings
                            $payment_payment_auth        = null;
                            $payment_date_time           = null;
                            $payment_status              = 'pending';
                            $payment_payment_status      = 'pending';
                            $payment_date_due            = $gateway_order->dueDate;
                            $payment_payment_details     = $gateway_order->invoiceUrl;
                            $payment_payment_doc         = $gateway_order->bankSlipUrl;

                    } elseif ( $order->payment_method == 'cartao' ) {
                            

                            // Build Strings
                            $payment_payment_auth        = null;
                            $payment_date_time           = $gateway_order->confirmedDate;
                            $payment_status              = $status_order;
                            $payment_payment_status      = $status_order;
                            $payment_date_due            = $gateway_order->dueDate;
                            $payment_payment_details     = json_encode($gateway_order->creditCard);
                            $payment_payment_doc         = $gateway_order->transactionReceiptUrl;

                    }

                    if ( $order->payment_method != 'pix' || $order->payment_method == 'pix' && isset($gateway_payment->success) && $gateway_payment->success ) { // Se for PIX

                        $payment = new Payment();

                        $payment->gateway_code        = $gateway_order->id;
                        $payment->order_id            = $order_id;
                        $payment->customer_id         = $customer_id;
                        $payment->amout               = $cart_total_price;
                        $payment->status              = $payment_status;
                        $payment->payment_status      = $payment_payment_status;
                        $payment->payment_method      = $request->input('payment_method');
                        $payment->payment_details     = $payment_payment_details;
                        $payment->payment_doc         = $payment_payment_doc;
                        $payment->payment_auth        = $payment_payment_auth;
                        $payment->payment_date_time   = $payment_date_time;
                        $payment->date_due            = $payment_date_due;

                        $payment->save();

                    } 
                
                    

                    // Atualizando o Status do pedido
                    $order->status              = $status_order;
                    $order->payment_status      = $status_order;

                    $order->save(); // salva o ID (gateway) do pedido

                    //Strings de response, que definem a URL de redirecionamento
                    $order_code = $gateway_order->id;
                    $status_request = 'success';

                    //===================================================================
                    // Validando campos
                    //===================================================================
                    //====
                    // CPF Cadastro
                    //====
                    if ( !$this->validaCPF(  $customer_cpfCnpj ) ) {
                
                        $order_code = 'error-1003';
                        $status_request = 'error';
                        $trans_code = 'Por favor, digite um CPF válido, no cadastro';

                        $order->status  = 'failed';
                        $order->gateway_code  = 'error-1003';
                        $order->save(); // salva o ID (gateway) do pedido
                             
                        // Redionrecionamento construído a partor dos responses acima.
                        return redirect('/checkout/'.$order_code.'/'.$status_request.'/'.$trans_code);        
                    }

                   
                     //===============================================
                    // Validações dos campos do cartão de crédito
                    //===============================================
                    if ( $request->input('payment_method') == 'cartao' ) {
                       
                        //====
                        // CPF no cartão
                        //====
                        if ( !$this->validaCPF(  $customer_cartao_cpf ) ) {
                    
                            $order_code = 'error-1007';
                            $status_request = 'error';
                            $trans_code = 'Por favor, digite um CPF válido, no cartão';

                            $order->status  = 'failed';
                            $order->gateway_code  = 'error-1007';
                            $order->save(); // salva o ID (gateway) do pedido
                                
                            // Redionrecionamento construído a partor dos responses acima.
                            return redirect('/checkout/'.$order_code.'/'.$status_request.'/'.$trans_code);        
                        }


                        //====
                        // Número do cartão
                        //====
                        if ( !$this->validationCreditCard((int)$customer_cartao_numero) ) {
                    
                            $order_code = 'error-1009';
                            $status_request = 'error';
                            $trans_code = 'Digite um número válido de cartão de crédito.';

                            $order->status  = 'failed';
                            $order->gateway_code  = 'error-1009';
                            $order->save(); // salva o ID (gateway) do pedido
                                
                            // Redionrecionamento construído a partor dos responses acima.
                            return redirect('/checkout/'.$order_code.'/'.$status_request.'/'.$trans_code);        
                        }
                    }
                  

                    //====
                    // CEP
                    //====

                    if ( !$this->validaCEP(  $customer_postalCode ) ) {
                
                        $order_code = 'error-1006';
                        $status_request = 'error';
                        $trans_code = 'Por favor, CEP válido';

                        $order->status  = 'failed';
                        $order->gateway_code  = 'error-1006';
                        $order->save(); // salva o ID (gateway) do pedido
                             
                        // Redionrecionamento construído a partor dos responses acima.
                        return redirect('/checkout/'.$order_code.'/'.$status_request.'/'.$trans_code);        
                    }


                    //===================================================================
                    // END - Validando campos
                    //===================================================================

                } else {

                    if ( isset( $gateway_order->errors ) ){
                        //dd($gateway_order->errors);

                        $order_code = $gateway_order->errors[0]->code;
                        $status_request = 'error';
                        $trans_code = $gateway_order->errors[0]->description;

                        // Salva o código do erro no banco de dados.
                        $order->gateway_code  = $gateway_order->errors[0]->code;
                    } else {
                    //Strings de response, que definem a URL de redirecionamento
                    $order_code = 'error-1001';
                    $status_request = 'error';
                    $trans_code = 'error-1001';

                    // Salva o código do erro no banco de dados.
                    $order->gateway_code  = 'error-1001';
                    }
                    $order->status  = 'failed';
                    $order->save(); // salva o ID (gateway) do pedido

                }
                // Save gateway customer ID in database
            } else {
                //Strings de response, que definem a URL de redirecionamento
                $order_code = 'error-1002';
                $status_request = 'error';
                $trans_code = 'error-1002';

                // Salva o código do erro no banco de dados.
                $order->gateway_code  = 'error-1002';
                $order->status  = 'failed';
                $order->save(); // salva o ID (gateway) do pedido
            }          
            // Redionrecionamento construído a partor dos responses acima.
            return redirect('/checkout/'.$order_code.'/'.$status_request.'/'.$trans_code);

        } else {

            return view('checkout');

        }
        
    }

    /*
    Request API
    * Faz a autenticação
    * Faz as resuisições GET
    * Faz as requisições POST
    * Faz Através dos parâmetros decide se fará uma requisição GET ou POST para:
    * - Clientes
    * - Pedidos
    * - Pagamentos
    * Retorna com o resultado da requisição
    */
    public function request_gateway_api($type="", $verb="", $data="", $param1="", $param2="", $param3="", $param4="")
    {

        //$gateway_order = $this->request_gateway_api("order", "POST", $CURLOPT_POSTFIELDS_order, $order_payment_method, $request, $gateway_customer->id, $get_ip_user);
        
        if( $type == 'customer') {

            $url_dir = '/customers';

        } elseif( $type == 'order' ) {

            $url_dir = '/payments';

           

            if ($param1 == 'cartao' || $param1 == 'CREDIT_CARD') {
                /*
                #Personalização dos dados para requisição com checkout utilizando Cartão de crédito
                */
                if( !empty($data)) {
                    $data = json_decode($data);
                }

                $request = $param2; // Campos do formulário
                // $data =
                // '
                // {
                //     "billingType": "CREDIT_CARD",
                //     "creditCard": {
                //       "holderName": "john doe",
                //       "number": "5162306219378829",
                //       "expiryMonth": "05",
                //       "expiryYear": "2025",
                //       "ccv": "318"
                //     },
                //     "creditCardHolderInfo": {
                //       "name": "John Doe",
                //       "email": "john.doe@asaas.com.br",
                //       "cpfCnpj": "24971563792",
                //       "postalCode": "89223-005",
                //       "addressNumber": "277",
                //       "phone": "4738010919"
                //     },
                //     "customer": "cus_000005899309",
                //     "value": 100,
                //     "dueDate": "2024-03-05",
                //     "description": "Pedido 056984",
                //     "externalReference": "056984",
                //     "remoteIp": "45.229.214.85"
                //   }
                // '; 

                $data = 
                '
                {
                    "billingType": "CREDIT_CARD",
                    "creditCard": {
                    "holderName": "'.$request->input('cartao_nome').'",
                    "number": "'.$request->input('cartao_numero').'",
                    "expiryMonth": "'.$request->input('cartao_data_mes').'",
                    "expiryYear": "'.$request->input('cartao_data_ano').'",
                    "ccv": "'.$request->input('cartao_codigo').'"
                    },
                    "creditCardHolderInfo": {
                    "name": "John Doe",
                    "email": "'.$request->input('email').'",
                    "cpfCnpj": "'.$request->input('cpfCnpj').'",
                    "postalCode": "'.$request->input('postalCode').'",
                    "addressNumber": "'.$request->input('addressNumber').'",
                    "addressComplement": "'.$request->input('complement').'",
                    "phone": "'.$request->input('mobilePhone').'"
                    },
                    "customer": "'.$param3.'",
                    "value": '.$data->value.',
                    "dueDate": "'.$data->dueDate.'",
                    "description": "'.$data->description.'",
                    "externalReference": "'.$data->externalReference.'",
                    "remoteIp": "'.$param4.'"
                }
                
                ';
                
            }

        
        } elseif( $type == 'payment' ) {
            /*
            #Personalização dos dados para requisição com checkout utilizando PIX
            */
            switch($param1) {
                case 'PIX' :
                    $url_complement = '/pixQrCode';
                break;
                default :
                    $url_complement = '/';
                break;
            }

            $url_dir = '/payments/'.$data.$url_complement;

            $param1 = '';
            
        }
        if ($verb == "POST") {
            // Requisição principal para criação do pedido no gateway.
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => env('ASAAS_SANDBOX_URL').$url_dir,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'access_token: '.env('ASAAS_TOKEN')
            ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            return $response;
        
        } else if ($verb == "GET") {

            
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => env('ASAAS_SANDBOX_URL').$url_dir.$param1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'access_token: '.env('ASAAS_TOKEN'),
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;

        }
    }


    /**
     * Parametriza a view adequada, a partir da resposta da requisição à API do gateway.
     * Se o status for de sucess, limpa as seções "shoppingCart" e "cart_total_price" e exibe a view de obrigado.
     * Se o status de de error, repete a tela de checkout, porém com todos os dados salvos.
     * 
     * @return \Illuminate\Http\Response
     */
    public function processing( Request $request )
    {
        // Captura os códigos de erro expressados na URL.
        $request_order_code =  $request->order_code;
        $request_status_checkout_request =  $request->status_checkout_request;
        $request_trans_code =  $request->trans_code;

        //recria as seções do carrinho
        $shoppingCart = session( 'shoppingCart' );
        $cart_total_price = session( 'cart_total_price' );
        
        // Construnido a mensagem de erro
        $this->error_library_notifiation($request_order_code);      
        $get_checkout_request_details = $request_order_code.'|'.$request_trans_code; // simulacao
        //==============
        $status_checkout_request = $request->status_checkout_request ? $request->status_checkout_request : '';
        $order_code = $request->order_code ? $request->order_code : '';
        $trans_code = $request->trans_code ? $request->trans_code : '';
        //$get_checkout_request_details = $request->checkout_request_details ? $request->checkout_request_details : '';
        //==============

        $get_checkout_request_details = explode('|', $get_checkout_request_details);
        $checkout_request_details = array(
            'code' => $get_checkout_request_details[0],
            'msg' => $get_checkout_request_details[1]
        );

        if ( $status_checkout_request === 'success') {
            session('shoppingCart', []);
            session('cart_total_price', null);

            $get_order = new Order();
            $get_order_details = $get_order->item_details($order_code);
            
                if($get_order_details) {

                    $get_order_details = $get_order_details[0];

                    $get_customer = new Customer();
                    $get_customer_details = $get_customer->item_details($get_order_details->customer_id);
                    
                    $get_payment = new Payment();
                    $get_payment_details = $get_payment->item_details($get_order_details->id);
                    $get_payment_details = $get_payment_details[0];

                    if( $get_customer_details ) {
                        $get_customer_details = $get_customer_details[0];
                        

                        return view('checkout-obrigado', compact( 'order_code', 'get_order_details', 'get_customer_details', 'get_payment_details' ));
                    } else {
                        return redirect('/checkout');
                    }
                } else {
                    return redirect('/checkout');
                }
            
        } else {
            if( !empty($order_code)) {
                $get_order = new Order();
                $get_order_details = $get_order->item_details($order_code);

                if($get_order_details) {

                    $get_order_details = $get_order_details[0];

                    $get_customer = new Customer();
                    $get_customer_details = $get_customer->item_details($get_order_details->customer_id);
                    if( $get_customer_details ) {
                        $get_customer_details = $get_customer_details[0];
                        return view('checkout', compact('shoppingCart', 'cart_total_price', 'order_code', 'get_order_details', 'get_customer_details', 'checkout_request_details' ));
                    } else {
                        return redirect('/checkout');
                    }
                }
                else {
                    return redirect('/checkout');
                }
                
            }
            else {
                return redirect('/checkout');
            }
            
        }
    }

    /*
    * Banco de Erros
    */
    public function error_library_notifiation( $code = "", $value="" )
    {

        $error_library_arr = array(
            'error-1001' => 'Transação não autorizada. Verifique os dados do cartão de crédito e tente novamente.',
            'error-1002' => 'Erro ao tentar cadastrar o usuário. Por favor, tente novamente ou solicite um suporte.',
            'error-1003' => 'Por favor, digite um CPF válido.',
            'error-1004' => 'Por favor, digite um e-mail válido.',
            'error-1005' => 'Por favor, digite um CEP válido.',
            'error-1006' => 'Por favor, digite um número de celular válido.',
            'error-1007' => 'Por favor, digite um CPF válido.',
            'error-1008' => 'Por favor, solicite um suporte.',
            'error-1009' => 'Por favor, digite um CPF válido.',
            'invalid_action' => $value,
            'invalid_customer' => $value,
            'invalid_creditCard'=>$value
        );

        if( array_key_exists($code, $error_library_arr)) { // Só retorna com valor se o erro existir no banco de erros.

            return $error_library_arr[$code];

        } else{

            return null;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCheckoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCheckoutRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCheckoutRequest  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCheckoutRequest $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }

    /*
    ===============================================================================================================
    #Validações de campos
    ===============================================================================================================
    */

    public function RemoveSpecialChar($str){
      
        
        $res = str_ireplace( array( '\'', '"', ',' , ';', '<', '>', '.', '-', ' ', '(', ')' ), '', $str);
        // Returning the result 
        return $res;
    }

    public function validaCPF($cpf = "") {
 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }


    public function validaCEP($CEPNumber){
        
        if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $CEPNumber)) {
           return false;
        } else {
            return true;
        }
    }

    public function validationCreditCard($cardNumber)
    {
        $number = substr($cardNumber, 0, -1);
        $doubles = [];
    
        for ($i = 0, $t = strlen($number); $i < $t; ++$i) {
            $doubles[] = substr($number, $i, 1) * ($i % 2 == 0? 2: 1);
        }
    
        $sum = 0;
    
        foreach ($doubles as $double) {
            for ($i = 0, $t = strlen($double); $i < $t; ++$i) {
                $sum += (int) substr($double, $i, 1);
            }
        }
    
        return substr($cardNumber, -1, 1) == (10-$sum%10)%10;
    }
    
   

    //==================================
    // END - CUSTOMIZER APP - 2022, Out
    //==================================

     //==================================
    // CUSTOMIZER APP - 2023, Mar
    //==================================

    public function cvf_convert_object_to_array($data = "") {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }
    
        if (is_array($data)) {
            return array_map(__FUNCTION__, $data);
        }
        else {
            return $data;
        }
        return $data;
    }



    /*
    ===============================================================================================================
    #END - Validações de campos
    ===============================================================================================================
    */

    /** DEBUG
     *  Função criada para simular, testar, debugar as requisições - emulando uma consulta a API do gateway
     */
    public function request_gateway_api_debug($type="", $verb="", $data="", $param1 = "", $param2 = "", $param3 = "", $param4 = "")
    {  

        if( !empty($data)) {
            $data = json_decode($data);
        }
        
        if ( $type == "customer" && $verb == 'POST' ) {
          // Simulação de response do Cadastro de cliente  
            return '
            {"object":"customer","id":"cus_000005897333","dateCreated":"2024-02-28","name":"Marcelo Almeida","email":"marcelo.almeida@gmail.com","company":null,"phone":"4738010919","mobilePhone":"47999376637","address":"Av. Paulista","addressNumber":"150","complement":"Sala 201","province":"Centro","postalCode":"01310000","cpfCnpj":"24971563792","personType":"FISICA","deleted":false,"additionalEmails":"marcelo.almeida2@gmail.com,marcelo.almeida3@gmail.com","externalReference":"12987382","notificationDisabled":false,"observations":"ótimo pagador, nenhum problema até o momento","municipalInscription":"46683695908","stateInscription":"646681195275","canDelete":true,"cannotBeDeletedReason":null,"canEdit":true,"cannotEditReason":null,"city":12565,"state":"SP","country":"Brasil"}';
        
        } elseif ( $type == "customer" && $verb == 'GET' ) {
            // Simulação de response da pesquisa por cliente

        } elseif ( $type == "order" && $verb == 'POST' ) {
            // Simulação de resopnse do cadastro de cobrança (pedido / order)
            if( $param1  == 'PIX' || $param1  == 'pix' ) {
                // Se a cobrança for via PIX
                return '
                {
                    "object": "payment",
                    "id": "pay_9wbab7d0y1eqcoq8",
                    "dateCreated": "2024-02-28",
                    "customer": "cus_000005897333",
                    "paymentLink": null,
                    "value": 100,
                    "netValue": 99.01,
                    "originalValue": null,
                    "interestValue": null,
                    "description": "Pedido 056984",
                    "billingType": "PIX",
                    "pixTransaction": null,
                    "status": "PENDING",
                    "dueDate": "2024-03-02",
                    "originalDueDate": "2024-03-02",
                    "paymentDate": null,
                    "clientPaymentDate": null,
                    "installmentNumber": null,
                    "invoiceUrl": "https://sandbox.asaas.com/i/9wbab7d0y1eqcoq8",
                    "invoiceNumber": "05176241",
                    "externalReference": "056984",
                    "deleted": false,
                    "anticipated": false,
                    "anticipable": false,
                    "creditDate": null,
                    "estimatedCreditDate": null,
                    "transactionReceiptUrl": null,
                    "nossoNumero": null,
                    "bankSlipUrl": null,
                    "lastInvoiceViewedDate": null,
                    "lastBankSlipViewedDate": null,
                    "discount": {
                    "value": 0,
                    "limitDate": null,
                    "dueDateLimitDays": 0,
                    "type": "FIXED"
                    },
                    "fine": {
                    "value": 0,
                    "type": "FIXED"
                    },
                    "interest": {
                    "value": 0,
                    "type": "PERCENTAGE"
                    },
                    "postalService": false,
                    "custody": null,
                    "refunds": null
                }
                ';
            } elseif( $param1  == 'BOLETO' || $param1  == 'boleto' ) {
                // se a cobrança for via boleto
                return '
                {
                    "object": "payment",
                    "id": "pay_517hlrt65agypbai",
                    "dateCreated": "2024-02-28",
                    "customer": "cus_000005897333",
                    "paymentLink": null,
                    "value": 250,
                    "netValue": 249.01,
                    "originalValue": null,
                    "interestValue": null,
                    "description": "Pedido: 12345",
                    "billingType": "BOLETO",
                    "canBePaidAfterDueDate": true,
                    "pixTransaction": null,
                    "status": "PENDING",
                    "dueDate": "2024-03-05",
                    "originalDueDate": "2024-03-05",
                    "paymentDate": null,
                    "clientPaymentDate": null,
                    "installmentNumber": null,
                    "invoiceUrl": "https://sandbox.asaas.com/i/517hlrt65agypbai",
                    "invoiceNumber": "05177941",
                    "externalReference": "111111",
                    "deleted": false,
                    "anticipated": false,
                    "anticipable": false,
                    "creditDate": null,
                    "estimatedCreditDate": null,
                    "transactionReceiptUrl": null,
                    "nossoNumero": "1480998",
                    "bankSlipUrl": "https://sandbox.asaas.com/b/pdf/517hlrt65agypbai",
                    "lastInvoiceViewedDate": null,
                    "lastBankSlipViewedDate": null,
                    "discount": {
                      "value": 0,
                      "limitDate": null,
                      "dueDateLimitDays": 0,
                      "type": "FIXED"
                    },
                    "fine": {
                      "value": 0,
                      "type": "FIXED"
                    },
                    "interest": {
                      "value": 0,
                      "type": "PERCENTAGE"
                    },
                    "postalService": false,
                    "custody": null,
                    "refunds": null
                  }
                ';

            } elseif( $param1  == 'CREDIT_CARD' || $param1  == 'cartao' ) {

                if ($param1 == 'cartao' || $param1 == 'CREDIT_CARD') {

                    $request = $param2; // Campos do formulário

                    $data = 
                    '
                    {
                        "billingType": "CREDIT_CARD",
                        "creditCard": {
                          "holderName": "'.$request->input('cartao_nome').'",
                          "number": "'.$request->input('cartao_nome').'",
                          "expiryMonth": "'.$request->input('cartao_nome').'",
                          "expiryYear": "'.$request->input('cartao_nome').'",
                          "ccv": "'.$request->input('cartao_nome').'"
                        },
                        "creditCardHolderInfo": {
                          "name": "John Doe",
                          "email": "'.$request->input('cartao_nome').'",
                          "cpfCnpj": "'.$request->input('cartao_nome').'",
                          "postalCode": "'.$request->input('cartao_nome').'",
                          "addressNumber": "'.$request->input('cartao_nome').'",
                          "addressComplement": "'.$request->input('cartao_nome').'",
                          "phone": "'.$request->input('cartao_nome').'"
                        },
                        "customer": "'.$param3.'",
                        "value": '.$data->value.',
                        "dueDate": "'.$data->dueDate.'",
                        "description": "'.$data->description.'",
                        "externalReference": "'.$data->externalReference.'",
                        "remoteIp": "'.$param4.'"
                      }
                      ';

                    //   var_dump($data);
                    //   die;

                }

                

                // Se a cobraça for via cartão
                $return_success =  '
                {
                    "object": "payment",
                    "id": "pay_4t9669bm23qod0wn",
                    "dateCreated": "2024-02-28",
                    "customer": "cus_000005897333",
                    "paymentLink": null,
                    "value": 1000,
                    "netValue": 979.61,
                    "originalValue": null,
                    "interestValue": null,
                    "description": "Pedido: 123",
                    "billingType": "CREDIT_CARD",
                    "confirmedDate": "2024-02-28",
                    "creditCard": {
                      "creditCardNumber": "8829",
                      "creditCardBrand": "MASTERCARD",
                      "creditCardToken": "a14d306f-569a-4f46-a2c9-9e3c2aed3478"
                    },
                    "pixTransaction": null,
                    "status": "CONFIRMED",
                    "dueDate": "2024-03-05",
                    "originalDueDate": "2024-03-05",
                    "paymentDate": null,
                    "clientPaymentDate": "2024-02-28",
                    "installmentNumber": null,
                    "invoiceUrl": "https://sandbox.asaas.com/i/4t9669bm23qod0wn",
                    "invoiceNumber": "05177975",
                    "externalReference": "12345",
                    "deleted": false,
                    "anticipated": false,
                    "anticipable": false,
                    "creditDate": "2024-04-01",
                    "estimatedCreditDate": "2024-04-01",
                    "transactionReceiptUrl": "https://sandbox.asaas.com/comprovantes/9003141297288889",
                    "nossoNumero": null,
                    "bankSlipUrl": null,
                    "lastInvoiceViewedDate": null,
                    "lastBankSlipViewedDate": null,
                    "postalService": false,
                    "custody": null,
                    "refunds": null
                  }
                ';

                $return_error = '
                {
                    "errors": [
                      {
                        "code": "invalid_action",
                        "description": "Transação não autorizada. Verifique os dados do cartão de crédito e tente novamente."
                      }
                    ]
                  }
                ';

            return $return_success;

            }

        } elseif ( $type == "order" && $verb == 'GET' ) {

        } elseif ( $type == "payment" && $verb == 'GET' ) {

            if ( $param1 == 'PIX' ) {
                return '
                {
                    "success": true,
                    "encodedImage": "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",
                    "payload": "00020101021226820014br.gov.bcb.pix2560qrpix-h.bradesco.com.br/9d36b84f-c70b-478f-b95c-12729b90ca255204000053039865406100.005802BR5905ASAAS6009JOINVILLE62070503***6304474A",
                    "expirationDate": "2024-02-28 23:59:59"
                  }
                ';
            } elseif ( $param1 == 'BOLETO' ) {

            } elseif ( $param1 == 'CREDIT_CARD' ) {

            }

        }
    }

}

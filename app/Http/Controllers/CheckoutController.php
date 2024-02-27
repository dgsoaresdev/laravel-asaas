<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $order_id = null;
        $order_code = null;

        if ( isset($request)) {

            $shoppingCart = session( 'shoppingCart' );
            //$cart_items_id = session( 'cart_items_id' );
            $cart_total_price = session( 'cart_total_price' );            
            
            //==================
            //Create CUSTOMER
            // var_dump($request->all());
            //==================
            $customer = new Customer();

            //print_r( $customer->getAttributes() );

            //print_r( $customer->getAttributes() );

            $customer->name             = $request->input('name');
            $customer->surname          = $request->input('surname');
            $customer->email            = $request->input('email');
            $customer->cpfCnpj          = $request->input('cpfCnpj');
            $customer->telefone         = $request->input('telefone');
            $customer->mobilePhone      = $request->input('mobilePhone');
            $customer->address          = $request->input('address');
            $customer->addressNumber    = $request->input('addressNumber');
            $customer->complement       = $request->input('complement');
            $customer->province         = $request->input('province');
            $customer->city             = $request->input('city');
            $customer->state            = $request->input('state');
            $customer->postalCode       = $request->input('postalCode');

            $customer->save();
            $customer_id = $customer->id;

            //==================
            //Create ORDER
            //==================
            $order = new Order();

            $order->code                = '';
            $order->customer_id         = $customer_id;
            $order->line_items          = json_encode( $shoppingCart );
            $order->amout               = $cart_total_price;
            $order->status              = 'draft';
            $order->payment_status      = 'pending';
            $order->payment_method      = $request->input('payment_method');
            $order->payment_details     = '';
            $order->checkout_status     = 'open';          

            $order->save();

            $order_id = $order->id;

            // Request API

            $request_api = $this->request_gateway_api();
            

            if( !empty( $request_api ) ) {
                $order_code = '123456789';
                $status_request = 'success';
                $trans_code = '11111';
                //============
                // Será feito um registro no banco de dados como uma tentativa de pagamento que falhou
                //============
            }

            return redirect('/checkout/'.$order_code.'/'.$status_request.'/'.$trans_code);

        } else {

            return view('checkout');

        }
        
    }

    /*
    Request API
    */

    public function request_gateway_api($type="", $data="")
    {
        // return true;

        if( $type == 'customer') {

        } elseif( $type == 'order' ) {
            
        } elseif( $type == 'payment' ) {
            
        }

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://sandbox.asaas.com/api/v3/customers', [
        'body' => '{"name":"John Doe","email":"john.doe@asaas.com.br","phone":"4738010919","mobilePhone":"4799376637","cpfCnpj":"24971563792","postalCode":"01310-000","address":"Av. Paulista","addressNumber":"150","complement":"Sala 201","province":"Centro","externalReference":"12987382","notificationDisabled":false,"additionalEmails":"john.doe@asaas.com,john.doe.silva@asaas.com.br","municipalInscription":"46683695908","stateInscription":"646681195275","observations":"ótimo pagador, nenhum problema até o momento"}',
        'headers' => [
            'accept' => 'application/json',
            'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzUxOTM6OiRhYWNoXzgxOTdiMjQyLTU5MDMtNGEzNS1iMzJmLTgzMzg5YmM0NThhYw==',
            'content-type' => 'application/json',
        ],
        ]);

        $response_content = $response->getBody();

        return $response_content;




        //KEY: $aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzUxOTM6OiRhYWNoXzgxOTdiMjQyLTU5MDMtNGEzNS1iMzJmLTgzMzg5YmM0NThhYw==
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
        $shoppingCart = session( 'shoppingCart' );
        $cart_total_price = session( 'cart_total_price' );
        
        //==============
        // A única informação a ser considerada na URL para a consulta no DB é o ORDER_COD e o TRANS_CODE onde a partir deles, será feita uma busca no DB para que aí sim sejam recuperados os dados detalhes do erro. 
        //==============
        $get_checkout_request_details = '111|Teste da mensagem padrão'; // simulacao
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
                    if( $get_customer_details ) {
                        $get_customer_details = $get_customer_details[0];

                        return view('checkout-obrigado', compact( 'order_code', 'get_order_details', 'get_customer_details' ));
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

    public function auth_asaas_api(Checkout $checkout)
    {
        //
        return true;
    }

}

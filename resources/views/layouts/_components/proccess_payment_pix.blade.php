<div class="form-row">
  <div class="form-group">
  {{-- @php dd($get_payment_details); @endphp --}}
  <div class="PaymentMethods-pix-Form-fieldset">
      <div class="u-sizeFull u-displayFlex">                            
          <div class="input-group mb-3 d-flex flex-column align-items-center">
            @if ( isset($get_payment_details->payment_doc) & !empty($get_payment_details->payment_doc) )
                <img src="data:image/png;base64, {{ $get_payment_details->payment_doc }}" />
            @endif
            @if(isset($get_payment_details->payment_details) & !empty($get_payment_details->payment_details))
            <div class=" mt-2 mb-1">
            <button id="ButtonCopyTextToClipBoard" class="btn btn-success PaymentMethods-items-item-container-content-cta btn blue radius-10" onclick="copyTextToClipBoard('{{ $get_payment_details->payment_details }}')">
                <i class="far fa-copy"></i> 
                COPIAR CHAVE PIX
            </button>
            </div>
            <div class="pt-3 pb-4 text-center">
            <small><small>{{ $get_payment_details->payment_details }}</small></small>
            </div> 
            @endif
              <ol class="text-body ms-2 PaymentMethods-items-item-container-content-description GuidePayment-items">
                  <li class="GuidePayment-items-item">
                  <strong>Aponte seu celular para essa tela</strong> para capturar o código
                  </li>
                  <li class="GuidePayment-items-item">
                  Abra seu <strong>aplicativo  de pagamentos</strong>
                  </li>
                  <li class="GuidePayment-items-item">
                  Confirme os dados e <strong>finalize o pagamento pelo aplicativo</strong>
                  </li>
                  <li class="GuidePayment-items-item">
                  Enviaremos uma <strong>confirmação de compra</strong> pra você
                  </li>
              </ol>
              <div class="GuidePayment-items">
                  <p class="GuidePayment-items-item text-body ms-2 PaymentMethods-items-item-container-content-description">
                      <i class="GuidePayment-items-item-icon fas fa-info-circle"></i>
                      Você também pode finalizar o pagamento copiando e colando o código em seu aplicativo 
                  </p>
                  <p class="GuidePayment-items-item text-body ms-2 PaymentMethods-items-item-container-content-description">
                      <i class="GuidePayment-items-item-icon fas fa-info-circle"></i>
                      Essa chave PIX é válida até:  <strong> {{ date( 'd/m/Y', strtotime( $get_payment_details->date_due) ) }}</strong>.
                  </p>
                  </div>
          </div>
      </div>
      
  </div>

  
  
  </div>
  </div>
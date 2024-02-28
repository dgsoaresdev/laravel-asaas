<div class="form-row">
  <div class="form-group">
  {{-- @php dd($get_payment_details); @endphp --}}
  <div class="PaymentMethods-pix-Form-fieldset">
      <div class="u-sizeFull u-displayFlex">                            
          <div class="input-group mb-3 d-flex flex-column align-items-center">
            @if ( isset($get_payment_details->payment_doc) & !empty($get_payment_details->payment_doc) )
                <a href="{{ $get_payment_details->payment_doc }}" target="_blank" class="btn btn-success radius-10">
                <i class="far fa-pdf"></i> 
                ACESSAR BOLETO
                </a>
            @endif
            @if(isset($get_payment_details->payment_details) & !empty($get_payment_details->payment_details))
            
            <div class="pt-3 pb-4 text-center">
            <small><small>{{ $get_payment_details->payment_details }}</small></small>
            </div> 
            @endif
              <ol class="text-body ms-2 PaymentMethods-items-item-container-content-description GuidePayment-items">
                  <li class="GuidePayment-items-item">
                  <strong>Você pode pagar o boleto em qualquer instituição bancária</strong>
                  </li>
                  <li class="GuidePayment-items-item">
                  Pague o seu boleto até a data do dia <strong>{{ date( 'd/m/Y', strtotime( $get_payment_details->date_due) ) }}</strong>
                  </li>
                  
              </ol>
              <div class="GuidePayment-items">
                  <p class="GuidePayment-items-item text-body ms-2 PaymentMethods-items-item-container-content-description">
                      <i class="GuidePayment-items-item-icon fas fa-info-circle"></i>
                      Descrições de exemplo. 
                  </p>
                 
                  </div>
          </div>
      </div>
      
  </div>

  
  
  </div>
  </div>
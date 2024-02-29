 <div class="form-row">
     <div class="form-group col-md-6">
      <label for="cartao_nome">Nome impresso no cartão</label>
      <input type="text" class="form-control" id="cartao_nome" name="cartao_nome" placeholder="Nome do titular do cartão..." value="{{ old('cartao_nome') }}">
    </div>
    <div class="form-group col-md-6">
      <label for="cartao_numero">Número do cartão</label>
      <input type="text" class="form-control" id="cartao_numero" name="cartao_numero" placeholder="0000 0000 0000 0000" maxlength="19" minlength="16" value="{{ old('cartao_numero') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
      <label for="cartao_data_mes">Validade (Mês)</label>
      <select class="form-control" name="cartao_data_mes"  id="cartao_data_mes">
        <option selected>Selecione...</option>
        <option value="01">01 (JAN)</option>
        <option value="02">02 (FEV)</option>
        <option value="03">03 (MAR)</option>
        <option value="04">04 (ABR)</option>
        <option value="05">05 (MAI)</option>
        <option value="06">06 (JUN)</option>
        <option value="07">07 (JUL)</option>
        <option value="08">08 (AGO)</option>
        <option value="09">09 (SET)</option>
        <option value="10">10 (OUT)</option>
        <option value="11">11 (NOV)</option>
        <option value="12">12 (DEZ)</option>
      </select>
      {{-- <input type="text" class="form-control" id="cartao_data_mes" name="cartao_data_mes" placeholder="MM" maxlength="2" minlength="2" value="{{ old('cartao_data_mes') }}"> --}}
    </div>
    <div class="form-group col-md-4">
      <label for="cartao_data_ano">Validade (Ano)</label>
      <select class="form-control" name="cartao_data_ano"  id="cartao_data_ano">
        <option selected>Selecione...</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
      </select>
      {{-- <input type="text" class="form-control" id="cartao_data_ano" name="cartao_data_ano" placeholder="AAAA" maxlength="4" minlength="2" value="{{ old('cartao_data_ano') }}"> --}}
    </div>
    <div class="form-group col-md-4">
      <label for="cartao_codigo">CVV</label>
      <input type="text" class="form-control" id="cartao_codigo" name="cartao_codigo" placeholder="1111" maxlength="4" minlength="3"  value="{{ old('cartao_codigo') }}">
    </div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
      <label for="cartao_parcela">Parcela</label>
      <select class="form-control" name="cartao_parcela"  id="cartao_parcela">
        <option selected>Selecione...</option>
        <option value="1">1x R$ 500,00</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="data_cartao">CPF do titular</label>
      <input type="text" class="form-control" id="cartao_cpf" name="cartao_cpf" minlength="11" maxlength="15" placeholder="00000000000" value="{{ old('cartao_cpf') }}">
    </div>    
</div>
  
    
<div class="form-row">
  <div class="form-group">
  <button type="submit" name="payment_method" value="cartao" class="btn btn-success">Pagar com segurança</button>
  </div>
  </div>

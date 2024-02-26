{{ $slot }}
<form action="{{ route('checkout') }}" method="post">
    @csrf
 <div class="form-row">
     <div class="form-group col-md-6">
      <label for="cartao_nome">Nome impresso no cartão</label>
      <input type="text" class="form-control" id="cartao_nome" name="cartao_nome" placeholder="Nome do titular do cartão...">
    </div>
    <div class="form-group col-md-6">
      <label for="cartao_numero">Número do cartão</label>
      <input type="text" class="form-control" id="cartao_numero" name="cartao_numero" placeholder="0000 0000 0000 0000">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="cartao_data">Data de validade</label>
      <input type="text" class="form-control" id="cartao_data" name="cartao_data" placeholder="MM/AA">
    </div>
    <div class="form-group col-md-6">
      <label for="cartao_codigo">Código do cartão</label>
      <input type="text" class="form-control" id="cartao_codigo" name="cartao_codigo" placeholder="1111">
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
      <input type="text" class="form-control" id="cartao_cpf" name="cartao_cpf" placeholder="00000000000">
    </div>    
</div>
  
    
<div class="form-row">
  <div class="form-group">
  <button type="submit" class="btn btn-success">Pagar com segurança</button>
  </div>
  </div>
</form>
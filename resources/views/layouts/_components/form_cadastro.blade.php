{{ $slot }}
<form method="post">
    @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome..." required>
    </div>
    <div class="form-group col-md-6">
      <label for="sobrenome">Sobrenome</label>
      <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Seu sobrenome..." required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Seu E-mail..." required>
    </div>
    <div class="form-group col-md-6">
      <label for="telefone">Telefone</label>
      <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(11) 88888-7777)" required>
    </div>
  </div>
  <div class="form-group">
    <label for="endereco">Endereço</label>
    <input type="text" class="form-control" id="endereco"  name="endereco" placeholder="Logradouro, Bairro, Número..." required>
  </div>
  <div class="form-group">
    <label for="complemento">Complemento</label>
    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Bloco, Apartamento, ..." required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="cidade">Cidade</label>
      <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Sua cidade..." required>
    </div>
    <div class="form-group col-md-4">
      <label for="estado">Estado</label>
      <select id="estado" name="estado" class="form-control" required>
        <option selected>Selecione...</option>
        <option value="SP">SP</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="cep">CEP</label>
      <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP..." required>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group p-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required>
      <label class="form-check-label" for="gridCheck">
        Li e  Concordo com os <a href="#">Termos e Políticas</a> da plataforma.
      </label>
    </div>
  </div>
  </div>
</form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Nome <span>*</span></label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome..." value="{{ $data_fields['name'] ? $data_fields['name'] : old('name') }}" >
    </div>
    <div class="form-group col-md-6">
      <label for="surname">Sobrenome <span>*</span></label>
      <input type="text" class="form-control" id="surname" name="surname" placeholder="Seu sobrenome..." value="{{ $data_fields['surname'] ? $data_fields['name'] : old('surname') }}" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="email">E-mail <span>*</span></label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $data_fields['email'] ? $data_fields['email'] : old('email') }}" placeholder="Seu E-mail..." required>
    </div>
    <div class="form-group col-md-6">
      <label for="cpfCnpj">CPF/CNPJ <span>*</span></label>
      <input type="text" class="form-control" id="cpfCnpj" name="cpfCnpj" value="{{ $data_fields['cpfCnpj'] ? $data_fields['cpfCnpj'] : old('cpfCnpj') }}" placeholder="Seu CPF ou CNPJ..." minlength="11" maxlength="15" required>
    </div>
    
  </div>
  
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="telefone">Telefone</label>
      <input type="tel" class="form-control" id="telefone" name="telefone" value="{{ $data_fields['telefone'] ? $data_fields['telefone'] : old('telefone') }}" placeholder="(11) 3333-4444" minlength="10" maxlength="15" required>
    </div>
    <div class="form-group col-md-6">
      <label for="mobilePhone">Celular <span>*</span></label>
      <input type="tel" class="form-control" id="mobilePhone" name="mobilePhone" value="{{ $data_fields['mobilePhone'] ? $data_fields['mobilePhone'] : old('mobilePhone') }}" minlength="11" maxlength="15" placeholder="(11) 88888-7777" required>
    </div>
  </div>

<div class="form-row">
  <div class="form-group col-md-12">
    <label for="address">Endereço (logradouro) <span>*</span></label>
    <input type="text" class="form-control" id="address"  name="address" value="{{ $data_fields['address'] ? $data_fields['address'] : old('address') }}" placeholder="Rua.., Avenida..., Alameda..." required>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-3">
      <label for="addressNumber">Número <span>*</span></label>
      <input type="text" class="form-control" id="addressNumber" name="addressNumber" value="{{ $data_fields['addressNumber'] ? $data_fields['addressNumber'] : old('addressNumber') }}" placeholder="Número..." required>
    </div>
    <div class="form-group col-4">
      <label for="complement">Complemento</label>
      <input type="text" class="form-control" id="complement" name="complement" value="{{ $data_fields['complement'] ? $data_fields['complement'] : old('complement') }}" placeholder="Número...">
    </div>
    <div class="form-group col-5">
      <label for="province">Bairro <span>*</span></label>
      <input type="text" class="form-control" id="province" name="province" value="{{ $data_fields['province'] ? $data_fields['province'] : old('province') }}" placeholder="Bairro..." required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="city">Cidade</label>
      <input type="text" class="form-control" id="city" name="city" value="{{ $data_fields['city'] ? $data_fields['city'] : old('city') }}" placeholder="Sua cidade..." required>
    </div>
    <div class="form-group col-md-4">
      <label for="state">Estado</label>
      <select id="state" name="state" class="form-control" required>
        <option selected>Selecione...</option>
        <option value="SP" {{ $data_fields['state'] === 'SP' ? ' selected' : '' }} >SP</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="postalCode">CEP</label>
      <input type="text" class="form-control" id="postalCode" name="postalCode" value="{{ $data_fields['postalCode'] ? $data_fields['postalCode'] : old('postalCode') }}" minlength="8" maxlength="10" placeholder="CEP..." required>
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
{{ $slot }}
<form action="{{ route('checkout') }}" method="post">
    @csrf
 
<div class="form-row">
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Li e  Concordo com os <a href="#">Termos e Políticas</a> da plataforma.
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Pagar com segurança</button>
  </div>
</form>
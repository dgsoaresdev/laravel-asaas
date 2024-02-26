{{ $slot }}
<form action="{{ route('checkout') }}" method="post">
    @csrf
 
<div class="form-row">
  <div class="form-group">
  <button type="submit" class="btn btn-success">Pagar com segurança</button>
  </div>
  </div>
</form>
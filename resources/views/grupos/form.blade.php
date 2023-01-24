<div class="form-group">
  <label class="form-label" for="default-03">Instructor</label>
  <div class="form-control-wrap">
      <div class="form-icon form-icon-left">
          <em class="icon ni ni-user"></em>
      </div>
      <input type="text" class="form-control" id="default-03" value="{{ auth()->user()->name }}" disabled>
  </div>
</div>
<div class="form-group">
  <label class="form-label" for="default-03">Nombre del grupo</label>
  <div class="form-control-wrap">
      <div class="form-icon form-icon-left">
        <em class="icon ni ni-text"></em>
      </div>
      <input type="text" class="form-control" id="default-03" name="nombre" value="{{ isset( $grupo->nombre ) ? $grupo->nombre : '' }}" required>
  </div>
</div>
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

@if (isset($usuarios))
<div class="form-group">
  <label class="form-label" for="default-07">Aprendices asignados al grupo</label>
  <div class="form-control-wrap">
    @foreach ($usuarios as $user)
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="{{ $user->id }}" value="{{ $user->id }}" name="aprendices[]" 
      @foreach ($aprendices as $aprendiz)
        @if($user->email == $aprendiz->email) checked @endif
      @endforeach
      >
      <label class="custom-control-label" for="{{ $user->id }}">{{ $user->name }}</label>
    </div>
    <br><br>
    @endforeach
  </div>
</div>
@endif

<button type="submit" class="btn btn-primary">Guardar</button>
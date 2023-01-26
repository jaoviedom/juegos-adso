@extends('layouts.main')

@section('titulo', 'Detalle del ejercicio')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">Detalle del ejercicio</h2>
      <div class="nk-block-des">
          <p class="lead">Vista previa.</p>
      </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <div class="preview-block">
      <h3 class="fw-normal">Categoría: {{ $ejercicio->categoria }}</h3>
      <h5 class="fw-normal">Número: {{ $ejercicio->id }}</h5>
      <div class="code-block">
        <h6 class="overline-title title">Enunciado</h6>
        <button class="btn btn-sm clipboard-init" title="Copiado al portapapeles" data-clipboard-target="#formElements" data-clip-success="Copiado" data-clip-text="Copiar"><span class="clipboard-text">Copiar</span></button>
        <pre class="prettyprint lang-html" id="formElements">
{{ $ejercicio->enunciado }}
        </pre>
      </div>
      <form action="{{ route('respuesta.store') }}" method="post" class="needs-validation" novalidate>
          @csrf
  {{ $pregejercicio }}
      @foreach ($pregejercicio as $item)
      <h3>Pregunta {{ $item->numero + 1 }}:</h3>
      <div class="form-group">
        <label class="form-label" for="default-03">Respuesta Correcta</label>
        <input type="hidden" name="idpregunta[]" value="{{ $item->preguntas_id }}">
        <div class="form-control-wrap">
            <div class="form-icon form-icon-left">
              <em class="icon ni ni-check-circle"></em>
            </div>
            <input type="text" class="form-control" id="default-03" name="nombre" value="{{ $item->texto }}" required disabled>
        </div>
        <label class="form-label" for="default-03">Respuesta Incorrecta</label>
        <div class="form-control-wrap">
            <div class="form-icon form-icon-left">
              <em class="icon ni ni-cross-circle"></em>
            </div>
            <input type="text" class="form-control" id="default-03" name="respuesta[]" value="" required>
        </div>
        <label class="form-label" for="default-03">Respuesta Incorrecta</label>
        <div class="form-control-wrap">
            <div class="form-icon form-icon-left">
              <em class="icon ni ni-cross-circle"></em>
            </div>
            <input type="text" class="form-control" id="default-03" name="respuesta[]" value="" required>
        </div>
        <label class="form-label" for="default-03">Respuesta Incorrecta</label>
        <div class="form-control-wrap">
            <div class="form-icon form-icon-left">
              <em class="icon ni ni-cross-circle"></em>
            </div>
            <input type="text" class="form-control" id="default-03" name="respuesta[]" value="" required>
        </div>
      </div>
      @endforeach
      <a href="{{ route('ejercicios.index') }}" class="mt-3 btn btn-secondary"><em class="icon ni ni-arrow-left"></em> Volver</a>
      <button type="submit" class="mt-3 btn btn-secondary"><em class="icon ni ni-arrow-left"></em> Guardar</button>

      </form>
    </div>
  </div>
</div>
@endsection
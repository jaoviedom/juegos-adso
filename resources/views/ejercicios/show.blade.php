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
      <h3>Pregunta 1:</h3>
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <h3>Pregunta 2:</h3>
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <h3>Pregunta 3:</h3>
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <h3>Pregunta 4:</h3>
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <input type="text" name="" id="" class="form-control">
      <a href="{{ route('ejercicios.index') }}" class="mt-3 btn btn-secondary"><em class="icon ni ni-arrow-left"></em> Volver</a>
    </div>
  </div>
</div>
@endsection
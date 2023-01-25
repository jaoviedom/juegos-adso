@extends('layouts.aprendiz')

@section('titulo', 'Ejercicios')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
    <h2 class="nk-block-title fw-normal">Ejercicio {{ $ejercicio->id }}</h2>
    <div class="nk-block-des">
      <p class="lead"></p>
    </div>
  </div>
</div>
<div class="code-block">
  <h6 class="overline-title title">Enunciado</h6>
  <pre class="prettyprint linenums lang-py" id="formElements" style="max-height: 100%;">{{ $strEjercicio }}</pre>
</div>

<div class="card card-bordered card-preview">
  <div class="card-inner">
    <form action="{{ route('ejercicios.guardarRespuestas') }}" method="post" class="needs-validation" novalidate>
      @csrf
      <input type="hidden" name="ejercicio_id" value="{{ $ejercicio->id }}">
      @foreach ($preguntas as $i => $pregunta)
        <label class="form-label">Seleccione la opción que corresponde al campo número {{ $i + 1 }}</label>
        <input type="hidden" name="preguntas[]" value="{{ $pregunta->id }}">
        <select class="form-select" name="respuestas[]" required>
          <option value="" disabled selected>Seleccione...</option>
          @foreach ($respuestas as $respuesta)
            @foreach ($respuesta as $item)
              @if ($item->pregunta_id == $pregunta->id)
                <option value="{{ $item->id }}">{{ $item->texto  }}</option>
              @endif
            @endforeach
          @endforeach
        </select>
      @endforeach
      <button class="btn btn-secondary mt-3" type="submit">Guardar</button>
    </form>
  </div>
</div>
@endsection

@section('scripts')
    <script>
      (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
      })()
    </script>
@endsection
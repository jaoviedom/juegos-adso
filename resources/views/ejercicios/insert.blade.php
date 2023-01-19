@extends('layouts.main')

@section('titulo', 'Nuevo ejercicio')
@section('nombre-usuario', 'Nombre de usuario')

@section('content')
<div class="nk-block-head-content">
  <h2 class="nk-block-title fw-normal">Crear ejercicio</h2>
  <div class="nk-block-des">
      <p class="lead">Cree un nuevo ejercicio.</p>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
      <div class="preview-block">
        <form action="{{ route('ejercicios.store') }}" method="post" class="needs-validation" novalidate>
          @csrf
          <div class="form-group">
            <label class="form-label" for="default-06">Categoría</label>
            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control" id="default-06" name="categoria" required>
                        <option selected disabled>Seleccione...</option>
                        <option value="Condicionales">Condicionales</option>
                        <option value="Ciclo for">Ciclo for</option>
                        <option value="Ciclo while">Ciclo while</option>
                    </select>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="default-textarea">Enunciado</label>
            <div class="form-control-wrap">
                <textarea class="form-control no-resize" id="default-textarea" name="enunciado" required>Ingrese el cuerpo del enunciado...</textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
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
@extends('layouts.main')

@section('titulo', 'Editar grupo')

@section('content')
<div class="nk-block-head-content">
  <h2 class="nk-block-title fw-normal">Editar grupo</h2>
  <div class="nk-block-des">
      <p class="lead">Ingrese los nuevos datos del grupo.</p>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
      <div class="preview-block">
        <form action="{{ route('grupos.update', $grupo->id) }}" method="post" class="needs-validation" novalidate>
          @csrf
          @method('PUT')
          @include('grupos.form')
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
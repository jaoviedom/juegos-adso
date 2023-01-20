@extends('layouts.main')

@section('titulo', 'Ejercicios')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">Ejercicios</h2>
      <div class="nk-block-des">
          <p class="lead">Banco de ejercicios.</p>
      </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <table class="datatable-init table">
        <thead>
            <tr class="tb-tnx-head">
                <th>#</th>
                <th>Categoría</th>
                <th>Enunciado</th>
                <th><span>&nbsp;</span></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($ejercicios as $item)
            <tr class="tb-tnx-item">
              <td class="tb-tnx-id">
                {{ $item->id }}
              </td>
              <td class="">
                <div class="tb-tnx-desc">
                    <span class="title">{{ $item->categoria }}</span>
                </div>
              </td>
              <td class="">
                <div class="">
                  <div class="code-block">
                    <h6 class="overline-title title">Código</h6>
                    <button class="btn btn-sm clipboard-init" title="Copy to clipboard" data-clipboard-target="#formElements{{ $item->id }}" data-clip-success="Copiado" data-clip-text="Copiar"><span class="clipboard-text">Copiar</span></button>
                    <pre class="prettyprint lang-html" id="formElements{{ $item->id }}">{{ $item->enunciado }}</pre>
                  </div>
                </div>
              </td>
              <td class="tb-tnx-action">
                <div class="dropdown">
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                        <ul class="link-list-plain">
                            <li><a href="{{ route('ejercicios.show', $item->id) }}">Ver</a></li>
                            <li><a href="{{ route('ejercicios.edit', $item->id) }}">Editar</a></li>
                            <li>
                              <form method="POST" action="{{ route('ejercicios.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link show_confirm">Borrar</button>
                              </form>
                            </li>
                        </ul>
                    </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
  $('.show_confirm').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();

    swal({
      title: '¿Está seguro de eliminar el ejercicio?',
      text: "Esta acción no se podrá deshacer.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })

    .then((willDelete) => {
      if (willDelete) {
        form.submit();
      }
    });
   });
</script>
@endsection
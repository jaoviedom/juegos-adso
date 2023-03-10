@extends('layouts.main')

@section('titulo', 'Grupos')

@section('content')
<div class="nk-block-head nk-block-head-lg wide-sm">
  <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">Grupos</h2>
      <div class="nk-block-des">
          <p class="lead">Grupos creados.</p>
      </div>
  </div>
</div>
<div class="card card-bordered card-preview">
  <div class="card-inner">
    <table class="datatable-init table">
        <thead>
            <tr class="tb-tnx-head">
                <th>Nombre del grupo</th>
                <th><span>&nbsp;</span></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($grupos as $item)
            <tr class="tb-tnx-item">
              <td class="">
                <div class="tb-tnx-desc">
                    <span class="title">{{ $item->nombre }}</span>
                </div>
              </td>
              <td class="tb-tnx-action">
                <div class="dropdown">
                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                        <ul class="link-list-plain">
                            <li><a href="{{ route('grupos.show', $item->id) }}">Ver</a></li>
                            <li><a href="{{ route('grupos.edit', $item->id) }}">Editar</a></li>
                            <li>
                              <form method="POST" action="{{ route('grupos.destroy', $item->id) }}">
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
      title: '??Est?? seguro de eliminar el grupo?',
      text: "Esta acci??n no se podr?? deshacer.",
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
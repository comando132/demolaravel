@extends('layouts.app')
@section('content')
    <div class="row justify-content-end">
        <div class="col-1"><a class="btn btn-primary" href="{{ route('agregar-empleado') }}">Agregar</a></div>
    </div>
    <br class="clearfix" />
    <div class="row">
        @foreach ($employees as $emp)
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ "{$emp->firstName} {$emp->lastName} (#{$emp->employeeNumber})" }}</h5>
                        <p class="card-text">
                            <strong>{{ $emp->jobTitle }} </strong><br />
                            {{ $emp->email}} <br />
                            {{ $emp->extension}}
                        </p>
                        <a href="{{ route('editar-empleado',['id' => $emp->employeeNumber])}}" class="btn btn-primary">Editar</a>
                        @if ($emp->employeeNumber > 1143)
                            <a href="javascript:void(0)" class="btn btn-danger" onclick="mostrarModal({{ $emp->employeeNumber }}, '{{ "{$emp->firstName} {$emp->lastName}" }}')">Borrar</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="confirmacion" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Borrar Empleado</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modal-body" class="modal-body">
            </div>
            <div class="modal-footer">
              <a id="borrar_empleado" href="javascript:void(0)" class="btn btn-danger">Borrar</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
  @endsection
  @section('scripts')
    <script>
        function mostrarModal(id, nombre) {
            $('#modal-body').html(`¿Estas seguro de borrar el empleado <strong>#${id}:</strong> ${nombre}?`);
            let url = "{{route('borrar-empleado', ['id' => '_ID_'])}}";
            url = url.replace('_ID_', id);
            $('#borrar_empleado').attr('href', url);
            $('#confirmacion').modal({
                backdrop : 'static',
                show: true,
            });
        }

        $('#confirmacion').on('hide.bs.modal', function (e) {
            $('#borrar_empleado').attr('href', 'javascript:void(0)');
        });
    </script>

  @endsection

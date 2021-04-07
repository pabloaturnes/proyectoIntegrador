@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($seminario->idseminario) && $seminario->idseminario > 0 ? $seminario->idseminario : 0; ?>';
    <?php $globalId = isset($seminario->idseminario) ? $seminario->idseminario : "0";?>

</script>
    @endsection
    @section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/admin/seminarios">Seminario;</a></li>
        <li class="breadcrumb-item active">Modificar</li>
    </ol>
    <ol class="toolbar">
        <li class="btn-item"><a title="Nuevo" href="/admin/seminario/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
        <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
        </li>
        @if($globalId > 0)
        <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
        </li>
        @endif
        <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
    </ol>
<script>
function fsalir(){
    location.href ="/admin/seminarios";
}
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="panel-body">
        <div id = "msg"></div>
        <?php
if (isset($msg)) {
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
        <form id="form1" method="POST" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                <div class="form-group col-lg-6">
                    <label>Nombre: *</label>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="{{ $seminario->nombre or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha Curso</label>
                    <input type="date" id="txtFechaCurso" name="txtFechaCurso" class="form-control"  value="{{ $seminario->fecha_curso or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Contenido: *</label>
                    <input type="text" id="txtContenido" name="txtContenido" class="form-control" value="{{ $seminario->contenido or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Horario: *</label>
                    <input type="text" id="txtHorario" name="txtHorario" class="form-control" value="{{ $seminario->horario or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Descripcion: *</label>
                    <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" value="{{ $seminario->descripcion or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Observacion: *</label>
                    <input type="text" id="txtObservacion" name="txtObservacion" class="form-control" value="{{ $seminario->observacion or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                 <label for="fileImagen">Imagen:</label>
                    <input type="file" class="form-control-file" name="archivo" id="archivo">
                    <img src="/web/img/{{ $seminario->imagen or '' }}" class="img-thumbnail"  style="height: 80px;">
                </div>
                <div class="form-group col-lg-6">
                    <label>Direccion: *</label>
                    <input type="text" id="txtDireccion" name="txtDireccion" class="form-control" value="{{ $seminario->direccion or '' }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Fecha Carga</label>
                    <input type="date" id="txtFechaCarga" name="txtFechaCarga" class="form-control"  value="{{ $seminario->fecha_carga or '' }}" required>
                </div>
            </div>
        </form>
</div>
<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar registro?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">¿Deseas eliminar el registro actual?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" onclick="eliminar();">Sí</button>
          </div>
        </div>
      </div>
    </div>
<script>

    $("#form1").validate();

    function guardar() {
        if ($("#form1").valid()) {
            modificado = false;
            form1.submit();
        } else {
            $("#modalGuardar").modal('toggle');
            msgShow("Corrija los errores e intente nuevamente.", "danger");
            return false;
        }
    }

    function eliminar() {
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/seminarios/eliminar') }}",
            data: { id:globalId },
            async: true,
            dataType: "json",
            success: function (data) {
                if (data.err = "0") {
                    msgShow("Registro eliminado exitosamente.", "success");
                    $("#btnEnviar").hide();
                    $("#btnEliminar").hide();
                    $('#mdlEliminar').modal('toggle');
                } else {
                    msgShow("Error al eliminar", "success");
                }
            }
        });
    }

</script>
@endsection
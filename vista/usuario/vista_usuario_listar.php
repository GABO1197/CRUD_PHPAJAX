
<script type="text/javascript" src="../js/usuario.js?rev=<?php echo time();?>"></script>

<div class="col-md-12">
    <div class="card card-warning shadow">
      <div class="card-header with-border">
        <h3 class="card-title">BIENVENIDO USUARIO</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="col-lg-10">
            <div class="input-group">
              
              <input type="text" class="global_filter form-control" id="global_filter" placeholder="Ingresar dato a buscar">
              <span class="input-group-text"><i class="fa fa-search"></i></span>
              <br>
              <div class="col-lg-2">
                <button  class="btn btn-danger" style="width:200px" onclick="AbrirmodalRegistro()"><i class="fa fa-plus-circle" aria-hidden="true"></i>Nuevo registro</button>
              </div>
          </div>
          
        </div>
        <table id="tabla_usuario" class="display  responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Sexo</th>
                    <th>Estatus</th>
                    <th>Acci&oacute;n</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Sexo</th>
                    <th>Estatus</th>
                    <th>Acci&oacute;n</th>
                </tr>
            </tfoot>
        </table>
      </div>
    </div>
</div>
<form autocomplete="false" onsubmit="return false">
<div class="modal fade" id="modal_registro"  aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Registro de usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                  <label for="">Usuario</label>
                  <input type="text" class="form-control" id="txt_usu" placeholder="Ingrese usuario"><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Contrase&ntilde;a</label>
                  <input type="password" class="form-control" id="txt_con1" placeholder="Ingrese su Contrase&ntilde;a"><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Repita la Contrase&ntilde;a</label>
                  <input type="password" class="form-control" id="txt_con2" placeholder="Repita la Contrase&ntilde;a"><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Rol</label>
                  <select class="js-example-basic-single" id="cbm_rol"name="cbm_rol" style="width: 100%;">
                   
                  </select><br><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Sexo</label>
                  <select class="js-example-basic-single" id="cbm_sexo"name="cbm_sexo" style="width: 100%;">
                   <option value="M">MASCULINO</option>
                   <option value="F">FEMENINO</option>
                  </select><br><br>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"><b>&nbsp;cerrar</b></i></button>
              <button type="button" class="btn btn-success" onclick="Registrar_Usuario()"><i class="fa fa-check"><b>&nbsp;registrar</b></i></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
</form>

<form autocomplete="false" onsubmit="return false">
<div class="modal fade" id="modal_editar"  aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar datos del usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                  <input type="text" id="txtidusuario" class="form-control" hidden>
                  <label for="">Usuario</label>
                  <input type="text" class="form-control" id="txt_usu_editar" placeholder="Ingrese usuario" disa><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Rol</label>
                  <select class="js-example-basic-single" id="cbm_rol_editar"name="cbm_rol" style="width: 100%;">
                   
                  </select><br><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Sexo</label>
                  <select class="js-example-basic-single" id="cbm_sexo_editar"name="cbm_sexo" style="width: 100%;">
                   <option value="M">MASCULINO</option>
                   <option value="F">FEMENINO</option>
                  </select><br><br>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"><b>&nbsp;cerrar</b></i></button>
              <button type="button" class="btn btn-success" onclick="Modificar_Usuario()"><i class="fa fa-check"><b>&nbsp;Modificar</b></i></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</form>




<script>
  $(document).ready(function(){
    listar_usuario();
  });
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    listar_combo_rol();
    $('#modal_registro').on('shown.bs.modal',function(){
      $('#txt_usu').focus();
    })
});
</script>
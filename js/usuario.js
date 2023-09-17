function verificar_usuario(){
    var usu= $('#txt_usuario').val();
    var con= $('#txt_con').val();
    if(usu-length==0 || con.length==0){
        return Swal.fire("Mensaje de abvertencia","los campos estan vacios","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_verificar_usuario.php',
        type: 'post',
        data:{
            user : usu,
            pass: con
        }
    }).done(function(resp){
        if(resp==0){
        Swal.fire("Mensaje De Error","Usuario y/o contrase\u00f1a incorrecta","error");
        }else{
            var data=JSON.parse(resp);
            if(data[0][5]==='INACTIVO'){
                return Swal.fire("Mensaje de abvertencia","Lo sentimos el usuario "+usu+" se encuentra inactivo","warning");
            }
            $.ajax({
                url:'../controlador/usuario/controlador_crear_sesion.php',
                type: 'post',
                data:{
                    idusuario :data[0][0],
                    user: data[0][2],
                    rol: data[0][6]
                }
            }).done(function(resp){
                let timerInterval
                Swal.fire({
                title: 'BIENVENIDO AL SISTEMA',
                html: 'USTED SERA REDIRECCIONADO EN <b></b> MILISEGUNDOS.',
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                    // console.log('I was closed by the timer')
                }
                })
            })
            
        }
    })
}
var table;
function listar_usuario(){
     table = $("#tabla_usuario").DataTable({
       "ordering":false,   
       "bLengthChange":false,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/usuario/controlador_usuario_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"usu_nombre"},
           {"data":"rol_nombre"},
           {"data":"usu_sexo",
                render: function (data, type, row ) {
                    if(data=='M'){
                        return "MASCULINO";                   
                    }else{
                        return "FEMINO";                 
                    }
                }
           }, 
           {"data":"usu_estatus",
             render: function (data, type, row ) {
               if(data=='ACTIVO'){
                   return "<span class='label label-success'>"+data+"</span>";                   
               }else{
                 return "<span class='label label-danger'>"+data+"</span>";                 
               }
             }
           },  
           {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>"}
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_usuario_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}

$('#tabla_usuario').on('click','.desactivar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    // alert(data.usu_id);
    Swal.fire({
        title: 'Esta seguro de desactivar al usuario?',
        text: "Una vez hecho esto el usuario no tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id,'INACTIVO');
        }
      })
})
$('#tabla_usuario').on('click','.activar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    // alert(data.usu_id);
    Swal.fire({
        title: 'Esta seguro de activar el usuario?',
        text: "Una vez hecho esto el usuario  tendra acceso al sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
            Modificar_Estatus(data.usu_id,'ACTIVO');
        }
      })
})
////////traer campos al modal para actualizar 
$('#tabla_usuario').on('click','.editar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data = table.row(this).data();
    }
    $('#modal_editar').modal('show');
    $('#txtidusuario').val(data.usu_id).trigger("change");
    $('#txt_usu_editar').val(data.usu_nombre).trigger("change");
    $('#cbm_sexo_editar').val(data.usu_sexo).trigger("change");
    $('#cbm_rol_editar').val(data.rol_id).trigger("change");



    
})
// modificar el status
function Modificar_Estatus(idusuario,estatus){
    var mensaje="";
    if(estatus=='INACTIVO'){
        mensaje="desactivo";
    }else{
        mensaje="actuivo";

    }
    $.ajax({
        "url":"../controlador/usuario/controlador_modificar_esatatus_usuario.php",
        type:'POST',
        data:{
            idusuario:idusuario,
            estatus:estatus,
            
        }
    }).done(function(resp){
        // alert(resp);
        if(resp>0){
            Swal.fire("Mensaje De Confirmacion","EL usuario se "+mensaje+" con exito","success")            
                .then ( ( value ) =>  {
                    table.ajax.reload();
                }); 
        }
    })
}


function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function AbrirmodalRegistro(){
    $('#modal_registro').modal('show');
}

function listar_combo_rol(){
    $.ajax({
        "url":"../controlador/usuario/controlador_combo_rol.php",
        type:'post'
    }).done(function(resp){
        // alert(resp);
        var data= JSON.parse(resp);
        var cadena="";

        if(data.length>0){
            for(var i=0; i<data.length; i++){
                cadena+="<option value='"+data[i][1]+"'>"+data[i][2]+"</option>"
            }
            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);

        } else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>"
            $("#cbm_rol").html(cadena);
            $("#cbm_rol_editar").html(cadena);
        }
    })
}

function Registrar_Usuario(){
    var usu = $("#txt_usu").val();
    var contra = $("#txt_con1").val();
    var contra2 = $("#txt_con2").val();
    var sexo = $("#cbm_sexo").val();
    var rol = $("#cbm_rol").val();
    if(usu.length==0 || contra.length==0 || contra.length==0 || contra2.length==0 || sexo.length==0 || rol.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }

    if(contra != contra2){
        return Swal.fire("Mensaje De Advertencia","Las contraseñas deben coincidir","warning");        
    }

    $.ajax({
        "url":"../controlador/usuario/controlador_usuario_registro.php",
        type:'POST',
        data:{
            usuario:usu,
            contrasena:contra,
            sexo:sexo,
            rol:rol
        }
    }).done(function(resp){
        // alert(resp);
        if(resp>0){
            if(resp ==1){
                $("#modal_registro").modal('hide');
                Swal.fire("Mensaje De Confirmacion","Datos correctamente, Nuevo Usuario Registrado","success")            
                .then ( ( value ) =>  {
                    LimpiarRegistro();
                    table.ajax.reload();
                }); 
            }else{
                return Swal.fire("Mensaje De Advertencia","Lo sentimos, el nombre del usuario ya se encuentra en nuestra base de datos","warning");
            }
        }else{
            Swal.fire("Mensaje De Error","Lo sentimos, no se pudo completar el registro","error");
        }
    })


}
// editar el usuario 
function Modificar_Usuario(){
    var idusuario = $("#txtidusuario").val();
    var usuario= $("#txt_usu_editar").val();
    var sexo = $("#cbm_sexo_editar").val();
    var rol = $("#cbm_rol_editar").val();
    if(idusuario.length==0 || usuario.length==0 || sexo.length==0 || rol.length==0 ){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }
    $.ajax({
        "url":"../controlador/usuario/controlador_usuario_modificar.php",
        type:'POST',
        data:{
            idusuario:idusuario,
            usuario:usuario,
            sexo:sexo,
            rol:rol
        }
    }).done(function(resp){
        // alert(resp);
        if(resp>0){
            TraerDatosUsuario();
                $("#modal_editar").modal('hide');
                Swal.fire("Mensaje De Confirmacion","Datos actualizados correctamente","success")            
                .then ( ( value ) =>  {
                    table.ajax.reload();
                    
                }); 
           
        }else{
            Swal.fire("Mensaje De Error","no se pudo completar la actualizacion","error");
        }
    })


}


function LimpiarRegistro(){
    $("#txt_usu").val("");
    $("#txt_con1").val("");
    $("#txt_con2").val("");
}


// para el cambio de  foto por sexo
function TraerDatosUsuario(){
     var usuario= $('#usuarioprincipal').val();
     $.ajax({
        "url":"../controlador/usuario/controlador_traer_usuario.php",
        type:'POST',
        data:{
            usuario:usuario
        }
     }).done(function(resp){
        var data = JSON.parse(resp);
        if(data.length>0){
            // alert(data[0][4]);
            $("#txt_contra_bd").val(data[0][3]);
            if(data[0][4]=="M"){
                $("#img_nav").attr("src","../plantilla/dist/img/avatar5.png");
                $("#img_subnav").attr("src","../plantilla/dist/img/avatar5.png");
                $("#img_lateral").attr("src","../plantilla/dist/img/avatar5.png");
            }else{
                $("#img_nav").attr("src","../plantilla/dist/img/avatar3.png");
                $("#img_subnav").attr("src","../plantilla/dist/img/avatar3.png");
                $("#img_lateral").attr("src","../plantilla/dist/img/avatar3.png");

            }
        }
        // alert(resp);
     })
}
////////////////////////////////

// actualizar contraseña

function AbrirModalEditarContra(){
    $('#modal_editar_contra').modal('show');
    $('#modal_editar_contra').on('shown.bs.modal',function(){
    $('#txt_contra_actual').focus();
    })
}


function Editar_contra(){
    var idusuario=$("#txtidprincipal").val();
    var contrabd=$("#txt_contra_bd").val();
    var contraescrita=$("#txt_contra_actual").val();
    var contranu=$("#txt_contra_nueva").val();
    var contrare=$("#txt_contra_re").val();
    
    if(contraescrita.length==0 || contranu.length==0 || contrare.length==0){
        return Swal.fire("Mensaje de Abvertencia","llene los campos vacios","warning");
    }if(contranu != contrare){
        return Swal.fire("Mensaje de Abvertencia","Debes ingresar la misma clave 2 veces para confirmarla","warning");

    }
    $.ajax({
        url:'../controlador/usuario/controlador_contra_modificar.php',
        type:'POST',
        data:{
            idusuario:idusuario,
            contrabd:contrabd,
            contraescrita:contraescrita,
            contranu:contranu
        }
    }).done(function(resp){
        // alert(resp);
        if(resp>0){

            if(resp==1){
                $("#modal_editar_contra").modal('hide');
                // limpiarEditarContra();
                Swal.fire("Mensaje De Confirmacion","Contrase\u00f1a actualizada correctamente","success")            
                .then ( ( value ) =>  {
                    TraerDatosUsuario();
                }); 
           
            }else{
                Swal.fire("Mensaje de Error","La contrase\u00f1a actual no coincide con la que tenemos en nuestra base de datos","error");
            }
        }else{
            Swal.fire("Mensaje de Error","No se pudo actualizar la contrase\u00f1a","error");
        }
    })
}
function limpiarEditarContra(){
    $("#txt_contra_re").val("");
    $("#txt_contra_nueva").val("");
    $("#txt_contra_actual").val("");
   
    
}
// ///////////////////
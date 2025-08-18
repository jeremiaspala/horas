


    <div class="row layout-top-spacing" id="cancel-row">
      
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                                <div style="display: box; text-align: right; padding: 5px 5px 5px 5px;">
                                    <button class="btn btn-success mb-2 mr-2 btn-rounded" onclick="window.location.href='<?=base_url?>usuarios/nuevo'">Nuevo <svg> <b>+</b> </svg></button>
                                </div>      
                            <div class="table-responsive mb-4 mt-4">
                                <!-- Registro exitoso !-->
                                <?php if(isset($_SESSION['registro']) && $_SESSION['registro']=="ok"){?>
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Success!</strong> Registro Cargado Correctamente.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("registro");
                                }elseif(isset($_SESSION['registro']) && $_SESSION['registro']=="no"){?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Error!</strong> No se ha podido salvar!. Hay errores!.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("registro");
                                } ?>
                                <!-- Registro exitoso !-->
                                <!-- Borrado Exitoso !-->
                                <?php if(isset($_SESSION['delete']) && $_SESSION['delete']=="ok"){?>
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Success!</strong> Registro Eliminado Correctamente.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("delete");
                                }elseif(isset($_SESSION['delete']) && $_SESSION['delete']=="no"){?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Error!</strong> No se ha podido Eliminar!. Hay errores!.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("delete");
                                } ?>
                                <!-- Borrado exitoso !-->
                                <!-- password !-->
                                <?php if(isset($_SESSION['password']) && $_SESSION['password']=="ok"){?>
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Success!</strong> Password Cambiada Correctamente.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("password");
                                }elseif(isset($_SESSION['password']) && $_SESSION['password']=="no"){?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Error!</strong> No se ha podido cambiar la password!. Hay errores!.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("password");
                                } ?>
                                <!-- password !-->
                                <!-- conversion !-->
                                <?php if(isset($_SESSION['conversion']) && $_SESSION['conversion']=="ok"){?>
                                <div class="alert alert-success mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Success!</strong> Usuario Creado Correctamente.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("conversion");
                                Utils::deleteSession('id_conversion');
                                Utils::deleteSession('email_conversion');
                                }elseif(isset($_SESSION['conversion']) && $_SESSION['conversion']=="no"){?>
                                <div class="alert alert-danger mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                    <strong>Error!</strong> No se ha podido convertir en usuario!. Hay errores!.</button>
                                </div> 
                                <?php 
                                Utils::deleteSession("conversion");
                                Utils::deleteSession('id_conversion');
                                Utils::deleteSession('email_conversion');
                                } ?>
                                <!-- password !-->
                                <table id="default-ordering" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre / Apellido</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Celular</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($usuarios as $r):
                                            
                                        ?>
                                        <tr id="p<?=$r['id']?>">
                                            <td><?=$r['nombre']." ".$r['apellidos']?></td>                                            
                                            <td><?=$r['email']?></td>
                                            <td><?=$r['rol']?></td>
                                            <td><?=$r['celular']?></td>
                                            <td class="text-center">
                                               <a onclick="$('#id').attr('value', <?=$r['id']?>);" data-toggle="modal" data-target="#loginModal">Password</a> <br/><a href="<?=base_url?>usuarios/editar&id=<?=$r['id']?>">Editar</a> | <a onclick="eliminarUsuario(<?=$r['id']?>);">Eliminar</a>
                                            </td>
                                        </tr>
                                        <?php                               
                                        endforeach;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre / Apellido</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Celular</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>
                                <!-- Modal -->
                                    <div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                              <form class="mt-0" action="<?=base_url?>usuarios/password" method="post">
                                                <div style="font-weight: bold; color:red;">La password debe contener mínusculas y números! </div><br/>
                                              <div class="form-group">
                                                  
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                <input type="password" class="form-control mb-4" id="pass1" placeholder="Password" name="pass1" required="true" onkeyup="validar();">
                                              </div>
                                                <div class="form-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                                <input type="password" class="form-control mb-4" id="pass2" placeholder="Password" name="pass2" required="true" onkeyup="validar();">
                                                <br/><span style="color:yellow" id="alerta"></span>
                                                </div>
                                                <input type="hidden" name="id" id="id">
                                                <button id="cambiar" type="submit" class="btn btn-primary mt-2 mb-2 btn-block" disabled="true">Cambiar Password</button>
                                            </form>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                <!-- Modal -->
<script type="text/javascript">
function validar(){
    var p1 = document.getElementById("pass1").value;
    var p2 = document.getElementById("pass2").value;
    if(validar_clave(p1)){
        if(validar_clave(p2)){
            if (p1 != p2) {
                $('#alerta').html("Las passwords deben de coincidir");
                 $('#cambiar').attr("disabled", true);
              } else {
                $('#alerta').html("Excelente!");
                $('#cambiar').attr("disabled", false);
              }
        }else{
            $('#alerta').html("La password 2 no cumple con los requisitos");
             $('#cambiar').attr("disabled", true);
        }
    }else{
        $('#alerta').html("La password no cumple con los requisitos");
         $('#cambiar').attr("disabled", true);
    }
    
}

function validar_clave(contrasenna){
    if(contrasenna.length >= 8){		
        var mayuscula = false;
	var minuscula = false;
	var numero = false;
	var caracter_raro = false;
	
	for(var i = 0;i<contrasenna.length;i++){
            if(contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90){
		mayuscula = true;
            }else if(contrasenna.charCodeAt(i) >= 97 && contrasenna.charCodeAt(i) <= 122){
		minuscula = true;
            }else if(contrasenna.charCodeAt(i) >= 48 && contrasenna.charCodeAt(i) <= 57){
		numero = true;
            }else{
		caracter_raro = true;
            }
	}
        if(minuscula == true && numero == true){
            return true;
        }
    }
    return false;
}

function eliminarUsuario(id){
var a = confirm("Está seguro de eliminar el usuario?");
if(a===true){
$.ajax({
    type: "post",
    url: "<?=base_url?>usuarios/eliminar&id="+id,
    success: function(data){
            if(data=="ok"){
                alert("Eliminado!");
                $('#p'+id).remove();
            }else{
                alert("No se ha podido eliminar");
            }
        }
    });
    }else{
        alert("No se ha eliminado!");
    }
}

</script>
        
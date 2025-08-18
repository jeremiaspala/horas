<br/>
                    <div id="basic" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Cambiar tu password</h4>
                                        </div>                 
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">

                                    <div class="row">
                                        <div class="col-lg-6 col-12 mx-auto">
                                            <form class="mt-0" action="<?=base_url?>login/password" method="post">
                                                <div style="font-weight: bold; color:red;">La password debe contener mínusculas y números! </div><br/>
                                              <div class="form-group">
                                                <input type="password" class="form-control mb-4" id="pass1" placeholder="Password" name="pass1" required="true" onkeyup="validar();">
                                              </div>
                                                <div class="form-group">
                                                <input type="password" class="form-control mb-4" id="pass2" placeholder="Password" name="pass2" required="true" onkeyup="validar();">
                                                <br/><span style="color:yellow" id="alerta"></span>
                                                </div>
                                                
                                                <button id="cambiar" type="submit" class="btn btn-primary mt-2 mb-2 btn-block" disabled="true">Cambiar Password</button>
                                            </form>
                                        </div>                                        
                                    </div>

                                </div>
                            </div>
                        </div>


                                              
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
</script>
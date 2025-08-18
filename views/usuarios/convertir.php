                    <br/>
                        <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <form action="<?=base_url?>usuarios/conversion" method="post" name="convertirusuario">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4><?=$nombre?> <?=$apellido?></h4>
                                            <p>  Escribir y repetir las passwords para convertir</p>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Password</span>
                                      </div>
                                        <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Password" aria-label="Password" required="true" onkeyup="validar();">
                                    </div>
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">Password</span>
                                      </div>
                                      <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Repita Password" aria-label="Password" required="true" onkeyup="validar();">
                                    </div><span style="color:yellow" id="alerta"></span><br/>             
                                    <input type="submit" class="form-control" value="Enviar" id="cambiar">
                                </div>
                            </form>
                            
                            <script>
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
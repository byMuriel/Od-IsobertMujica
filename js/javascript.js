function verificarPasswords() {
    // Ontenemos los valores de los campos de contraseñas 
    pass1 = document.getElementById('passNueva1');
    pass2 = document.getElementById('passNueva2');
 
    if(pass1.value!="" && pass2.value!=""){
        // Verificamos si las constraseñas no coinciden 
        if (pass1.value != pass2.value) {
            //Si son diferentes
            document.getElementById("error").classList.add("mostrar");
            document.getElementById("ok").classList.remove("mostrar");
            document.getElementById("ok").classList.add("ocultar");
    
        }else{
            //Si son iguales
            document.getElementById("error").classList.remove("mostrar"); 
            document.getElementById("ok").classList.remove("ocultar");
            document.getElementById("ok").classList.add("mostrar");
    
        }
    }else{
        document.getElementById("error").classList.remove("mostrar");
        document.getElementById("ok").classList.remove("mostrar");
        document.getElementById("ok").classList.add("ocultar");
        document.getElementById("error").classList.add("ocultar");
    }
}

function validarTelefono() {
    var telefonoInput = document.getElementById('telefono');
    var telefono = telefonoInput.value.trim();

    // Verificar si el teléfono tiene exactamente 9 caracteres y solo contiene números
    if (telefono.length !== 9 || isNaN(telefono)) {
        document.getElementById("spanTlf").classList.add("mostrar");
        document.getElementById("spanTlf").classList.remove("ocultar");
    }else{
        document.getElementById("spanTlf").classList.remove("mostrar");
        document.getElementById("spanTlf").classList.add("ocultar");
    }
}

function validarPassReg() {
    const contraseniaInput = document.getElementById("contrasenia");
    const contrasenia = contraseniaInput.value;
  
    const spanPass = document.getElementById("spanPass");
  
    if (contrasenia.length < 8 || !/^[a-zA-Z0-9]+$/.test(contrasenia)) {
        spanPass.classList.add("mostrar");
        spanPass.classList.remove("ocultar");
    } else {
      spanPass.classList.add("ocultar");
      spanPass.classList.remove("mostrar");
    }
  }

function validarEmail() {
    const emailInput = document.getElementById("email");
    const email = emailInput.value;
    
    let mail_re = /^([.a-zA-Z0-9_]{3,10})+[@]+([.a-zA-Z0-9_]{3,10})+[.]+([a-z]{2,10})$/;
    
    if (email.value == "" || email.value == null) {
        document.getElementById("spanEmail").classList.add("mostrar");
        document.getElementById("spanEmail").classList.remove("ocultar");
    }
    
    if (!mail_re.exec(email.value)) {
            document.getElementById("spanEmail").classList.add("mostrar");
            document.getElementById("spanEmail").classList.remove("ocultar");
        
        
    } else {
            document.getElementById("spanEmail").classList.add("ocultar");
            document.getElementById("spanEmail").classList.remove("mostrar");
    }
}
    
function validarFormulario() {
    const nombre = document.getElementById("nombre").value;
    const apellidos = document.getElementById("apellidos").value;
    const email = document.getElementById("email").value;
    const telefono = document.getElementById("telefono").value;
    const fechaNacimiento = document.getElementById("fechaNacimiento").value;
    const direccion = document.getElementById("direccion").value;
    const sexo = document.getElementById("sexo").value;
    const contrasenia = document.getElementById("contrasenia").value;

    const btnAgregar = document.getElementById("btnAgregar");

    if (nombre.trim() === "" || apellidos.trim() === "" || email.trim() === "" || telefono.length !== 9 || isNaN(telefono) || fechaNacimiento.trim() === "" || direccion.trim() === "" || sexo === "Select one" || contrasenia.length < 8 || !/^[a-zA-Z0-9]+$/.test(contrasenia)) {
        btnAgregar.disabled = true; // Deshabilitar el botón si algún campo no cumple los requisitos
    } else {
        btnAgregar.disabled = false; // Habilitar el botón si todos los campos son válidos
    }
}
import { alert, setData, showPassword, menuMov, blackGround, cardShop} from "./utils.js"

document.addEventListener("DOMContentLoaded", function(){
    updatePerfil()
    showPassword()
    changePassword()
    menuMov()
    blackGround()
    cardShop()
});

function updatePerfil(){
    var submit = document.getElementById("submitUpdate")
    let form = document.getElementById("updateForm")
    
    if(submit){
        submit.onclick = async e => {  
            e.preventDefault()
    
            let dates = await setData("/controllers/usuarios/actualizar_usuario.php", form);
    
            if(dates == "empty"){
                alert("error", "Por favor, complete todos los campos del formulario.")
            }else if(dates.includes("campo")){
                alert("error", dates)
            }else if(dates.includes("email")){
                alert("error", dates)
            }else if(dates == "ExisteEmail"){
                alert("error", "Email ya registrado.")
            }else if(dates == "movil"){
                alert("error", "Introduce un número de móvil válido.")
            }else if(dates == "ok"){
                alert("ok", "Datos actualizados correctamente.")
            }
        }
    }
}

function changePassword(){
    var submit = document.getElementById("submitPassChange")
    let form = document.getElementById("passwordForm")
    
    if(submit){
        submit.onclick = async e => {  
            e.preventDefault()
    
            let dates = await setData("/controllers/usuarios/cambiar_password.php", form);
    
            if(dates == "empty"){
                alert("error", "Por favor, complete todos los campos del formulario.")
            }else if(dates == "password"){
                alert("error", "La contraseña debe tener al menos 8 caracteres.")
            }else if(dates == "passNoRepeat"){
                alert("error", "Ambas contraseñas deben ser iguales.")
            }else if(dates == "ok"){
                document.getElementById("password").value = ""
                document.getElementById("passwordRepeat").value = ""
                alert("ok", "Contraseña actualizada correctamente.")
            }
        }
    }
}
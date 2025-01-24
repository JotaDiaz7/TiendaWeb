import { alert, setDataSec, setData, menuMov, blackGround} from "./utils.js"

document.addEventListener("DOMContentLoaded", function(){
    changeRol()
    menuMov()
    blackGround()
});

function changeRol(){
    const submit = document.querySelectorAll(".rolButton")

    submit.forEach(button => {
        button.onclick = async e => {  
            e.preventDefault()
            const li = button.closest('li')
            const ul = li.parentElement    

            let dates = await setDataSec(button.href)
    
            if(dates == "empty"){
                window.location.href = "/"
            }else if(dates == "admin"){
                alert("error", "Un admin no puede cambiar el rol asimismo.")
            }else{
                alert("ok", dates)

                ul.prepend(li)            
            }
        }
    })
}



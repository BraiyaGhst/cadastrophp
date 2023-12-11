function checkPass() {
    let pass = document.getElementById("pass").value
    let passConf = document.getElementById("pass-confirm").value
    let check = true

    if(pass != passConf) {
        check = false
        alert("Senhas não coincidem! ❌")
    }

    return check
}


function showPass(e) {
    e.type = "text"
}

function hidePass(e) {
    e.type = "password"
}


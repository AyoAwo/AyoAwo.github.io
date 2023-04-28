const passwords = ["DREAMLAND"]
function menuToggle(x) {
    x.classList.toggle("change");

    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
    document.getElementById("main").style.marginLeft = document.getElementById("main").style.marginLeft == "150px" ? "0" : "150px";
}

function passwordMatch(form, x) {
    var password;
    for (var i=0;i<form.length;i++){
        if(form.elements[i].name == "password"){
            password = form.elements[i].value;
        }
    }
    if(password === passwords[x-1]){
        document.getElementById("letter1Link").hidden = false;
        localStorage.setItem("letter1", "unlocked");
        form.hide();
        return;
    }
    document.getElementById("incorrect1").hidden = false;
    return;

}

$(document).ready(function() {
    document.getElementById("letter1Link").hidden = true;
    document.getElementById("incorrect1").hidden = true;
    let letter1 = localStorage.getItem("letter1");
    if(letter1 != null){
        document.getElementById("letter1Link").hidden = false;
    }
})

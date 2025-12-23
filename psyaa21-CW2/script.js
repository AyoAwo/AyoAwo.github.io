function menuToggle(x) {
    x.classList.toggle("change");

    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
    document.getElementById("main").style.marginLeft = document.getElementById("main").style.marginLeft == "150px" ? "0" : "150px";
}

function validate(form) {
    var ok=1
    var msg=""
    for (var i=0;i<form.length;i++){
        if(form.elements[i].id == "uploadImage"){
           continue;
        }
        if(form.elements[i].value.trim() == ""){
            msg += "" + form.elements[i].id + " is empty. Please enter something and try again.\n"
            ok=0
        }
        if(form.elements[i].name == "confirm"){
            if(!(form.elements[i].checked == true)){
                msg += "You have not confirmed this entry is unique. Please tick the checkbox and try again.\n"
                ok=0
            }
        }
    }
    if(ok == 0){
        alert(msg)
        return false
    }
    else {
        return true
    }
}

function loadXMLDoc(placement, file) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(placement).innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", file, true);
    xhttp.send();
  }

function fillField(field, newValue){
    document.getElementById(field).value = newValue;
}
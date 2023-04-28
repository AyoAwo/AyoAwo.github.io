function menuToggle(x) {
    x.classList.toggle("change");

    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
    document.getElementById("main").style.marginLeft = document.getElementById("main").style.marginLeft == "150px" ? "0" : "150px";
}

$(document).ready(function(){
    let letter1 = localStorage.getItem("letter1");
    if(letter1 != null){

    }
})

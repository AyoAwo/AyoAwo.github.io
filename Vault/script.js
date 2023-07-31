const passwords = ["DREAMLAND"]

function menuToggle(x) {
    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
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
        return true;
    }
    document.getElementById("incorrect1").hidden = false;
    return false;

}

$(document).ready(function() {
    document.getElementById("letter1Link").hidden = true;
    document.getElementById("incorrect1").hidden = true;
    document.getElementById("readLetter1").hidden = true;
    document.getElementById("dinnerInvite").hidden = true;
    document.getElementById("openInvite").hidden = true;
    var cardImage1 = $("#cardImg");
    let letter1 = localStorage.getItem("letter1");
    if(letter1 != null){
        document.getElementById("letter1Link").hidden = false;
        document.getElementById("readLetter1").hidden = false;
        document.getElementById("passwordForm1").hidden = true;
        cardImage1.append('<img src="images/unlocked.png" class="card-img-top" alt="..."></img>');
    }
    else {
        cardImage1.append('<img src="images/locked.png" class="card-img-top" alt="..."></img>');
    }
    checkTime();

})

function checkTime() {
    const anniversary = new Date(2023,7,1,23,0,0);
    var date = new Date();
    if(date > anniversary){
        document.getElementById("dinnerInvite").hidden = false;
        document.getElementById("openInvite").hidden = false;
    }
    else{
        setTimeout(checkTime, 2500);
    }
}

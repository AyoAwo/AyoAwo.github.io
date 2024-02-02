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
    document.getElementById("openValentine").hidden = true;
    document.getElementById("valentineLink").hidden = true;

    var cardImage1 = $("#cardImg1");
    let letter1 = localStorage.getItem("letter1");
    if(letter1 != null){
        document.getElementById("letter1Link").hidden = false;
        document.getElementById("readLetter1").hidden = false;
        document.getElementById("passwordForm1").hidden = true;
        cardImage1.append('<img src="assets/images/unlocked.png" class="card-img-top" alt="..."></img>');
    }
    else {
        cardImage1.append('<img src="assets/images/locked.png" class="card-img-top" alt="..."></img>');
    }
    checkTime(1,8,2023,"openInvite");
    checkTime(1,8,2023,"dinnerInvite");
    checkTime(7,2,2024,"openValentine");
    checkTime(7,2,2024,"valentineLink");
})

function checkTime(d, m, y, id) {
    const dateCheck = new Date(y,m-1,d);
    var date = new Date();
    if(date > dateCheck){
        document.getElementById(id).hidden = false;
    }
    else{
        setTimeout(checkTime(d, m, y, id), 2500);
    }
}

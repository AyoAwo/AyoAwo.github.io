const passwords = ["WINSTON"]

function passwordMatch(form, x) {
    var password;
    for (var i=0;i<form.length;i++){
        if(form.elements[i].name == "password"){
            password = form.elements[i].value;
        }
    }
    if(password.toUpperCase() === passwords[x-1]){
        document.getElementById("incorrect1").hidden = true;
        letterReveal();
        return true;
    }
    document.getElementById("incorrect1").hidden = false;
    return false;
}

$(document).ready(function() {
    document.getElementById("incorrect1").hidden = true;
    document.getElementById("readLetter1").hidden = true;
})


const myModalLl = document.getElementById('passwordModal1')
myModalLl.addEventListener('show.bs.modal', event => {
    //On modal Show
    var questions = [{
        question: "What cuisine did we eat the day we decided to make it official?",
        choices: ["Indian", "Jamaican", "Italian"],
        correctAnswer: 1,
        title: "So you don't know the password..."
    }, {
        question: "Where did we go for our first anniversary?",
        choices: ["Brighton", "Amsterdam", "Belgium"],
        correctAnswer: 2,
        title: "Next question !!!"
    }, {
        question: "What do you always say you're craving as soon as you enter my door?",
        choices: ['"A sweet treat"', '"Where\'s my pookie?"', '"Huggiesss!"'],
        correctAnswer: 0,
        title: "Last one..."
    }];

    var questionCounter = 0; //Tracks question number
    var selections = []; //Array containing user choices
    var quiz = $('#quiz'); //Quiz div object
    var answers; //Later array containing button objects

    // Display initial question
    $("#intro").show();
    $("#restart").hide();
    displayNext();

    // Click handler for the 'submit' button
    /*$('#submit').on('click', function (e) {
        e.preventDefault();

        // Suspend click listener during fade animation
        if(quiz.is(':animated')) {
        return false;
        }
        selections[questionCounter] = +$('input[name="answer"]:checked').val();
        
        i = selections.length -1
        if (isNaN(selections[questionCounter])){
            $("#answer").empty();
            $("#answer").append('You gotta answer dummy');
            $("#answer").show();
        }else {
        $("#intro").fadeOut();
        displayNext();
        questionCounter++;
        }
    });*/
    
    
    
    // Function for storing answer
    function submit() {
        // Suspend click listener during fade animation
        if(quiz.is(':animated')) {
            return false;
        }
        selections[questionCounter] = +$('input[name="answer"]:checked').val();
        
        $("#intro").fadeOut();
        displayNext();
        questionCounter++;
    };
    
    $('#restart').on('click', function (e) {
        e.preventDefault();

        questionCounter = 0;
        displayNext();
        $('#restart').hide();
        return;
    });

    // Creates and returns the div that contains the questions and
    // the answer selections
    function createQuestionElement(index) {
        var qElement = $('<div>', {
        id: 'question'
        });

        var header = $('<h4>Question ' + (index + 1) + ':</h4>');
        qElement.append(header);

        var question = $('<p>').append(questions[index].question);
        qElement.append(question);

        var radioButtons = createRadios(index);
        qElement.append(radioButtons);

        return qElement;
    }

    // Creates a list of the answer choices as radio inputs
    function createRadios(index) {
        var radioList = $('<div class="btn-group-vertical justify-content-center" role="group" aria-label="Basic radio toggle button group">');
        var item;
        var input = '';
        for (var i = 0; i < questions[index].choices.length; i++) {
            item = $('<input type="radio" class="btn-check" name="answer" id="btnradio'+ i +'" value=' + i + ' autocomplete="off">');
            input = '<label class="btn btn-outline-primary" for="btnradio'+ i +'">';
            input += questions[index].choices[i];
            input += '</label>';
            radioList.append(item);
            radioList.append(input);
        }
        return radioList;
    }

    // Displays next requested element
    function displayNext() {
        quiz.fadeOut(function() {
        $('#question').remove();

        if(questionCounter < questions.length){
            var nextQuestion = createQuestionElement(questionCounter);
            quiz.append(nextQuestion).fadeIn();
            answers = document.querySelectorAll('input[name="answer"]');
            answers.forEach(btn => {btn.addEventListener('click', function() {submit();});});
            $("#letter1Password").empty();
            $("#letter1Password").append(questions[questionCounter].title);
            $("#letter1Password").show();
        }else {
            var scoreElem = displayScore();
            quiz.append(scoreElem).fadeIn();
        }
        });
    }

    // Computes score and returns a paragraph element to be displayed
    function displayScore() {
        var score = $('<p>',{id: 'question', style: 'text-align: center'});

        var numCorrect = 0;
        for (var i = 0; i < selections.length; i++) {
            if (selections[i] === questions[i].correctAnswer) {
                numCorrect++;
            }
        }
        if(numCorrect === questions.length){
            $("#letter1Password").empty();
            $("#letter1Password").append("You did it!");
            $("#letter1Password").show();
            score.append('Okay you got all my questions right, maybe you are my gf after all &#128580;');
            score.append('<br> <span style="background-color: #d1ad1b">The password is "<span style="color:#3800cf;"><strong>WINSTON</strong></span>" </span>');
        }
        else{
            $("#letter1Password").empty();
            $("#letter1Password").append("Yikes...");
            $("#letter1Password").show();    
            $("#restart").fadeIn();
            score.append('You' + (numCorrect == 0 ? ' ' : ' only ') + 'got ' + numCorrect + ' out of ' +
                        questions.length + " right, must be your other nigga you're thinking about &#128580;");
            score.append('<br><small><small>You can always try again though</small></small>');
        }
        return score;
    }

})


function letterReveal(){
    document.body.style.padding = null;
    $('#main').remove();
    $('body').append('<div class="container" id="main"><div class = "col-12" style="display: grid; height: 100%;"> <img src="assets/aLetterofLove.jpg" style="max-width: 100%; max-height: 100vh; margin: auto;"></div></div>');
}
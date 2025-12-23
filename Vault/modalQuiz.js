const myModalLl = document.getElementById('passwordModal1')
myModalLl.addEventListener('show.bs.modal', event => {
    //On modal Show
    var questions = [{
        question: "What do you want to be when you grow up?",
        choices: ["Librarian", "Dentist", "Teacher"],
        correctAnswer: 1,
        title: "So you don't know the password..."
    }, {
        question: "Which of these is your favourite colour?",
        choices: ["Gold", "Maroon", "Llilac"],
        correctAnswer: 2,
        title: "Next question !!!"
    }, {
        question: "Where did I take you to eat on our first date?",
        choices: ["Shakeshack", "Mcdonald's", "Nobu"],
        correctAnswer: 0,
        title: "Keep going..."
    }, {
        question: "What's our comfort show?",
        choices: ["Vampire Diaries", "Brooklyn nine-nine", "Family Guy"],
        correctAnswer: 0,
        title: "Almost there..."
    }, {
        question: "Who's the prettiest girl in the world?",
        choices: ["Catherine", "Caffo", "Me"],
        correctAnswer: 2,
        title: "Last one's a tough one"
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
            item = $('<input type="radio" class="btn-check" name="answer" id="btnradio'+ i +'" value=' + ((index === questions.length-1) ? 2 : i) + ' autocomplete="off">');
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
            score.append('<br> <span style="background-color: #d1ad1b">The password is "<span style="color:#3800cf;"><strong>DREAMLAND</strong></span>" </span>');
        }
        else{
            $("#letter1Password").empty();
            $("#letter1Password").append("Yikes...");
            $("#letter1Password").show();    
            $("#restart").fadeIn();
            score.append('You only got ' + numCorrect + ' out of ' +
                        questions.length + ' right, no password for you &#128542;');
            score.append('<br>You can always try again though');
        }
        return score;
    }

})

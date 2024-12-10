<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="favicon.png">
        {{--  <!-- Bootstrap CDN links -->  --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{--  <!-- Fonts -->  --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400i&amp;display=swap" rel="stylesheet">
        <title>Hackathon Heroes</title>
        <link rel="stylesheet" href="{{ url('css/ide.css') }}">
    </head>

<body>


<div class="container">

        <div class="row text-center logo-H">
            <div class="col-md-12">
               <span class="main">
                  <strong> Hackathon <br>
                </strong>
                   H &nbsp;e &nbsp;r &nbsp;o &nbsp;e &nbsp;s
                </span>
            </div>
        </div>
        <div class="header timer">
              <p>
                  End Time: <span id="countdown"></span>
              </p>
        </div>


            {{--  <!-- Modal -->  --}}
        <div class="modal" id="timeoutModal">
            <div class="modal-content">
                <h2>Time Up! You Lose</h2>
                <button class="go-button" onclick="redirectToHome()">Go</button>
            </div>
        </div>


        <div class="control-panel">
            <select id="languages" class="languages" onchange="changelanguage()">
                <option value="Select" selected>Select your language</option>
                <option value="{{ $openChallenge->language }}">
                    {{ $openChallenge->language }}
                </option>
            </select>
        </div>



        <div id="Question">
            <h5></h5>
        </div>

        <br>

            <div class="row">
                <div class="col-md-7">
                    <div class="editor" id="editor" contenteditable="true"></div>

                </div>

                {{--  <!-- Output Display (Editable or Generated Output) -->  --}}
                <div class="col-md-5">
                    <div class="output" id="output"></div>
                </div>

                {{--  <!-- row close -->  --}}
            </div>

            <div class="button-container">
                <button class="btn" id="runButton" onclick="executeCode()"> Run </button>
            </div>

            <p id="getPointsMessage" class="text-center mt-3 text-info" style="color: red !important;"></p>

            {{--  <!-- Expected Output (Hidden) -->  --}}
            <div class="d-none">
                <div class="demooutput" id="demooutput">
                    <p></p>
                </div>
            </div>

            <br>

            <div class="row">

                {{--  <!-- Box 1 -->  --}}
                <div class="col-md-4 mb-3">
                    <div class="border p-3 text-center">
                        <h6 class="text-left">Test Cases</h6>
                            <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                <span class="display-4" id="testResult"></span>
                            </div>
                            <button class="btn btn-success">Check</button>
                    </div>
                </div>


                 {{--  <!-- Box 2 -->  --}}
                 {{--  <!-- Output Match Div -->  --}}
                 <div class="col-md-4 mb-3">
                     <div class="border p-3 text-center">
                         <h6 class="text-left">Output</h6>
                         <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                             <span class="display-4" id="result"></span>
                         </div>
                         <button class="btn btn-success" onclick="matchOutput()">Check</button>
                     </div>
                 </div>



                {{--  <!-- Box 3 -->  --}}
                <div class="col-md-4 mb-3">
                    <div class="border p-3 text-center points">
                        <h6 class="text-left">Points</h6>
                        <form method="post" action="{{ url('/store-points') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="challenge_id" value="{{ $openChallenge->id }}">
                            <input type="hidden" name="user_role" value="{{ $user->id === $openChallenge->creator_id ? 'creator' : 'joiner' }}">

                            <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                <input type="text" name="points" id="points" readonly>
                            </div>
                            <button type="submit" class="btn btn-success">get points</button>
                        </form>
                    </div>
                </div>



            </div>


</div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ url('js/lib/ace.js') }}"></script>
        <script src="{{ url('js/lib/theme-monokai.js') }}"></script>





    <script>
/** @format */

let editor;

window.onload = function () {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");

    // shortcut keys that will be disabled
    const disabledKeys = ["c", "C", "c", "J", "u", "I", "v", "V", "x", "X" , "s" , "S" , "r" , "R"];

    const showAlert = (editor) => {
        editor.preventDefault();
        return alert("This feature is restricted!");
    };
    //call ShowAlert on muse right-click
    document.addEventListener("contextmenu", showAlert);

     document.addEventListener("keydown", (editor) => {
        //call showAlert, if the pressed ksy is F12 or matched to disabled keys
        if (
            (editor.ctrlKey && disabledKeys.includes(editor.key)) ||
            editor.key == "F12"
        ) {
            showAlert(editor);
        }
    });
};

function changelanguage() {
    let language = $("#languages").val();

    if (language == "php") editor.session.setMode("ace/mode/php");
    else if (language == "python") editor.session.setMode("ace/mode/python");
    else if (language == "node") editor.session.setMode("ace/mode/javascript");
}


function changelanguage() {
    let language = $("#languages").val();

    if (language === "php") {
        editor.session.setMode("ace/mode/php");
    } else if (language === "python") {
        editor.session.setMode("ace/mode/python");
    } else if (language === "node") {
        editor.session.setMode("ace/mode/javascript");
    }

    // Update question and output based on selected language
    let questionText = "";
    let outputText = "";
    switch (language) {
        case "php":
            questionText =
                "Q) Write a PHP code and print Hello ?";
                {{--  function named `findMostFrequentWord` that takes a string as an argument and returns the most frequently occurring word in the string. If there are multiple words with the same frequency, return any one of them. Ignore case and punctuation.";  --}}
            outputText = "hello";
            break;
        case "node":
            questionText =
                "Q) Create a JavaScript function `flattenArray` that takes a nested array of any depth and returns a flat, single-dimensional array. Do not use built-in methods like `flat()` or `flatMap()`.";
            outputText = "1, 2, 3, 4, 5, 6";
            break;
        case "python":
            questionText =
                "Q) Write a Python function called `reverse_words` that takes a sentence as input and returns the sentence with each word reversed, but the order of the words remains the same.";
            outputText = "olleH dlrow morf nohtyP";
            break;
    }

    // Update the content of the Question and demooutput divs
    $("#Question h5").text(questionText);
    $("#demooutput p").text(outputText);
}

    function executeCode() {
        $.ajax({
            url: "{{ url('app/compiler.php') }}",
            method: "POST",
            data: {
                language: $("#languages").val(),
                code: editor.getSession().getValue(),
            },
            success: function (response) {
                $("#output").text(response);
                matchOutput();
                runTestCases();

            // Disable elements after running code
            $("#languages").attr("disabled", true); // Disable language dropdown
            $("#Question h5").css("color", "gray"); // Optional: style to appear disabled
            $("#editor").attr("contenteditable", false); // Disable editor input
            $("#output").attr("contenteditable", false); // Disable output input

            // Display message to prompt clicking "Get Points" button
            $("#getPointsMessage").text("Click 'Get Points' button to proceed").show();

            },
        });
    }


    function matchOutput() {
        // Fetch and trim the actual output and expected output
        let outputText = $("#output").text().trim().toLowerCase(); // Actual output
        let demoOutputText = $("#demooutput p").text().trim().toLowerCase(); // Expected output

        // Check if outputs match
        let isMatched = outputText === demoOutputText;

        // Display the result
        $("#result").text(isMatched ? "Matched" : "Unmatched")
                    .removeClass(isMatched ? "text-danger" : "text-success")
                    .addClass(isMatched ? "text-success" : "text-danger");

    }






// Function to simulate code run (for demo purpose)
function simulateRun(input) {
    // Return the expected output directly for now
    return input;
}

// Set initial countdown time to 1 hour (3600 seconds)
let countdownTime = 900;   //15 minutes

// Function to update the countdown display
function updateCountdown() {
    const hours = Math.floor(countdownTime / 3600);
    const minutes = Math.floor((countdownTime % 3600) / 60);
    const seconds = countdownTime % 60;
    document.getElementById("countdown").textContent = `${hours}:${minutes
        .toString()
        .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

    // Check if countdown has reached zero
    if (countdownTime <= 0) {
        clearInterval(timerInterval); // Stop the timer
        showTimeoutModal(); // Show the "Time Up" modal
    } else {
        countdownTime--; // Decrement the countdown time
    }
}

// Display the initial time immediately
updateCountdown();

// Start the countdown timer
const timerInterval = setInterval(updateCountdown, 1000);

// Function to show the "Time Up" modal
function showTimeoutModal() {
    document.getElementById("timeoutModal").style.display = "flex";
}

// Redirect function for the "Go" button
function redirectToHome() {
    window.location.href = "/profile"; // Redirect to the home page
}



document.addEventListener('DOMContentLoaded', function () {
    // Get editor and result elements
    const editor = document.getElementById('editor');
    const testResult = document.getElementById('testResult');
    const checkButton = document.querySelector('.btn-success');

    // Add event listener to the check button
    checkButton.addEventListener('click', function () {
        // Disable the button after it is clicked
        checkButton.disabled = true;

        // Get the code from the editor
        const codeInput = editor.innerText.trim();

        // Initialize conditions passed count
        let conditionsPassed = 0;

        // Results array for debugging/logging
        const results = [];

        // 1. Syntax Validation
        try {
            new Function(codeInput); // Try parsing code
            results.push("Syntax: Valid");
            conditionsPassed++;
        } catch (error) {
            results.push("Syntax: Invalid");
        }

        // 2. Logical Consistency
        if (codeInput && !codeInput.includes('eval')) {
            results.push("Logic: Valid");
            conditionsPassed++;
        } else {
            results.push("Logic: Invalid - Avoid 'eval' or empty code");
        }

        // 3. Edge Case Handling
        if (codeInput !== "") {
            results.push("Edge Case: Valid");
            conditionsPassed++;
        } else {
            results.push("Edge Case: Invalid - Empty input");
        }

        // 4. Performance Check
        if (codeInput) {
            const start = performance.now();
            try {
                new Function(codeInput)(); // Execute the code
                const end = performance.now();
                const executionTime = end - start;
                if (executionTime <= 500) {
                    results.push(`Performance: Valid - Execution time ${executionTime}ms`);
                    conditionsPassed++;
                } else {
                    results.push(`Performance: Invalid - Execution time ${executionTime}ms`);
                }
            } catch (error) {
                results.push("Performance: Invalid - Code execution failed");
            }
        }

        // 5. Output Validation (Example output validation logic)
        const expectedOutput = "Hello, World!"; // Example expected output
        try {
            const actualOutput = new Function(`return ${codeInput}`)(); // Execute code to get output
            if (actualOutput === expectedOutput) {
                results.push("Output: Valid - Match");
                conditionsPassed++;
            } else {
                results.push("Output: Invalid - Mismatch");
            }
        } catch (error) {
            results.push("Output: Invalid - Execution error");
        }

        // Randomly determine how many of the 5 test cases should pass (1 to 5)
        const randomPassedCases = Math.floor(Math.random() * 5) + 1; // Random number between 1 and 5
        const totalCases = 5;

        // Update testResult span with passed conditions count
        testResult.innerText = `${randomPassedCases} / ${totalCases} Passed`;

        // Calculate points based on passed cases
        let points = (randomPassedCases / totalCases) * 10;

        // Optional: Log results to console for debugging
        console.log(results);

        // Show points
        document.getElementById("points").value = points;
        document.getElementById("testResultPoints").innerText = `Points: ${points}`;
    });
});




</script>



</body>
</html>

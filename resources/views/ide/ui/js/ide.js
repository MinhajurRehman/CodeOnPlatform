/** @format */

let editor;

window.onload = function () {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");

    // shortcut keys that will be disabled
    const disabledKeys = ["c", "C", "c", "J", "u", "I", "v", "V", "x", "X"];

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

    if (language == "c" || language == "cpp")
        editor.session.setMode("ace/mode/c_cpp");
    else if (language == "php") editor.session.setMode("ace/mode/php");
    else if (language == "python") editor.session.setMode("ace/mode/python");
    else if (language == "node") editor.session.setMode("ace/mode/javascript");
}

function executeCode() {
    $.ajax({
        url: "/ide/app/compiler.php",

        method: "POST",

        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue(),
        },

        success: function (response) {
            $(".output").text(response);
        },
    });
}

function changelanguage() {
    let language = $("#languages").val();

    if (language === "c" || language === "cpp") {
        editor.session.setMode("ace/mode/c_cpp");
    } else if (language === "php") {
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
                "Q) Write a PHP function named `findMostFrequentWord` that takes a string as an argument and returns the most frequently occurring word in the string. If there are multiple words with the same frequency, return any one of them. Ignore case and punctuation.";
            outputText = "Example Output: 'hello'";
            break;
        case "node":
            questionText =
                "Q) Create a JavaScript function `flattenArray` that takes a nested array of any depth and returns a flat, single-dimensional array. Do not use built-in methods like `flat()` or `flatMap()`.";
            outputText = "Example Output: [1, 2, 3, 4, 5, 6]";
            break;
        case "python":
            questionText =
                "Q) Write a Python function called `reverse_words` that takes a sentence as input and returns the sentence with each word reversed, but the order of the words remains the same.";
            outputText = "Example Output: 'olleH dlrow morf nohtyP'";
            break;
        default:
            questionText =
                "Q) Enter a program where the output is 1 to 10 numbers printed in sequence using a loop.";
            outputText = "1, 2, 3, 4, 5, 6, 7, 8, 9, 10";
    }

    // Update the content of the Question and demooutput divs
    $("#Question h5").text(questionText);
    $("#demooutput p").text(outputText);
}

function executeCode() {
    $.ajax({
        url: "/ide/app/compiler.php",
        method: "POST",
        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue(),
        },
        success: function (response) {
            $("#output").text(response);
            matchOutput();
        },
    });
}

// function executeCode() {
//   const editorContent = editor.getSession().getValue().trim();
//   const outputDiv = $("#output");
//   const runButton = $("#runButton");

//   // Check if editor has content before executing
//   if (editorContent !== "") {
//     // Disable editor interactions
//     editor.setReadOnly(true);
//     $("#editor").addClass("disabled"); // Apply CSS to fully disable
//     // Disable "Run" button fully
//     runButton.prop("disabled", true).addClass("disabled");

//     $.ajax({
//       url: "/ide/app/compiler.php",
//       method: "POST",
//       data: {
//         language: $("#languages").val(),
//         code: editorContent,
//       },
//       success: function (response) {
//         // Display output
//         outputDiv.text(response);
//         matchOutput();

//         // Optionally re-enable elements after execution completes
//         editor.setReadOnly(false);
//         $("#editor").removeClass("disabled");
//         runButton.prop("disabled", false).removeClass("disabled");
//       },
//       error: function () {
//         // Display error
//         outputDiv.text("An error occurred.");

//         // Re-enable elements in case of error
//         editor.setReadOnly(false);
//         $("#editor").removeClass("disabled");
//         runButton.prop("disabled", false).removeClass("disabled");
//       },
//     });
//   } else {
//     alert("Please enter code in the editor before running.");
//   }
// }

// Output match function
function matchOutput() {
    let outputText = $("#output").text().trim();
    let demoOutputText = $("#demooutput").text().trim();

    if (outputText === demoOutputText) {
        // Output matches demo output
        alert("Output matches the expected result.");
    } else {
        // Output does not match demo output
        alert("Output does not match the expected result.");
    }
}

// Set initial countdown time to 1 hour (3600 seconds)
let countdownTime = 3600;

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
    window.location.href = "/home"; // Redirect to the home page
}

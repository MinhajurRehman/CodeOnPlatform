// Check Selected Language Syntax
function checkLanguageSyntax(editorCode, selectedLanguage) {
    const syntaxPatterns = {
        python: /def\s+\w+\(.*\):/, // Python function syntax
        javascript: /function\s+\w+\(.*\)\s*{/, // JavaScript function syntax
        php: /function\s+\w+\(.*\)\s*{/, // PHP function syntax
    };

    if (syntaxPatterns[selectedLanguage]) {
        return syntaxPatterns[selectedLanguage].test(editorCode);
    }
    return false; // Unsupported language
}

// Check If Function Is Used
function checkFunctionUsage(editorCode, question) {
    if (question.includes("function")) {
        return (
            /function\s+\w+\(.*\)/.test(editorCode) ||
            /def\s+\w+\(.*\)/.test(editorCode)
        ); // JS or Python
    }
    return true; // If no function required
}

// Check Code Formatting
function checkFormatting(editorCode) {
    const lines = editorCode.split("\n");
    let isFormatted = true;

    lines.forEach((line, index) => {
        if (line.startsWith(" ") && line.length % 4 !== 0) {
            console.log(`Line ${index + 1} is not properly indented`);
            isFormatted = false;
        }
    });

    return isFormatted;
}

// Check Semantics
function checkSemantics(editorCode) {
    try {
        new Function(editorCode); // Dynamically checks code for syntax
        return true;
    } catch (e) {
        console.error("Semantic error: ", e.message);
        return false;
    }
}

// Check Math Validity
function checkMathOperations(editorCode) {
    const mathPattern = /\d+\s*[\+\-\*\/]\s*\d+/; // Matches simple math expressions like 2 + 3
    if (mathPattern.test(editorCode)) {
        try {
            const mathResult = eval(editorCode.match(mathPattern)[0]);
            return !isNaN(mathResult); // Check if result is a valid number
        } catch (e) {
            console.error("Invalid math expression: ", e.message);
            return false;
        }
    }
    return true; // No math operations to check
}

// Validate All Requirements
function validateCode(editorCode, selectedLanguage, question) {
    const languageSyntax = checkLanguageSyntax(editorCode, selectedLanguage);
    const functionUsage = checkFunctionUsage(editorCode, question);
    const formatting = checkFormatting(editorCode);
    const semantics = checkSemantics(editorCode);
    const mathValidity = checkMathOperations(editorCode);

    const results = {
        languageSyntax,
        functionUsage,
        formatting,
        semantics,
        mathValidity,
    };

    console.log("Validation Results: ", results);

    return results; // Return individual results
}

// Display Results in the Frontend
function showResults(results) {
    const resultDiv = document.getElementById("result");
    resultDiv.innerHTML = `
        <ul>
            <li>Language Syntax: ${
                results.languageSyntax ? "Passed" : "Failed"
            }</li>
            <li>Function Usage: ${
                results.functionUsage ? "Passed" : "Failed"
            }</li>
            <li>Formatting: ${results.formatting ? "Passed" : "Failed"}</li>
            <li>Semantics: ${results.semantics ? "Passed" : "Failed"}</li>
            <li>Math Validity: ${
                results.mathValidity ? "Passed" : "Failed"
            }</li>
        </ul>
    `;
}

// Example Usage
function runValidation() {
    const editorCode = `function add(a, b) {
    return a + b;
}`; // Example code
    const selectedLanguage = "javascript"; // Example selected language
    const question = "Write a function to add two numbers."; // Example question

    const results = validateCode(editorCode, selectedLanguage, question);
    showResults(results);
}

// Run validation on page load for testing (optional)
document.addEventListener("DOMContentLoaded", () => {
    runValidation();
});

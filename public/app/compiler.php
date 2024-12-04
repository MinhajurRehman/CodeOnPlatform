<?php
$language = strtolower($_POST['language']);
$code =  $_POST['code'];

$random = substr(md5(mt_rand()), 0, 7);
$filePath = "temp/" . $random . "." . $language;
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);

$current_date = date("H:i:s");

if($language == 'php') {
    $output = shell_exec("C:/xampp/php/php.exe $filePath 2>&1");
    echo $output;
}

if($language == 'python') {
    $output = shell_exec("C:\Users\minha\AppData\Local\Microsoft\WindowsApps\python.exe $filePath 2>&1");
    echo $output;
}

if($language == 'node') {
    rename($filePath, $filePath.".js");
    $output = shell_exec("node $filePath.js 2>&1");
    echo $output;
}


function checkRuntimeSavedFile($random, $language, $code) {
    // Define the file path
    $filePath = "temp/" . $random . "." . $language;

    // Open and write the code to the file
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    // Check if the file exists and is readable
    if (file_exists($filePath) && is_readable($filePath)) {
        // Attempt to read the file
        $fileContents = file_get_contents($filePath);

        // Check if reading the file was successful
        if ($fileContents !== false) {
            // The file was read successfully, so echo true
            echo " ";
        } else {
            // Failed to read the file, so echo false
            echo "false";
        }
    } else {
        // The file doesn't exist or is not readable, so echo false
        echo "false";
    }
}

// Example usage:
checkRuntimeSavedFile($random, $language, $code);


function calculateRuntimeAndDate() {

    $current_date = date("H:i:s");

    // Create input fields to store the results
    echo " ";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    calculateRuntimeAndDate();
}

    // Database connection (replace with your connection details)
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "codes";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert the file path
    $sql = "INSERT INTO compile_file (file_path,file_time) VALUES ('$filePath','$current_date')";

    // Close the connection
    $conn->close();
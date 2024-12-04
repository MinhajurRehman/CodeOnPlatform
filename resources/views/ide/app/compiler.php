<?php
$language = strtolower($_POST['language']);
$code =  $_POST['code'];

$random = substr(md5(mt_rand()), 0, 7);
$filePath = "temp/" . $random . "." . $language;
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);



if($language == 'php') {
    $output = shell_exec("C:/xampp/php/php.exe $filePath 2>&1");
    echo "Output:" . $output;
}

if($language == 'python') {
    $output = shell_exec("C:\Program Files\WindowsApps\PythonSoftwareFoundation.Python.3.8_3.8.2800.0_x64__qbz5n2kfra8p0\pythonw3.8.exe $filePath 2>&1");
    echo "Output:" . $output;
}

if($language == 'node') {
    rename($filePath, $filePath.".js");
    $output = shell_exec("node $filePath.js 2>&1");
    echo "Output:" . $output;
}

if($language == 'c') {
    $outputExe = $random . ".exe";
    shell_exec("gcc $filePath -o $outputExe");
    $output = shell_exec( __DIR__ . "//$outputExe");
    echo "Output:" . $output;

}

if($language == 'cpp') {
    $outputExe = $random . ".exe";
    shell_exec("g++ $filePath -o $outputExe");
    $output = shell_exec( __DIR__ . "//$outputExe");
    echo "Output:" . $output;

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
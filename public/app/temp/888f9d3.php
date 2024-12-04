<?php
function findMostFrequentWord($text) {
    // Convert text to lowercase and remove all punctuation except spaces
    $text = strtolower($text);
    $text = preg_replace('/[^\w\s]/', '', $text); // Remove punctuation

    // Remove extra spaces and split text into words
    $words = preg_split('/\s+/', trim($text)); // Splits by whitespace and trims extra spaces

    // Count word occurrences
    $wordCounts = array_count_values($words);

    // Find the word with the maximum count
    $maxCount = max($wordCounts);
    $mostFrequentWords = array_keys($wordCounts, $maxCount); // Get all words with max frequency

    // Return one of the most frequent words (if there are multiple)
    return $mostFrequentWords[0];
}

// Example usage
$text = "Hello world! Hello everyone. Hello, hello!";
echo findMostFrequentWord($text); // Expected output: "hello"
?>

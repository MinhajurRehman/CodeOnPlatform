<?php
function findMostFrequentWord($text) {
    // Convert text to lowercase and remove punctuation
    $text = strtolower($text);
    $text = preg_replace('/[^\w\s]/', '', $text); // Remove punctuation

    // Split text into words
    $words = explode(" ", $text);

    // Count word occurrences
    $wordCounts = array_count_values($words);

    // Find the most frequent word
    $mostFrequentWord = array_search(max($wordCounts), $wordCounts);

    return $mostFrequentWord;
}

// Example usage
$text = "Hello world! Hello everyone. Hello, hello!";
echo findMostFrequentWord($text); // Output: "hello"
?>

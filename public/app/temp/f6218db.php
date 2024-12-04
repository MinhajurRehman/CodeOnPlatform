<?php
 function findMostFrequentWord($text) {
    // Convert text to lowercase and remove punctuation
    $text = strtolower($text);
    $text = preg_replace('/[^\w\s]/', '', $text);

    // Split the text into words
    $words = explode(' ', $text);

    // Count frequency of each word
    $wordCounts = array_count_values($words);

    // Find the word with the highest frequency
    $maxFrequency = max($wordCounts);
    foreach ($wordCounts as $word => $count) {
        if ($count === $maxFrequency) {
            return $word; // Return the first word with max frequency
        }
    }
 }
 
 $text = "Hello, hello! This is a test. This is only a test.";
 echo findMostFrequentWord($text); // Output: "hello" or "this"
?>
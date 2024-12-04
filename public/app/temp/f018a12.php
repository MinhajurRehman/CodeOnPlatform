<?php
function findMostFrequentWord($text) {
    // Remove punctuation and make the string lowercase
    $text = strtolower(preg_replace("/[^\w\s]/", "", $text));
    
    // Split the string into words
    $words = explode(" ", $text);
    
    // Count the frequency of each word
    $wordFrequency = array_count_values($words);
    
    // Find the word with the highest frequency
    $mostFrequentWord = "";
    $maxCount = 0;
    foreach ($wordFrequency as $word => $count) {
        if ($count > $maxCount) {
            $mostFrequentWord = $word;
            $maxCount = $count;
        }
    }
    
    return $mostFrequentWord;
}

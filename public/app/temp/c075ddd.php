<?php

  function findMostFrequentWord($text) {
    $words = str_word_count(strtolower($text), 1); // Convert to lowercase and split into words
    $frequentWord = array_search(max($counts = array_count_values($words)), $counts);
    return $frequentWord;
        }
?>

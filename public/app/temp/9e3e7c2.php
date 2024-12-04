<?php
 function findMostFrequentWord($text){
    $words = str_word_count(strtolower($text), 1);
    $counts = array_count_values($words);
    return array_search(max($counts), $counts);
 }
 
 echo findMostFrequentWord($text);
?>
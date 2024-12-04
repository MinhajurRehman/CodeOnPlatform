<?php
 function findMostFrequentWord($text){
    $words = str_word_cout(strlower($text),1);
    $counts = array_count_values($words);
    return array_search(max($counts),$counts);
 }
 
 $text = "Hello, hello! How are you? Are you okay? Hello";
 echo findMostFrequentWord($text);
?>
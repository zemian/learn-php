<?php 
// PHP RegEx = PCRE = Perl Compatible Regular Expression 
// https://www.php.net/manual/en/reference.pcre.pattern.syntax.php
// 
// Commonly used functions: preg_match, preg_split, preg_replace, preg_filter
// https://www.php.net/manual/en/ref.pcre.php

echo "preg_match test:\n";
if (preg_match("/php/i", "PHP is the web scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}

echo "\n\n";
echo "preg_split test:\n";
$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
print_r($keywords);

echo "\n\n";
echo "Escape regex chars\n";
$keywords = '$40 for a g3/400';
$keywords = preg_quote($keywords, '/');
echo $keywords; // returns \$40 for a g3\/400

echo "\n\n";
echo "Delimiters test:\n";
// Delimiter can be slash, hash or tilda
// https://www.php.net/manual/en/regexp.reference.delimiters.php
print_r(preg_split("/[\s,]+/", "hypertext language, programming"));
print_r(preg_split("#[\s,]+#", "hypertext language, programming"));
print_r(preg_split("{[\s,]+}", "hypertext language, programming"));

//echo "\n\n";
//echo "CamelCase Test:\n";
// Split CamelCase Words with RegEx
///*
//https://stackoverflow.com/questions/4519739/split-camelcase-word-into-words-with-php-preg-match-regular-expression
//
//(        - Start of capturing parenthesis.
// (?:     - Start of non-capturing parenthesis.
//  ^      - Start anchor.
//  |      - Alternation.
//  [A-Z]  - Any one capital letter.
// )       - End of non-capturing parenthesis.
// [a-z]+  - one ore more lowercase letter.
//)        - End of capturing parenthesis.
//*/
// About non-capturing group - https://www.regular-expressions.info/refcapture.html
// Further note: Use non-capturing group so it can use parenthese with OR 
// logic, but do not capture it. The reg will match any word starts with one lower case
// letter then one or more lower case letters, OR one upper case letter with one 
// or more lower case letters.
//
//$str = "TEST AllTest";
//preg_match_all('/((?:^|[A-Z])[a-z]+)/',$str,$matches);
//print_r($matches);


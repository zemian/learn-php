<?php 

/*
https://stackoverflow.com/questions/4519739/split-camelcase-word-into-words-with-php-preg-match-regular-expression

(        - Start of capturing parenthesis.
 (?:     - Start of non-capturing parenthesis.
  ^      - Start anchor.
  |      - Alternation.
  [A-Z]  - Any one capital letter.
 )       - End of non-capturing parenthesis.
 [a-z]+  - one ore more lowercase letter.
)        - End of capturing parenthesis.
*/

// About non-capturing group - https://www.regular-expressions.info/refcapture.html
// Further note: Use non-capturing group so it can use parenthese with OR 
// logic, but do not capture it. The reg will match any word starts with one lower case
// letter then one or more lower case letters, OR one upper case letter with one 
// or more lower case letters.

$str = "TEST AllTest";
preg_match_all('/((?:^|[A-Z])[a-z]+)/',$str,$matches);
print_r($matches);


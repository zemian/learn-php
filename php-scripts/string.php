<?php

// PHP_EOL = "\n";
echo "Hi\n";
echo "Hi".PHP_EOL;

echo 'this is a simple string';

echo 'You can also have embedded newlines in
strings this way as it is
okay to do';

// Outputs: Arnold once said: "I'll be back"
echo 'Arnold once said: "I\'ll be back"';

// Outputs: You deleted C:\*.*?
echo 'You deleted C:\\*.*?';

// Outputs: You deleted C:\*.*?
echo 'You deleted C:\*.*?';

// Outputs: This will not expand: \n a newline
echo 'This will not expand: \n a newline';

// Outputs: Variables do not $expand $either
echo 'Variables do not $expand $either';


// Dollar variables
$juice = "apple";

echo "He drank some $juice juice.".PHP_EOL;
// Invalid. "s" is a valid character for a variable name, but the variable is $juice.
//echo "He drank some juice made of $juices.";
// Valid. Explicitly specify the end of the variable name by enclosing it in braces:
echo "He drank some juice made of ${juice}s.";

// Accessing characters in string
echo PHP_EOL;
$s = "Hello";
echo '$s[1]=', $s[1], "\n";
echo 'strlen($s)=', strlen($s), "\n";
for ($i = 0; $i < strlen($s); $i++) {
    echo "\$s[$i]=", $s[$i], "\n";
}
?>
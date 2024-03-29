<?php
// This example will sanitize input with few built-in php functions
// Example: htmlspecialchars() makes sure any characters that are special in html are properly
//          encoded so people can't inject HTML tags or Javascript into your page. 
//
// The form submit for all empty values will give you empty string, but the 'gender' is not
// defined in POST if not selected! One way to ensure this is to always have a default value!
//
// The htmlentities-vs-htmlspecialchars (use htmlspecialchars if possible)
// https://stackoverflow.com/questions/46483/htmlentities-vs-htmlspecialchars
//
// > The difference is what gets encoded. The choices are everything (entities) or "special" characters,
// > like ampersand, double and single quotes, less than, and greater than (specialchars).
//

//print_r($_POST);

// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"] ?? '');
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!--
https://www.w3schools.com/php/php_form_validation.asp


	So, the $_SERVER["PHP_SELF"] sends the submitted form data to the page itself, instead of jumping to a different page. This way, the user will get error messages on the same page as the form.

	NOTE: $_SERVER["PHP_SELF"] exploits can be avoided by using the htmlspecialchars() function.
-->
<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <br><br>
  E-mail: <input type="text" name="email">
  <br><br>
  Website: <input type="text" name="website">
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


<?php
echo "<h2>Your Input:</h2>";
echo '$name: ' . $name;
echo "<br>";
echo '$email: ' . $email;
echo "<br>";
echo '$website: ' . $website;
echo "<br>";
echo '$comment: ' . $comment;
echo "<br>";
echo '$gender: ' . $gender;
?>
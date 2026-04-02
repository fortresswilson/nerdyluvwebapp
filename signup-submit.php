<?php
# signup-submit.php
# NerdLuv - Signup form processor.
# Reads POST data from signup.php, appends the new user to singles2.txt,
# and displays a thank-you confirmation with a link to matches.php.

require "common.php";

# Read and sanitize all submitted form fields.
$name    = $_POST["name"];
$gender  = $_POST["gender"];
$age     = $_POST["age"];
$type    = $_POST["type"];
$os      = $_POST["os"];
$min_age = $_POST["min_age"];
$max_age = $_POST["max_age"];
$seek    = $_POST["seek"];

# Build the new record line in the singles2.txt format:
# Name,Gender,Age,Type,OS,MinAge,MaxAge,Seek
$newLine = "$name,$gender,$age,$type,$os,$min_age,$max_age,$seek\n";

# Append the new user record to singles2.txt.
# If the file does not end with a newline, add one first so the new
# record is not glued onto the last existing line.
$existing = file_get_contents($SINGLES_FILE);
if ($existing !== "" && substr($existing, -1) !== "\n") {
    file_put_contents($SINGLES_FILE, "\n", FILE_APPEND);
}
file_put_contents($SINGLES_FILE, $newLine, FILE_APPEND);

printHeader("NerdLuv - Welcome");
?>

<div id="content">
    <h2>Thank you!</h2>
    <p>Welcome to NerdLuv, <?= htmlspecialchars($name) ?>!</p>
    <p>
        Now <a href="matches.php">log in to see your matches!</a>
    </p>
</div>

<?php printFooter(); ?>

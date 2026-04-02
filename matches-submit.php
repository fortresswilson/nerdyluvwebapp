<?php
# matches-submit.php
# NerdLuv - Match results page.
# Reads the name GET parameter, finds all matching singles from singles2.txt,
# and displays each match with their photo and details.

require "common.php";

# Read the submitted name from the GET query parameter.
$name = $_GET["name"];

printHeader("NerdLuv - Matches for " . htmlspecialchars($name));
?>

<div id="content">
    <h2>Matches for <?= htmlspecialchars($name) ?></h2>

    <?php
    # Load all singles and find the user record by name.
    $singles = readSingles();
    $user = null;
    foreach ($singles as $single) {
        if ($single["name"] === $name) {
            $user = $single;
            break;
        }
    }

    # Find and display all matches for this user.
    $matchCount = 0;
    foreach ($singles as $single) {
        if ($single["name"] === $name) {
            continue;
        }
        if (isMatch($user, $single)) {
            $matchCount++;
            displayMatch($single);
        }
    }

    # If no matches found, show a message.
    if ($matchCount === 0) {
        echo "<p>No matches found. Try broadening your search criteria!</p>";
    }
    ?>
</div>

<?php printFooter(); ?>

<?php
# common.php
# NerdLuv - Shared functions used by all pages.
# Provides header, footer, and data-reading utilities.

# Base URL for professor's provided assets (CSS, images).
$ASSETS = "https://codd.cs.gsu.edu/~lhenry/WebPro/Assignments/Assign03";

# Path to the singles data file.
$SINGLES_FILE = "singles2.txt";

# Prints the standard NerdLuv HTML header, opening <body>, and logo.
# Parameters: $title - the page <title> string.
function printHeader($title = "NerdLuv") {
    global $ASSETS;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" type="text/css" href="<?= $ASSETS ?>/nerdluv.css" />
</head>
<body>
<div id="header">
    <a href="index.php">
        <img src="<?= $ASSETS ?>/logo.jpg" alt="nerdLuv - where meek geeks meet" />
    </a>
</div>
    <?php
}

# Prints the standard NerdLuv page footer, closing </body> and </html>.
# Includes site blurb, copyright, back link, and W3C badges.
function printFooter() {
    global $ASSETS;
    ?>
<div id="footer">
    <p>This page is for single nerds to meet and date each other!
       Type in your personal information and wait for the nerdly luv to begin!
       Thank you for using our site.</p>
    <p>Results and page (C) Copyright NerdLuv Inc.</p>
    <p>
        <a href="index.php">
            <img src="<?= $ASSETS ?>/back.gif" alt="back arrow" />
            Back to front page
        </a>
    </p>
    <p>
        <a href="https://validator.w3.org/check/referrer">
            <img src="<?= $ASSETS ?>/w3c-html.png" alt="Valid HTML5" />
        </a>
        <a href="https://jigsaw.w3.org/css-validator/check/referer">
            <img src="<?= $ASSETS ?>/w3c-css.png" alt="Valid CSS" />
        </a>
    </p>
</div>
</body>
</html>
    <?php
}

# Reads all singles from singles2.txt and returns an array of associative
# arrays. Each record has keys:
#   name, gender, age, type, os, min_age, max_age, seek
# Returns an empty array if the file cannot be read.
function readSingles() {
    global $SINGLES_FILE;
    $singles = [];
    $lines = file($SINGLES_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$lines) {
        return $singles;
    }
    foreach ($lines as $line) {
        $parts = explode(",", $line);
        if (count($parts) < 8) {
            continue;
        }
        $singles[] = [
            "name"    => trim($parts[0]),
            "gender"  => trim($parts[1]),
            "age"     => (int) trim($parts[2]),
            "type"    => trim($parts[3]),
            "os"      => trim($parts[4]),
            "min_age" => (int) trim($parts[5]),
            "max_age" => (int) trim($parts[6]),
            "seek"    => trim($parts[7]),  // M, F, or MF
        ];
    }
    return $singles;
}

 #Returns true if person A and person B are a match.
# Match criteria (all four must be true):
#   1. Opposite gender
#   2. Compatible ages: A's age is within B's min/max AND B's age is within A's min/max
#   3. Same favorite OS
#   4. At least one personality type letter matches at the same index
# Also checks the extra CSE feature: each person's "seek" field must include
# the other person's gender.
function isMatch($a, $b) {
    # 1. Each person's seek field must include the other's gender (CSE extra version).
    #    This replaces the simple "opposite gender" rule and allows same-sex matches
    #    when both parties have seek = "MF".
    if (strpos($a["seek"], $b["gender"]) === false) {
        return false;
    }
    if (strpos($b["seek"], $a["gender"]) === false) {
        return false;
    }

    # 2. Compatible ages (mutual)
    if ($a["age"] < $b["min_age"] || $a["age"] > $b["max_age"]) {
        return false;
    }
    if ($b["age"] < $a["min_age"] || $b["age"] > $a["max_age"]) {
        return false;
    }

    # 3. Same favorite OS
    if ($a["os"] !== $b["os"]) {
        return false;
    }

    # 4. At least one personality letter matches at the same index
    $typeA = $a["type"];
    $typeB = $b["type"];
    $matched = false;
    for ($i = 0; $i < min(strlen($typeA), strlen($typeB)); $i++) {
        if ($typeA[$i] === $typeB[$i]) {
            $matched = true;
            break;
        }
    }
    if (!$matched) {
        return false;
    }

    return true;
}
?>

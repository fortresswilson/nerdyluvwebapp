<?php
# common.php
# NerdLuv - Shared functions used by all pages.
# Extra features: #2 user photos, #3 LGBT seek-based matching.

# Base URL for this site's assets.
$ASSETS = "https://codd.cs.gsu.edu/~fezeuchenne1/nerdyluvwebapp";

# Path to the singles data file.
$SINGLES_FILE = "singles2.txt";

# Prints the standard NerdLuv HTML header, opening <body>, and logo.
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
    <h1>nerd<span class="luv">Luv</span><sup>tm</sup></h1>
    <p>where meek geeks meet</p>
</div>
    <?php
}

# Prints the standard NerdLuv page footer, closing </body> and </html>.
function printFooter() {
    ?>
<div id="footer">
    <p>This page is for single nerds to meet and date each other!
       Type in your personal information and wait for the nerdly luv to begin!
       Thank you for using our site.</p>
    <p>Results and page (C) Copyright NerdLuv Inc.</p>
    <p><a href="index.php">&larr; Back to front page</a></p>
</div>
</body>
</html>
    <?php
}

# Reads all singles from singles2.txt and returns an array of associative arrays.
# Keys: name, gender, age, type, os, min_age, max_age, seek
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
            "seek"    => trim($parts[7]),
        ];
    }
    return $singles;
}

# Returns true if person A and person B are a match.
# Extra #3: seek field allows LGBT matches.
function isMatch($a, $b) {
    if (strpos($a["seek"], $b["gender"]) === false) {
        return false;
    }
    if (strpos($b["seek"], $a["gender"]) === false) {
        return false;
    }
    if ($a["age"] < $b["min_age"] || $a["age"] > $b["max_age"]) {
        return false;
    }
    if ($b["age"] < $a["min_age"] || $b["age"] > $a["max_age"]) {
        return false;
    }
    if ($a["os"] !== $b["os"]) {
        return false;
    }
    $typeA   = $a["type"];
    $typeB   = $b["type"];
    $matched = false;
    for ($i = 0; $i < min(strlen($typeA), strlen($typeB)); $i++) {
        if ($typeA[$i] === $typeB[$i]) {
            $matched = true;
            break;
        }
    }
    return $matched;
}

# Extra #2: Returns photo URL — checks images/ locally first, falls back to user.jpg.
function getPhotoUrl($name) {
    global $ASSETS;
    $filename  = strtolower(str_replace(" ", "-", $name)) . ".jpg";
    $localPath = "images/" . $filename;
    if (file_exists($localPath)) {
        return $ASSETS . "/images/" . $filename;
    }
    return $ASSETS . "/user.jpg";
}

# Outputs one match block: name and details list (no image dependency).
function displayMatch($person) {
    $name   = htmlspecialchars($person["name"]);
    $gender = htmlspecialchars($person["gender"]);
    $age    = htmlspecialchars($person["age"]);
    $type   = htmlspecialchars($person["type"]);
    $os     = htmlspecialchars($person["os"]);
    ?>
    <div class="match">
        <p class="match-name"><?= $name ?></p>
        <ul>
            <li>gender: <?= $gender ?></li>
            <li>age: <?= $age ?></li>
            <li>type: <?= $type ?></li>
            <li>OS: <?= $os ?></li>
        </ul>
    </div>
    <?php
}

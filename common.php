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


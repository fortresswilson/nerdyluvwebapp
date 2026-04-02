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
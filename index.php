<?php
# index.php
# NerdLuv - Front page.
# Displays the site logo, welcome message, and links to signup and matches.

require "common.php";
printHeader("NerdLuv");
?>

<div id="content">
    <h2>Welcome!</h2>
    <p>
        <a href="signup.php">
            Sign up for a new account
        </a>
    </p>
    <p>
        <a href="matches.php">
            Check your matches
        </a>
    </p>
</div>

<?php printFooter(); ?>

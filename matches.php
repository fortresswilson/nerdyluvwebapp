<?php
# matches.php
# NerdLuv - Returning user login page.
# Displays a form for existing users to look up their matches.

require "common.php";
printHeader("NerdLuv - Check Matches");
?>

<div id="content">
    <fieldset>
        <legend>Returning User:</legend>
        <form action="matches-submit.php" method="get">
            <p>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" size="16" maxlength="16" />
            </p>
            <p>
                <input type="submit" value="View My Matches" />
            </p>
        </form>
    </fieldset>
</div>

<?php printFooter(); ?>

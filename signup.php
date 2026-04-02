<?php
# signup.php
# NerdLuv - New user signup page.
# Displays a form for new users to create an account.

require "common.php";
printHeader("NerdLuv - Sign Up");
?>

<div id="content">
    <fieldset>
        <legend>New User Signup:</legend>
        <form action="signup-submit.php" method="post">
            <p>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" size="16" maxlength="16" />
            </p>
            <p>
                <label>Gender:</label>
                <input type="radio" id="gender_m" name="gender" value="M" />
                <label for="gender_m">Male</label>
                <input type="radio" id="gender_f" name="gender" value="F" checked="checked" />
                <label for="gender_f">Female</label>
            </p>
            <p>
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" size="6" maxlength="2" />
            </p>
            <p>
                <label for="type">Personality type:</label>
                <input type="text" id="type" name="type" size="6" maxlength="4" />
                <a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">(Don't know your type?)</a>
            </p>
            <p>
                <label for="os">Favorite OS:</label>
                <select id="os" name="os">
                    <option value="Windows" selected="selected">Windows</option>
                    <option value="Mac OS X">Mac OS X</option>
                    <option value="Linux">Linux</option>
                </select>
            </p>
            <p>
                <label>Seeking age:</label>
                <input type="text" id="min_age" name="min_age" size="6" maxlength="2"
                       placeholder="min" />
                to
                <input type="text" id="max_age" name="max_age" size="6" maxlength="2"
                       placeholder="max" />
            </p>
            <p>
                <label>Seeking gender:</label>
                <input type="radio" id="seek_m" name="seek" value="M" />
                <label for="seek_m">Male</label>
                <input type="radio" id="seek_f" name="seek" value="F" />
                <label for="seek_f">Female</label>
                <input type="radio" id="seek_mf" name="seek" value="MF" checked="checked" />
                <label for="seek_mf">Both</label>
            </p>
            <p>
                <input type="submit" value="Sign Up" />
            </p>
        </form>
    </fieldset>
</div>

<?php printFooter(); ?>

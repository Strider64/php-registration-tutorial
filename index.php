<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <title>PHP Registration Tutorial</title>
        <link rel="stylesheet" href="assests/css/reset.css">
        <link rel="stylesheet" href="assests/css/stylesheet.css">
    </head>
    <body>
        <div class="container">
            <form id="register" action="index.php" method="post" autocomplete="off">
                <fieldset>
                    <legend>Registration Form</legend>
                    <input type="hidden" name="action" value="submit">
                    <label for="username">username:</label>
                    <input id="username" type="text" name="username" value="" autofocus tabindex="1">
                    <label for="password">password:</label>
                    <input id="password" type="password" name="password" tabindex="2">
                    <label for="verify">verify password:</label>
                    <input id="verify" type="password" name="verify" tabindex="3">
                    <label for="email">email address:</label>
                    <input id="email" type="text" name="email" value="" tabindex="4">
                    <label for="verify_email">verify email:</label>
                    <input id="verify_email" type="text" name="verifyEmail" value="" tabindex="5">
                    <input id="registerBtn" type="submit" name="submit" value="submit" tabindex="6">
                </fieldset>
            </form>
            <div class="info">
                <h1>Registration Tutorial</h1>
                <ol>
                    <li>All input fields must be entered.</li>
                    <li>Password must contain at least 8 characters, have at least one uppercase, one lowercase and one numeric character.</li>
                    <li>Password and Verify Password must match.</li>
                    <li>Email Address must be valid.</li>
                    <li>Email Address and Verify Address must match.</li>
                </ol>
            </div>
        </div>
    </body>
</html>

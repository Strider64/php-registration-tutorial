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
                
            </div>
        </div>
    </body>
</html>

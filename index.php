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
            <form id="register" action="index.php" method="post">
                <fieldset>
                    <legend>Registration Form</legend>
                    <input type="hidden" name="action" value="submit">
                    <label for="username">username</label>
                    <input id="username" type="text" name="username" value="">
                    <label for="password">password</label>
                    <input id="password" type="password" name="password">
                    <label for="verify">verify password</label>
                    <input id="verify" type="password" name="verify">
                    <label for="email">email address</label>
                    <input id="email" type="text" name="email" value="">
                    <label for="verify_email">verify email</label>
                    <input id="verify_email" type="text" name="verifyEmail" value="">
                    <input id="registerBtn" type="submit" name="submit" value="submit">
                </fieldset>
            </form>
        </div>
    </body>
</html>

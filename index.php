<?php
/*
 * Turn on error reporting, set the default timezone, start sessions and create a constant PDO database 
 * connection to the database in config.php under the directory includes in the the assests folder.
 */
require_once 'assests/includes/config.php';
/*
 * Create a bunch of helper functions since we are creating the registration and input the procedural way, 
 * if we had been doing the Object-Oriented Programming way we would had created an classes and a class
 * autoloader.
 */
require_once 'assests/functions/functions.inc.php';
/*
 * Create an users table if one doesn't already exists, once it exists you can comment out the call to the createTabase
 * function. Though it really doesn't hurt leaving it in there. 
 */
createTables(); // You can comment this out when this is run at least once:

$data = []; // An array that we setup as $data:
$error = [];
/*
 * When user click on the submit button we grab the hidden input variable and the
 * reason we do that instead of the regular submit button is to ensure that we get the click.
 * For some older I.E. browsers don't register the click on the submit button (or so I am told).
 */
$submit = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // using htmlspecialchars sanitizes the variable:

if ($submit && $submit === 'submit') {
    /*
     * Grab all the user's input responses and store them it the array called $data. We
     * will shorting be validating all the input fields and then storing the values in a database table if everything
     * passes validation.
     */
    $data['username'] = htmlspecialchars($_POST['username']);
    $data['password'] = htmlspecialchars($_POST['password']);
    $data['password_verify'] = htmlspecialchars($_POST['verify']);
    $data['email'] = htmlspecialchars($_POST['email']);
    $data['email_verify'] = htmlspecialchars($_POST['verifyEmail']);

    /*
     * Validate user's input from registration form. Check to see if all fields have been entered, password is 
     * valid, email is valid, verify that both password and email address has been entered correct and make sure there
     * are no dupicate accounts being entered. 
     */
    $error['empty'] = checkContent($data);
    $error['password'] = checkPassword($data['password']);
    $error['email'] = checkEmail($data['email']);
    $error['passwordMatch'] = passwordMatch($data['password'], $data['password_verify']);
    $error['emailMatch'] = emailMatch($data['email'], $data['email_verify']);
    $error['account'] = accountStatus($data['email'], $pdo);

    /*
     * Check to see if everything passes, if so save user's acount to database table users. Otherwise inform
     * user there was an error(s) when registering and please try again. 
     */
    $result = validate($error);
    if (!is_array($result)) {
        $info = saveRegistration($data, $pdo);
        unset($data);
    } else {
        //echo "<pre>" . print_r($error, 1) . "</pre>\n";
    }
}
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
                    <input id="username" type="text" name="username" value="<?php echo isset($data['username']) ? $data['username'] : NULL; ?>" autofocus tabindex="1">
                    <label for="password">password:</label>
                    <input id="password" type="password" name="password" tabindex="2">
                    <label for="verify">verify password:</label>
                    <input id="verify" type="password" name="verify" tabindex="3">
                    <label for="email">email address:</label>
                    <input id="email" type="text" name="email" value="<?php echo isset($data['email']) ? $data['email'] : NULL; ?>" tabindex="4">
                    <label for="verify_email">verify email:</label>
                    <input id="verify_email" type="text" name="verifyEmail" value="<?php echo isset($data['email_verify']) ? $data['email_verify'] : NULL; ?>" tabindex="5">
                    <input id="registerBtn" type="submit" name="submit" value="submit" tabindex="6">
                </fieldset>
            </form>
            <div class="info">
                <?php if (isset($info)) { ?>
                <h1 class="green">Successfully Registered!</h1>
                <p class="green">You have successfully registered with Registration Tutorial. If you want to you can login to the Demo Page at <a href="login.php">login</a>?</p>
                <?php } else { ?>
                    <h1 class="green">Registration Tutorial</h1>
                    <ol>
                        <li <?php echo (isset($result) && !$result['empty']) ? 'class="red"' : 'class="green"'; ?>>All input fields must be entered.</li>
                        <li <?php echo (isset($result) && !$result['password']) ? 'class="red"' : 'class="green"'; ?>>Password must contain at least 8 characters, have at least one uppercase, one lowercase and one numeric character.</li>
                        <li <?php echo (isset($result) && !$result['passwordMatch']) ? 'class="red"' : 'class="green"'; ?>>Password and Verify Password must match.</li>
                        <li <?php echo (isset($result) && !$result['email']) ? 'class="red"' : 'class="green"'; ?>>Email Address must be valid.</li>
                        <li <?php echo (isset($result) && !$result['emailMatch']) ? 'class="red"' : 'class="green"'; ?>>Email Address and Verify Address must match.</li>
                        <?php echo (isset($result) && !$result['account']) ? '<li class="red">You already have an account registered with us!</li>' : NULL; ?>
                    </ol>
                <?php } ?>
            </div>
        </div>
    </body>
</html>

<?php

function createTables() {
    try {
        if (filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL) == "localhost") {
            $conn = new PDO("mysql:host=localhost:8889;dbname=tutorial_login", DATABASE_USERNAME, DATABASE_PASSWORD);
        } else {
            $conn = new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        }
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $table1 = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(60) NOT NULL,
                email VARCHAR(120) NOT NULL,
                password VARCHAR(255) NOT NULL,
                confirmation VARCHAR(255) NOT NULL,
                security VARCHAR(11) NOT NULL DEFAULT 'public',
                dateCreated DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00')";
        $conn->exec($table1);
        $use = 'use ' . DATABASE_NAME;
        $conn->exec($use);
        $conn = NULL;
    } catch (PDOException $e) {
        echo "Something went wrong" . $e->getMessage();
    }
}

/*
 * Begin of Validation.
 */

function checkContent($data) {
    /* This makes sure user just didn't type spaces in an attempt to make the form valid */
    foreach ($data as $key => $value) {
        $data[$key] = isset($value) ? trim($value) : '';
    }
    /* If there are empty field(s) then set the error array to
     * false otherwise it should be true. I know it sounds like that we should set it to true and
     * I will explain it better when we are all finished coding the validation
     * portion of the script.
     */
    if (in_array("", $data, true)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function checkPassword($password) {
    /*
     * 
     * Explaining !preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password)
     * $ = beginning of string
     * \S* = any set of characters
     * (?=\S{8,}) = of at least length 8
     * (?=\S*[a-z]) = containing at least one lowercase letter
     * (?=\S*[A-Z]) = and at least one one uppercase letter
     * (?=\S*[\d]) = and at least one number
     * (?=\S*[\W]) = and at least a special character (non-word character)
     * $ = end of the string:
     * 
     */
    if (!\preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $password)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function checkEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function passwordMatch($password, $verify_password) {
    if ($password === $verify_password) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function emailMatch($email, $verify_email) {
    if ($email === $verify_email) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function accountStatus($email, $pdo) {
    $query = "SELECT 1 FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function validate(array $error) {
    foreach ($error as $status) {
        if (!$status) {
            return $error;
        }
    }
    return true;
}

/*
 * End of Validation
 */

/* 
 * Save data to database table after validation is done.
 */
function saveRegistration(array $data, $pdo) {
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $query = 'INSERT INTO users(username, email, password, dateCreated) VALUES ( :username, :email, :password, NOW())';
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([':username' => $data['username'], ':email' => $data['email'], ':password' => $password]);
    if ($result) {
        return TRUE;
    } else {
        return FALSE;
    }
}

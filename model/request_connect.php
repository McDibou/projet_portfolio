<?php

// verify_connect.php
function compareUsers( $enter, $id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE pseudo_users = '$enter' AND roles_id = $id"));
}

// verify_connect.php
function createUsers($name_users, $username_users, $mail_users, $pseudo_users, $password_users, $key, $db)
{
    mysqli_query($db, "INSERT INTO users ( name_users, username_users, mail_users, pseudo_users, password_users, key_users, active_users, roles_id ) VALUES ( '$name_users', '$username_users', '$mail_users', '$pseudo_users', '$password_users', '$key',0, 1 );");
}

// verify_connect.php
function updateUsers($log,$db)
{
    return mysqli_query($db, "UPDATE users SET active_users = 1 WHERE pseudo_users = '$log'");
}
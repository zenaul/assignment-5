<?php
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
    $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
    $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
    $password = sha1( $password );

    $userDetails = sprintf("%s|%s|%s|%s\n",$username, $email, $password, 'user');
    file_put_contents( "../data/users.txt", $userDetails, FILE_APPEND );

    header( "Location: ../index.php?register=1&success=1" );
    exit();
}
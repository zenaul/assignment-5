<?php
session_start();
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    
    $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
    $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );

    $users = file( "../data/users.txt", FILE_IGNORE_NEW_LINES );
    foreach ( $users as $user ) {
        $data = explode( "|", $user );
        if ( $email == $data[1] && $data[2] == sha1( $password ) ) {
            
            $_SESSION['loggedin'] = true;
            $_SESSION["username"] = $data[0];
            $_SESSION["role"]     = $data[3];

            if ("admin" == $data[3]) {
                header( "Location: ../admin_dashboard.php" );
            }else if("manager" == $data[3]){
                header( "Location: ../manager_dashboard.php" );
            }else{
                header( "Location: ../user_dashboard.php" );
            }

            exit();
        }
    }

    header( "Location: ../login.php?error=1&msg=Username and Password didn't match!" );
    exit();
}
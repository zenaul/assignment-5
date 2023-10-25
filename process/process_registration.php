<?php
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
    $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
    $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );

    if( empty( $username ) || empty($email) || empty($password)){
        header( "Location: ../registration.php?error=1&msg=Require all field" );
    }elseif ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        header( "Location: ../registration.php?error=1&msg=Email Address Invalid" );
    }else{
        $users = file( '../data/users.txt', FILE_IGNORE_NEW_LINES );
        $found = false;
        foreach ( $users as $user ) {
            $data = explode( "|", $user );
            if ( $data[1] == $email ) {
                $found = true;
                break;
            }
        }
        if( $found ){
            header( "Location: ../registration.php?error=1&msg=User Already exists" );
        }else{
            $password = sha1( $password );
            $userDetails = sprintf("%s|%s|%s|%s\n",$username, $email, $password, 'user');
            file_put_contents( "../data/users.txt", $userDetails, FILE_APPEND );
            header( "Location: ../index.php?register=1&success=1" );
        }
        
    }
    exit();
}
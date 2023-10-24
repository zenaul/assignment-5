<?php
$delete_id = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_STRING );
$action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_STRING );

if ( $_SERVER["REQUEST_METHOD"] == "POST" || 'delete' == $action) {
    $dataFilePath = "../data/users.txt";

    $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
    $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
    $password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
    $role = filter_input( INPUT_POST, 'role', FILTER_SANITIZE_STRING );
    $id = filter_input( INPUT_POST, 'userid', FILTER_SANITIZE_STRING );

    $id = ( 'delete' == $action ) ? $delete_id : $id;

    if( $id ){
        $users = file( $dataFilePath );
        foreach ( $users as $key => $user ) {
            $data = explode( "|", $user );
            if ( $key == ($id-1) ) {
                if( 'delete' == $action ){
                    unset($users[$key]);
                    header( "Location: ../index.php?delete=1&success=1" );
                }else{
                    $users[$key] = sprintf("%s|%s|%s|%s\n",$username, $email, $data[2], $role);
                    header( "Location: ../index.php?update=1&success=1" );
                }
            }
        }
        file_put_contents( $dataFilePath, $users, LOCK_EX );

    }else{
        $password = sha1( $password );
        $userDetails = sprintf("%s|%s|%s|%s\n",$username, $email, $password, $role);
        file_put_contents( $dataFilePath, $userDetails, FILE_APPEND );

        header( "Location: ../index.php?create=1&success=1" );
    }

    exit();
}
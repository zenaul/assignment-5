<?php
function isAdmin() {
    return !empty( $_SESSION['role'] ) ? ( 'admin' == $_SESSION['role'] ) : false;
}

function isManager() {
    return !empty( $_SESSION['role'] ) ? ( 'manager' == $_SESSION['role'] ) : false;
}

function isUser() {
    return !empty( $_SESSION['role'] ) ? ( 'user' == $_SESSION['role'] ) : false;
}

function hasPrivilege() {
    return ( isAdmin() || isManager() || isUser());
}

function getSessionValue($key){
    return !empty( $_SESSION[$key] ) ? $_SESSION[$key] : "";
}

function getUser( $id ) {
    $users = file( 'data/users.txt', FILE_IGNORE_NEW_LINES );
    foreach ( $users as $key => $user ) {
        $data = explode( "|", $user );
        if ( $key == ($id-1) ) {
            return $data;
        }
    }

    return false;
}
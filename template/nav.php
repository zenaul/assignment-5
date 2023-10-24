<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">All Users</a>
            </li>
            <?php if( hasPrivilege() ):?>
            <li class="nav-item active">
                <?php
                    if(isAdmin()){
                        printf('<a class="nav-link" href="%s">Dashboard</a>','admin_dashboard.php');
                    }else if(isManager()){
                        printf('<a class="nav-link" href="%s">Dashboard</a>','manager_dashboard.php');
                    }else{
                        printf('<a class="nav-link" href="%s">Dashboard</a>','user_dashboard.php');
                    }
                ?>
            </li>
            <?php endif;?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if( hasPrivilege() ):?>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php?logout=1">Logout</a>
                </li>
            <?php else:?>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="registration.php">Register</a>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>

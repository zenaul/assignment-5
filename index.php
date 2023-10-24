<?php include_once './template/head.php';?>
<?php include_once './template/nav.php';?>

<?php
    $action = isAdmin() && !empty($_GET['action']) ? $_GET['action'] : '';
    $id = !empty( $_GET['id'] ) ? $_GET['id'] : '';
?>
<?php 
    if("edit" == $action && !empty( $id ) && isAdmin()){
        $user = getUser($id);
        if( $user ){
            $currentRole = !empty( $user[3] ) ? $user[3] : 'user';
            ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update</h5>
                            <hr />
                            <form action="process/process_user.php" method="post">
                            <div class="form-group">
                                <label for="email">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $user[0]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user[1]; ?>">
                                <input type="hidden" id="userid" name="userid" class="form-control" value="<?php echo $id; ?>">
                            </div>
                            <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="user" <?php if( $currentRole == 'user' ) echo"selected"; ?>>User</option>
                                <option value="manager" <?php if( $currentRole == 'manager' ) echo"selected"; ?>>Manager</option>
                                <option value="admin" <?php if( $currentRole == 'admin' ) echo"selected"; ?>>Admin</option>
                            </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
?>

<?php
    if( "add" == $action && isAdmin() ){
        ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add User</h5>
                        <hr />
                        <form action="process/process_user.php" method="post">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="user">User</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>

<?php if( '' == $action ): ?>
    <div class="row">
        <div class="col-sm-12 mt-3 mb-3">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h2>All User</h2>
            </div>
            <?php if( isAdmin() ) : ?>
                <div class="col-sm-6 text-right">
                    <a href="index.php?action=add" class="btn btn-primary">+ Add User</a>
                </div>
            <?php endif;?>
        </div>
        </div>
        <div class="col-sm-12">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <?php if( isAdmin() ) : ?>
                        <th scope="col">Action</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $users = file( "./data/users.txt", FILE_IGNORE_NEW_LINES );
                        $count = 0;
                        foreach ( $users as $key => $user ) {
                            $count++;
                            $data = explode( "|", $user );
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $count;?></th>
                                    <td><?php echo $data[0]; ?></td>
                                    <td><?php echo $data[1]; ?></td>
                                    <td><?php echo !empty($data[3]) ? $data[3] : "-"; ?></td>
                                    <?php if( isAdmin() ){ printf( '<td><a href="index.php?action=edit&id=%s" class="btn btn-primary btn-sm">Update</a> <a class="delete btn btn-danger btn-sm" href="process/process_user.php?action=delete&id=%s">Delete</a></td>', $count, $count );} ?>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php include_once './template/footer.php';?>
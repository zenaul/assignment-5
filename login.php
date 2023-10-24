<?php
    include_once './template/head.php';
    if( isset($_SESSION['loggedin']) ){
        if( "admin" == $_SESSION["role"] ){
            header( "Location: admin_dashboard.php" );
        }else if( "admin" == $_SESSION["role"] ){
            header( "Location: manager_dashboard.php" );
        }else{
            header( "Location: user_dashboard.php" );
        }
    }

    $error = !empty( $_GET['error'] ) ? $_GET['error'] : '';
    $msg = !empty( $_GET['msg'] ) ? $_GET['msg'] : '';
?>
<?php include_once './template/nav.php';?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Login</h5>
            <hr />
            <?php if( $error ): ?>
            <div class="alert alert-danger">
                <?php echo $msg; ?>
            </div>
            <?php endif; ?>
            <form action="process/process_login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        </div>
        </div>
    </div>
</div>
<?php include_once './template/footer.php';?>
<?php 
    include_once './template/head.php';
    if( !isManager() ){
        header( "Location: index.php" );
    }
?>
<?php include_once './template/nav.php';?>
<div class="row">
    <div class="col-sm-12">
        <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Welcome To <?php echo getSessionValue('username');?></h5>
            <p class="card-text">This is manager dashboard.</p>
        </div>
        </div>
    </div>
</div>
<?php include_once './template/footer.php';?>
<?php

$query = "SELECT * FROM modules ORDER BY seq LIMIT 1";
$result = mysqli_query($con, $query);
$module = mysqli_fetch_assoc($result);
$module = $module['link'];
$module_id = $module['id'];

$query = "SELECT * FROM menus ORDER BY seq LIMIT 1";
$result = mysqli_query($con, $query);
$menu = mysqli_fetch_assoc($result);
$menu = $menu['link'];

if(isset($_GET['user'])){
    $uid = $_GET['user'];
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
    // CHECK PASSWORD...
    $query = "UPDATE users SET `password` = '{$password}' WHERE id = {$uid};";
    $result = mysqli_query($con, $query);
    if($result){
        $link = '../' . $module. '/index.php?mod=' . $module . '&menu=' . $menu;
        header('Location: ' . $link);
        exit();
    }
}

?>




<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <section class="content-header">
            <h1>
                User <small>profile</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            echo '<button type="update" class="btn btn-primary pull-left btn-sm" name="update" form="reset_password">Update</button> '; 
            echo '&nbsp<a href="../'.$module.'/index.php?mod=' . $module . '&menu=' . $menu . '" class="btn btn-default btn-sm" role="button">Cancel</a>';  
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">
<div class="row">
    <div class="col-md-6">
        <legend><h4>Reset Password</h4></legend> 
        <form class="form-horizontal" id="reset_password" method="POST" action="">
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control input-sm" id="password" name="password" value="<?php echo $username; ?>" />										
                </div>
            </div>
        </form>
    </div>
</div>
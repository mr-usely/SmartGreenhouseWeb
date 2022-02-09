<?php
$username = '';
$password = '';
$group = '';
$active = '';
$id = '';

if(isset($_GET['edit_user'])){
    $id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE id={$id} LIMIT 1;";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['name'];
    $password = $row['password'];
	$group = $row['group'];
	$active = $row['active'];
}

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$group = $_POST['group'];
	$active = $_POST['active'];
    $query = "INSERT INTO users (`name`, `password`,`group`, `active`) VALUES ('{$username}','{$password}',{$group},{$active});";
   
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=usr');
        exit();
    }
}

if(isset($_POST['update']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$group = $_POST['group'];
	$active = $_POST['active'];
	
    $query = "UPDATE users SET `name` = '{$username}', `password` = '{$password}',`group`={$group},`active`={$active} WHERE id = {$id};";
	echo $query;
	
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=usr');
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
                User <small>management</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            if(isset($_GET['edit_user'])){
                echo '<button type="update" class="btn btn-primary pull-left btn-sm" name="update" form="add_user">Update</button> ';
                echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '&delete_user='. $id .'" class="btn btn-danger btn-sm" role="button">Delete</a>';
            }
            else{
                echo '<button type="submit" class="btn btn-success pull-left btn-sm" name="submit" form="add_user">Save</button> ';
            }
            echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '" class="btn btn-default btn-sm" role="button">Cancel</a>';  
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">

<div class="row">
    <div class="col-md-6">
        <legend><h4>User Info</h4></legend> 
        <form class="form-horizontal" id="add_user" method="POST" action="">
            <div class="form-group">
                <label for="inputDbHost" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="username" name="username" value="<?php echo $username; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="password" name="password" value="<?php echo $password; ?>" />										
                </div>
            </div>
			<div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="group" name="group" value="<?php echo $group; ?>" />										
                </div>
            </div>
			<div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="active" name="active" value="<?php echo $active; ?>" />										
                </div>
            </div>
        </form>
    </div>
</div>
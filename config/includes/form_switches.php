<?php
$pin = '';
$desc = '';

if(isset($_GET['edit_pin'])){
    $id = $_GET['edit_pin'];
    $query = "SELECT * FROM pin_status WHERE id={$id} LIMIT 1;";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $pin = $row['pin'];
	$desc= $row['description'];
}

if(isset($_GET['delete_pin'])){
    $id = $_GET['delete_pin'];
    $query = "DELETE * FROM pin_status WHERE id={$id} LIMIT 1;";
    $result = mysqli_query($con, $query);
    echo $query;
    //if($result){
        //header('Location: index.php?mod=base&menu=sw');
        //exit();
    //}
}


if(isset($_POST['submit']))
{
	$pin = $_POST['pin'];
	$desc = $_POST['description'];

    $query = "INSERT INTO pin_status (`pin`, `description`) VALUES ('{$pin}','{$description}');";
   
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=sw');
        exit();
    }
}

if(isset($_POST['update']))
{
	$pin = $_POST['pin'];
	$description = $_POST['description'];

    $query = "UPDATE pin_status SET `pin` = '{$pin}', `description` = '{$description}' WHERE id = {$id};";
	echo $query;
	
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=sw');
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
                Pin <small>Configuration</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            if(isset($_GET['edit_pin'])){
                echo '<button type="update" class="btn btn-primary pull-left btn-sm" name="update" form="add_pin">Update</button> ';
                echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '&delete_pin='. $id .'" class="btn btn-danger btn-sm" role="button">Delete</a>';
            }
            else{
                echo '<button type="submit" class="btn btn-success pull-left btn-sm" name="submit" form="add_pin">Save</button> ';
            }
            echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '" class="btn btn-default btn-sm" role="button">Cancel</a>';  
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">

<div class="row">
    <div class="col-md-6">
        <legend><h4>Pin Info</h4></legend> 
        <form class="form-horizontal" id="add_pin" method="POST" action="">
            <div class="form-group">
                <label for="inputDbHost" class="col-sm-2 control-label">Arduino Pin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="pin" name="pin" value="<?php echo $pin; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="description" name="description" value="<?php echo $desc; ?>" />										
                </div>
            </div>
        </form>
    </div>
</div>
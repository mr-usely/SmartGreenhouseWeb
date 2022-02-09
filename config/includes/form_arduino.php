<?php
$ip = '';
$desc = '';
$port = '';
if(isset($_GET['edit_ip'])){
    $id = $_GET['edit_ip'];
    $query = "SELECT * FROM arduino WHERE id=1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $ip = long2ip($row['ip']);
    $port = $row['port'];
	$desc= $row['description'];
}

if(isset($_GET['delete_ip'])){
    $id = $_GET['delete_pin'];
    $query = "DELETE * FROM arduino WHERE id=1;";
    $result = mysqli_query($con, $query);
    echo $query;
    //if($result){
        //header('Location: index.php?mod=base&menu=sw');
        //exit();
    //}
}


if(isset($_POST['submit']))
{
	$ip = ip2long($_POST['ip']);
    $port = $_POST['port'];
	$desc = $_POST['description'];
    $query = "INSERT INTO arduino (`ip`,`port`, `description`) VALUES ({$ip},{$port},'{$desc}');";
    echo $query;
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=ar');
        exit();
    }
}

if(isset($_POST['update']))
{
	$ip = ip2long($_POST['ip']);
    $port = $_POST['port'];
	$desc = $_POST['description'];

    $query = "UPDATE arduino SET `ip` = {$ip},`port`={$port}, `description` = '{$desc}' WHERE id = 1;";
	echo $query;
	
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=ar');
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
            if(isset($_GET['edit_ip'])){
                echo '<button type="update" class="btn btn-primary pull-left btn-sm" name="update" form="add_ip">Update</button> ';
                echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '&delete_ip='. $id .'" class="btn btn-danger btn-sm" role="button">Delete</a>';
            }
            else{
                echo '<button type="submit" class="btn btn-success pull-left btn-sm" name="submit" form="add_ip">Save</button> ';
            }
            echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '" class="btn btn-default btn-sm" role="button">Cancel</a>';  
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">

<div class="row">
    <div class="col-md-6">
        <legend><h4>Pin Info</h4></legend> 
        <form class="form-horizontal" id="add_ip" method="POST" action="">
            <div class="form-group">
                <label for="inputDbHost" class="col-sm-2 control-label">Ip address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="ip" name="ip" value="<?php echo $ip; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Port</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="port" name="port" value="<?php echo $port; ?>" />										
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
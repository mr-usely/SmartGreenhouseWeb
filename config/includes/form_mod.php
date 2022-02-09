<?php
$id = '';
$mod = '';
$link = '';
$desc = '';
$seq = '';
$group = '';


if(isset($_GET['edit_mod'])){
    $id = $_GET['edit_mod'];
    $query = "SELECT * FROM modules WHERE id={$id} LIMIT 1;";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $mod = $row['name'];
    $link = $row['link'];
    $desc = $row['description'];
    $seq = $row['seq'];
    $group = $row['group'];
}

if(isset($_POST['submit']))
{
	$mod = $_POST['name'];
	$link = $_POST['link'];
    $desc = $_POST['desc'];
    $seq = $_POST['seq'];
    $group = $_POST['group'];

    $query = "INSERT INTO modules (`name`, `link`, `description`,`seq`, `group`) VALUES ('{$mod}','{$link}','{$desc}','{$seq}','{$group}');";
    $result = mysqli_query($con, $query);

    if($result){
        header('Location: index.php?mod=base&menu=mo');
        exit();
    }
}

if(isset($_POST['update']))
{
	$mod = $_POST['name'];
	$link = $_POST['link'];
    $desc = $_POST['desc'];
    $seq = $_POST['seq'];
    $group = $_POST['group'];

    $query = "UPDATE modules SET `name` = '{$mod}', `link` = '{$link}', `description`='{$desc}', `seq`='{$seq}', `group`='{$group}' WHERE id = {$id};";
	echo $query;
	
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=mo');
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
                Module <small>management</small>
            </h1>
        </section>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <?php
            if(isset($_GET['edit_mod'])){
                echo '<button type="submit" class="btn btn-primary pull-left btn-sm" name="update" form="add_user">Update</button> ';
                echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '&delete_mod='. $id .'" class="btn btn-danger btn-sm" role="button">Delete</a>';
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
        <legend><h4>Add Module</h4></legend> 
        <form class="form-horizontal" id="add_user" method="POST" action="">
            <div class="form-group">
                <label for="inputDbHost" class="col-sm-2 control-label">Module Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="name" name="name" value="<?php echo $mod; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Link</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="link" name="link" value="<?php echo $link; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="desc" name="desc" value="<?php echo $desc; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Sequence</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="seq" name="seq" value="<?php echo $seq; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="group" name="group" value="<?php echo $group; ?>" />										
                </div>
            </div>
        </form>
    </div>
</div>
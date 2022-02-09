<?php
$ip = '';
$desc = '';
$port = '';
if(isset($_GET['edit_gr'])){
    $id = $_GET['edit_gr'];
    $query = "SELECT * FROM groups WHERE id={$id}";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    
    $name = $row['name'];
    $mod = $row['module'];
	$desc= $row['description'];
}


if(isset($_POST['submit']))
{
	$name = $_POST['name'];
    $mod = $_POST['module'];
	$desc = $_POST['description'];
    $query = "INSERT INTO groups (`name`, `module`, `description`) VALUES ('{$name}',{$mod},'{$desc}');";
    echo $query;
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=gr');
        exit();
    }
}

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $mod = $_POST['module'];
	$desc = $_POST['description'];

    $query = "UPDATE groups SET `name` = '{$name}',`module`={$mod},`description` = '{$desc}' WHERE id = {$id};";
	echo $query;
	
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=gr');
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
                Group <small>Configuration</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            if(isset($_GET['edit_gr'])){
                echo '<button type="update" class="btn btn-primary pull-left btn-sm" name="update" form="add_group">Update</button> ';
                echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '&delete_gr='. $id .'" class="btn btn-danger btn-sm" role="button">Delete</a>';
            }
            else{
                echo '<button type="submit" class="btn btn-success pull-left btn-sm" name="submit" form="add_group">Save</button> ';
            }
            echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '" class="btn btn-default btn-sm" role="button">Cancel</a>';  
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">

<div class="row">
    <div class="col-md-6">
        <legend><h4>Group Info</h4></legend> 
        <form class="form-horizontal" id="add_group" method="POST" action="">
             <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Select Module</label>
                <div class="col-sm-10">
                    <select class="form-control" name="module">
                        <option></option>
                    <?php
                        $query = "SELECT * FROM modules";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)):
                            echo "<option value={$row['id']}"; if($row['id']==$mod) echo " selected"; echo ">{$row['name']}</option>";
                        endwhile;
                    
                    ?>
                    </select>
                </div>
             </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="name" name="name" value="<?php echo $name; ?>" />										
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
<?php
$id = '';
$parent_id = '';
$name = '';
$link = '';
$seq = '';
$page_title = '';
$page_title_sm = '';
$icon = '';
$group = '';


if(isset($_GET['edit_menu'])){
    $id = $_GET['edit_menu'];
    $query = "SELECT * FROM menus WHERE id={$id} LIMIT 1;";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $parent_id = $row['parent_id'];
    $name = $row['name'];
    $link = $row['link'];
    $seq = $row['seq'];
    $page_title = $row['page_title'];
    $page_title_sm = $row['page_title_sm'];
    $icon = $row['icon'];
    $group = $row['group'];
}

if(isset($_POST['submit']))
{
	$parent_id = $_POST['parent_id'];
    $name = $_POST['name'];
    $link = $_POST['link'];
    $seq = $_POST['seq'];
    $page_title = $_POST['page_title'];
    $page_title_sm = $_POST['page_title_sm'];
    $icon = $_POST['icon'];
    $group = $_POST['group'];

    $query = "INSERT INTO menus (`parent_id`, `name`, `link`,`seq`, `page_title`,`page_title_sm`,`icon`,`group`)";
    $query .= "VALUES ({$parent_id},'{$name}','{$link}',{$seq},'{$page_title}','{$page_title_sm}','{$icon}','{$group}');";
    $result = mysqli_query($con, $query);
	echo $query;
    if($result){
        header('Location: index.php?mod=base&menu=me');
        exit();
    }
}

if(isset($_POST['update']))
{
	$parent_id = $_POST['parent_id'];
    $name = $_POST['name'];
    $link = $_POST['link'];
    $seq = $_POST['seq'];
    $page_title = $_POST['page_title'];
    $page_title_sm = $_POST['page_title_sm'];
    $icon = $_POST['icon'];
    $group = $_POST['group'];

    $query = "UPDATE menus SET `parent_id`= {$parent_id}, `name` = '{$name}', `seq`='{$seq}',`link`='{$link}',";
    $query .= "`page_title` = '{$page_title}',`page_title_sm` = '{$page_title_sm}', `icon`='{$icon}', `group`='{$group}' WHERE id = {$id};";
	echo $query;
	
    $result = mysqli_query($con, $query);
    if($result){
        header('Location: index.php?mod=base&menu=me');
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
                Menu <small>management</small>
            </h1>
        </section>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <?php
            if(isset($_GET['edit_menu'])){
                echo '<button type="submit" class="btn btn-primary pull-left btn-sm" name="update" form="add_user">Update</button> ';
                echo '&nbsp<a href="?mod=' . $module . '&menu=' . $menu . '&delete_menu='. $id .'" class="btn btn-danger btn-sm" role="button">Delete</a>';
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
                <label for="inputDbHost" class="col-sm-2 control-label">Menu Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="name" name="name" value="<?php echo $name; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="parent_id" name="parent_id" value="<?php echo $parent_id; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Link</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="link" name="link" value="<?php echo $link; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Sequence</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="seq" name="seq" value="<?php echo $seq; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Page Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="page_title" name="page_title" value="<?php echo $page_title; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Page Title Small</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="page_title_sm" name="page_title_sm" value="<?php echo $page_title_sm; ?>" />										
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="icon" name="icon" value="<?php echo $icon; ?>" />										
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
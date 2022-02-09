<?php
$edit = '';
$db_host = DB_HOST;
$db_user = DB_USER;
$db_pass = DB_PASS;
$database = DATABASE;

if(isset($_POST['submit']))
{
	$db_host = $_POST['db_host'];
	$db_user = $_POST['db_user'];
	$db_pass = $_POST['db_pass'];
	$database = $_POST['database'];
	
	$file = fopen("../base/includes/constants.php","w");
	$config = '<?php';
	$config .= "\ndefine('DB_HOST','". $db_host."');\n";
	$config .= "define('DB_USER','". $db_user."');\n";
	$config .= "define('DB_PASS','". $db_pass."');\n";
	$config .= "define('DATABASE','". $database."');\n";
	$config .= "?>";
	fwrite($file, $config);
	fclose($file);
	header('Location: index.php?mod=base&menu=db');
	exit();
}

if(isset($_GET['edit'])){
	$edit = $_GET['edit'];
}
?>
<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <section class="content-header">
            <h1>
                Database <small>connection</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            if($edit == 'true'){
                echo '<button type="submit" class="btn btn-success pull-left btn-sm" name="submit" form="save_db_config">Save</button>';
                echo "&nbsp";
                echo '<a href="?mod=' . $module . '&menu=' . $menu . '" class="btn btn-default btn-sm" role="button">Cancel</a>';
            }
            else{
                echo '<a href="?mod=' . $module . '&menu=' . $menu . '&edit=true" class="btn btn-warning btn-sm" role="button">Edit</a>';
            }
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">

<div class="row">
    <div class="col-md-5">
        <legend><h4>Database Parameters</h4></legend> 
        <form class="form-horizontal" id="save_db_config" method="POST" action="">
            <div class="form-group">
              <label for="inputDbHost" class="col-sm-2 control-label">db. host</label>
              <div class="col-sm-10">
                <?php
                    if($edit == 'true')
                        echo '<input type="text" class="form-control input-sm" id="db_host" name="db_host" placeholder="" value='. $db_host .'>';
                    else
                        echo '<p class="form-control-static">' . $db_host . '</p>';
                ?>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">db. user</label>
              <div class="col-sm-10">
                <?php
                    if($edit == 'true')
                        echo '<input type="text" class="form-control input-sm" id="db_user" name="db_user" placeholder="" value='.$db_user .'>';
                    else
                        echo '<p class="form-control-static">' . $db_user . '</p>';
                ?>											
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">db. passw</label>
              <div class="col-sm-10">
                <?php
                    if($edit == 'true')
                        echo '<input type="password" class="form-control input-sm" id="db_pass" name="db_pass" placeholder="" value='. $db_pass .'>';
                    else{
                        $l = strlen($db_pass);
                        $hide_pass = '';
                        for($i=0; $i<$l; $i++)
                            $hide_pass.='*';
                        echo '<p class="form-control-static">'.$hide_pass.'</p>';
                    }
                ?>	
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Database</label>
              <div class="col-sm-10">
                <?php
                    if($edit == 'true')
                        echo '<input type="text" class="form-control input-sm" id="database" name="database" placeholder="" value='.$database .'>';
                    else
                        echo '<p class="form-control-static">' . $database . '</p>';
                ?>	
              </div>
            </div>
        </form>
    </div>
    <div class="col-md-7">
        <legend><h4>Connection Status</h4></legend>
        <?php
            if($con)
            {
                echo '<div class="alert alert-success" role="alert">Success! Connection to <b>'. $database . '</b> database OK!</div>';
            }
            else{
                echo '<div class="alert alert-danger" role="alert">Warning! Connection to <b>'. $database . '</b> database fail!</div>';
            }
        ?>								
    </div>
</div>
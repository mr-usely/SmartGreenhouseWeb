<?php
$query = "SHOW TABLES;";
$result = mysqli_query($con, $query);
$static_tables = array();

while($row = mysqli_fetch_array($result)){
    array_push($static_tables, $row[0]);
}
?>
<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <section class="content-header">
            <h1>
                Static <small>tables</small>
            </h1>
        </section>
    </div>
</div>
<hr class="style-four">

<div class="spacer"></div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Table</th>
                    <th>Records</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="searchable">
                <tr>
                    <td>1</td>
                    <td>Users</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `users`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("users", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_users_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_users_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Groups</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as gr FROM `groups`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['gr'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("groups", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_group_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_group_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Modules</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `modules`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("modules", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_modules_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_modules_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Menus</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `menus`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("menus", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_menus_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_menus_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Temperature</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `temperature`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("temperature", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_temp_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_temp_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
				<tr>
                    <td>6</td>
                    <td>Humidty</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `humidity`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("humidity", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_hum_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_hum_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
				<tr>
                    <td>7</td>
                    <td>Soilmoisture</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `soilmoist`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("soilmoist", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_soil_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_soil_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
				<tr>
                    <td>8</td>
                    <td>Water Level</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `waterlevel`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("waterlevel", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_waterl_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_waterl_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Switches</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as co FROM `pin_status`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['co'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("pin_status", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_pin_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_pin_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Arduino</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as ar FROM `arduino`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['ar'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("arduino", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_ard_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_ard_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Log</td>
                    <td>
                        <?php
                            $rec_num = 0;
                            $query = "SELECT COUNT(*) as log FROM `logs`;";
                            $result = mysqli_query($con, $query);
                            $rec_num = mysqli_fetch_assoc($result);
                            $rec_num = $rec_num['log'];
                        ?>
                        <span class="label label-success"><?php echo $rec_num; ?></span>
                    </td>
                    <td>
                        <?php
                            if(in_array("logs", $static_tables)){
                                echo '<a class="btn btn-danger btn-xs" role="button" href="includes/cr_tables.php?create_log_tbl=false">Delete</a>';
                            }
                            else{
                                echo '<a class="btn btn-primary btn-xs" role="button" href="includes/cr_tables.php?create_log_tbl=true">Create</a>';
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

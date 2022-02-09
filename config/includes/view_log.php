<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <section class="content-header">
            <h1>
                Log <small>management</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            //echo '<a href="?mod=' . $module . '&menu=' . $menu . '&add_menu=true" class="btn btn-success btn-sm" role="button">Add menu</a>';
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Log</th>
            <th>Date</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody class="searchable">
        <?php
            $query = "SELECT * FROM log ORDER BY ID DESC";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['log']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['type']}</td>";
                echo "</tr>";
            }  
        ?>
    </tbody>
</table>
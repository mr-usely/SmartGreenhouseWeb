<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <section class="content-header">
            <h1>
                Group <small>management</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            echo '<a href="?mod=' . $module . '&menu=' . $menu . '&add_gr=true" class="btn btn-success btn-sm" role="button">Add Group</a>';
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Module</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody class="searchable">
        <?php
            $query = "SELECT * FROM groups";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr class='clickable-row pointer' data-href=\"?mod={$module}&menu={$menu}&edit_gr={$row['id']}\">";
                echo "<td>{$row['id']}</td>";
                $q = "SELECT name FROM modules WHERE id={$row['module']};";
                $r = mysqli_query($con, $q);
                $r = mysqli_fetch_assoc($r);
                echo "<td>{$r['name']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "</tr>";
            }  
        ?>
    </tbody>
</table>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
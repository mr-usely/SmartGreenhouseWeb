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
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            echo '<a href="?mod=' . $module . '&menu=' . $menu . '&add_mod=true" class="btn btn-success btn-sm" role="button">Add module</a>';
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Link</th>
            <th>Description</th>
            <th>Sequence</th>
            <th>Group</th>
        </tr>
    </thead>
    <tbody class="searchable">
        <?php
            $query = "SELECT * FROM modules";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr class='clickable-row pointer' data-href=\"?mod={$module}&menu={$menu}&edit_mod={$row['id']}\">";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['link']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['seq']}</td>";
                echo "<td>{$row['group']}</td>";
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
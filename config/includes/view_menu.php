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
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            echo '<a href="?mod=' . $module . '&menu=' . $menu . '&add_menu=true" class="btn btn-success btn-sm" role="button">Add menu</a>';
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Module</th>
            <th>Link</th>
            <th>Sequence</th>
            <th>Page Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="searchable">
        <?php
            $query = "SELECT * FROM menus";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr class='clickable-row pointer' data-href=\"?mod={$module}&menu={$menu}&edit_menu={$row['id']}\">";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['parent_id']}</td>";
                echo "<td>{$row['link']}</td>";
                echo "<td>{$row['seq']}</td>";
                echo "<td>{$row['page_title']} " . "{$row['page_title_sm']}</td>";
                echo '</div>';
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
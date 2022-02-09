<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <section class="content-header">
            <h1>
                Arduino <small>ip address</small>
            </h1>
        </section>
    </div>
</div>
<div class="spacer"></div>
<div class="row">
    <div class="col-md-6">
        <?php
            echo '<a href="?mod=' . $module . '&menu=' . $menu . '&add_ip=true" class="btn btn-success btn-sm" role="button">Add Ip</a>';
        ?>        
    </div>
</div><!--/row-->
<hr class="style-four">
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pin</th>
            <th>Port</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody class="searchable">
        <?php
            $query = "SELECT * FROM arduino";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr class='clickable-row pointer' data-href=\"?mod={$module}&menu={$menu}&edit_ip={$row['id']}\">";
                echo "<td>{$row['id']}</td>";
                echo "<td>". long2ip($row['ip']) ."</td>";
                echo "<td>{$row['port']}</td>";
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
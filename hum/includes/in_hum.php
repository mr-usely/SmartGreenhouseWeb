<hr class="style-four">
<div class="row">
    <div class="col-md-6 col-md-6 col-sm-6">
        <div id="g1" class="gauge float-right"></div>
    </div>
        <?php
            // GET LAST HUMIDITY
            $query = "SELECT value FROM humidity ORDER BY ID DESC LIMIT 1;";
            $result = mysqli_query($con, $query);  
            $result = mysqli_fetch_assoc($result);
            $result = $result['value'];
        ?>      
        <script>
            var humidity= 0;           
            function get_element() {
                $.post( "ajax/get_hum.php?last=true", function( data ) {
                    humidity = data;
                });
            }       
            
            function drow_graph(){
                var g1 = new JustGage({
                    id: "g1", 
                    value: <?php echo $result; ?>, 
                    min: -15,
                    max: 100,
                    title: "Live Humidity",
                    label: "%",    
                    gaugeWidthScale: 0.6          
                });
                
                setInterval(function() {
                    g1.refresh(humidity);
                    }, 2000); 
            }
            setInterval(get_element,10000); 
        </script>

    <div class="col-md-6 col-md-6 col-sm-6">
        <div class="box  box-stat">
            <div class="box-body">
                <div style="display: block;">
                    <h4><small class="pull-right"> Statistic</small></h4>
                    <table class="table table-condensed">
                        <tbody>
                          <tr>
                            <td><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span> &nbsp;Max</td>
                            <td id="max_hum"></td>
                            <td id="max_time"></td>
                          </tr>
                          <tr>
                            <td><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> &nbsp;Min</td>
                            <td id="min_hum"></td>
                            <td id="min_time"></td>
                          </tr>
                          <tr>
                            <td><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> &nbsp;Average</td>
                            <td id="ave_hum"></td>
                            <td>Today</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<hr class="style-four">

<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="btn-group pull-right" role="group" aria-label="...">
            <button type="button" class="btn btn-sm btn-default active" id="stat"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Live</button>
            <button type="button" class="btn btn-sm btn-default" id="graph"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter</button>
        </div>
    </div>
</div>

<div class="spacer"></div>
<div class="row " id="stat_table">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Live Humidity</h3>
            </div>
            <div class="box-body">
                    <?php
                        $query = "SELECT * FROM humidity ORDER BY id DESC LIMIT 10";
                        $result = mysqli_query($con, $query);  
                        
                        $number = 1;
                        echo '<table class="table table-hover table-condensed display" id="example2" cellspacing="0" width="100%">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>#</th>';
                        echo '<th>Location</th>';
                        echo '<th>Value</th>';
                        echo '<th>Date</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody id="attending_tbl">';
                        // DYNAMIC VALUES                        
                        echo '</tbody>';
                        echo '</table>';
                    ?>
                    <!--<div id="attending_tbl">Loading...</div>-->
            </div>
        </div>
    </div>
</div>


<div class="row hide" id="stat_graph">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Filter</h3>
            </div>
            <div class="box-body">
                <?php
                    $query = "SELECT * FROM humidity ORDER BY id DESC";
                    $result = mysqli_query($con, $query);  
                    
                    $number = 1;
                    echo '<table class="table table-hover table-condensed display" id="example" cellspacing="0" width="100%">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>#</th>';
                    echo '<th>Location</th>';
                    echo '<th>Value</th>';
                    echo '<th>Date</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody class="searchable">';
                    while($row = mysqli_fetch_assoc($result)):
                        echo "<tr>";
                        echo "<td>{$number}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['value']}%</td>";
                        echo "<td>{$row['date']}</td>";
                        echo "</tr>";
                        $number+=1;
                    endwhile;
                    echo '</tbody>';
                    echo '</table>';
                ?>
            </div>
        </div>
    </div>
</div>

<script>      
    function refreshData()
	{
	  $('#attending_tbl').load('ajax/one_day_hum.php');
      $('#chart').load('ajax/get_day_graph.php');
	}
    
    function get_day_stat(){
        $.ajax({
            url: 'ajax/get_day_stat.php',
            type: 'POST',
            data: {name: 'test'},
            dataType: 'html',
            success: function(data){
                //data string format
                //min,min_time,max,max_time,average
                var vals = data.split(",");
                console.log(vals[0]);
                console.log(vals[1]);
                console.log(vals[2]);
                console.log(vals[3]);
                console.log(vals[4]);
                document.getElementById("min_hum").innerHTML = vals[0]+"%";
                document.getElementById("min_time").innerHTML = vals[1];
                document.getElementById("max_hum").innerHTML = vals[2]+"%";
                document.getElementById("max_time").innerHTML = vals[3];
                document.getElementById("ave_hum").innerHTML = vals[4]+"%";
                }
        });
    }
    
    
    $(document).ready(function() {
        $('#example').DataTable( {
            "pagingType": "full_numbers"
        } );
        
        $('#example2').DataTable( {
            bFilter: false, bInfo: false,
            "paging":   false,
            "ordering": false,
            "info":     false
        });
    });

        
    
	// Execute every 5 seconds
	window.setInterval(refreshData, 60000);
    window.setInterval(get_day_stat, 1000);
    window.onload = function() {
        get_element();
        drow_graph();
        refreshData();
        get_day_stat();
    };   

    $('#graph').click(function(){
        $('#stat_graph').removeClass('hide');
        $('#stat_table').addClass('hide');
        
        $('#graph').addClass('active');
        $('#stat').removeClass('active');
    
    });
    
    $('#stat').click(function(){
        $('#stat_graph').addClass('hide');
        $('#stat_table').removeClass('hide');
        
        $('#stat').addClass('active');
        $('#graph').removeClass('active');
        
        /*
        $("#wrapper").on('transitionend webkitTransitionEnd oTransitionEnd', function () {
             myLineChart.resize(myLineChart.render, true);
        });
        */
    });
</script>












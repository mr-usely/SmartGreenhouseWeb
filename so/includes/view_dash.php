<div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <section class="content-header">
                        <h1>
                            Dashboard
                            <small>Short Statistic</small>
                        </h1>
                    </section>
                </div>
            </div>
            <hr class="style-four">
            <div class="row">            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-purple"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></span>
                <div class="info-box-content">
                  <span class="info-box-text text-muted">Tasks</span>
                  <span class="info-box-number">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></span>
                <div class="info-box-content">
                  <span class="info-box-text text-muted">Sensors</span>
                  <span class="info-box-number">2</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-orange"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></span>
                <div class="info-box-content">
                  <span class="info-box-text text-muted">Logs</span>
                  <span class="info-box-number">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span></span>
                <div class="info-box-content">
                  <span class="info-box-text text-muted">Warnings</span>
                  <span class="info-box-number">0</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
            
            
            <hr class="style-four">
            
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-6 col-sm-6">
                            <div id="g1" class="gauge float-right"></div>
                        </div>
						<?php
								// GET LAST TEMP
								$query = "SELECT value FROM soilmoist ORDER BY ID DESC LIMIT 1;";
								$result = mysqli_query($con, $query);  
								$result = mysqli_fetch_assoc($result);
								$result = $result['value'];
							?>      
							<script>
								var soil = 0;           
								function get_element() {
									$.post( "so/ajax/get_soilmo.php?last=true", function( data ) {
										soil = data;
									});
								}       
            
								function drow_graph(){
									var g1 = new JustGage({
										id: "g1", 
										value: <?php echo $result; ?>, 
										min: -15,
										max: 150,
										title: "Live Soil Moisture",
										label: "",    
										gaugeWidthScale: 0.6          
									});
                
								setInterval(function() {
									g1.refresh(soil);
								}, 2000); 
								}
								setInterval(get_element,10000); 
							</script>
                        <div class="col-md-6 col-md-6 col-sm-6">
                            <h4><small class="pull-right"> Statistic</small></h4>
							<div class="row " id="stat_table">
								<div class="box-body">
									<?php
										$query = "SELECT * FROM soilmoist ORDER BY id DESC LIMIT 2";
										$result = mysqli_query($con, $query);  
                    
										$number = 1;
										echo '<table class="table table-hover table-condensed display" id="example1">';
										echo '<thead>';
										echo '<tr>';
										echo '<th>Value</th>';
										echo '<th>Date</th>';
										echo '</tr>';
										echo '</thead>';
										echo '<tbody id="attending_tbl1">';
										while($row = mysqli_fetch_assoc($result)):
											echo "<tr>";
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
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div style="width:100%; padding-left: 20px; padding-right: 20px;">
                            <div>
                                <canvas id="canvas-line" height="75px"></canvas>
                            </div>
                        </div>

                        <script>
                            var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
                            var lineChartData = {
                                labels : ["January","February","March","April","May","June","July"],
                                datasets : [
                                    {
                                        label: "My Second dataset",
                                        fillColor : "rgba(151,187,205,0.2)",
                                        strokeColor : "rgba(151,187,205,1)",
                                        pointColor : "rgba(151,187,205,1)",
                                        pointStrokeColor : "#fff",
                                        pointHighlightFill : "#fff",
                                        pointHighlightStroke : "rgba(151,187,205,1)",
                                        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                                    },
                                ]
                    
                            }
							function drow_lineChart(){
							var ctx = document.getElementById("canvas-line").getContext("2d");
								window.myLine = new Chart(ctx).Line(lineChartData, {
									responsive: true
								});
							}
                        </script>
                    </div>
                </div>
            </div>
            <hr class="style-four">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-6 col-sm-6">
                            <div id="g2" class="gauge float-right"></div>
                        </div>
						<?php
							// GET LAST TEMP
							$query = "SELECT value FROM temperature ORDER BY ID DESC LIMIT 1;";
							$result = mysqli_query($con, $query);  
							$result = mysqli_fetch_assoc($result);
							$result = $result['value'];
							?>  
                            
                            <script>
                                var temp = 0;           
								function get_element2() {
									$.post( "mo/ajax/get_temp.php?last=true", function( data ) {
										temp = data;
									});
								}       
            
								function drow_graph2(){
									var g2 = new JustGage({
										id: "g2", 
										value: <?php echo $result; ?>, 
										min: -15,
										max: 50,
										title: "Live Temperature",
										label: "C",    
										gaugeWidthScale: 0.6          
									});
                
									setInterval(function() {
										g2.refresh(temp);
									}, 2000); 
								}
								setInterval(get_element2,10000); 
							</script>
							
                        <div class="col-md-6 col-md-6 col-sm-6">
							
										<h4><small class="pull-right"> Statistic</small></h4>
										<?php
										$query = "SELECT * FROM temperature ORDER BY id DESC LIMIT 2";
										$result = mysqli_query($con, $query);  
                    
										$number = 1;
										echo '<table class="table table-hover table-condensed display" id="example2">';
										echo '<thead>';
										echo '<tr>';
										echo '<th>Value</th>';
										echo '<th>Date</th>';
										echo '</tr>';
										echo '</thead>';
										echo '<tbody id="attending_tbl2">';
										while($row = mysqli_fetch_assoc($result)):
											echo "<tr>";
											echo "<td>{$row['value']}&deg c</td>";
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
				<div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 col-md-6 col-sm-6">
                            <div id="g3" class="gauge float-right"></div>
                        </div>
						<?php
							// GET LAST TEMP
							$query = "SELECT value FROM humidity ORDER BY ID DESC LIMIT 1;";
							$result = mysqli_query($con, $query);  
							$result = mysqli_fetch_assoc($result);
							$result = $result['value'];
							?>  
                            
                            <script>
                                var humidity = 0;           
								function get_element3() {
									$.post( "hum/ajax/get_hum.php?last=true", function( data ) {
										humidity = data;
									});
								}       
            
								function drow_graph3(){
									var g3 = new JustGage({
										id: "g3", 
										value: <?php echo $result; ?>, 
										min: -15,
										max: 100,
										title: "Live Humidity",
										label: "%",    
										gaugeWidthScale: 0.6          
									});
                
									setInterval(function() {
										g3.refresh(humidty);
									}, 2000); 
								}
								setInterval(get_element3,10000); 
							</script>
							
									<div class="col-md-6 col-md-6 col-sm-6">
										<h4><small class="pull-right"> Statistic</small></h4>
										<?php
										$query = "SELECT * FROM humidity ORDER BY id DESC LIMIT 2";
										$result = mysqli_query($con, $query);  
                    
										$number = 1;
										echo '<table class="table table-hover table-condensed display" id="example3">';
										echo '<thead>';
										echo '<tr>';
										echo '<th>Value</th>';
										echo '<th>Date</th>';
										echo '</tr>';
										echo '</thead>';
										echo '<tbody id="attending_tbl3">';
										while($row = mysqli_fetch_assoc($result)):
											echo "<tr>";
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
            </div>
            <hr class="style-four">
            <div class="row">
				<div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-lg-12 col-lg-12 col-xs-12">
                                    <!-- Table -->
									<?php
										$query = "SELECT * FROM watertime ORDER BY id DESC LIMIT 2";
										$result = mysqli_query($con, $query);
										
										$number = 1;
										echo '<table class="table">';
										echo '<thead>';
										echo '<tr>';
										echo '<th>Info</th>';
										echo '<th>Status</th>';
										echo '<th>Date</th>';
										echo '<th>Time</th>';
										echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
										while($row = mysqli_fetch_assoc($result)):
											echo "<tr>";
											echo "<td>Moisture Content</td>";
											echo "<td>";
											echo '<span class="label label-success">';
											echo "{$row['value']}%</span>";
											echo "</td>";
											echo '<td class="vert-align">';
											echo "{$row['date']}</td>";
											echo '<td class="vert-align">';
											echo "{$row['time']}</td>";
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
                </div>
            </div>    
         </div>
    <!-- /#page-content-wrapper -->
    <script>
	
	function refreshTable()
	{
	  $('#attending_tbl1').load('../../../so/ajax/one_day_soildash.php');
	  $('#attending_tbl2').load('../../../mo/ajax/one_day_tempdash.php');
	  $('#attending_tbl3').load('../../../hum/ajax/one_day_humdash.php');
	}
	
	$(document).ready(function() {
		$('#example1').DataTable( {
            bFilter: false, bInfo: false,
            "paging":   false,
            "ordering": false,
            "info":     false
        });
		
		$('#example2').DataTable( {
            bFilter: false, bInfo: false,
            "paging":   false,
            "ordering": false,
            "info":     false
        });
		
        $('#example3').DataTable( {
            bFilter: false, bInfo: false,
            "paging":   false,
            "ordering": false,
            "info":     false
        });
    });
	
	window.setInterval(refreshTable, 60000);
	window.onload = function() {         
        get_element();
		get_element2();
		get_element3();
        drow_graph();
		drow_graph2();
		drow_graph3();
		drow_barChart();
		drow_lineChart();
		refreshTable();
    };
	
	</script>
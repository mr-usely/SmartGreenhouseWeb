<button id="pin_status" class="btn btn-sm btn-primary" role="button"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refresh Status</button>
<hr class="style-four">
<div class="row">
    <div class="col-xs-12">
        <table class="table table-hover">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Manager</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    $query = "SELECT * FROM pin_status;";
                    $result = mysqli_query($con, $query);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)):
                    echo "<tr>";
                    echo "<td>{$i}</td>";
                    echo "<td>{$row['pin']}</td>";
                    echo '<td><span class="label label-success"><label id="CheckBoxValue" value="None">Approved</label></span></td>';
                    echo '<td>';
                        echo '<button id="pin_'.$row['pin'].'_on" class="btn btn-sm btn-danger '; if($row['status'] == 1) echo "hide"; echo '"role="button" onclick="onOff(this.id)"=>On Button</button>';
                        echo '<button id="pin_'.$row['pin'].'_off"class="btn btn-sm btn-success '; if($row['status'] == 0) echo "hide"; echo '"role="button" onclick="onOff(this.id)">Off Button</button>';
                    echo '</td>';
                    echo "<tr>";
                    $i+=1;
                    endwhile;
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#pin_status').click(function(){
        $.ajax({url: "ajax/update_status.php", success: function(result){
            $("#div1").html(result);
        }});
        update_status();
        change_status();
    });
    
    
    function update_status() {
        $.ajax({
            url: "ajax/update_status.php",
            type: 'POST',
            data: {refresh: 1},
            dataType: 'html',
            success: function(data){
                 console.log(data);
                },error: function (xhr, ajaxOptions, thrownError) {console.log("ERROR");}
        });
        setTimeout(
            function() {
                change_status();
            },
            1500);
    }
    
    var vals;
    
    function change_status() {
        $.ajax({
            url: "ajax/pin_status_read.php",
            type: 'POST',
            data: {refresh: 1},
            dataType: 'html',
            success: function(data){
                // WE GET DATA FROM PHP
                // DATA FORMAT: pin:status,pin:status,pin:status,
                // AFTER SPLIT FUNCTION WE GET ARRAY
                // [pin:status, pin:status,pin:status, ""]
                // ""_becouse we have last comma ','
                // TO REMOVE LAST ELEMENT MAKE 'FOR' TO array.length-1
                vals = data.split(",");
                console.log(vals);
                for(i=0; i<vals.length-1; i++){
                    // FORMAT pin_number:status
                    // example 6:1,7:0,8:1
                    temp_array = vals[i].split(':')
                    // we get temp_array[0] = PIN_NUMBER
                    // temp_array[1] = PIN_STATUS
                    var selec_off = "pin_"+temp_array[0] + "_off";
                    var selec_on = "pin_"+temp_array[0] + "_on";
                    
                    if (temp_array[1] == "1") {
                        console.log("STATUS ON");
                        $("#"+selec_off).removeClass('hide');
                        $("#"+selec_on).addClass('hide');
                    }
                    if (temp_array[1] == "0") {
                        console.log("STATUS OFF");
                        $("#"+selec_off).addClass('hide');
                        $("#"+selec_on).removeClass('hide');
                    }
                }
               
                },error: function (xhr, ajaxOptions, thrownError) {console.log("ERROR");}
        });
    }
    
    function onOff(id) {
        console.log(id);
        // id format pin_6_on
        // GET request format pin_6=on
        // split id and make get request
        temp_array = id.split('_')
        var url = "ajax/on_off.php?"+ temp_array[0] + "_" + temp_array[1] + "=" + temp_array[2];
        console.log(url);
        $.ajax({
            url: url, success: function(result){
            console.log("-----PIN "+temp_array[1] + " " + temp_array[2]);
        }});

        setTimeout(
            function() {
                //$btn.button('reset');
                update_status();
            },
            2000);
    }
    
    $("button").click(function() {
        var $btn = $(this);
        $btn.button('loading');
        // simulating a timeout
        setTimeout(function () {
            $btn.button('reset');
        }, 2000);
    });
    
    // EXAMPLE
    //$('#pin_6_on').click(function(){
    //    var $btn = $(this);
    //    $btn.button('loading');
    //    $.ajax({url: "ajax/on_off.php?pin_6=on", success: function(result){
    //        console.log("-----PIN 6 ON!")
    //    }});
    //    setTimeout(
    //        function() {
    //            $btn.button('reset');
    //            update_status();
    //        },
    //        2000);
    //});
    //$('#pin_6_off').click(function(){
    //    var $btn = $(this);
    //    $btn.button('loading');
    //    $.ajax({url: "ajax/on_off.php?pin_6=off", success: function(result){
    //        console.log("-----PIN 6 OFF!")
    //    }});
    //    setTimeout(
    //        function() {
    //            $btn.button('reset');
    //            update_status();
    //        },
    //        2000);
    //    
    //});
    $(document).ready(function(){
        update_status();
        change_status();
    });
    
    function onLoad() {
        update_status();
        change_status();
    }
    
    window.onload = onLoad();
    
</script>

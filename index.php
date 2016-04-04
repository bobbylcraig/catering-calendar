<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Catering Pick-Up</title>
<meta name="author" content="Denison Enterprises"/>
<meta name="Description" content="Get food."/>
<link href="style.css" rel="stylesheet"/>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<?php
    include("includes/connection.php");
?>

<!--link rel="shortcut icon" href="favicon.ico"/-->

</head>

<!-- PAGE DESIGN -->

<body>

<div id="headerMine">
<h1>Catering Pick-Up</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="formMine">
                <h1>Sign-Up:</h1><br>
                <form class="form-horizontal" name="insertForm" action="insertAttendee.php" method="get">
                    <div class="form-group">
                        <label for="inputFName" class="col-md-4 control-label">First Name</label>
                        <div class="col-lg-8">
                            <input name="first_name" type="text" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLName" class="col-md-4 control-label">Last Name</label>
                        <div class="col-lg-8">
                            <input name="second_name" type="text" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDnum" class="col-md-4 control-label">D Number</label>
                        <div class="col-lg-8">
                            <input name="d_num" type="text" class="form-control" id="inputText" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFName" class="col-lg-4 control-label">Event</label>
                        <div class="col-lg-8">
                            <select name="event" class="form-control" id="sel1" required>
                            <?php
                                $sql_statement3 = "SELECT event_id, food_type, attendance, date, end_time FROM event ORDER BY DATE(date)";
                                
                                $sth3 = $connect->prepare($sql_statement3);
                                $sth3->execute();
                                $sth3->bind_result($event_id, $food_type, $attendance, $date, $start_time);
                                $sth3->store_result();
                                
                                while ($sth3->fetch()) {
                                    if ( strtotime( "now" ) <= strtotime($date) ) {
                                        $newDate = date("F j", strtotime($date));
                                        $result = $connect->query("SELECT COUNT(*) FROM attendee WHERE $event_id = event_id");
                                        $row = $result->fetch_row();
                                        $count = $row[0];
                                        if ( $count < $attendance ) {
                                            echo "<option value=\"$event_id\">$food_type on $newDate";
                                        }
                                    }
                                }
                                $sth3->close();
                            ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-10">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div id="formMine2">
                <h1>Catering Schedule:</h1>
                <hr>
                <ul class="no-bullets">
                    <?php
                        $sql_statement = "SELECT event_id, food_type, attendance, date, end_time FROM event ORDER BY DATE(date)";
                        
                        $sth = $connect->prepare($sql_statement);
                        $sth->execute();
						$sth->bind_result($event_id, $food_type, $attendance, $date, $start_time);
                        $sth->store_result();
                        
                        while ($sth->fetch()) {
                            if ( strtotime( "now" ) <= strtotime($date) ) {
                                $newDate = date("l, F j", strtotime($date));
                                $newTime = date("h:i A", strtotime($start_time));
                                echo "<li><h3>$food_type</h3><h4 style=\"color:gray\">$newDate at $newTime</li></h4>";
                                echo    "<ul style=\"padding-left: 50px;\">";
                                $result = $connect->query("SELECT COUNT(*) FROM attendee WHERE $event_id = event_id and confirmed = \"1\"");
                                $row = $result->fetch_row();
                                $count = $row[0];
                                for ($x = $count; $x > 0; $x--) {
                                    echo "<li style=\"color: red;\">Spot Taken</li>";
                                }
                                for ($y = $attendance - $count; $y > 0; $y--) {
                                    echo "<li>Vacant Spot</li>";;
                                }
                                echo    "</ul>";
                                echo "<hr>";
                            }
                        }
                        
                        $sth->close();
                        $connect->close();
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>
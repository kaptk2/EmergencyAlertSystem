<?php
/*
 * reports.php
 *
 * This file allows is the front end for csv file managment. It allows
 * for a GUI to upload and remove CSV files from the Alert system.
 *
 * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
 */
require "config.php";

  function tail_log ($num_lines, $file) {
    $num_lines = preg_replace('/\D/', '', $num_lines); // Must be a number
    $log_array = array();

    $log_lines = explode("\n", `tail -$num_lines $file`);
    $log_lines = array_filter($log_lines);

    foreach($log_lines as $line) {
      array_push($log_array, str_getcsv($line));
    }
    return array_reverse($log_array);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Emergency Alert System</title>

    <!-- Bootstrap and Theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/custom.css"


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Emergency Text Alert</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="list.php">List Maintenance</a></li>
            <li class="active"><a href="reports.php">Reports</a></li>
            <li><a href="https://github.com/kaptk2/EmergencyAlertSystem/wiki" target="_blank">Help</a></li>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="panel panel-default table-responsive">
        <div class="panel-heading">
          <h3 class="panel-title">Events</h3>
        </div>
        <div class="panel-body">
          <p>View last: <input id="events" type="text" size="3" value="10" disabled> events.
          <span class="pull-right"><a href="<?php echo $config['log_file']; ?>">Download log as spreadsheet</a></span>
          </p>
        </div>
        <!-- Table -->
        <table class="table table-striped table-condensed">
          <thead>
            <tr>
              <th>Date</th>
              <th>Status</th>
              <th>Name</th>
              <th>Number</th>
              <th>Addtional Info</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $log = tail_log(10, $config['log_file']);

              foreach ($log as $entry) {
                if(isset($entry[4])) {
                  $info = $entry[4];
                } else {
                  $info = "";
                }
                echo '<tr>
                   <td>'.date('Y-m-d H:i:s', $entry[0]).'</td>
                   <td>'.$entry[1].'</td>
                   <td>'.$entry[2].'</td>
                   <td>'.$entry[3].'</td>
                   <td>'.$info.'</td>
                </tr>';
              }
            ?>
          </tbody>
        </table>
      </div><!-- /panel -->
    </div> <!-- /container -->

    <!-- jQuery and Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>

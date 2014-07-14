<?php
/*
 * list.php
 *
 * This file allows is the front end for csv file managment. It allows
 * for a GUI to upload and remove CSV files from the Alert system.
 *
 * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
 */
require "config.php";
require "helper.php";

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
            <li class="active"><a href="list.php">List Maintenance</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="https://github.com/kaptk2/EmergencyAlertSystem/wiki" target="_blank">Help</a></li>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Upload new lists of numbers to send -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Upload New List</h3>
        </div>
        <div class="panel-body">
          <form class="form-inline" role="form" method="post" action="list_management.php"  enctype="multipart/form-data">
            <div class="form-group">
              <label class="sr-only" for="inputFile">File input</label>
              <input type="file" class="form-control" name="csv" id="inputFile">
              <button type="submit" class="btn btn-primary">Upload new file</button>
              <p class="help-block">Only upload CSV or TXT files. <a href="https://github.com/kaptk2/EmergencyAlertSystem/wiki/CSV-File-format" target="_blank">View file format</a></p>
            </div>
          </form>
        </div>
      </div><!-- /upload panel -->
      <div class="panel panel-default table-responsive">
        <div class="panel-heading">Current Lists</div>
        <table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>List Name</th>
              <th>Members</th>
              <th class="text-center">Remove</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $upload = $config['upload_dir'];
              $files =  get_files($upload);
              foreach ($files as $file) {
                echo
                '<tr>
                  <td>'.$file.'</td>
                  <td>'.count_members($file).'</td>
                  <td class="text-center">
                    <a href="list_management.php?remove='.$file.'" class="text-danger">
                      <span class="glyphicon glyphicon-remove-circle"></span>
                    </a>
                  </td>
                </tr>';
              }
            ?>
          </tbody>
        </table>
      </div><!-- /panel csv file listing -->
    </div> <!-- /container -->

    <!-- jQuery and Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript
    <script src="/assets/js/custom.js"></script>-->
  </body>
</html>

<?php
/*
 * index.php
 *
 * This file is the front-end to send an emergency text alert out to
 * the phone numbers loaded into the database.
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="list.php">List Maintenance</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="https://github.com/kaptk2/EmergencyAlertSystem/wiki" target="_blank">Help</a></li>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main form for sending out emergency text alerts-->
      <form role="form" method="post" action="alert.php">
        <div class="form-group">
          <label for="recipients">Recipients</label>
          <p class="help-block">Hold <em>ctrl</em> to select mutiple lists</p>

          <select multiple class="form-control" name="recipients[]" id="recipients" required>
            <?php
              $upload = $config['upload_dir'];
              $files =  get_files($upload);
              foreach ($files as $file) {
                echo '<option value="'.$upload.$file.'">'.$file.'</option>';
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="message">Emergency Message</label>
          <p class="help-block" id="feedback">Maximum of 140 characters</p>
          <textarea id="message" name="message" class="form-control" rows="3" maxlength="140" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Alert</button>
      </form>

    </div> <!-- /container -->

    <!-- jQuery and Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="./assets/js/alert.js"></script>
  </body>
</html>

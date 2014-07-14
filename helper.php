<?php
/*
 * helper.php
 *
 * This file provides helper functions to the common across
 * the application.
 *
 * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
 */

  function get_files($directory) {
    $scanned_directory = array_diff(scandir($directory), array('..', '.','.gitignore'));
    return $scanned_directory;
  }

  function count_members($csv_file) {
    require "config.php";
    $file_path = $config['upload_dir'].$csv_file;
    $num_members = count(file($file_path)) - 1;
    return $num_members;
  }

  function log_status($line, $log_file) {
    $fp = fopen($log_file, 'a');

    if (!fputcsv($fp, $line))
    {
      fclose($fp);
      die("Unable to write to log file, aborting");
    }
    fclose($fp);
    return True;
  }
?>

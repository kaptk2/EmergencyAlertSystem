<?php
/*
 * list_management.php
 *
 * This file manipulates the CSV files on disk. It allows for the upload
 * of new files as well as the removal of obsolete ones.
 *
 * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
 */

  require "config.php";
  require "helper.php";

  function remove_csv($file_path) {
    return (unlink($file_path));
  }

  // Set the upload directory
  $upload_dir = $config['upload_dir'];

  if (isset($_GET['remove'])) {
    $file = $_GET['remove'];
    $full_path = $upload_dir.$file;

    if (in_array($file, get_files($upload_dir))) {
      // Make sure the file is in the upload directory
      if (remove_csv($full_path))
        header('Location: list.php');
      else
        die('There was an error deleting the file, please contact support@rocky.edu');
    }

  }

  if ($_FILES) {
    // Quick and dirty file upload FIXME
    $file_name = $_FILES["csv"]["name"];
    $file_name =preg_replace('/[^\da-z.]/i', '', $file_name);

    if (file_exists($upload_dir.$_FILES["csv"]["name"])) {
      // Make sure that file doesn't exist
      die($_FILES["csv"]["name"]." already exists. Please go back and try again");
    }
      move_uploaded_file($_FILES["csv"]["tmp_name"], $upload_dir.$file_name);
      header('Location: list.php');
  }
?>

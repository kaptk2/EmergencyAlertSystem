<?php
  /*
  * alert.php
  *
  * This file does the heavy lifting. It uses the Twilio API to send
  * out messages to a listing of phone numbers. It splits the numbers
  * as evenly as possible between the available Twilio accounts for max
  * message delivery speed.
  *
  * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
  */
  require "vendor/autoload.php";
  require "config.php";
  require "helper.php";

  function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function send_message($file_location, $msg) {
    global $config;
    $error = False;
    $log_file = $config['log_file'];

    $AccountSid = $config['twilio']['accountSid'];
    $AuthToken  = $config['twilio']['authToken'];

    $client = new Services_Twilio($AccountSid, $AuthToken);
    $twilio_numbers = $config['twilio']['twilioNumbers'];

    if (($fp = fopen($file_location, "r")) !== FALSE) {
      $i = 0;

      $header_row = fgetcsv($fp); // Throw away the header row
      while (($data = fgetcsv($fp)) !== FALSE) {
        $error = False;

        if($i > (count($twilio_numbers) - 1)) { $i = 0; }

        try {
          $sms = $client->account->messages->sendMessage(
            $twilio_numbers[$i],
            $data[1], // Phone number to send to from CSV
            $msg
          );
        } catch (Services_Twilio_RestException $e) {
          $error_msg = $e->getMessage();
          $msg = array(time(), 'Failed', $data[0], $data[1], $error_msg);
          log_status($msg, $log_file);
          $error = True;
        }

        if ($error == False) {
          $msg = array(time(), 'Success', $data[0], $data[1]);
          log_status($msg, $log_file);
        }
        $i++;
      }
      fclose($fp);
    }
  }

  if ($_POST) {
    $message = check_input($_POST["message"]);
    $lists = $_POST["recipients"];

    if (strlen($message) > 140) { // Message to long, die
      die("Message is too long, please try again");
    }
    foreach ($lists as $item)
    {
      send_message($item, $message);
    }
  }
  header('Location: reports.php');
?>

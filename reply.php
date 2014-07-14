<?php
/*
 * reply.php
 *
 * This file provides helper functions to the common across
 * the application.
 *
 * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
 */
  require "config.php";
  require "helper.php";

  $log_file = $config['log_file'];

  if(isset($_REQUEST)) {
    $msg = array(time(), 'Reply', $_REQUEST['To'], $_REQUEST['From'], $_REQUEST['Body']);
    log_status($msg, $log_file);
  }

  // Reply with XML
  header("content-type: text/xml");
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message><?php echo $config['reply_message']; ?></Message>
</Response>

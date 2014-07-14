<?php
/*
 * config.php
 *
 * Edit this file to include all your Twilio numbers and settings.
 *
 * Copyright 2014 Andrew Niemantsverdriet <andrew@rimrockhosting.com>
 */
date_default_timezone_set("America/Denver");

  $config = array(
    "twilio" => array(
      "accountSid"    => "YOUR_ACCOUNT_SID",
      "authToken"     => "YOUR_AUTH_TOKEN",
      "twilioNumbers" => array(
                            "1111111111",
                            "2222222222",
                            "3333333333",
                            "4444444444",
                            "5555555555",
                      )
      ),
      "upload_dir" => "./upload/",
      "log_file" => "./log/log.csv",
      "reply_message" => "Thank you for your message"
  );
?>

<?php
  
  function check_ping($ip) {
    $pingresult = exec("/bin/ping -n 3 $ip", $outcome, $status);
    if (0 == $status) {
        $status = "alive";
    } else {
        $status = "dead";
    }
    return "The IP address, $ip, is  ".$status;
}

  function operate($param1, $param2, $operation) {

    if ($operation == "plus") {
      return $param1 . " plus " . $param2 . " is " . ($param1 + $param2) . ".";
    }

    if ($operation == "minus") {
      return $param1 . " minus " . $param2 . " is " . ($param1 - $param2) . ".";
    }

    if ($operation == "times") {
      return $param1 . " times " . $param2 . " is " . ($param1 * $param2) . ".";
    }

    if ($operation == "divided by") {
      return $param1 . " divided by " . $param2 . " is " . ($param1 / $param2) . ".";
    }

    return "Unknown operation.";
  }

  $json = file_get_contents('php://input');

  $input = json_decode($json, true);
  $parameters = $input["result"]["parameters"];

  $ip = $parameters["any"];
  
  $outString = check_ping($ip);


  header("Content-type: application/json");

  $out = array(
    "speech" => $outString,
    "displayText" => $outString,
    "source" => "JaanusTestBot"
  );

  echo(json_encode($out));
?>

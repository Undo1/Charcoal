<?php
  //magic goes here
  include "context.php";
  
  $query = mysql_query("SELECT Count(*) AS number, FROM flags WHERE handled=0 ORDER BY LENGTH(`Text`)");
  $row = mysql_fetch_assoc($query);
  $number = $row["number"];
  $done = 0;
  while ($number - $done > 0)
  {
    $done = 100 + $done;
    $getflags = mysql_query("SELECT `Id`, `site` FROM flags WHERE handled=0 ORDER BY LENGTH(`Text`) LIMIT 100");
    $flagid = mysql_fetch_assoc($getflags);
    $url = 'https://api.stackexchange.com/2.1/posts/' . $flagid["Id"] . '/comments';
    $data = array("site" => $flagid["site"], "filter" => "!SrhZo6aE2O(w*j4-4i", "order" => "asc", key => "mmpZxopkL*psP5WoBK6BuA((");
    $response = (new Curl)->exec($url . '?' . http_build_query($data), [CURLOPT_ENCODING => 'gzip']);
  }
  

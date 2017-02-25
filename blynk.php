<?php

//   // blynkでLEDをつける
  $blynk = curl_init();
  curl_setopt($blynk, CURLOPT_URL, "https://blynk-cloud.com/753525ca17b54e83add9df0c635266c6/update/D0?value=1");
  curl_setopt($blynk, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($blynk, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($blynk, CURLOPT_HEADER, FALSE);

  $response = curl_exec($blynk);
  curl_close($blynk);

    // $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL, "http://blynk-cloud.com/753525ca17b54e83add9df0c635266c6/update/D0");
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // curl_setopt($ch, CURLOPT_HEADER, FALSE);

    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    // curl_setopt($ch, CURLOPT_POSTFIELDS, "[
    // \"1\"
    // ]");

    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    // "Content-Type: application/json"
    // ));

    // $response = curl_exec($ch);
    // curl_close($ch);

    var_dump($response);
?>

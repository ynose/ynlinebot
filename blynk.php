<?php
//header('Location: https://blynk-cloud.com/753525ca17b54e83add9df0c635266c6/update/D0?value=1');
//exit;

//   // blynkでLEDをつける
  $blynk = curl_init();
  curl_setopt($blynk, CURLOPT_URL, 'https://blynk-cloud.com/753525ca17b54e83add9df0c635266c6/update/D0?value=1');
//  curl_setopt($blynk, CURLOPT_URL, "http://blynk-cloud.com/753525ca17b54e83add9df0c635266c6/update/D0?value=1 -H 'Host: blynk-cloud.com' -H 'User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko' -H 'Accept: text/html, application/xhtml+xml, */*' -H 'Accept-Language: ja-JP' --compressed -H 'Connection: keep-alive' -H 'If-Modified-Since: Sun, 28 Feb 2016 11:54:45 GMT' -H 'Cache-Control: no-cache'");
//  curl_setopt($blynk, CURLOPT_URL, 'http://cloud.blynk.cc:8080/753525ca17b54e83add9df0c635266c6/update/D0?value=1');
//  curl_setopt($blynk, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
  curl_setopt($blynk, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($blynk, CURLOPT_VERBOSE, TRUE);
  curl_setopt($blynk, CURLOPT_FOLLOWLOCATION, TRUE);
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

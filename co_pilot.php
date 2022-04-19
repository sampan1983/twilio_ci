<?php $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://countriesnow.space/api/v0.1/countries/flag/images');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
print_r($result);
?>
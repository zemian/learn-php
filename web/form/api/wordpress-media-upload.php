<?php
/*
 * See https://stackoverflow.com/questions/37432114/wp-rest-api-upload-image
 *
 * NOTE: You would need to setup WordPress with Basic Auth first.
 * See https://github.com/WP-API/Basic-Auth
 *
 * Curl example:
curl --request POST \
--url http://www.yoursite.com/wp-json/wp/v2/media \
--header "cache-control: no-cache" \
--header "content-disposition: attachment; filename=tmp" \
--header "authorization: Basic d29yZHByZXNzOndvcmRwcmVzcw==" \
--header "content-type: image/png" \
--data-binary "@/home/web/tmp.png" \
--location
 */

// This PHP curl example is from SO above:
$curl = curl_init();

$data = file_get_contents('C:\test.png');

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://woo.dev/wp-json/wp/v2/media",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic XxxxxxxXxxxxXx=",
        "cache-control: no-cache",
        "content-disposition: attachment; filename=test.png",
        "content-type: image/png",
    ),
    CURLOPT_POSTFIELDS => $data,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

<?php


function picwish($img)
{

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://techhk.aoscdn.com/api/tasks/visual/segmentation');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "X-API-KEY:". PICWISH_API_KEY,
      "Content-Type: multipart/form-data",
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, array('sync' => 1, 'image_file' => new CURLFILE($img)));
$response = curl_exec($curl);
$result = curl_errno($curl) ? curl_error($curl) : $response;
curl_close($curl);
$json=json_decode($response);
// Check if the operation was successful
 if ($json && isset($json->data->image)) {
            echo '<center><img height="50%" width="50%" class="img-responsive" src="' . $json->data->image . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in PicWish API response';
        }

}

function photoroom($img)
{
     
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://sdk.photoroom.com/v1/segment');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "x-api-key:". PHOTOROOM_API_KEY,
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, array('image_file' => new CURLFILE($img)));
$response = curl_exec($curl);
$result = curl_errno($curl) ? curl_error($curl) : $response;
curl_close($curl);

   // Check if the operation was successful
        if (isset($response)) {
            echo '<center><img height="50%" width="50%"class="img-responsive" src="data:image/jpeg;base64,' . base64_encode($response) . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in Photoroom API response';
        }



}


function imagga($img)
{
$api_credentials = array(
    'key' => IMAGGA_API_KEY,
    'secret' => IMAGGA_API_secret
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.imagga.com/v2/remove-background");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, 1);
$fields = [
    'image' => new \CurlFile($img, 'image/jpeg', 'image.jpg')
];
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

$response = curl_exec($ch);
curl_close($ch);

 // Check if the operation was successful
        if (isset($response)) {
            echo '<center><img height="50%" width="50%"class="img-responsive" src="data:image/jpeg;base64,' . base64_encode($response) . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in IMAGGA API response';
        }

}



function clipdrop($img)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://clipdrop-api.co/remove-background/v1');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "x-api-key: ". CLIPDROP_API_KEY,
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, array('image_file' => new CURLFILE($img)));
$response = curl_exec($curl);
$result = curl_errno($curl) ? curl_error($curl) : $response;
curl_close($curl);

 // Check if the operation was successful
        if (isset($response)) {
            echo '<center><img height="50%" width="50%"class="img-responsive" src="data:image/jpeg;base64,' . base64_encode($response) . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in clipdrop API response';
        }
}

function slazzer($img)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.slazzer.com/v2.0/remove_image_background');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "API-KEY: ".SLAZZER_API_KEY,
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, array('source_image_file' => new CURLFILE($img)));
$response = curl_exec($curl);
curl_close($curl);

// Check if the operation was successful
        if (isset($response)) {
            echo '<center><img height="50%" width="50%"class="img-responsive" src="data:image/jpeg;base64,' . base64_encode($response) . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in Slazzer API response';
        }
}


function clippingmagic($img)
{
$ch = curl_init('https://clippingmagic.com/api/v1/images');

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER,
    array('Authorization: Basic '. CLIPPINGMAGIC_API_KEY));
curl_setopt($ch, CURLOPT_POSTFIELDS,
    array(
      'image' => curl_file_create($img),
      'format' => 'result',
      'test' => 'true' // TODO: Remove for production
      // TODO: Add more upload options here
    ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Parse the headers to get the image id & secret
$headers = [];
curl_setopt($ch, CURLOPT_HEADERFUNCTION,
  function($curl, $header) use (&$headers) {
    $len = strlen($header);
    $header = explode(':', $header, 2);
    if (count($header) < 2) // ignore invalid headers
      return $len;
    $headers[strtolower(trim($header[0]))][] = trim($header[1]);
    return $len;
  });

$response = curl_exec($ch);

// Check if the operation was successful
        if (isset($response)) {
            echo '<center><img height="50%" width="50%"class="img-responsive" src="data:image/jpeg;base64,' . base64_encode($response) . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in clippingmagic API response';
        }

curl_close($ch);
}


function removebg($img){
$img=Imgurl.$img;
//CURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
'x-api-key:'. REMOVEBG_API_KEY,
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, [
'image_url' => $img,
]);

$response = curl_exec($ch);
curl_close($ch);

// Check if the operation was successful
        if (isset($response)) {
            echo '<center><img height="50%" width="50%"class="img-responsive" src="data:image/jpeg;base64,' . base64_encode($response) . '" width="400" height="400"/></center>';
        } else {
            echo 'Error in clippingmagic API response';
        }



}
?>



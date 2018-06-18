<?php
//TITLE: playlist.php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');

list($dir, $shuf) = split('[/.-]', $_GET['var1']);

if($dir != '')
     { $dir = $dir . '/';
     }
else
     { $dir = 'mp3/';
     }

if(empty($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
}

// Strip off query string so dirname() doesn't get confused
$url = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
$url = 'http://'.$_SERVER['HTTP_HOST'].'/'.ltrim(dirname($url), '/'). '/' . $dir;

$n = 0;
$playlist = array();
$fdir = opendir($dir);
while($i = readdir($fdir)) {
   // if a .mp3 string is found, add the file to the array
   if (strpos(strtolower($i),".mp3") !== false){
  	   $playlist[$n] = $i;
       $n++;
      }
}

if($shuf =='yes')
     { shuffle($playlist);
     }
else
     { array_multisort($playlist);
     }

closedir($fdir);

header("Content-type: text/xml; charset='UTF-8'");
$xml_output = "<?xml version='1.0' encoding='UTF-8'?>\n";
// echoing the playlist to flash
$xml_output .="<xml>\n";
for ($i=0, $j=1; $i<sizeof($playlist), $j<sizeof($playlist)+1; $i++, $j++) {
  $title = str_replace(".mp3","",$playlist[$i]);
  $title = str_replace("_", " ", $title);
            $playlist[$i]=rawurlencode($playlist[$i]);
$xml_output .= "<track>\n<path>$url{$playlist[$i]}</path>\n<title>$j) $title</title>\n</track>";
}
$xml_output .= "</xml>";
echo $xml_output;
?>
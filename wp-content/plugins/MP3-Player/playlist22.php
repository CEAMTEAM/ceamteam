<?php
//TITLE: playlist22.php

if($_GET['folder'] != '')
     { $dir = $_GET['folder'] . '/';
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

function curPageURL() {
 if(empty($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
}

// Strip off query string so dirname() doesn't get confused
$url = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
$url = 'http://'.$_SERVER['HTTP_HOST'].'/'.ltrim(dirname($url), '/').'';
 return $url;
}


$url2 = curPageURL();
$email = $_GET["eml"];
$name = $_GET["blgnme"];
$decrp = $_GET["dircrip"];
$n = 0;
$playlist = array();
$fdir = opendir($dir);
while($i = readdir($fdir)) {
   // if a .mp3 string is found, add the file to the array
   if (strpos(strtolower($i),".mp3") !== false){
  	   $playlist[$n] = $i;
           urlencode($playlist[$n]); // = str_replace("'", "%27", $playlist[$n]);
           $n++;
       }
}

//sort($playlist);
//shuffle($playlist);
//array_multisort($playlist);

$ttl = 1440;
$music_rss = "$url2/playlist22.php";
header('Content-type: application/xml');
$rss_output = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>\n";
$rss_output .= "<rss xmlns:atom='http://www.w3.org/2005/Atom/' version='2.0'>\n";
$rss_output .= "<channel>\n\n";
$rss_output .= "<atom:link href='$music_rss' rel='self' type='application/rss+xml' />\n";
$rss_output .= "<title>$name</title>\n";
$rss_output .= "<description>$decrp</description>\n";
$rss_output .= "<link>$url2</link>\n";
$rss_output .= "<language>en-us</language>\n";
$rss_output .= "<ttl>$ttl</ttl>\n";

if ($n < 10)
  { 
for ($j=$n-1; $j>=0; $j--) {
   $title = str_replace(".mp3","", $playlist[$j]);
   $title = str_replace("_", " ", $title);
   $title = str_replace("%27", "'", $title);
   $other = str_replace(" ", "%20", $playlist[$j]);
   $files = "$dir{$playlist[$j]}";
   $filetime = filectime($files);
   $size = filesize($files);
    $rss_output .= "\n<item>\n\n";
    $rss_output .= "<title>$title</title>\n";
    $rss_output .= "<link>$url{$other}</link>\n";  
    $rss_output .= "<pubDate>" . date ("r", $filetime); 
    $rss_output .= "</pubDate>\n";
    $rss_output .= "<enclosure url='$url{$other}' type='audio/mpeg' length='$size' />\n";
    $rss_output .= "<guid>$url{$other}</guid>\n";  
    $rss_output .= "<author>$email</author>\n";
    $rss_output .= "</item>\n";
  }
}
else{
for ($j=$n-1; $j>$n-11; $j--) {
   $title = str_replace(".mp3","", $playlist[$j]);
   $title = str_replace("_", " ", $title);
   $title = str_replace("%27", "'", $title);
   $other = str_replace(" ", "%20", $playlist[$j]);
   $files = "$dir{$playlist[$j]}";
   $filetime = filectime($files);
   $size = filesize($files);
    $rss_output .= "\n<item>\n\n";
    $rss_output .= "<title>$title</title>\n";
    $rss_output .= "<link>$url{$other}</link>\n";  
    $rss_output .= "<pubDate>" . date ("r", $filetime); 
    $rss_output .= "</pubDate>\n";
    $rss_output .= "<enclosure url='$url{$other}' type='audio/mpeg' length='$size' />\n";
    $rss_output .= "<guid>$url{$other}</guid>\n";  
    $rss_output .= "<author>$email</author>\n";
    $rss_output .= "</item>\n";
  }
}
$rss_output .= "</channel>\n</rss>\n";
echo $rss_output;
closedir($fdir);

?>
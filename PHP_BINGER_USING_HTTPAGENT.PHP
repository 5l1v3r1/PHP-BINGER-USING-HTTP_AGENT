<html><head><style>
body{cursor:url("http:///foro.elhacker.net/elhacker.cur"),auto;}html{display:table;height:100%;width:100%;}body{display:table-row;}body{display:table-cell;vertical-align:middle;text-align:center;}a:link{text-decoration:none;}
body {
	  background-color: #423e3f;
	background-image: url(http://www.theunitive.com/wp-content/uploads/2014/07/who-am-i-1024x575.gif);
<!--http://www.theunitive.com/wp-content/uploads/2014/07/who-am-i-1024x575.gif-->
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-position:right top;
	background-repeat:no-repeat;
	background-size:110%
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</title>SparkyDz<title>
</style>
</head>
./Coded By SparkyDz
<form method="post">
Bing Dork: <input type="text" name="dork" placeholder="dork" required>
<input type="submit" name="go" value=">>">
</form>
<?php
function getsource($url, $proxy) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if($proxy) {
        $proxy = explode(':', autoprox());
        curl_setopt($curl, CURLOPT_PROXY, $proxy[0]);
        curl_setopt($curl, CURLOPT_PROXYPORT, $proxy[1]);
    }
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}
$dork = htmlspecialchars($_POST['dork']);
$do = urlencode($dork);
if(isset($_POST['go'])) {
	$npage = 1;
	$npages = 30000;
	$allLinks = array();
	$lll = array();
	while($npage <= $npages) {
	    $x = getsource("http://www.bing.com/search?q=".$do."&first=".$npage."", $proxy);
	    if($x) {
	        preg_match_all('#<h2><a href="(.*?)" h="ID#', $x, $findlink);
	        foreach ($findlink[1] as $fl) array_push($allLinks, $fl);
	        $npage = $npage + 10;
	        if (preg_match("(first=" . $npage . "&amp)siU", $x, $linksuiv) == 0) break;
	    } else break;
	}
	$URLs = array();
	foreach($allLinks as $url){
	    $exp = explode("/", $url);
	    $URLs[] = $exp[2];
	}
	$array = array_filter($URLs);
	$array = array_unique($array);
	$sss = count(array_unique($array));
	echo "ToTaL SiTe : $sss<br>";
	foreach($array as $domain) {
		echo "http://$domain/<br>";
	}
}
?>
</html>
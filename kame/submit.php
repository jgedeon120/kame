<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <title>Kamehameha</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Home</a>
		  <a class="navbar-brand" href="results.php">Results</a>
        </div>
        <div class="navbar-collapse collapse">
        </div><!--/.navbar-collapse -->
      </div>
    </div>


    <div class="jumbotron">
      <div class="container">
		
        <?php
		if(!empty($_POST["domain"]))
		{
			#Vars
			$input = $_POST["domain"]; 
			$input = str_replace("http://","",$input);
			$input = str_replace("https://","",$input);
			$useragent = $_POST["UserAgent"]; 
			$time=time();
			$thedate = date("Y-m-d");
			if(!empty($_POST["reader"])){$reader = "-A ".$_POST["reader"];} else {$reader="-A 9.1.0";}
			if(!empty($_POST["flash"])){$flash = "-S ".$_POST["flash"]; } else {$flash="-S 10.0.64.0";}
			if(!empty($_POST["java"])){$java = "-J ".$_POST["java"]; } else {$java="-J 1.6.0.32";}
			
			#IP Data
			$parsed_url = parse_url("http://".$input);
			$host = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
			$ip = isset($host) ? gethostbyname($host) : '';
			$ch = curl_init(); 
			$geoip = "freegeoip.net/json/".$host;
			curl_setopt($ch, CURLOPT_URL, $geoip); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$geooutput = curl_exec($ch); 
			$json_a=json_decode($geooutput,true);
			$country = $json_a['country_name'];
			$countrycode = strtolower($json_a['country_code']);
			curl_close($ch);   
			
			#Initiate Mongo
			$mongo = new Mongo();
			$db = $mongo->selectDB('table');
			$sites = $db->sites;
			$link = "<a href='report.php?id=".$time."' target='_blank'>".$input."</a>";
			$dlink = "<a href='reports/".$time."/package.zip'>Download</a>";

			#Execute Thug CMD
			$com = "python /opt/thug/src/thug.py -n /var/www/thuggin/reports/".$time."/ -u ".$useragent." -t 90 ".$reader." ".$flash." ".$java." ".$input;
			$command = escapeshellcmd($com);
			$output = shell_exec($command);
			
			#Zip Up the Aquire Files
			$zipcmd = "zip -P infected -r /var/www/thuggin/reports/".$time."/package reports/".$time;
			$command = escapeshellcmd($zipcmd);
			$output = shell_exec($zipcmd);
			
			#Fix Inputs
			$reader = str_replace("-A","",$reader);
			$java = str_replace("-J","",$java);
			$flash = str_replace("-S","",$flash);
			
			$tracking = "id".$time;
			
			#Convert UA
			$useragent = str_replace("winxpie61","Internet Explorer 6.1(Windows XP)",$useragent);
			$useragent = str_replace("winxpie70","Internet Explorer 7.0(Windows XP)",$useragent);
			$useragent = str_replace("winxpie80","Internet Explorer 8.0(Windows XP)",$useragent);
			$useragent = str_replace("winxpchrome20","Chrome 20.0.1132.47(Windows XP)",$useragent);
			$useragent = str_replace("winxpfirefox12","Firefox 12.0(Windows XP)",$useragent);
			$useragent = str_replace("winxpsafari5","Safari 5.1.7(Windows XP)",$useragent);
			$useragent = str_replace("win2kie60","Internet Explorer 6.0(Windows 2000)",$useragent);
			$useragent = str_replace("win2kie80","Internet Explorer 8.0(Windows 2000)",$useragent);
			$useragent = str_replace("win7ie80","Internet Explorer 8.0(Windows 7)",$useragent);
			$useragent = str_replace("win7ie90","Internet Explorer 9.0(Windows 7)",$useragent);
			$useragent = str_replace("win7chrome20","Chrome 20.0.1132.47(Windows 7)",$useragent);
			$useragent = str_replace("win7firefox3","Firefox 3.6.13(Windows 7)",$useragent);
			$useragent = str_replace("win7safari5","Safari 5.1.7(Windows 7)",$useragent);
			$useragent = str_replace("osx10safari5","Safari 5.1.1(MacOS X 10.7.2)",$useragent);
			$useragent = str_replace("osx10chrome19","Chrome 19.0.1084.54(MacOS X 10.7.4)",$useragent);
			$useragent = str_replace("linuxchrome26","Chrome 26.0.1410.19(Linux)",$useragent);
			$useragent = str_replace("linuxchrome30","Chrome 30.0.1599.15(Linux)",$useragent);
			$useragent = str_replace("linuxfirefox19","Firefox 19.0(Linux)",$useragent);
			$useragent = str_replace("galaxy2chrome18","Chrome 18.0.1025.166(Samsung Galaxy S II, Android 4.0.3)",$useragent);
			$useragent = str_replace("galaxy2chrome25","Chrome 25.0.1364.123(Samsung Galaxy S II, Android 4.0.3)",$useragent);
			$useragent = str_replace("galaxy2chrome29","Chrome 29.0.1547.59(Samsung Galaxy S II, Android 4.1.2)",$useragent);
			$useragent = str_replace("nexuschrome18","Chrome 18.0.1025.133(Google Nexus, Android 4.0.4)",$useragent);
			$useragent = str_replace("ipadsafari7","Safari 7.0(iPad, iOS 7.0.4)",$useragent);
			$useragent = str_replace("ipadchrome33","Chrome 33.0.1750.21(iPad, iOS 7.1)",$useragent);
			
			#Insert Into Mongo
			$site = array(
				'date'=>$thedate,
				'time'=>$tracking,
				'url' =>$link,
				'ip' =>$ip,
				'download' =>$dlink,
				'UserAgent'=>$useragent,
				'reader'=>$reader,
				'flash'=>$flash,
				'java'=>$java,
				'user'=>$_SERVER['PHP_AUTH_USER'],
				'country'=>$country,
				'countrycode'=>$countrycode
			);
			$site_id = $sites->insert($site);

			#Output Report Link
			echo "<div class='alert alert-info'>COMPLETE! <a href='report.php?id=".$time."'  target='_blank'> See Report</a></div>";
		}
		else
		{
			echo "<div class='alert alert-danger'>Please input a URL</div>";
		}
		?>
      </div>
    </div>

    <div class="container">
      <hr>

      <footer>
        <p>&copy; r3comp1l3 2014</p>
      </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>




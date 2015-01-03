<?php
$geoip_domain = "http://ip-json.rhcloud.com/json";
$db = "kame";
$db_table = "sites";
$jsclassifier = "/opt/thug/src/Classifier/rules/jsclassifier.yar";
$urlclassifier = "/opt/thug/src/Classifier/rules/urlclassifier.yar";
$sampleclassifier = "/opt/thug/src/Classifier/rules/sampleclassifier.yar";
$thug_py = "/opt/thug/src/thug.py";
$thug_output = "-q"; # Quiet -q, Verbose -v, and Debug -d.  Verbose is the default output when not specified in Thug.
$kame_reports_dir = "/var/www/kame/reports/";
?>
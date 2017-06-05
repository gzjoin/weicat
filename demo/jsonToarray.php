<?php
//$json = '{"access_token":"ACCESS_TOKEN","expires_in":7200}';


$arr = json_decode($json,1);

echo $arr["access_token"];


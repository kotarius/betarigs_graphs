<?php

`/var/www/lite/betarigs/log.sh`;

$api['timestamp'] = time();

$json_lines = file("/tmp/allbeta.json", FILE_IGNORE_NEW_LINES);

foreach($json_lines as $json_line){
	$array[] = json_decode($json_line, true);
	$count++;

}

print_r($array);

for($i = 0; $i<=$count; $i++){

	$name = $array[$i]['name'];
	$rented = round($array[$i]['rented_capacity']['value']/1000/1000,2);
	$available = round($array[$i]['available_capacity']['value']/1000/1000,2);
	$total = $rented+$available;

	$string[$name] = $api['timestamp']." ".$rented." ".$available." ".$total;

	file_put_contents("/var/www/lite/betarigs/$name.log",$string[$name]."\n",FILE_APPEND);
}

?>

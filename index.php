<?php


$algos = explode(" ","X11 X13 X15 Scrypt SHA-256 Nist5 Blake-256 Keccak Scrypt-A.-Nfactor");

foreach($algos as $algo){

$log = explode("\n",trim(`tail -3000 /var/www/lite/betarigs/$algo.log`));

foreach($log as $line){

	$array = explode(" ",$line);
	$timestamp = array_shift($array);
	$string = implode(", ",$array);
	$date = date("H:i F d, Y",$timestamp);
	$google_data[$algo] .= "[new Date('".$date."'), ".$string."],\n";    
	$numbers = array();

}

}
echo "<script type='text/javascript' src='http://www.google.com/jsapi'></script>";

foreach($algos as $algo){

    echo "<script type='text/javascript'>
      google.load('visualization', '1.1', {'packages':['annotationchart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();

		data.addColumn('datetime', 'Date');
                      data.addColumn('number', 'rented ".$algo." ghs');
		  data.addColumn('number', 'available ".$algo." ghs');
			data.addColumn('number', 'total ".$algo." ghs');

        data.addRows([";
	echo $google_data[$algo];

        echo "]);
        
         var chart = new google.visualization.AnnotationChart(document.getElementById('".$algo."'));
                var options = {
          thickness: 1,
          fill: 10,
          scaleType: 'fixed',
	        allValuesSuffix: 'ghs',
		 colors: ['#cc0000','#00cc00','#111111'],
          legendPosition: 'newRow'
        };

        chart.draw(data, options);
      }
    </script>
<h2>betarigs.com ".$algo."</h2>

<div id='".$algo."' style='width: 800px; height: 300px;'></div>";

}

?>

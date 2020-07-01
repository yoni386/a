<!DOCTYPE html>
<meta charset="utf-8">
        
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
      

        Body {
        background-color: rgba(0,0,0,0.1);
        color: #000305;
        font-size: 87.5%;
        font-family: Helvetica;
        line-height: 1.5;
        text-align: left;
    }
          
        .up {
        color: #2d7abd;
        }
          
        .down {
        color: #F08080;
        }
          
        .head {
        color: #000305;
        font-size: 45.5%;
        font-family: Helvetica;
        }
                
    </style>
    
</head>
 
<body>

    <div class="up">
        <p>
            Example : Host 172.17.30.3 is up, will be colored as blue.
        </p>
    </div>
        
       <div class="down">
        <p>
            Example : Host 172.16.32.60 is down, will be colored as red.
        </p>
    </div>
  
    <div class="head">
        <h1>
            Output Up/Down for the following servers ; 
        </h1>
           <p>
         172.17.30.3,172.17.30.4,172.17.30.5,172.17.30.55,172.17.16.2,172.17.16.4,172.17.17.73,172.17.17.67,109.226.3.17,109.226.3.18,109.226.8.150,109.226.10.10,172.16.8.90,172.16.8.120,172.16.8.122,172.16.8.130,172.16.8.132,109.226.4.29,172.16.8.106
            </p> 
    </div>
    

</body>

<?php
		

$hosts = array('172.17.30.3','172.17.30.4','172.17.30.5','172.17.30.55','172.17.16.2','172.17.16.4','172.17.17.73','172.17.17.67','109.226.3.17','109.226.3.18','109.226.8.150','109.226.10.10','172.16.8.90','172.16.8.120','172.16.8.122','172.16.8.130','172.16.8.132','109.226.4.29',"172.16.8.106");
$ports = array(22, 25, 53, 80, 443, 587, 3389);


//$values = array(
//   $hosts => '172.17.16.3','172.17.16.4',
//   $ports => '22, 25, 53, 80, 443, 110, 3389'
//   );

foreach ($hosts as $host) {
    
    foreach ($ports as $port) {
   
  
//$array_combine = array_combine($hosts, $ports);

    $connection = @fsockopen($host, $port, $errno, $errstr, 1);
        
        
    if ($connection !== false) {
       
//        foreach (is_resource($connection)) {
         $output =   '<div class="up"><p>' . $host . ' is up </p></div>' . "\n";
        
        
    
        
//        	return askapache_sock_strerror($errno,$errstr);
            

        fclose($connection);
            break;
        
        }
    
 

    else {
      $output = '<div class="down"><p>'. $host . ' is down</p></div>' . "\n";
           }
}
    echo $output;
}



?>


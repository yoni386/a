

<meta charset="utf-8">
<?php
		

$hosts = array('172.17.30.3','172.17.30.4','172.17.30.5','172.17.30.55','172.17.16.2','172.17.16.4','172.17.17.73','172.17.17.67','109.226.3.17','109.226.3.18','109.226.8.150','109.226.10.10','172.16.8.90','172.16.8.120','172.16.8.122','172.16.8.130','172.16.8.132','109.226.4.29');
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
        $output =  '<p>' . $host . ' Port' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</p>' . "\n";
        
//        	return askapache_sock_strerror($errno,$errstr);
            

        fclose($connection);
            break;
        
        }
    
 

    else {
       $output = '<p>'. $host . ' is not responding.</p>' . "\n";
           }
}
    echo $output;
}

    

?>


<?php

ini_set('display_errors', 1);

$filename= "c:\\sc\logs\\restore_debug.log";

//$myfile = fopen($filename, "w+");

//if( !file_exists($filename) ) {
  //     $myfile = fopen($filename, "w+");
//} else {
 //   break;
//}

$i = 0;
while( !file_exists($filename) )
{
   sleep(1);
   $i++;
   if ($i == 7) {
       	$response = array( 'msg' => 'Process Is Completed.', 'timestamp' => '');
	   	echo json_encode($response);
	   	exit(0);
  	}
}



$lastmodif = isset( $_GET['timestamp'])? $_GET['timestamp']: 0 ;
$currentmodif=filemtime($filename);


while ($currentmodif <= $lastmodif) {
  usleep(10000);
  clearstatcache();
  if(file_exists($filename) ) {
  	$currentmodif =filemtime($filename);
  }
  else {
  	$response = array( 'msg' => "Process Is Completed.", 'timestamp' => $currentmodif);
  	echo json_encode($response);
  	exit(0);
  }
 }
 
 $response = array();
 $response['msg'] =Date("H:i:s")." ".file_get_contents($filename);
 $response = str_replace("\n", "<br/>", $response);
 $response['timestamp']= $currentmodif;
 echo json_encode($response);
 
?>
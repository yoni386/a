<meta charset="utf-8">
<?php
		

if((isset($_POST["submit"])) && (!empty($_POST["user_input1"])))
{
    // Get the variables submitted by POST in order to pass them to the PowerShell script:
    $user_input1 = $_POST["user_input1"];	
    /*
$hostname = explode("-", $user_input1);
    $hostname[0] = strtoupper($hostname[0]);
    $hostname[2] = strtolower($hostname[2]);
    $hostname = implode("-", $hostname);
    $user_input1 = $hostname;
    $user_input2 = $_POST["user_input2"];
	$user_input3 = $_POST["user_input3"];
	$user_input4 = $_POST["user_input4"];
*/

   /*
 $file_log1 = "c:\\sc\\logs\\restore_debug.log";
    
if (file_exists($file_log1))
{
	echo "Script is busy, try again in 10 secs!";
	exit;
}
*/
    $psScriptPath = "C:\\sc\\find_bmw_mac1.ps1";

 
$query = shell_exec("powershell -command $psScriptPath -user_input1 '$user_input1'< NUL");


 /* echo ($query); */
 
/*
$one = file_get_contents ($file_log1);
$one = str_replace("\n", "<br/>", $one);
echo ($one);
echo 'Process Is Completed' ;

$datestr0 = date("d_m_Y_H_i_s");

$filename = $file_log1;
$filename2 = "C:\\sc\\logs\\old\\$datestr0.log";
rename ($filename, $filename2);

$filename3 = "C:\\sc\\logs\\old\\$datestr0.debug.log";

file_put_contents($filename3, $query);
*/

  
}

echo $query;
 
?>



<?php


// If there was no submit variable passed to the script (i.e. user has visited the page without clicking submit), display the form:
if(!isset($_POST["submit"]))
 {
    ?>
    <form name="testForm" id="testForm" action="7.php" method="post" />
        VM to restore  : <input type="text" name="username1" id="username1" maxlength="20" /><br />
        Days to recover: <input type="text" name="username2" id="username2" maxlength="20" /><br />
        <input type="submit" name="submit" id="submit" value="Restore VM" />
    </form>
    <?php    
}
// Else if submit was pressed, check if all of the required variables have a value:
elseif((isset($_POST["submit"])) && (!empty($_POST["username1"])))
{
    // Get the variables submitted by POST in order to pass them to the PowerShell script:
    $username1 = $_POST["username1"];
    $username2 = $_POST["username2"];
    $username3 = $_POST["username3"];
    $username4 = $_POST["username4"];
    // Best practice tip: We run out POST data through a custom regex function to clean any unwanted characters, e.g.:

    // Path to the PowerShell script. Remember double backslashes:
    $file_log1 = "\path\logs\restore_debug.log";
    
if (file_exists($file_log1))
{
	echo "Script is busy, try again in 10 secs!";
	exit;
}

    $psScriptPath = "\path\restore_bmw_1.ps1";
 
$query = shell_exec("powershell -command $psScriptPath -username1 '$username1' -username2 '$username2' -username3 '$username3' -username4 '$username4'< NUL");


  // echo ($query);
 
$one = file_get_contents ($file_log1);
$one = str_replace("\n", "<br/>", $one);
echo ($one);
echo 'Process Is Completed' ;

$datestr0 = date("d_m_Y_H_i_s");

$filename = $file_log1;
$filename2 = "\path\$datestr0.log";
rename ($filename, $filename2);

$filename3 = "\path\$datestr0.debug.log";

file_put_contents($filename3, $query);

  
}
 

// Else the user hit submit without all required fields being filled out:
//else
//{
 //   echo "Sorry, you did not complete all required fields. Please go back and try again.";
//} 
// print "Form submitted successfully: <br>VM Name is <b>".$_POST['username1']."</b> Days to Recover is <b>".$_POST['username2']."</b><br>";
 
?>
</body>
</html>

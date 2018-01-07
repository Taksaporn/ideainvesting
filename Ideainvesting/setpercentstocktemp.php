<?php  
	include 'databaseConnect.php';
	$userid =1;
    $ideaID = 1;
	$Symbol=$_GET['Symbol'];

	if (!empty($_POST['setpercent0'])) 
	{
		$Percent=$_POST['setpercent0'];
	}

	elseif (!empty($_POST['setpercent1'])) 
	{
		$Percent=$_POST['setpercent1'];
	}

	elseif (!empty($_POST['setpercent2'])) 
	{
		$Percent=$_POST['setpercent2'];
	}

	elseif (!empty($_POST['setpercent3'])) 
	{
		$Percent=$_POST['setpercent3'];
	}

	elseif (!empty($_POST['setpercent4'])) 
	{
		$Percent=$_POST['setpercent4'];
	}

	elseif (!empty($_POST['setpercent5'])) 
	{
		$Percent=$_POST['setpercent5'];
	}

	elseif (!empty($_POST['setpercent6'])) 
	{
		$Percent=$_POST['setpercent6'];
	}
	elseif (!empty($_POST['setpercent7'])) 
	{
		$Percent=$_POST['setpercent7'];
	}
	elseif (!empty($_POST['setpercent8'])) 
	{
		$Percent=$_POST['setpercent8'];
	}
	elseif (!empty($_POST['setpercent9'])) 
	{
		$Percent=$_POST['setpercent9'];
	}

	echo $Percent;
	
	$updatepercent="UPDATE stockideatemp SET Percent=$Percent WHERE Symbol='$Symbol'";
	echo $updatepercent;
    $conn->query($updatepercent);

    mysqli_close($conn);

    header('Location: Createidea.php');
?>
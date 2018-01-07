<?php  

	include 'databaseConnect.php';
	$symbol=$_GET['Symbol'];

	$sqldeleteSymbol=$conn->query("DELETE FROM stockideatemp where Symbol= '$symbol'");
	echo "$sqldeleteSymbol";
	$conn->query($sqldeleteSymbol);

	$stock=0;
    $resultcountstock=$conn->query("SELECT * FROM stockideatemp");
    while ($rowrresultcountstock=$resultcountstock->fetch_assoc()) 
    {
        $amountstock=$rowrresultcountstock['IdeaID'];
        $stock +=$amountstock;
    }

    $Percent=100/$stock;
    $updatepercent="UPDATE stockideatemp SET Percent=$Percent WHERE 1";
    $conn->query($updatepercent);

	mysqli_close($conn);
	header('Location: createIdea.php');
?>
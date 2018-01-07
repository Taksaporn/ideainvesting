<?php
  include 'databaseConnect.php';

    $userid =1;
    $ideaID = 1;
    $Symboltemp=$_POST['Symbol'];
    $companytemp=$_POST['Company'];

    $Percent=0;

    if ($Symboltemp!=null) 
    {
        $resultstock = $conn->query("SELECT * FROM listofcompanies WHERE Symbol='$Symboltemp'" );
        while($rowstock = $resultstock->fetch_assoc())
        {
            $symbol = $rowstock['Symbol'];
            $company=$rowstock['Company'];
            if ($Symboltemp==$symbol) 
            {
                $sql1 = "INSERT INTO stockideatemp (IdeaID, Symbol, Percent) VALUES ('$ideaID', '$symbol', '$Percent')";
                $conn->query($sql1);
            }      
        } 
    }
    else
    {
        $resultstock2 = $conn->query("SELECT * FROM listofcompanies WHERE  Company='$companytemp' "); 
        while($rowstock2 = $resultstock2->fetch_assoc())
        {
            $symbol = $rowstock2['Symbol'];
            $company=$rowstock2['Company'];
            if ($companytemp==$company) 
            {
                $sql1 = "INSERT INTO stockideatemp (IdeaID, Symbol, Percent) VALUES ('$ideaID', '$symbol', '$Percent')";
                $conn->query($sql1);
            }      
        } 
    }

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
    header('Location: Createidea.php');
?>


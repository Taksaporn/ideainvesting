<?php
  include 'databaseConnect.php';

    $ideaID = $_POST["ideaID"];
    //$ideaID=1;
    //echo $IdeaName;
    $userid =1;
    $money=$_POST['inputmoney'];
    //$money=20000;

    $sqlupdateoldinvest = "UPDATE idea SET oldinvest = $money WHERE IdeaID =$ideaID ";
    $conn->query($sqlupdateoldinvest);



    $resultdateToday=$conn->query("SELECT dateToday FROM idea where IdeaID = $ideaID");
    $rowdateToday = $resultdateToday->fetch_array();
    $dateToday = $rowdateToday[0];


    $sqlupdatedatecreate = "UPDATE idea SET DateCreated = '$dateToday' WHERE IdeaID =$ideaID ";
    $conn->query($sqlupdatedatecreate);

    $returnInvest=0;
    $stockprice=0;
    $newmoneyinvest=0;
    $result4 = $conn->query("SELECT * FROM stockidea WHERE ideaID = $ideaID" );
    while($row4 = $result4->fetch_assoc())
    {
        $symbol = $row4['Symbol'];
        $percent = $row4['Percent'];
        $investeachStock=$money*($percent/100);

        $result2 = $conn->query("SELECT * FROM historyprice WHERE datePrice = '$dateToday' and Symbol='$symbol' ");
        while($rowstockprice = $result2->fetch_assoc())
        {
            $stockprice=$rowstockprice['Priceclose'];
            $amountStock1=intval($investeachStock/$stockprice);
            $investStock1=$amountStock1*$stockprice;
        }

        $newmoneyinvest +=$investStock1;
    }

    echo $newmoneyinvest;

    $sql2 = "UPDATE idea SET InvestAmount = $newmoneyinvest WHERE IdeaID =$ideaID ";
    $conn->query($sql2);


    $resultGetCash = $conn->query("SELECT cash FROM user WHERE userID = 1");
    $rowGetcash= $resultGetCash->fetch_array(); //Get price when create the idea
    $cash = $rowGetcash[0];
    $newcash=$cash-$newmoneyinvest;

    $updatecash="UPDATE user SET cash = $newcash WHERE userID = 1 ";
    $conn->query($updatecash);



    $resultinvestamount=$conn->query("SELECT * FROM idea WHERE ideaID=$ideaID");
    while ($rowinvestamount=$resultinvestamount->fetch_assoc()) 
    {
        $dateToday=$rowinvestamount['dateToday'];
        $InvestAmount=$rowinvestamount['InvestAmount'];
        $InvestName=$rowinvestamount['InvestName'];

        $sql6="INSERT INTO transaction (userID ,ideaID ,dateToday ,ideaName ,action ,NetAmount) VALUES ('$userid', '$ideaID', '$dateToday', '$InvestName', 'buy', '$newmoneyinvest')";
        //echo $sql6;
        $conn->query($sql6);
    }
    
 
    //$result2 = $conn->query("DELETE FROM stockideatemp WHERE IdeaID = $ideaID" );
    mysqli_close($conn);

    header('Location: performance.php');
?>

<?php
 	include 'databaseConnect.php';
    $UserID = 1;
    $ideaID = $_GET['ideaID'];
    $cash=0;
    $result1 = $conn->query("SELECT * FROM idea WHERE ideaID = $ideaID" );
    while($row1 = $result1->fetch_assoc())
    { 
      $Description=$row1['Description'];
      $InvestName=$row1['InvestName'];
      $DateCreated=$row1['DateCreated']; 
      $dateToday=$row1['dateToday'];
      $InvestAmount=$row1['InvestAmount'];
      $ReturnInvest=$row1['ReturnInvest'];
    }

    $sqltransaction="INSERT INTO transaction(userID ,ideaID ,dateToday ,ideaName ,action ,NetAmount) VALUES('$UserID', '$ideaID', '$dateToday', '$InvestName', 'sellall', '$ReturnInvest')";
    $conn->query($sqltransaction);

    $resultGetoldcash = $conn->query("SELECT cash FROM user WHERE userID = $UserID");
    $rowGetoldcash= $resultGetoldcash->fetch_array(); //Get price when create the idea
    $oldcash = $rowGetoldcash[0];

    $profit=$ReturnInvest-$InvestAmount;
    
    $cash=$oldcash+$ReturnInvest;
    //insert transactions 
    //update investment idea 

    $sqlupdateCash="UPDATE user SET cash=$cash WHERE userID=$UserID ";
    $conn->query($sqlupdateCash);

    $sql="UPDATE idea SET ReturnInvest=0 ,InvestAmount=0 ,ReturnPercent=0 WHERE IdeaID = $ideaID ";
    $conn->query($sql);
              
    //delete all date in sumcalculatestock table
    $sql2="DELETE * FROM sumcalculatestock WHERE ideaID = $ideaID ";
    $conn->query($sql2);
    
    header('Location: performance.php');
?>
<?php
  include 'databaseConnect.php';

    $ideaID = $_POST["ideaID"];
    $IdeaName = $_POST['IdeaName'];
    $Description = $_POST['Description'];
    //echo $IdeaName;
    $userid =1;
    $money=$_POST['investamount'];

    $sql2 = "UPDATE idea SET InvestAmount= $money, UserID=$userid  WHERE IdeaID =$ideaID ";
    $conn->query($sql2);

    //$sql6="INSERT INTO transaction (userID ,ideaID ,dateToday ,ideaName ,action ,NetAmount) VALUES ('$userid', '$ideaID', '$Date', '$IdeaName', 'Createidea', '$money')";
    //$conn->query($sql6);
    //echo $sql;
/*
    $result2 = $conn->query("DELETE FROM stockideatemp WHERE IdeaID = $ideaID" );*/
    mysqli_close($conn);
    //echo "yesssssssssssssssssssssssss";
    header('Location: showCalculateStock.php?id='.$ideaID.'');
?>

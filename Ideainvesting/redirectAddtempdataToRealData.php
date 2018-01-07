<?php
  include 'databaseConnect.php';
  
    $IdeaName = $_POST['IdeaName'];
    $Description = $_POST['Description'];
    //$Date = $_POST['createDate'];
    //$dateToday = $_POST['createDate'];
    $Date = '2014-01-02';
    $dateToday = '2016-12-30';

    $ReturnInvest=0;
    $ReturnPercent=0;
    $oldinvest=0;
    $resultgetDatechange=$conn->query("SELECT dateToday FROM idea ");
    $rowgetDatechange = $resultgetDatechange->fetch_array();
    $getDatechange = $rowgetDatechange[0];

    //echo $IdeaName;
    $userid =1;
    $money=0;
    $sql = "INSERT INTO idea (UserID ,Description ,InvestAmount ,InvestName, DateCreated, dateToday, ReturnInvest, ReturnPercent, oldinvest)
    VALUES ('$userid', '$Description', '$money', '$IdeaName', '$getDatechange', '$getDatechange', '$ReturnInvest', '$ReturnPercent', '$oldinvest')";
    $conn->query($sql);

    $resultGetIdeaid = $conn->query("SELECT IdeaID FROM idea ");
    $rowGetIdeaid= $resultGetIdeaid->fetch_array();  //Get price when create the idea
    $IdeaID = $rowGetIdeaid[0];
    
    $sqltransaction="INSERT INTO transaction (userID ,ideaID , dateToday, ideaName, action, NetAmount) VALUES ('$userid', '$IdeaID', '$getDatechange', '$IdeaName', 'Createidea', '$money')";
    $conn->query($sqltransaction);
        
    $result2 = $conn->query("SELECT IdeaID FROM idea ORDER BY IdeaID DESC LIMIT 1");
    $row2 = $result2->fetch_array();
    $ideaID = $row2[0];

    $resultAdd = $conn->query("SELECT * FROM stockideatemp where IdeaID = 1");
    while($rowSymbol = $resultAdd->fetch_array()) 
    { 
        $Symbol = $rowSymbol['Symbol'];
        $Weight = $rowSymbol['Percent'];
        $sql1 = "INSERT INTO stockidea (IdeaID, Symbol, Percent) VALUES ('$ideaID', '$Symbol', '$Weight')";
        $conn->query($sql1);
    }

    $sqltrunc = $conn->query("TRUNCATE TABLE ideatemp");
    $conn->query($sqltrunc);
    $sqltrunc1 = $conn->query("TRUNCATE TABLE stockideatemp");
    $conn->query($sqltrunc1);

    mysqli_close($conn);
    header('Location: portfolio.php');
?>

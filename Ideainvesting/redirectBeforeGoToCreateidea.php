<?php
  session_start();

    include 'databaseConnect.php';
    //if(isset($_POST["submit"]))
  	//{
      $IdeaName = 'Idea name... ';
      $Description = 'Description....... ';
      $Date = $_POST['createDate'];
      $dateToday = '2016-01-04';
      $ReturnInvest=0;
      $ReturnPercent=0;
      //echo $IdeaName;
      $userid =1;
      $money=0;
      $sql = "INSERT INTO ideatemp (UserID ,Description ,InvestAmount ,InvestName, DateCreated, dateToday, ReturnInvest, ReturnPercent)
      VALUES ('$userid', '$Description', '$money', '$IdeaName', '$Date', '$dateToday', ' $ReturnInvest', '$ReturnPercent')";
  //  }


    //  echo $IdeaName.'-'.$Description;
      //echo "$sql";
      $conn->query($sql);
      mysqli_close($conn);

      //echo "yesssssssssssssssssssssssss";
      header('Location: createIdea.php');
  ?>

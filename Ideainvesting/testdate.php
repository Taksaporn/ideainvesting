<?php  
include 'databaseConnect.php';



  $resultGetdateToday = $conn->query("SELECT dateToday FROM idea ");
  $rowGetdateToday= $resultGetdateToday->fetch_array();  
  $dateToday = $rowGetdateToday[0];

  echo $dateToday.'<br>';
  $startDate = date_create($dateToday);
  date_modify($startDate, '-367 days');
  $firstDate=date_format($startDate, 'Y-m-d');
  echo $firstDate.'<br>';

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  //if(mysqli_num_rows($resultfindfirstdate)==0)

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
    
  }
  echo $firstDate.'<br>';


  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  //if(mysqli_num_rows($resultfindfirstdate)==0)

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
    
  }
  echo $firstDate.'<br>';


  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  //if(mysqli_num_rows($resultfindfirstdate)==0)

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
  }
  echo $firstDate.'<br>';


  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  //if(mysqli_num_rows($resultfindfirstdate)==0)

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
  }
  echo $firstDate.'<br>';

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  //if(mysqli_num_rows($resultfindfirstdate)==0)

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
  }
  echo $firstDate.'<br>';


  


    

//$prev_date = date('Y-m-d', strtotime($date .' -1 day'));
//$next_date = date('Y-m-d', strtotime($date .' +1 day'));  


  /*$resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket where DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  $a="SELECT * FROM setindexmarket where DateIndex='$firstDate'";
  echo $a;
  $resultfindfirstdate=$conn->query("SELECT * FROM setindexmarket where DateIndex='$firstDate'");
  echo $resultfindfirstdate;
  while($rowresultfindfirstdate = $resultfindfirstdate->fetch_assoc())
    { 
      $DateIndex=$rowresultfindfirstdate['DateIndex'];
      echo $DateIndex.'<br>';
      if (mysql_num_rows($resultfindfirstdate)==0) 
      {
        echo "null".'<br>';
      }
      else
      {
        echo "notnull".'<br>';
      }
      
    }

  echo $firstDate.'<br>';*/

  //if(is_null($resultfindfirstdate)== false) 
 // {
    //echo $firstDate.'<br>';
   // $startDate = date_create($Firstdatetemp);
   // date_modify($startDate, '-1 day');
   // $firstDate=date_format($startDate, 'Y-m-d');
 // }

  //echo $firstDate.'<br>';

?>
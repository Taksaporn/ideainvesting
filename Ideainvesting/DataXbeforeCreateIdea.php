<?php
  function CreateDataX($a)
{
    include 'databaseConnect.php';
   // $resultGetFirstdate = $conn->query("SELECT DateCreated FROM idea ");
   // $rowGetFirstdate= $resultGetFirstdate->fetch_array();  //Get price when create the idea
    //$Firstdate = $rowGetFirstdate[0];

    $resultGetDateCreated = $conn->query("SELECT dateToday FROM idea");
    $rowDateCreated= $resultGetDateCreated->fetch_array(); //Get price when create the idea
    $dateToday = $rowDateCreated[0];

    $startDate = date_create($dateToday);
    date_modify($startDate, '-365 days');
    $Firstdate=date_format($startDate, 'Y-m-d');

    // find firstdate
    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$Firstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    //if(mysqli_num_rows($resultfindfirstdate)==0)

    if(empty($Firstdatetemp))
    {
      $Firstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
      
    }

    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$Firstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    //if(mysqli_num_rows($resultfindfirstdate)==0)

    if(empty($Firstdatetemp))
    {
      $Firstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
      
    }


    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$Firstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    //if(mysqli_num_rows($resultfindfirstdate)==0)

    if(empty($Firstdatetemp))
    {
      $Firstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
    }


    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$Firstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    //if(mysqli_num_rows($resultfindfirstdate)==0)

    if(empty($Firstdatetemp))
    {
      $Firstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
    }

    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$Firstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    //if(mysqli_num_rows($resultfindfirstdate)==0)

    if(empty($Firstdatetemp))
    {
      $Firstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
    }

    
    $arrValue = array();
    $resultSymbol = $conn->query("SELECT * FROM stockideatemp Where ideaID = 1");
    while($rowSymbol = $resultSymbol->fetch_array()) { // 5 รอบ
      $Symbol = $rowSymbol['Symbol'];
      $Weight = $rowSymbol['Percent'];

      $resultGetPriceDateCreated = $conn->query("SELECT Priceclose FROM historyprice WHERE Symbol = '$Symbol' AND datePrice <= '$dateToday' ");
      $rowpriceCreatedDate = $resultGetPriceDateCreated->fetch_array();
      $PriceDateCreated = $rowpriceCreatedDate[0];

      $resultValue = $conn->query("SELECT datePrice, (($Weight/$PriceDateCreated)*Priceclose) AS Value FROM historyprice WHERE Symbol = '$Symbol'");
      $arrValue["'".$Symbol."'"] = array();
      while($rowValue = $resultValue->fetch_array()) 
      {
        // $tmpValue = array();
        // $tmpValue['datePrice'] = $rowValue['datePrice'];
        // $tmpValue['Value'] = $rowValue['Value'];
        $arrValue["'".$Symbol."'"]["'".$rowValue['datePrice']."'"] = $rowValue['Value'];
        // print_r($rowValue);
      }
      // echo $rowSymbol['Symbol'];
      //  print_r($arrValue);
    }
    // print_r($arrValue);
    //$datePrice= $conn->query("SELECT datePrice FROM historyprice WHERE Symbol = '$Symbol'");
    $arrDate = array();
    $resultdatePrice = $conn->query("SELECT DISTINCT datePrice FROM historyprice WHERE datePrice >= '$Firstdate' and datePrice <= '$dateToday' ");
    

    //$resultdatePrice = $conn->query("SELECT DISTINCT datePrice FROM historyprice WHERE datePrice <= '$DateCreated' ");
    //$resultdatePrice = $conn->query("SELECT DISTINCT datePrice FROM historyprice");
    while($rowdatePrice = $resultdatePrice->fetch_array()) 
    {
      array_push($arrDate, $rowdatePrice['datePrice']);  
    }
    // print_r($arrDate);
    $arrSum = array();
    foreach ($arrDate as $dateToday) 
    {
      $resultSymbol = $conn->query("SELECT * FROM stockideatemp where ideaID = 1");
      $sum = 0;
      while($rowSymbol = $resultSymbol->fetch_array()) 
      { // 5 รอบ
        $Symbol = $rowSymbol['Symbol'];
        
          if(array_key_exists("'".$dateToday."'", $arrValue["'".$Symbol."'"])) 
          {
            $sum += $arrValue["'".$Symbol."'"]["'".$dateToday."'"];
          }
      }
      $arrSum["'".$dateToday."'"] = array();
      $arrSum["'".$dateToday."'"] = $sum;
    }
    
      
    $SumFirstDate = $arrSum["'".$Firstdate."'"];
    $arrIdeaIndex = array();
    foreach ($arrSum as $key => $value) 
    {
      $sum = 0;
      if ($SumFirstDate==0) 
      {
        $sum = ($value/1);
        $arrIdeaIndex[$key] = array();
        $arrIdeaIndex[$key] = $sum;
      }
      else
      {
        $sum = ($value/$SumFirstDate) -1;
        $arrIdeaIndex[$key] = array();
        $arrIdeaIndex[$key] = $sum;
      }
    } //echo$SumFirstDate;
    return $arrIdeaIndex;
  }
?>

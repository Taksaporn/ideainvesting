<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Idea</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      showButtonPanel: true
    });
  } );
  </script>

  </head>

  <body>
    <div class="tagline-upper text-center text-heading text-shadow text-black mt-3 d-none d-lg-block" style="font-size: 45px">IDEA INVESTING
      <form action="redirectAddDatetoday.php" method="post">
        <?php 
          include 'databaseConnect.php';
          $resultscalendar=$conn->query("SELECT * FROM idea " );
          while ($rowcalendar=$resultscalendar->fetch_assoc()) 
          {
            $dateToday=$rowcalendar['dateToday'];
          }
          echo '<input type="Date" id="datepicker" name="setdateToday" class="boxdate" value='.$dateToday.'>';
        ?>
         <button type="submit" class="buttonsetdate btn-primary" >Set Date</button>
      </form>
    </div>
    
    <!-- Navigation -->
     <nav class="navbar navbar-expand-lg navbar-light bg-faded" style="font-size: 16px">
      <div class="container" style="margin-left: 300px">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Idea investing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto" style="position: center">
            <li class="nav-item active px-lg-2">
              <a class="nav-link text-uppercase text-expanded " href="performance.php">portfolio</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="portfolio.php">your idea</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="createIdea.php">Build an Idea</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="transaction.php">Transactions</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="index.php">| Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <?php  
          include'databaseConnect.php';
          $Ideanumber = $_GET['id'];
          $Description='';
          $IdeaName='';
                  //<!while loop to fetch name and description!>
          $result2 = $conn->query("SELECT * FROM idea WHERE IdeaID = $Ideanumber" );
          while($row2 = $result2->fetch_assoc())
          {
            $Description = $row2['Description'];
            $IdeaName = $row2['InvestName'];
            $InvestAmount=$row2['InvestAmount'];
            $ReturnInvest=$row2['ReturnInvest'];
          }
        ?>
      <div class="jumbotron">
        <div class="container">
         <div>
          <form action="redirectAddDatetoday.php" method="post">
              <div style="font-size: 28px"><b><?php echo $IdeaName; ?></b></div><br>
              <input type="hidden" value= "<?php echo $Ideanumber ?>" name="ideaID">
              <?php  
                echo '<div class="boxcost">
                      <a style="font-size:16px" >Cost<br>
                      <a style="font-size:24px">฿'.number_format($InvestAmount, 2).'</a></a>
                      <div class="boxreturn">
                      <a  style="font-size:16px" >Return<br>
                      <a style="font-size:24px">฿'.number_format($ReturnInvest, 2).'</a></a>
                      </div>
                      </div>';
              ?>
          </div><br><br><br><br>
          <div class="row">
            <div class="col-sm-6">
              <font size="4" color="black" align="left">Description</font><br>
              <font size="3" color="black" align="left" class="textarea"><?php echo $Description; ?></font>
            </div>
           <div class="col-sm-6" style="margin-top: -180px">
              <h3 align="center">Performance</h3>
              <div id="myGraph" ></div>
            </div>
          </div><br><br>
          <?php $ideaID = $Ideanumber; ?>
        <div>
          <div class="container">

          <?php 
                $resultidea2=$conn->query("SELECT * FROM idea WHERE IdeaID = $ideaID" );
                while ( $rowidea2=$resultidea2->fetch_assoc()) 
                {
                  $investAmount=$rowidea2['InvestAmount'];
                  $ReturnInvest=$rowidea2['ReturnInvest'];
                  $DateCreated=$rowidea2['DateCreated'];
                  $dateToday=$rowidea2['dateToday'];
                  // echo '<br><br><font size="5"  align="left">Asset in this idea</font>
                        //<font size="5"  > Invest: '.$investAmount.'</font>
                        //<font size="5"  align="right">Return: ' .$ReturnInvest.'</font>' ;
                }
          ?>
          <table class="table" bgcolor="black" style="font-size: 13px">
            <thead>
              <tr>
                <th>Symbol</th>
                <th>Company</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Shares Owned</th>
                <th>Current Value</th>
                <th>Gain/Loss</th>
              </tr>
            </thead>
            <tbody>
              <?php
                include 'databaseConnect.php';
                /*$resultidea=$conn->query("SELECT * FROM idea WHERE IdeaID = $ideaID" );
                while ( $rowidea=$resultidea->fetch_assoc()) 
                {
                  $investAmount=$rowidea['InvestAmount'];*/
                  $result1 = $conn->query("SELECT * FROM stockidea WHERE IdeaID = $ideaID" );
                  while($row1 = $result1->fetch_assoc())
                    {
                        $ideaID=$row1['IdeaID'];
                        $symbol = $row1['Symbol'];
                        $percent = $row1['Percent'];
                        $investeachstock=$InvestAmount*($percent/100);
                          echo  '<tr>
                          <td>'.$symbol.'</td>';
                          $sql = $conn->query("SELECT Company FROM listofcompanies WHERE Symbol = '$symbol' ");
                          while($row = $sql->fetch_array())
                          {
                            echo '<td>'.$row[0].'</td>';
                          }
                          
                          echo '<td>'.$percent.'%'.'</td>';
                    
                          $gainloss=0;
                          $resultcalculateprice= $conn->query("SELECT * FROM sumcalculatestock WHERE ideaID = '$ideaID' and stockName ='$symbol'");
                          while ($rowcalculateprice=$resultcalculateprice->fetch_assoc()) 
                          {
                            $stockName=$rowcalculateprice['stockName'];
                            $stockamount=$rowcalculateprice['stockamount'];
                            $priceCreate=$rowcalculateprice['priceCreate'];
                            $priceToday=$rowcalculateprice['priceToday'];
                            $gainloss=$priceToday-$priceCreate;
                            
                            if ($symbol==$stockName && $gainloss>=0) 
                            {
                              echo  '<td>'.'฿'.$priceCreate.'</td>
                              <td>'.$stockamount.'</td>
                              <td>'.'฿'.$priceToday.'</td>
                              <td style="color:green">'.'฿'.$gainloss.'&nbsp;&uarr;'.'</td></tr>';  
                            }
                            else {
                              echo  '<td>'.'฿'.$priceCreate.'</td>
                              <td>'.$stockamount.'</td>
                              <td>'.'฿'.$priceToday.'</td>
                              <td style="color:red">'.'฿'.$gainloss.'&nbsp;&darr;'.'</td></tr>'; 
                            }
                          }
                    }  
                //}
              ?>
            </tbody>
          </table>
          <!--end table-->
          <!--return box-->
          <div class="boxshowreturn">
          <b>
          Return to Date<br>
            <tr style="font-weight: normal; font-size: 22px;">
               <td><a >This idea:</a></td>
               <?php 
                 if($InvestAmount ==0)
                 {
                    echo '<td><a>'. number_format(0, 2).'%</a></td>';
                 } 
                 else
                 {
                    echo '<td><a>'.number_format((($ReturnInvest*100)/$investAmount)-100, 2) .'%</a></td>';
                 }


               ?>
               
            </tr>
          </b>
          </div>
          <!--end return box-->
        </div>
      </div>
    </form>
    </div>
    </div>

    <footer class="text-center py-5">
      <div class="container">
        <p class="m-0" style=" color:white; ">Copyright &copy; Taksaporn&Theeranite</p>
      </div>
    </footer>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $('.map-container').click(function () {
        $(this).find('iframe').addClass('clicked')
      }).mouseleave(function () {
        $(this).find('iframe').removeClass('clicked')
      });
    </script>

  </body>
</html>
<?php
include('DataX.php');
include('DataY.php');

 //$arrIdea = array();


 $arrIdea = CreateDataX($Ideanumber);
 $arrIndex=CreateDataY($Ideanumber);
 //print_r($arrIdea);

?>

<script>
  $( document ).ready(function() {
     var layout ={
      margin:{
        t:10,
        b:20,
        l:30,
        r:100
      },
      height: "200",
       legend: {
        y: 0.5,
        traceorder: 'reversed',
        font: {size: 16},
        yref: 'paper'
      }
    };
  var idea_Index = {
    x: [
      <?php
      foreach ($arrIdea as $key => $value) {
        echo $key.', ';
      }
      ?>
    ],
    y: [
      <?php
      foreach ($arrIdea as $key => $value) {
        echo $value.', ';
      }
      ?>
      ],
    mode: 'lines',    
    connectgaps: true,
    name: 'Idea'

  };
  var SET_Index = {
    x: [
      <?php
      foreach ($arrIndex as $key => $value) {
        echo $key.', ';
      }
      ?>
    ],
    y: [
      <?php
      foreach ($arrIndex as $key => $value) {
        echo $value.', ';
      }
      ?>
      ],
    mode: 'lines',   
    connectgaps: true,
     name: 'SET50'

  };
  var data = [SET_Index, idea_Index];
  Plotly.newPlot('myGraph', data, layout);
});
</script>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Build a Idea</title>
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
    <!-- css link <link rel="stylesheet" href="/resources/demos/style.css">-->

    <!-- live search -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
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
       <nav class="navbar navbar-expand-lg navbar-light bg-faded" style="font-size: 17px" >
      <div class="container" style="margin-left: 300px">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Idea investing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div  class="collapse navbar-collapse" id="navbarResponsive" >
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active px-lg-2">
              <a class="nav-link text-uppercase text-expanded " href="performance.php" >portfolio</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="portfolio.php">your idea</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="createIdea.php">Build a Idea</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded " href="transaction.php" >transactions</a>
            </li>
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="index.php">| Log out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="bg-faded p-4 my-4">
      <?php $Ideanumber = 1; ?>
        <div class="form-group">  
          <form action="redirectaddtempdatatorealdata.php" name="add_stock" method="post" id= "add_stock">
            <?php
              include 'databaseConnect.php';
              $Ideanumber = 1;
              $Description='';
              $IdeaName='';
                $result2 = $conn->query("SELECT * FROM ideatemp WHERE IdeaID = 1 ");
                  while($row2 = $result2->fetch_assoc())
                    {
                      $Description = $row2['Description'];
                      $IdeaName = $row2['InvestName'];
                    }
            ?>
              <input type="text" id="fname" class="boxideaname" name="IdeaName" value="<?php echo $IdeaName; ?>" placeholder="Idea name">
              
              
              <button class="btn btn-info" type="submit" style="margin-left: 600px; margin-top: -80px; font-size: 18px">Create Idea</button>

              <h4 align="left" style="color:black;" >Description</h4>
              <textarea rows="6" cols="50" type="text" id="fname" name="Description" placeholder="Description..." align="left"></textarea>
              <div class="col-sm-6 showgraph" >
                <h5 align="center"><b>Performance</b></h5><!--genergategraph-->
                <div id="myGraph" ></div>
              </div>

              <input type="hidden" value= "<?php echo $Ideanumber ?>" name="ideaID">
          </form> <br />

            <!-- form stock add temp generate graph -->
            <h4 align="left">Stocks in This idea </h4>
              <form action="addstocktemp.php" name="addstocktemp" method="post" id= "addstocktemp" >
                <div>

                    <a type="button" class="btn btn-info" style="color: white" id="searchbysymbol">search by symbol</a> 
                    <a type="button" class="btn btn-info" style="color: white" id="searchbycompany">search by company</a><br>

                    <input type="text" name="Symbol" id="inputSymbol"  class="input-lg livesearch search-box" autocomplete="off" placeholder="Input Symbol" />
                    <input type="text" name="Company" id="inputCompany" style="display:none;" class="input-lg livesearch search-box" autocomplete="off" placeholder="Input Company" />
                    <button type="submit" name="add" id="addstock" class="btn btn-success">Add</button>
                    <button type="submit" name="add" id="addcompany" style="display:none;" class="btn btn-success">Add</button>
                </div><br>
                </form>

                <table class="table table-striped" id="stocktemp">  
                <thead> 
                  <tr>  
                    <td><b>Company</b></td>   
                    <td><b>Symbol</b></td>
                    <td id="columpercent"><b>Weight</b></td>
                    <td ></td>
                    <td ></td>  
                    <td ></td>
                    <td ></td>    
                  </tr>
                </thead>
                <tbody>
                <?php
                  include 'databaseConnect.php';
                  $resultstocktemp=$conn->query("SELECT * FROM stockideatemp");
                  $i=0;
                  while ( $rowstocktemp=$resultstocktemp->fetch_assoc()) 
                  {
                    $symbol=$rowstocktemp['Symbol'];
                    $percent=$rowstocktemp['Percent'];
                    $result1 = $conn->query("SELECT * FROM listofcompanies WHERE Symbol='$symbol'" );
                    while($row1 = $result1->fetch_assoc())
                    {
                        $symbol = $row1['Symbol'];
                        $company=$row1['Company'];
                          echo  '<tr>
                          <td>'.$company.'</td>
                          <td><a id="getSymbol">'.$symbol.'</a></td>
                          <td><a name="Percent" id="Percent">'.$percent.'</a></td>
                          <td><a href="deletestockattemp.php?Symbol='.$symbol.'"  style="color:white;" type="button" class="btn btn-danger" id="deletesymbol">delete</a></td>';

                          echo '
                          <form action="setpercentstocktemp.php?Symbol='. $symbol.'" method ="POST" >
                          <td><a id="setpercent'.$i.'" type="button" class="btn btn-info">Edit Weight</a></td>
                          <td><input type="text" name="setpercent'.$i.'"  style="display:none;" id="showsetpercent'.$i.'" ></td>
                          <td><button type="submit" name="confirm" style="display:none;" class="btn btn-success" id="buttonshowsetpercent'.$i.'">Confirm</button></td>
                          <td><a id="cancelsetpercent'.$i.'" style="display:none;" type="button" class="btn btn-danger">Cancel</a></td></tr>
                        </form>';
                        $i++; 
                    } 
                  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <footer class="text-center py-5">
      <div class="container">
        <p class="m-0" style=" color:white; ">Copyright &copy; Taksaporn&Theeranite </p>
      </div>
    </footer>

  </body>
</html>

<?php
  include('DataXbeforeCreateIdea.php');
  include('DataYbeforeCreateIdea.php');
  $a=1;
  $arrIdea = CreateDataX($a);
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
     name: 'SET 50'
  };
  var data = [SET_Index, idea_Index];
  Plotly.newPlot('myGraph', data, layout);
});
</script>

<!--search query Symbol stock-->
<script>
  $(document).ready(function(){
   $('#inputSymbol').typeahead({
    source: function(query, result)
    {
     $.ajax({
      url:"querystocksearch.php",
      method:"POST",
      data:{query:query},
      dataType:"json",
      success:function(data)
      {
       result($.map(data, function(item){
        
        return item.Symbol + '<?php echo '\r\n' ; ?>';     
       }));
      }
     })
    }
   });
  });
</script>

<script>
  $(document).ready(function(){
   $('#inputCompany').typeahead({
    source: function(query, result)
    {
     $.ajax({
      url:"querystocksearch.php",
      method:"POST",
      data:{query:query},
      dataType:"json",
      success:function(data)
      {
       result($.map(data, function(item){
        
        return item.Company + '<?php echo '\r\n' ; ?>';     
       }));
      }
     })
    }
   });
  });
</script>

<!--refresh table stock-->
<script>
$(document).ready(function(){
 $('#addstock').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"addstocktemp.php",
    method:"POST",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
});
</script>

<script>
$(document).ready(function(){
 $('#addcompany').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"addstocktemp.php",
    method:"POST",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
});
</script>

<script>
$(document).ready(function()
  {
    $("#searchbysymbol").click(function()
    {
      $("#inputSymbol").show();
      $("#addstock").show();
      $("#inputCompany").hide();
      $("#addcompany").hide();
    });

    $("#searchbycompany").click(function()
    {
      $("#inputCompany").show();
      $("#addcompany").show();
      $("#inputSymbol").hide();
      $("#addstock").hide();
    });


    //id=0
    $("#setpercent0").click(function()
    {
      $("#showsetpercent0").show();
      $("#buttonshowsetpercent0").show();
      $("#cancelsetpercent0").show();   
    });

    $("#cancelsetpercent0").click(function()
    {
      $("#showsetpercent0").hide();
      $("#buttonshowsetpercent0").hide();
      $("#cancelsetpercent0").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });

    //id=1
    $("#setpercent1").click(function()
    {
      $("#showsetpercent1").show();
      $("#buttonshowsetpercent1").show();
      $("#cancelsetpercent1").show();
    });

    $("#cancelsetpercent1").click(function()
    {
      $("#showsetpercent1").hide();
      $("#buttonshowsetpercent1").hide();
      $("#cancelsetpercent1").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });

    //id=2
    $("#setpercent2").click(function()
    {
      $("#showsetpercent2").show();
      $("#buttonshowsetpercent2").show();
      $("#cancelsetpercent2").show();
    });

    $("#cancelsetpercent2").click(function()
    {
      $("#showsetpercent2").hide();
      $("#buttonshowsetpercent2").hide();
      $("#cancelsetpercent2").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });

    //id=3
    $("#setpercent3").click(function()
    {
      $("#showsetpercent3").show();
      $("#buttonshowsetpercent3").show();
      $("#cancelsetpercent3").show();

    });

    $("#cancelsetpercent3").click(function()
    {
      $("#showsetpercent3").hide();
      $("#buttonshowsetpercent3").hide();
      $("#cancelsetpercent3").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });


    //id=4
    $("#setpercent4").click(function()
    {
      $("#showsetpercent4").show();
      $("#buttonshowsetpercent4").show();
      $("#cancelsetpercent4").show();
    });

    $("#cancelsetpercent4").click(function()
    {
      $("#showsetpercent4").hide();
      $("#buttonshowsetpercent4").hide();
      $("#cancelsetpercent4").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });

    //id=5
    $("#setpercent5").click(function()
    {
      $("#showsetpercent5").show();
      $("#buttonshowsetpercent5").show();
      $("#cancelsetpercent5").show();
    });

    $("#cancelsetpercent5").click(function()
    {
      $("#showsetpercent5").hide();
      $("#buttonshowsetpercent5").hide();
      $("#cancelsetpercent5").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });

    //id=6
    $("#setpercent6").click(function()
    {
      $("#showsetpercent6").show();
      $("#buttonshowsetpercent6").show();
      $("#cancelsetpercent6").show();
    });

    $("#cancelsetpercent6").click(function()
    {
      $("#showsetpercent6").hide();
      $("#buttonshowsetpercent6").hide();
      $("#cancelsetpercent6").hide();
      $("#Percent").show();
      $("#columpercent").show();
      $("#deletesymbol").show();
    });

  });
</script>


<?php
error_reporting(E_ALL & ~E_NOTICE);
include "php\\uploadFile.php";

$quesArray = array();
$subQuesArray = array();
$resultArray = array();
$resultCO;
$tableTitle;

$quesArrayVerbs = array();
$subQuesArrayVerbs = array();
$resultArrayVerbs = array();

$fileDir = "C:\\xampp\\htdocs\\www\\WebPage\\".$_GET['imgPath'];

collectDataForVerbs($fileDir,$quesArrayVerbs,$subQuesArrayVerbs,$resultArrayVerbs);

if ($_GET['option'] == 1) {
  $tableTitle = "Analysis by automatic mode";
  collectDataForAuto($fileDir,$resultCO);
}elseif ($_GET['option'] == 2) {
  collectDataForQT($fileDir,$quesArray,$subQuesArray,$resultArray,$resultCO);
  $tableTitle = "Analysis by Question Type";
} elseif ($_GET['option'] == 3) {
  collectDataForCO($fileDir,$quesArray,$subQuesArray,$resultArray,$resultCO);
  $tableTitle = "Analysis by Course Outcomes";
} elseif ($_GET['option'] == 4) {
  collectDataForQTCO($fileDir,$quesArray,$subQuesArray,$resultArray,$resultCO);
  $tableTitle = "Analysis by Course Outcomes & Question Type";
}

function collectDataForAuto($fileDir,&$resultCO) {
    if (($handle = fopen($fileDir."Value.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        $resultCO = $data[0];
    }
    fclose($handle);
    }
}

function collectDataForCO($fileDir,&$quesArray,&$subQuesArray,&$resultArray,&$resultCO) {
    if (($handle = fopen($fileDir."processed_data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($quesArray,$data[4]);
            array_push($subQuesArray,$data[5]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."analysed_CO.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($resultArray,$data[0]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."result_cowise.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        $resultCO = $data[0];
    }
    fclose($handle);
    }
}

function collectDataForQT($fileDir,&$quesArray,&$subQuesArray,&$resultArray,&$resultCO) {
    if (($handle = fopen($fileDir."processed_data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($quesArray,$data[4]);
            array_push($subQuesArray,$data[5]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."analysed_questiontype.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($resultArray,$data[0]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."result_questiontype.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        $resultCO = $data[0];
    }
    fclose($handle);
    }
}

function collectDataForQTCO($fileDir,&$quesArray,&$subQuesArray,&$resultArray,&$resultCO) {
    if (($handle = fopen($fileDir."processed_data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($quesArray,$data[4]);
            array_push($subQuesArray,$data[5]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."analysed_co_and_questiontype.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($resultArray,$data[0]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."result_co_and_questiontype.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        $resultCO = $data[0];
    }
    fclose($handle);
    }
}

function collectDataForVerbs($fileDir,&$quesArrayVerbs,&$subQuesArrayVerbs,&$resultArrayVerbs) {
    if (($handle = fopen($fileDir."processed_data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($quesArrayVerbs,$data[4]);
            array_push($subQuesArrayVerbs,$data[5]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."question_verb.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
          $num = count($data);
          $newArray = array();
          for ($i=0; $i < $num; $i++) {
            array_push($newArray,$data[$i]);
          }
          array_push($resultArrayVerbs,$newArray); 
        }
        fclose($handle);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>   
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="C:\Users\pc1\Desktop\styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
  .navbar-default .navbar-toggle {
      border-color: #123456;
      color: #000000 !important;
  }
</style>
<body>


  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="firstPage.html">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav nav-pills">
    <li><a data-toggle="pill" href="#menu1">Report</a></li>
    <li><a data-toggle="pill" href="#menu2">Verbs</a></li>
    <li><a data-toggle="pill" href="#menu3">Graphs</a></li>
      </ul> 
    </div>
  </div>
</nav>


 <br><br>
<div class="container">
  <div class="tab-content">
    <div id="menu1" class="tab-pane fade in active">
        <br>
          <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3><?php echo $tableTitle; ?></h3></div>
                    <?php if($_GET['option'] != 1) { ?>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th >Ques No.</th>
                                <th >Sub Ques No.</th>
                                <th >Grade</th>
                            </tr>
                            <?php 
                                $totalData = count($quesArray);
                                for($i=0; $i<$totalData; $i++) {
                            ?>
                            <tr>
                                <td><?php echo $quesArray[$i];?></td>
                                <td><?php echo $subQuesArray[$i];?></td>
                                <td><?php echo $resultArray[$i];?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <?php } else {  ?>
                    <div class="panel-body">
                      <center><h3>This Data is not available in <b><i>automatic mode</i></b></h3></center>
                    </div>
                    <?php } ?>
                    <div class="panel-footer"><h4>Average Quality of Question Paper is = <?php echo $resultCO; ?></h4></div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <br>
          <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>Verbs Found in Questions</h3></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th >Ques No.</th>
                                <th >Sub Ques No.</th>
                                <th >Verbs Found</th>
                            </tr>
                            <?php 
                                $totalData = count($quesArrayVerbs);
                                for($i=0; $i<$totalData; $i++) {
                            ?>
                            <tr>
                                <td><?php echo $quesArrayVerbs[$i];?></td>
                                <td><?php echo $subQuesArrayVerbs[$i];?></td>
                                <td><?php 
                                  $rowCount = count($resultArrayVerbs[$i]);
                                  for ($j=0; $j < $rowCount; $j++) { 
                                    echo $resultArrayVerbs[$i][$j].", ";
                                  }
                                ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu3" class="tab-pane fade">
      <div class="container">

      <center><img class="img-rounded" src=<?php echo '"'.$_GET['imgPath'].'1.png'.'"'; ?> alt="Smiley face"></center>

      <center><img class="img-rounded" src=<?php echo '"'.$_GET['imgPath'].'2.png'.'"'; ?> alt="Smiley face"></center>

      <center><img class="img-rounded" src=<?php echo '"'.$_GET['imgPath'].'3.png'.'"'; ?> alt="Smiley face"></center>
    </div>
    </div>
  </div>
</div>

</body>
</html>

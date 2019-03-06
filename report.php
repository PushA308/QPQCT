<?php
$quesArray = array();
$subQuesArray = array();
$COArray = array();
$resultCO;

$fileDir = "C:\\xampp\\htdocs\\www\\WebPage\\UsersData\\admin\\Makeup.xls\\";




collectData($fileDir,$quesArray,$subQuesArray,$COArray,$resultCO);

function collectData($fileDir,&$quesArray,&$subQuesArray,&$COArray,&$resultCO) {
    if (($handle = fopen($fileDir."processed_data.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($quesArray,$data[4]);
            array_push($subQuesArray,$data[5]);
        }
        fclose($handle);
    }
    if (($handle = fopen($fileDir."analysed_CO.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, ",")) !== FALSE) {
            array_push($COArray,$data[0]);
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

?>

<html>
<head>
    <style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;    
    }
</style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
    <body>
        <div class="container">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>Analysis by Course Outcomes</h3></div>
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
                                <td><?php echo $COArray[$i];?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="panel-footer"><h4>Average Quality of Question Paper is = <?php echo $resultCO; ?></h4></div>
                </div>
            </div>
        </div>
    </body>
</html>
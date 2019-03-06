<?php
$target_dir = "UsersData\\admin\\";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"])."\\";
$extOption = 1;

/*$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
*/
if(isset($_POST["submit"])) {
    if ($_POST['Mode'] === "m") {
        manualForm($extOption);
    } else {
        automaticForm($extOption);
    }
    header('Location: ../visual.php?option='.$extOption.'&imgPath='.$target_file);
}


?>

<?php



function automaticForm(&$extOption) {
	include '../runPython.php';
    $infArray = array();
    $target_dir = "../UsersData/admin/".basename($_FILES["fileToUpload"]["name"])."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    makeDirectory(basename($_FILES["fileToUpload"]["name"]));
    array_push($infArray,$target_file);
    upload($target_file);

    $collegeName = $_POST["collegeName"];
    array_push($infArray, $collegeName);

    $questionSetter = $_POST["questionSetter"];
    array_push($infArray, $questionSetter);
    //print_r($infArray);
    $fileDir = "UsersData\admin\\".basename($_FILES["fileToUpload"]["name"])."\\";
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $extOption= 1;
    tp($fileDir,$fileName,"1");
}

function manualForm(&$extOption) {
    include '../runPython.php';
    $infArray = array();
    $target_dir = "../UsersData/admin/".basename($_FILES["fileToUpload"]["name"])."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    makeDirectory(basename($_FILES["fileToUpload"]["name"]));
    array_push($infArray,$target_file);
    upload($target_file);
    
    $QuesType = $_POST["QuesType"];
    array_push($infArray,$QuesType);
    
    $Module = $_POST["Module"];
    array_push($infArray,$Module);

    $toCheck = array();
    foreach($_POST['toCheckList'] as $selected) {
        array_push($toCheck,$selected);
    }

    $options = 1;
    $extOption= 1;
    if (sizeof($toCheck) == 2) {
        $options = 4;
        $extOption= 4;     
    } elseif ($toCheck[0] == "CourseOutcome") {
        $options = 3;
        $extOption= 3;
    } elseif ($toCheck[0] == "QuestionType") {
        $options = 2;
        $extOption= 2;
    }

    array_push($infArray,$toCheck);
    
    $collegeName = $_POST["collegeName"];
    array_push($infArray, $collegeName);

    $questionSetter = $_POST["questionSetter"];
    array_push($infArray, $questionSetter);
    print_r($infArray);

    $fileDir = "UsersData\\admin\\".basename($_FILES["fileToUpload"]["name"])."\\";
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    tp($fileDir,$fileName,$options);
}

function upload($target_file) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.\r\n";
    } else {
        echo "Sorry, there was an error uploading your file.";  
    }  
}

function makeDirectory($fileName) {
	mkdir("../UsersData/admin/".$fileName,0777);
}

?>
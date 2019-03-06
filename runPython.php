<?php

//system('C:\Users\pranay\AppData\Local\Programs\Python\Python36-32\python hello.py', $retval);
//echo $retval;


function generateReport($filePath) {
	echo $filePath."=================";
}

function tp($fileDir,$fileName,$options) {
	$pythonPath = 'C:\Users\pc1\AppData\Local\Programs\Python\Python36-32\python ';

	$pythonMainFile = 'C:\xampp\htdocs\www\WebPage\BTechProject\main.py';

	$fileNameWithPath = ' C:\xampp\htdocs\www\WebPage\\'.$fileDir.' '.$options;
	echo $pythonPath.$pythonMainFile.$fileNameWithPath;
 
	//$filePath = ' C:\xampp\htdocs\www\WebPage\BTechProject'.$fileName.' 2';
	//$filePath2 = ' C:\Users\pc1\Desktop\BTechProject(1)\main.py'.$fileName.' 2';

	$res = exec($pythonPath.$pythonMainFile.$fileNameWithPath,$output,$return);
	//echo $pythonPath.$filePath;

	if($return === 0) { 
	    // exec is successful only if the $return_var was set to 0. !== means equal and identical, that is it is an integer and it also is zero.
	    foreach($output as $value){
	    echo $value . "<br>";
	    }
	}
	else{
	    echo "UnSuccessfully";
	}
}


?>
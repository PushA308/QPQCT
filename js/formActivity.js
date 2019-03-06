
function modeFunction(mode){
    //document.getElementById("generateReportButton").style.display = "block";
    //document.getElementById("SecondForm").style.display = "none";
    //document.getElementById("generateReport").disabled = false;
    if (mode == "manual"){
         document.getElementById("Manual").style.display = "block";
    } else {
        document.getElementById("Manual").style.display = "none";
    }
}

function nextForm(){
    alert();
    //document.getElementsById("QuesTypeYES").value
    document.getElementById("Manual").style.display = "none";
    document.getElementById("generateReportButton").style.display = "none";
    document.getElementById("SecondForm").style.display = "block";
    
   
    
}

function forCheck() {
    let radios = document.getElementsByName("Mode");
    if (radios[0].checked){
        atomaticForm();
    } else if (radios[1].checked) {
        manualForm();
    }
}

function atomaticForm(){
    alert(fileName);
}

function manualForm(){
    alert("1");
}
// This script captures the enter key in the On-Hand field and moves the focus to the Order field
function tabE(obj,e){
    var e=(typeof event!='undefined')?window.event:e;// IE : Moz
        if(e.keyCode==13){
            var ele = document.forms[0].elements;
            for(var i=0;i < ele.length;i++){
                var q=(i==ele.length-1)?0:i+1;// if last element : if any other
                if(obj==ele[i]){
                    ele[q].focus();
                    ele[q].value = "";
                    break;
                }
            }
            return false;
        }
    }

// This script captures the enter key in the Order field and moves the focus to the On-Hand field
function tabF(obj,e){
    var e=(typeof event!='undefined')?window.event:e;// IE : Moz
    if(e.keyCode==13){
        var ele = document.forms[0].elements;
        for(var i=0;i < ele.length;i++){
            var q=(i==ele.length-1)?0:i+1;// if last element : if any other
            if(obj==ele[i]){
                ele[q+1].focus();
                ele[q+1].value = "";
                break;
            }
        }
        return false;
    }
}

// This function clears all of the input fields
function clearEntries(){
    var	myNodes = document.getElementsByTagName("input");
    var nodeCount = myNodes.length;
    var focusHere = 0;

    for(var i=0; i < nodeCount; i++){
        if(myNodes[i].alt == "clear"){
            myNodes[i].value = "";
            if(focusHere == 0) focusHere = i;
        }
    }
    myNodes[focusHere].focus();
    return false;
}

// This function hides all of the input fields
function offCycle(){
    var	myNodes = document.getElementsByTagName("td");
    var checkNode = document.getElementById("checkNode");
    var poNode = document.getElementById("poNum");
    var poNum = poNode.innerHTML;
    var poNumEnd = poNum.substring(poNum.length-1);

    var nodeCount = myNodes.length;

    for(var i=0; i < nodeCount; i++){
        if(myNodes[i].className == "hide"){
            if(checkNode.checked) {
                myNodes[i].style.display = "none";
            } else {
                myNodes[i].style.display = "table-cell";
            }
        }
    }
    if(checkNode.checked && poNumEnd != "X") {
        poNode.innerHTML = poNode.innerHTML + "X";
    } else {
        if(poNumEnd == "X") poNode.innerHTML = poNum.substring(0,poNum.length - 1);
    }
    return false;
}
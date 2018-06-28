function setFocus(){
     document.getElementById("theSku").focus();
}
function price(){
     x=document.getElementById("cost").value;
     y=document.getElementById("multi").value;
     z=x*y;document.getElementById("retail").value=z;
}
function pop_clear(){
  document.getElementById("pop").style.visibility  = "hidden";
  document.getElementById("pop2").style.visibility  = "hidden";
  document.getElementById("screen").style.visibility  = "hidden";
}
function pop(recno){
  var doc_width = document.documentElement.clientWidth;
  doc_width = doc_width/2-300;
  document.getElementById("pop").style.left = doc_width+"px";
  document.getElementById("pop").style.top = "100px";
  document.getElementById("pop").style.visibility  = "visible";
  document.getElementById("screen").style.visibility  = "visible";
  document.getElementById("recspan").innerHTML  = "Record# "+ recno.toString();
  document.getElementById("record").value  = recno;
}
function pop2(recno, details){
  var doc_width = document.documentElement.clientWidth;
  var thePop = document.getElementById("pop2");
  doc_width = doc_width/2-300;
  thePop.style.left = doc_width+"px";
  thePop.style.top = "100px";
  thePop.style.visibility  = "visible";
  document.getElementById("theDet").innerHTML = details;
  document.getElementById("screen").style.visibility  = "visible";
  document.getElementById("recspan2").innerHTML  = "Record# "+ recno.toString();
  document.getElementById("record2").value  = recno;
}
function checkSku(){
    var sku = document.getElementById('theSku');
    var inputs = document.getElementsByTagName('input');
    for(var i=0; i<inputs.length; i++){
        if(inputs[i].name.slice(0,3) == "sku"){
            inputs[i].style.backgroundColor = "#FFFFFF";
            if(inputs[i].value == sku.value.toUpperCase()){
                alert("This SKU is already In Use");
                inputs[i].style.backgroundColor = "#FF99CC";
                sku.value = "";
                inputs[i].focus();
            }
        }
    }
}
function catPop(){
  var divSelect = document.getElementById('departments');
  var pack = document.getElementById('pack');
  divSelect.style.visibility = "visible";
}
function catUnPop(){
  var divSelect = document.getElementById('departments');
  setTimeout(function(){divSelect.style.visibility = "hidden";pack.focus();},500);;
}
function putCat(cat){
 var divSelect = document.getElementById('deptAdd');
 divSelect.value = cat;
}
function retailCalc(obj, e){
    var	myNodes = document.getElementsByTagName("input");
    var lookUp = "r" + obj.alt;
    var cost = obj.value;
    var multi = document.getElementById("multi").value;
    var retail = cost * multi;
    var nodeCount = myNodes.length;
    var focusHere = 0;

    for(var i=0; i < nodeCount; i++){
        if(myNodes[i].alt == lookUp){
            myNodes[i].value = retail.toFixed(2);
            if(focusHere == 0) focusHere = i;
            break;
        }
    }
    myNodes[focusHere].select();
    return false;
}
// this function submits the form to delete the current vendor
// it is only available if there  are no items associated with the vendor
function deleteVendor(){
    // get the form object
    var form = document.getElementById('delVen');

    // display and get the confirmation
    var confrimed = confirm("Delete this vendor?\nThis action is not reversable!");

    // if confirmed submit the form
    if(confrimed){
        form.action = "processVenDel.php";
        form.submit();
    }
}
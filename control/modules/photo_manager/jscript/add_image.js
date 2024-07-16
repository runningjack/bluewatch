// Add element
function addEvent() {
var showelem = document.getElementById('filediv');
var numi = document.getElementById('theValue');
var num = (document.getElementById("theValue").value -1)+ 2;
numi.value = num;
var divIdName = "my"+num+"Div";
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
//newdiv.innerHTML = "<input name='ProductCode"+num+"' type='file' id='ProductCode"+num+"' /><a href=\"javascript:;\" onclick=\"removeElement(\'"+divIdName+"\')\">&nbsp;Remove</a>";
newdiv.innerHTML = "<input name='img[]' type='file' id='img' /><a href=\"javascript:;\" onclick=\"removeElement(\'"+divIdName+"\')\">&nbsp;Remove</a>";
showelem.appendChild(newdiv);
}

// Remove element
function removeElement(divNum) {
var d = document.getElementById('filediv');
var olddiv = document.getElementById(divNum);
d.removeChild(olddiv);
}

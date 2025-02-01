/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkID(){
    var id = document.getElementById('id').value;
    var thisRegex = new RegExp(/^E\d{5}$/);
    if(id.length == 0){
        document.getElementById("id1").innerHTML = "Please enter <b>Event ID</b>.";
        return false;
    }else if(!thisRegex.test(id)){
        document.getElementById("id1").innerHTML = "Valid Format Eg : <b>E99999</b>.";
        return false;
    }else{
        document.getElementById("id1").innerHTML = "";
        return true;
    }
}
function checkName(){
    var name = document.getElementById("name").value;
    if(name.length == 0){
        document.getElementById("name1").innerHTML = "Please enter <b>Event Name</b>.";
    }else{
        document.getElementById("name1").innerHTML = "";
    }
}
function checkLoc(){
    var loc = document.getElementById("loc").value;
    if(loc.length == 0){
        document.getElementById("loc1").innerHTML = "Please enter <b>Event Location</b>.";
    }else{
        document.getElementById("loc1").innerHTML = "";
    }
}
function checkOrg(){
    var org = document.getElementById("org").value;
    if(org.length == 0){
        document.getElementById("org1").innerHTML = "Please enter <b>Organizer Name</b>.";
    }else{
        document.getElementById("org1").innerHTML = "";
    }
}
function checkDesc(){
    var desc = document.getElementById("desc").value;
    if(desc.length == 0){
        document.getElementById("desc1").innerHTML = "Please enter <b>Event Description</b>.";
    }else{
        document.getElementById("desc1").innerHTML = "";
    }
}
function checkTicket(){
    var thisRegex = new RegExp(/^\d+$/);
    var ticket = document.getElementById("ticket").value;
    if(ticket.length == 0){
        document.getElementById("ticket1").innerHTML = "Please enter <b>Ticket Stock</b>.";
    }else if(!thisRegex.test(ticket)){
        document.getElementById("ticket1").innerHTML = "<b>Numeric only</b>.";
    }else{
        document.getElementById("ticket1").innerHTML = "";
    }
}

function checkDate(){     //make sure event inserted is at least one month from today
    var sDate = document.getElementById("startDate").value;
    var eDate = document.getElementById("endDate").value;
    var today = new Date();
    today.setMonth(today.getMonth() + 1);
    var mysDate = new Date(sDate);
    var myeDate = new Date(eDate);
    if(mysDate < today){
        document.getElementById("date1").innerHTML = "<b>Error Date</b>.";
    }else{
        document.getElementById("date1").innerHTML = "";
    }
    if(myeDate < today || myeDate < mysDate){
        document.getElementById("date2").innerHTML = "<b>Error Date</b>.";
    }else{
        document.getElementById("date2").innerHTML = "";
    }
}


function display(x){  //display textbox if fee is required
    if(x == 0){
        document.getElementById("price").style.display = 'block';
    }else{
        document.getElementById("price").style.display = 'none';
    }
    return;
}

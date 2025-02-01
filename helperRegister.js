/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//for check validate the user id 
function checkID(){
    var id = document.getElementById("userID1").value;
    var reg = new RegExp(/^[A-Za-z0-9]{8,20}$/);
    if(id.length == 0){
        document.getElementById("id1").innerHTML = "Please enter <b>Username</b>.";
    }else if(!reg.test(id)){
        document.getElementById("id1").innerHTML = "Invalid <b>Username</b> Format.";
    }else{
        document.getElementById("id1").innerHTML = "";
    }
}
function checkIC(){
    var ic = document.getElementById('ic').value;
    var reg = new RegExp(/^([0-9][0-9])((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))\-([0-9][0-9])\-([0-9][0-9][0-9][0-9])$/);
    if(ic.length == 0){
        document.getElementById("passw1").innerHTML = "Please enter <b>IC Number</b>.";
    }else if(!reg.test(ic)){
        document.getElementById("ic1").innerHTML = "Invalid <b>IC Number</b> Format.";
    }else{
        document.getElementById("ic1").innerHTML = "";
    }
}
function checkPsw(){
    var psw = document.getElementById("passw").value;
    var tpsw = new RegExp(/^[A-Z][A-Za-z0-9]{7,15}$/);
    
    if(psw.length == 0){
        document.getElementById("passw1").innerHTML = "Please enter <b>Password</b>.";
    }else if(!tpsw.test(psw)){
        document.getElementById("passw1").innerHTML = "First character must be <b>Uppercase</b> and <b>Minimum 8 Characters</b>.";
    }else{
        document.getElementById("passw1").innerHTML = "";
    }
}
function checkCPsw(){
    var psw = document.getElementById("passw").value;
    var psw2 = document.getElementById("cpassw").value;
    
    if(psw2.length == 0){
        document.getElementById("passw2").innerHTML = "Please enter <b>Comfirm Password</b>.";
    }else if(psw2 != psw){
        document.getElementById("passw2").innerHTML = "Comfirm Password must be <b>Same</b> to Password.";
    }else{
        document.getElementById("passw2").innerHTML = "";
    }
}
function checkName(){
    var nm = document.getElementById("name1").value;
    var tnm = new RegExp(/^[A-Za-z \'\.]{1,30}$/);
    
    if(nm.length == 0){
        document.getElementById("nm1").innerHTML = "Please enter <b>Name</b>.";
    }else if (!tnm.test(nm)){
        document.getElementById("nm1").innerHTML = "Invalid <b>Name</b> Format.";
    }else{
        document.getElementById("nm1").innerHTML = "";
    }
    
}
function checkEmail(){
    var mail = document.getElementById("email1").value;
    var tem = new RegExp(/^[\w@#$%]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
    
    if(mail.length == 0){
        document.getElementById("em1").innerHTML = "Please enter <b>Email</b>.";
    }else if (!tem.test(mail)){
        document.getElementById("em1").innerHTML = "Valid Format. Eg: <b>abc123@gmail.com</b>";
    }else{
        document.getElementById("em1").innerHTML = "";
    }
}
function checkPhoneNum(){
    var phn = document.getElementById("phonenum1").value;
    var tpn = new RegExp(/^01[0-9]-[0-9]{7,8}$/);
    
    if(phn.length == 0){
        document.getElementById("pn1").innerHTML = "Please enter <b>Phone Number</b>.";
    }else if(!tpn.test(phn)){
        document.getElementById("pn1").innerHTML = "Valid Format Eg: <b>01X-XXXXXXX<b>.";
    }else{
        document.getElementById("pn1").innerHTML = "";
    }   
}

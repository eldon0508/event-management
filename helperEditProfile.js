/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkPass(){
    var pass = document.getElementById('pw').value;
    if(pass.length == 0){
        document.getElementById('pw1').innerHTML = "Please enter <b>Password</b>.";
    }else{
        document.getElementById('pw1').innerHTML = "";
    }
}
function checkCpass(){
    var pass = document.getElementById('pw').value;
    var pass1 = document.getElementById('cpw').value;
    
    if(pass1.length == 0){
        document.getElementById('cpw1').innerHTML = "Please enter <b>Password</b>.";
    }else if(pass1 != pass){
        document.getElementById('cpw1').innerHTML = "<b>Confirm Password</b> must be same";
    }else{
        document.getElementById('cpw1').innerHTML = "";
    }
}
function checkName(){
    var name = document.getElementById('name').value;
    var thisRegex = new RegExp(/^[A-Za-z \'\.\,]+$/);
    if(name.length == 0){
        document.getElementById('name1').innerHTML = "Please enter <b>Name</b>.";
    }else if(!thisRegex.test(name)){
        document.getElementById('name1').innerHTML = "Invalid <b>Name</b> Format.";
    }else{
        document.getElementById('name1').innerHTML = "";
    }
}
function checkEmail(){
    var email = document.getElementById('email').value;
    var thisRegex = new RegExp(/^[\w@#$%]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
    if(email.length == 0){
        document.getElementById('email1').innerHTML = "Please enter <b>Email</b>.";
    }else if(!thisRegex.test(email)){
        document.getElementById('email1').innerHTML = "Invalid <b>Email </b>Format.";
    }else{
        document.getElementById('email1').innerHTML = "";
    }
}
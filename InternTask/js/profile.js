var sessionData;
function openeditbox(){
    document.getElementById("container-form").style.display = 'block';
    document.getElementById("container-edit").style.display = 'none';
}

function openinfobox(){
    document.getElementById("container-form").style.display = 'none';
    document.getElementById("container-edit").style.display = 'block';

}
function profilebtnclk() {
    document.getElementById("container-form").style.display = 'block';
    document.getElementById("container-edit").style.display = 'none';
   
    var xhr1 = new XMLHttpRequest();
    xhr1.open("GET", "./php/get_profiledata.php", true);
    xhr1.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

    }};
    xhr1.send();

setTimeout(() => { 
    //-------SESSION--------//
var xhr = new XMLHttpRequest();
xhr.open("GET", "./php/get_session.php", true);
xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        var sessionData1 = JSON.parse(this.responseText); 
        console.log(sessionData1);
        document.getElementById("h-name").textContent = sessionData1[2];
        document.getElementById("h-age").textContent = sessionData1[3];
        document.getElementById("h-dob").textContent = sessionData1[4];
        document.getElementById("h-ph").textContent = sessionData1[5];
    }
};
xhr.send();
//--------SESSION-------//
}, 500);
}
function logoutbtnclk() {
    window.location.href = 'http://localhost/InternTask/index.html';
}
function load(){
    document.getElementById("container-form").style.display = 'none';
    document.getElementById("container-edit").style.display = 'none';
    //-------SESSION--------//
var xhr = new XMLHttpRequest();
xhr.open("GET", "./php/get_session.php", true);
xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        var sessionData1 = JSON.parse(this.responseText); 
        console.log(sessionData1[2]);
        document.getElementById("heading").textContent="Welcome "+sessionData1[2];
    }
};
xhr.send();
//--------SESSION-------//
}

document.getElementById('updatebtn').addEventListener('click', function(event) {
    event.preventDefault();
    var age = document.getElementById("update-age").value;
    var dob = document.getElementById("update-dob").value;
    var ph = document.getElementById("update-ph").value;
  

     //AJAX request
 const xhr = new XMLHttpRequest();
 xhr.open('POST', './php/profile.php', true);
 xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 xhr.onreadystatechange = function () {
   if (xhr.readyState === XMLHttpRequest.DONE) {
     if (xhr.status === 200) {
       console.log(xhr.responseText); // Print the response from PHP
     } else {
       console.error('Error:', xhr.status);
     }
   }
 };
 // Combine both sets of data and send them together
 xhr.send('age=' + encodeURIComponent(age) + '&dob=' + encodeURIComponent(dob) + '&ph=' + encodeURIComponent(ph));
//---------------END AJAX-------//
setTimeout(() => {  profilebtnclk(); }, 1000);

});
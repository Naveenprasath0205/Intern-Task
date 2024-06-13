document.getElementById('loginbtn').addEventListener('click', function(event) {
  var email = document.getElementById("login-email").value;
    var pass = document.getElementById("login-password").value;
    console.log(email);
    console.log(pass);

   //AJAX request
 const xhr = new XMLHttpRequest();
 xhr.open('POST', 'php/login.php', true);
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
 xhr.send('email=' + encodeURIComponent(email) + '&pass=' + encodeURIComponent(pass));
//---------------END AJAX-------//
setTimeout(() => { 
//-------SESSION--------//
var xhr1 = new XMLHttpRequest();
xhr1.open("GET", "php/get_session.php", true);
xhr1.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        var sessionData = JSON.parse(this.responseText); 
        console.log(sessionData.login);
        if(sessionData.login==1)
          {
            window.location.href='http://localhost/signuppage/profile.html';
          }
          delete sessionData;
    }
};
xhr1.send();
//--------SESSION-------//
}, 2000);
});

document.querySelector('.form-group.log-in a').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('signup-form').style.display = 'none';
    document.getElementById('container-form').style.display = 'block';
});
//-----------------------------//
document.getElementById('signupbtn').addEventListener('click', function(event) {
    event.preventDefault();
    var name = document.getElementById("signup-username").value;
    var email = document.getElementById("signup-email").value;
    var pass = document.getElementById("signup-password").value;
    //console.log(name);
   // console.log(email);
    //console.log(pass);

     //AJAX request
 const xhr = new XMLHttpRequest();
 xhr.open('POST', 'php/register.php', true);
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
 xhr.send('name=' + encodeURIComponent(name) + '&email=' + encodeURIComponent(email) + '&pass=' + encodeURIComponent(pass));
//---------------END AJAX-------// 
window.location.href = 'http://localhost/signuppage/index.html';
});


  //------DOM ACTIONS----------//
  document.querySelector('.form-group.sign-up a').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('signup-form').style.display = 'block';
    document.getElementById('container-form').style.display = 'none';

});
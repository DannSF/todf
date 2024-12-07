const arrowBack = document.getElementById('arrow-back');

arrowBack.addEventListener('click', ()=>{
    window.history.back();  
})

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    

    var formData = new FormData();
    formData.append('firstName', document.getElementById('firstName').value);
    formData.append('lastName', document.getElementById('lastName').value);
    formData.append('username', document.getElementById('username').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('password', document.getElementById('password').value);
    formData.append('confirmPassword', document.getElementById('confirmPassword').value);
    formData.append('profilePhoto', document.getElementById('profilePhoto').files[0]);

    fetch('http://localhost/Projects/TODF/index.php?action=registerUser', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
       if(data.status == 'error'){
        document.getElementById('response').innerHTML = data.message;
       }else{
        alert(data.message);
        window.history.back();  
       }
    })
    .catch(error => document.getElementById('response').innerHTML = error);
});
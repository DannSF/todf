

const navMenu = document.getElementById('nav-menu');
const navToggle = document.getElementById('nav-toggle');
const navClose = document.getElementById('nav-close');

const search = document.getElementById('search');
const searchBtn = document.getElementById('search-btn');
const searchClose = document.getElementById('search-close');

const login = document.getElementById('login');
const loginBtn = document.getElementById('login-btn');
const loginClose = document.getElementById('login-close');

const subMenu = document.getElementById('sub-menu');

const myQuestions = document.getElementById('my-questions');
const myAnswers = document.getElementById('my-answers');
const userPic = document.getElementById('user-pic');

const user = {};

navToggle.addEventListener('click', ()=>{
    navMenu.classList.add('show-menu');
})

navClose.addEventListener('click', ()=>{
    navMenu.classList.remove('show-menu');
})

searchBtn.addEventListener('click', ()=>{
    search.classList.add('show-search');
})

searchClose.addEventListener('click', ()=>{
    search.classList.remove('show-search');
})

loginBtn.addEventListener('click', ()=>{
    login.classList.add('show-login');
})

loginClose.addEventListener('click', ()=>{
    login.classList.remove('show-login');
})

function toggleSubMenu(){
    subMenu.classList.toggle("show-sub-menu");
}

if (isLoggedIn) {
    myAnswers.style.display = "block";
    myQuestions.style.display = "block";
    loginBtn.style.display = "none";  
    userPic.style.display = "block";  
} else {
    myAnswers.style.display = "none";
    myQuestions.style.display = "none";
    loginBtn.style.display = "block";  
    userPic.style.display = "none";   
}



const loginForm = document.getElementById('loginForm');
if(loginForm != null){
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
    
    
        const formData = new FormData();
        formData.append('username', document.getElementById('username').value);
        formData.append('password', document.getElementById('password').value);
    
        fetch('http://localhost/Projects/TODF/index.php?action=loginUser', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Welcome ${data.data.username}!`);
                    window.history.back();  
                } else {
                    document.getElementById('response').innerText = data.message;
                }
            })
            .catch(error => console.error('Error:', error));
    });
}

const updateForm = document.getElementById('updateForm');
if(updateForm != null){
    updateForm.addEventListener('submit', function(event) {
        event.preventDefault();
   
    
        const formData = new FormData();
        formData.append('memberId', memberID);
        formData.append('firstName', document.getElementById('firstName').value);
        formData.append('lastName', document.getElementById('lastName').value);
        formData.append('email', document.getElementById('email').value);

        
    
        fetch('http://localhost/Projects/TODF/index.php?action=updateUser', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    document.getElementById('response').innerText = data.message;
                }
            })
            .catch(error => console.error('Error:', error));
    });
}








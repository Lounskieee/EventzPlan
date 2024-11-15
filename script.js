const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signUp');

signUpButton.addEventListener('click', function() {
    signInForm.style.display = 'none';
    signUpForm.style.display = 'block';
});

signInButton.addEventListener('click', function() {
    signInForm.style.display = 'block';
    signUpForm.style.display = 'none';
});

function togglePassword(passwordId, iconElement) {
    var passwordField = document.getElementById(passwordId);

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        iconElement.classList.remove('fa-eye-slash');
        iconElement.classList.add('fa-eye');
    } else {
        passwordField.type = 'password';
        iconElement.classList.remove('fa-eye');
        iconElement.classList.add('fa-eye-slash')
    }
}

const texts = [
    "Let's Plan an Eventzing!!!",
    "Making Every Event Special",
    "Your Event, Our Passion",
    "Turning Moments into Memories",
    "Where Events Meet Excellence"
];

let currentIndex = 0;

function changeText() {
    const tileText = document.getElementById('tile-text');
    currentIndex = (currentIndex + 1) % texts.length;
    tileText.innerText = texts[currentIndex];
}

setInterval(changeText, 20000); 

let sections = document.querySelectorAll('section, .header-content');
let navLinks = document.querySelectorAll('nav a');

const navbarHeight = 60; 

navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        if (this.getAttribute('href') === '#home') {
            e.preventDefault(); 
            window.scrollTo({
                top: 0,
                behavior: 'smooth' 
            });
        }
    });
});

window.onscroll = () => {
    let top = window.scrollY;

    sections.forEach(sec => {
        let offset = sec.offsetTop - navbarHeight; 
        let height = sec.offsetHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + id) {
                    link.classList.add('active');
                }
            });
        }
    });
};
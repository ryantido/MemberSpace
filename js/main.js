const container = document.querySelector('.active-option');
const options = document.querySelector('.options');

function hideDropDown(){
    setTimeout(()=>{
        options.classList.add('hidden')
    }, 7500)
}
function showDropDown(){
    options.classList.remove('hidden')
}
function subHideDropDown(){
    options.className === 'options hidden' ? options.classList.remove('hidden') : options.classList.add('hidden')
    clearTimeout(()=>{
        options.className === 'options hidden' ? options.classList.remove('hidden') : options.classList.add('hidden')
    },1)
}
function redirect() {
    location.href='/index.php'
}


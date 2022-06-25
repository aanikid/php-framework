const flashMessage = document.getElementById('flashMessage');
let valueMessage = flashMessage.innerText;
if(valueMessage !== null)
{
    setTimeout(() =>{
        flashMessage.style.display = 'none'
    }, 2000)
}
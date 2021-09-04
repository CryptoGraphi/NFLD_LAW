/**
 * 
 * 
 *  file: view(dashboard) home.js
 * 
 */





let modelClose = document.getElementsByClassName('close');
let modelContainer = document.getElementsByClassName('modal');

for(let i = 0; i < modelClose.length; i++) {

    modelClose[i].addEventListener('click', () => {
         modelContainer[i].style.display = 'none';
    });
}

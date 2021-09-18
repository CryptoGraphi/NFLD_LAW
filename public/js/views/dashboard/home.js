/**
 * 
 * 
 *  file: view(dashboard) home.js
 * 
 */





let modelClose = document.getElementsByClassName('close')[0];
let modelContainer = document.getElementsByClassName('modal')[0];

modelClose.addEventListener('click', () => {
    modelContainer.style.display = 'none';
});
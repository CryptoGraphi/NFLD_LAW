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


let dialogBtn = document.getElementById('requestForm');
let container = document.getElementById('modal-request');

dialogBtn.addEventListener('click', () => {
if (container.style.display == 'none') {
    container.style.display = 'block';
} else {
    container.style.display = 'none';
}
});
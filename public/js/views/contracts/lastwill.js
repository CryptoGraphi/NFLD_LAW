/**
 * 
 *  file: (view) lastwill.js
 * 
 * 
 */

import {wizard} from '../../modules/wizard.js';


const wizardModule = new wizard();



let next = document.getElementById('btn-next');
let previous = document.getElementById('btn-back')



next.addEventListener('click', (e) => {

    e.stopImmediatePropagation();
    let pageNumber = wizardModule.getCurrentStep('step');


    switch(pageNumber)
    {
        case 0:
            alert('he');

        break;
    }

});


previous.addEventListener('click', (e) => {

    e.stopImmediatePropagation();

    let pageNumber = wizardModule.getCurrentStep('step');

    switch(pageNumber)
    {
        case 0:

        break;
    }
});
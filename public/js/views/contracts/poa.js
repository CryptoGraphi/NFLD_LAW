// poa view file

import {
    wizard
} from '../../modules/wizard.js';
import {
    modelPoa
} from '../../models/poa.js';


const wizardModule = new wizard();
var modelObject = new modelPoa();
var poa = modelObject.getObject();
let next = document.getElementById('btn-next');
let previous = document.getElementById('btn-back')
let formPannel = document.getElementsByClassName('step');


let errorMessage = undefined;
let inputFields = undefined;


const progress = 'progressBar';


//#region ui events 


// nav bar ui events 



// inner form ui  events 


// verify a document type
const verifyDocumentType = (domElement) => {

    let checkInputs = domElement.getElementsByTagName('input');
    let flag = false;
    let flagValue = undefined;

    if (checkInputs[0].checked === true ) {
        return checkInputs[0].value;
    } else if (checkInputs[1].checked === true) {
        return checkInputs[1].value;
    } 
        return false;
}

// verify tje document province 
const verifyDocumentProvince = (domElement) => {
    let selectComponet = document.querySelector('select');

    if (selectComponet.value !== '') {
        return selectComponet.value;
    } 
    
    return false;
} 


// verify the truth table for the error output 
const validateTruthTable = (truthTable) => {
    let tableMessage = [];

    for (let i = 0; i < truthTable.length; i++) {
        if (truthTable[i] === true ) {
            // push an empty string to clear the output
            tableMessage.push('');
        } else {
            tableMessage.push('Please enter an valid input');
        }
    }
    
    // send error message to the application
    wizardModule.setErrorMessage(...tableMessage);

    return validateState(truthTable);
}

// validate the application state 
const validateState = (truthTable) => {

    for (let i = 0; i < truthTable.length; i++) {
        if (truthTable[i] !== true) {
            return false;
        }
    }
    return true;
}
//  next navigation 
const verifyDocumentGrantor = (domElement) => {
    let inputs = domElement.getElementsByTagName('input');
    let truthTable = [];

        if (inputs[0].value.length > 0) {
        poa.person.name  = inputs[0].value;
        truthTable.push(true);
    } else {
        truthTable.push(false);
    }

    if (inputs[1].value.length > 0 ) {
        poa.person.address = inputs[1].value;
        truthTable.push(true);
    } else {
        truthTable.push(false);
    }
    // generate the truth table results 
    if (truthTable[0] === true && truthTable[1] === true) {
        return true;
    } else {    
        return validateTruthTable(truthTable);
    }
 }
 
 const verifyAttorneyInformation = (domElement) => {
     let inputs = domElement.getElementsByTagName('input');
     let truthTable = [];

     if (inputs[0].value.length > 0 ) {
         poa.attorney.name = inputs[0].value;
        truthTable.push(true);
     } else {
        truthTable.push(false);
     }

     if (inputs[1].value.length > 0) {
         poa.attorney.address = inputs[1].value;
        truthTable.push(true);
     } else {
        truthTable.push(false);
     }
     return validateTruthTable(truthTable);
 }


 const verifyAltAttorneyInformation = (domElement) => {
    let inputs = domElement.getElementsByTagName('input');
    let truthTable = [];

    if (inputs[0].value.length > 0 ) {
        poa.altAttorney.name = inputs[0].value;
       truthTable.push(true);
    } else {
       truthTable.push(false);
    }

    if (inputs[1].value.length > 0) {
        poa.altAttorney.address = inputs[1].value;
       truthTable.push(true);
    } else {
       truthTable.push(false);
    }
    return validateTruthTable(truthTable);
}



next.addEventListener('click', (e) => {


    e.stopImmediatePropagation();
    let pageNumber = wizardModule.getCurrentStep('step');

    switch(pageNumber)
    {
        // document type form
        case 0:
            let documentType = formPannel[0];
            if (verifyDocumentType(documentType) != false ) {
                    wizardModule.updateProgresBar(progress, 7);
                    poa.document.type = verifyDocumentType(documentType);
                    wizardModule.setErrorMessage();
                    wizardModule.show('step', 1);
            } else {    
                // trigger error
                poa.document.type = undefined;
                wizardModule.updateProgresBar(progress, 0);
                wizardModule.setErrorMessage('Please select an option inorder to continue')
            }
        break;

        // what province is the poa going to be located in 
        case 1:
            let documentProvince = formPannel[1];

            // wizard module
            if (verifyDocumentProvince(documentProvince) !== false) {
                wizardModule.setErrorMessage('');
                wizardModule.updateProgresBar(progress, 14);
                poa.document.province = verifyDocumentProvince(documentProvince);
                wizardModule.show('step', 2);
            } else {
                // trigger error
                wizardModule.updateProgresBar(progress, 7);
                wizardModule.setErrorMessage('Please select an option inorder to continue ');
                poa.document.province = undefined;
            }
        break;
        // grantor pannel
        case 2:
            let documentGrantor = formPannel[2];

            if (verifyDocumentGrantor(documentGrantor) === true) {
                wizardModule.updateProgresBar(progress, 21);
                wizardModule.show('step', 3);
            } else {
                poa.person.name = undefined;
                poa.person.address = undefined;
                wizardModule.updateProgresBar(progress, 14);
            }
        break;
        // attorney pannel
        case 3:
            let documentAttorney = formPannel[3];
            if (verifyAttorneyInformation(documentAttorney) === true) {
                 wizardModule.updateProgresBar(progress, 21);
                 wizardModule.show('step', 4);
            } else {
                poa.attorney.name = undefined;
                poa.attorney.address = undefined;

            }
        break;
        // alt attorney 
        case 4:
            let documnetAltAttorney = formPannel[4];

            if (verifyAltAttorneyInformation(documnetAltAttorney) == true) {
                console.table(poa);
            } else {
                poa.altAttorney.name = undefined;
                poa.altAttorney.address = undefined;
            }
        break;

        
    }

});

// previous navigation

previous.addEventListener('click', (e) => {
    e.stopImmediatePropagation();
    let pageNumber = wizardModule.getCurrentStep('step');
    
    
    switch(pageNumber)
    {
        case 0:
            

        break;
    }

});



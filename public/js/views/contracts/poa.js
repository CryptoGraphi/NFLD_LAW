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


// restrictions ui pannel
let restrictionsTrue = document.getElementById('form-restrictions-true');
let restrictionsFalse = document.getElementById('form-restrictions-false');
let restrictionsPannel = document.getElementById('form-restrictions-pannel');

restrictionsTrue.addEventListener('click', () => {
    restrictionsPannel.hidden = false;
});

restrictionsFalse.addEventListener('click', () => {
    restrictionsPannel.hidden = true;
});


// account form section.... 

let financialReportsTrue = document.getElementById('form-financial-reports-true');
let financialReportsFalse = document.getElementById('form-financial-reports-false');
let finacialPannel = document.getElementById('form-accountant-wrapper');


financialReportsTrue.addEventListener('click', () => {
    finacialPannel.hidden = false;
});


financialReportsFalse.addEventListener('click', () => {
    finacialPannel.hidden = true;
});

// end of accoutns report section ui.... 



// attorney termination ui events 

let poaTerminationTrue = document.getElementById('poa-termination-true');
let poaTerminationFalse = document.getElementById('poa-termination-false');
let poaTerminationPannel = document.getElementById('poa-date-pannel');


poaTerminationTrue.addEventListener('click', () => {
    poaTerminationPannel.hidden = false;
});

poaTerminationFalse.addEventListener('click', () => {
    poaTerminationPannel.hidden = true;
});

// end of attorney termination ui events 


// nav bar ui events 


let navbarStarted = document.getElementById('nav-tab-started');
let navbarAgent = document.getElementById('nav-tab-agent');
let navbarPowers = document.getElementById('nav-tab-powers');
let navbarRestrictions = document.getElementById('nav-tab-restrictions');
let navbarMisc = document.getElementById('nav-tab-misc');
let navbarSigning = document.getElementById('nav-tab-signing');
let navigationBarElement = document.getElementsByClassName('navigation')[0];

const clearNavTabs = (domElement, index = null) => {
    let navTabs = domElement.querySelectorAll('.nav-link');

    for (let tabs of navTabs) {
        tabs.classList.remove('active');
    }
}



navbarStarted.addEventListener('click', () => {
    clearNavTabs(navigationBarElement);
    let tab =  navbarStarted.querySelector('.nav-link');
    tab.classList.add('active');
    wizardModule.show('step', 0);
});


navbarAgent.addEventListener('click', () => {
    clearNavTabs(navigationBarElement);
    let tab =  navbarAgent.querySelector('.nav-link');
    tab.classList.add('active');
    wizardModule.show('step', 3);
});

navbarPowers.addEventListener('click', () => {
    clearNavTabs(navigationBarElement);
    let tab =  navbarPowers.querySelector('.nav-link');
    tab.classList.add('active');
    wizardModule.show('step', 5);
});


navbarRestrictions.addEventListener('click', () => {
    clearNavTabs(navigationBarElement);
    let tab =  navbarRestrictions.querySelector('.nav-link');
    tab.classList.add('active');
    wizardModule.show('step', 8);
});

navbarMisc.addEventListener('click', () => {
    clearNavTabs(navigationBarElement);
    let tab =  navbarMisc.querySelector('.nav-link');
    tab.classList.add('active');
    wizardModule.show('step', 9);
});


navbarSigning.addEventListener('click', () => {
    clearNavTabs(navigationBarElement);
    let tab =  navbarSigning.querySelector('.nav-link');
    tab.classList.add('active');
    wizardModule.show('step', 12);
});



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
            tableMessage.push('Please enter some valid input inorder to continue!!');
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


// reset the object state  => void function 
// might add a state checker inorder to have some sort of checking as i dont trust any i/o operations
const clearObjectState = (object) => {
    let keyIndex = Object.key(object);

    for (let i = 0; i < keyIndex.length; i++) {
        
        // reset all propertys in the object that do exist to clear the objects state
        if (object[keyIndex[i]] !== undefined ) {
            object[keyIndex[i]] = undefined;
        }
    
    }
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



const verifyAttorneyPowers = (domElement) => {
    let inputs = domElement.getElementsByTagName('input');
    let truthTable = [];

    if (inputs[0].checked === true || inputs[1].checked === true) {
        if (inputs[0].checked === true) {
            poa.powers.generalAuthority = true; 
        } else if (inputs[1].checked === true) {
            poa.powers.generalAuthority = false;
        }
        truthTable.push(true);
    } else {
        truthTable.push(false);
    }
     return validateTruthTable(truthTable);
}


const grantAttorneyPowers = (domElement) => {

    let inputs = domElement.getElementsByTagName('input');
    let keyIndex = Object.keys(poa.powers);

        for (let i = 0; i < inputs.length; i++) {

            if (inputs[i].checked === true) {
                poa.powers[keyIndex[i+1]] = inputs[i].value;
            } else {
                poa.powers[keyIndex[i+1]] = undefined;
            }
        }
    return true;
}


const grantLimitedPowers = (domElement) => {

    let inputs = domElement.getElementsByTagName('input');
    let keyIndex = Object.keys(poa.limited);

    let selectorInput = domElement.getElementsByTagName('input');

    if (selectorInput[0].checked === true  || selectorInput[1].checked === true ) {

   

    // find all data keys for our form 
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].checked === true) {
                poa.limited[keyIndex[i]] = inputs[i].value;
            } else {
                poa.limited[keyIndex[i]] = undefined;
            }
        } 
        return true;
    }
    return false;
}

const verifyRestrictions = (domElement) => {

    let inputs = domElement.querySelectorAll('input[type=checkbox]');
    let keyIndex = Object.keys(poa.restrictions);
    let truthTable = [];

    let selectInputs = domElement.querySelectorAll('input');

    if (selectInputs[0].checked == true || selectInputs[1].checked === true) {
  
        wizardModule.setErrorMessage('');
       if (selectInputs[0].checked === true ) {
            poa.restrictions.setRestrictions = true;   
            truthTable.push(true);
           
       } else if (selectInputs[1].checked === true) {
            poa.restrictions.setRestrictions = false; 
            truthTable.push(true);
       } 
    } else {
        // display error message 
        truthTable.push(false);
        poa.restrictions.setRestrictions = undefined;
        wizardModule.setErrorMessage('Please select an option inorder to continue');
    }

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].checked === true) {
            poa.restrictions[keyIndex[i+1]] = inputs[i].value;
        } else {
            poa.restrictions[keyIndex[i+1]] = undefined;
        }
    }
        return validateTruthTable(truthTable);
}


const verifyAttorneyPayment = (domElement) => {
    let inputs = domElement.querySelectorAll('input');
    let truthTable = [];
    if (inputs[0].checked === true || inputs[1].checked === true) {
        truthTable.push(true)

        poa.payment.outOfPocket = undefined;
        poa.payment.lawRate = undefined;

        // reset object information

        // set inputs rules for our json about 

        if (inputs[0].checked === true) {
            poa.payment.outOfPocket = true;
        } 
        else if (inputs[1].checked === true) 
        {
            poa.payment.lawRate = true;
        }
    }  else {
        truthTable.push(false);
    }

    return validateTruthTable(truthTable);
}


const verifiyFinancialReports = (domElement) => {
    let inputs = domElement.querySelectorAll('input');
    let selector = domElement.getElementsByTagName('select')[0];
    let truthTable = [];


    if (inputs[1].checked === true || inputs[0].checked == true) {
      
    
        if (inputs[0].checked === true) { // user select finiacial reports 
            truthTable.push(true);

            if (selector.value === 'monthly' || selector.value === 'semi-yearly' ||
                selector.value === 'yearly') {
                        truthTable.push(true);
                    if (inputs[2].value.length !== 0 && inputs[3].value.length !== 0) {
                        truthTable.push(true);

                        // set values 
                        poa.financialReports = {
                            "sendReports": true,
                            "frequency": selector.value,
                            "name": inputs[2].value,
                            "address": inputs[3].value,
                        }

                    } else {
                        truthTable.push(false);
                    }
                    
            } else {
                truthTable.push(false);
            }

        } else if (inputs[1].checked === true) {    // user doesnt want finicial reports 
            // clear the object and set the value
            truthTable.push(true);

            poa.financialReports = {
                "sendReports": false,
                "frequency": undefined,
                "name": undefined,
                "address": undefined,
            }
         
        }

    } else {
        truthTable.push(false);

        poa.financialReports = {
            "sendReports": undefined,
            "frequency": undefined,
            "name": undefined,
            "address": undefined,
        }
    }

    return validateTruthTable(truthTable);
}   


const verifyAttorneyTermination = (domElement) => {

    let inputs = domElement.getElementsByTagName('input');
    let truthTable = [];
    if (inputs[0].checked === true || inputs[1].checked === true) 
    {
        truthTable.push(true);

        if (inputs[0].checked === true ) { 
            // if the user specifs a terminationn date
            if (inputs[2].value.length  > 0 ) {
                truthTable.push(true);

               poa.attorneyTermination = {
                "specifyDate": true,
                "date": inputs[2].value,
            }

            } else {
                truthTable.push(false);
            }
        } else if (inputs[1].checked === true) {
            //  no termination data specified

            // add information to the model of our application

            poa.attorneyTermination = {
                "specifyDate": false,
                "date": undefined,
            }

        }

    } else {
        truthTable.push(false);
    }

    return validateTruthTable(truthTable);
}


const verifySigningDetails = (domElement) => {
    let inputs = domElement.querySelector('input');
    let selector = domElement.querySelector('select');
    let truthTable = [];

    if (selector.value.length > 0) {
        truthTable.push(true);
        poa.signingDetails.province = selector.value;
    } else {
        truthTable.push(false);
    }

    if (inputs.value.length ) {
        truthTable.push(true);
        poa.signingDetails.city = inputs.value;

    }   else {
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
                wizardModule.updateProgresBar(progress, 28);
                wizardModule.show('step', 5);
            } else {
                wizardModule.updateProgresBar(progress, 21);
                poa.altAttorney.name = undefined;
                poa.altAttorney.address = undefined;
            }
        break;
    
        // attorney powers 
        case 5:

            let documentAttorneyPowers = formPannel[5];

            if (verifyAttorneyPowers(documentAttorneyPowers) === true) {
                wizardModule.updateProgresBar(progress, 35);
                if (poa.powers.generalAuthority === true) {
                    wizardModule.show('step', 7);
                } else {
                    wizardModule.show('step', 6);
                }
            } else {
                wizardModule.updateProgresBar(progress, 28);
                poa.powers.generalAuthority = undefined;
            }
        break;

        // grant powers
        case 6:
            let documentAttorneySpecificPowers = formPannel[6];
            if (grantAttorneyPowers(documentAttorneySpecificPowers)) {
                    wizardModule.updateProgresBar(progress, 35);
                    wizardModule.show('step', 7);
            } else {
                let objectName = Object.keys(poa.powers);
                wizardModule.updateProgresBar(progress, 28);
                for (let i = 0; i < objectName.length; i++) {
                    poa.powers[objectName[i+1]] = undefined;
                }
            }
        break;
        // limited powers form 
        case 7:
            let documentLimitedPowers = formPannel[7];

            if (grantLimitedPowers(documentLimitedPowers)) {
                wizardModule.updateProgresBar(progress, 42);
                wizardModule.show('step', 8);
            } else {
                // reset our object
                let limitedPowerObject = Object.keys(poa.limited);
                wizardModule.updateProgresBar(progress, 35);
                for (let i = 0; i < limitedPowerObject.length; i++) {
                        poa.limited[limitedPowerObject[i]] = undefined;
                }
            }

        break;
        //  restrictiohs pannel
        case 8:
            let documentRestrictions = formPannel[8];

            if (verifyRestrictions(documentRestrictions)) {
                wizardModule.updateProgresBar(progress, 49);
                wizardModule.show('step', 9);

            }  else {
                // reset models data 
                wizardModule.updateProgresBar(progress, 42);
            }
        break;
        // attorney payment 
        case 9:
            let documentAttorneyPayment = formPannel[9];

            if (verifyAttorneyPayment(documentAttorneyPayment)) {
                wizardModule.updateProgresBar(progress, 56);
                wizardModule.show('step', 10);
            } else {

                // reset the objects state
                poa.payment.outOfPocket = undefined;
                poa.payment.lawRate = undefined;

            }
        break;
        // finacial statements form
        case 10:
                let paymentPannel = formPannel[10];

                if (verifiyFinancialReports(paymentPannel)) {
                  wizardModule.updateProgresBar(progress, 64);
                  wizardModule.show('step', 11);
                } else {
                    wizardModule.updateProgresBar(progress, 56);
                }
        break;

        // attorney termination date
        case 11:
            let attorneyTermination = formPannel[11];

            if (verifyAttorneyTermination(attorneyTermination)) {
                wizardModule.updateProgresBar(progress, 72);
                wizardModule.show('step', 12);
            } else {
                wizardModule.updateProgresBar(progress, 64);
            }
        break;
        // signing details 
        case 12:
            let signingDetails = formPannel[12];
            if (verifySigningDetails(signingDetails)) {
                wizardModule.updateProgresBar(progress, 95);
                // send the form request
            } else {
                wizardModule.updateProgresBar(progress, 72);

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
        case 1:
            wizardModule.show('step', 0);
            wizardModule.updateProgresBar(progress, 0);
        break;
        case 2:
            wizardModule.show('step', 1);
            wizardModule.updateProgresBar(progress, 15)
        break;
        case 3:
            wizardModule.show('step', 2);
            wizardModule.updateProgresBar(progress, 25);
        break;

        case 4:
            wizardModule.show('step', 3);
            wizardModule.updateProgresBar(progress, 35);
        break;

        case 5:
            wizardModule.show('step', 4);
            wizardModule.updateProgresBar(progress, 40);
        break;

        case 6:
            wizardModule.show('step', 5);
            wizardModule.updateProgresBar(progress, 45);
        break;

        case 7:
            wizardModule.show('step', 6);
            wizardModule.updateProgresBar(progress, 55);
        break;

        case 8:
            wizardModule.show('step', 7);
            wizardModule.updateProgresBar(progress, 60);
        break;

        case 9:
            wizardModule.show('step', 8);
            wizardModule.updateProgresBar(progress, 65);
        break;

        case 10:
            wizardModule.show('step', 9);
            wizardModule.updateProgresBar(progress, 75);
        break;

        case 11:
            wizardModule.show('step', 10);
            wizardModule.updateProgresBar(progress, 82);

        break;
        
        case 12:
            wizardModule.show('step', 11);
            wizardModule.updateProgresBar(progress, 92);
        break;
    }

});

// form submission 


let contractForm = document.getElementById('contract-form');
let jsonData = document.getElementById('_data_');


contractForm.addEventListener('submit', (e) => {

    let signingDetails = formPannel[12];
    if (verifySigningDetails(signingDetails)) {
        wizardModule.updateProgresBar(progress, 95);
        // send the form request  
        jsonData.value = JSON.stringify(poa);
        contractForm.submit();
    } else {
        e.preventDefault();
        wizardModule.updateProgresBar(progress, 72);

    }
  
});



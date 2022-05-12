/**
 * 
 *  file: (view) lastwill.js
 * 
 * 
 */

import {
    wizard
} from '../../modules/wizard.js';
import {
    ModelLastwill
} from '../../models/lastWill.js';

const wizardModule = new wizard();
let modelObject = new ModelLastwill();
let lastWill = modelObject.getObject();
let next = document.getElementById('btn-next');
let previous = document.getElementById('btn-back')
let formPannel = document.getElementsByClassName('step');


let errorMessage = undefined;
let inputFields = undefined;


const progress = 'progressBar';


//#region ui events 


// nav bar ui events 

let tabStarted = document.getElementById('nav-tab-started');
let tabExecutor = document.getElementById('nav-tab-executor');
let tabAltExecutor = document.getElementById('nav-tab-backupExecutor');
let tabChildren = document.getElementById('nav-tab-children');
let tabGifts = document.getElementById('nav-tab-gifts');
let tabRemainder = document.getElementById('nav-tab-remainder');
let tabFinal = document.getElementById('nav-tab-final');
let tabSigning = document.getElementById('nav-tab-signing');

// navigation events 

tabStarted.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', 'Getting Started');
    wizardModule.show('step', 0);
});


tabExecutor.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', 'Executor details');
    wizardModule.show('step', 3);
});


tabAltExecutor.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', 'Backup Executor');
    wizardModule.show('step', 4);
});


tabChildren.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', 'Children');
    wizardModule.show('step', 5);
});

tabGifts.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', 'Gifts');
    wizardModule.show('step', 8);
});


tabRemainder.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', 'Remainder of estate');
    wizardModule.show('step', 9);
});

tabFinal.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', "Final Details");
    wizardModule.show('step', 11);
});


tabSigning.addEventListener('click', () => {
    wizardModule.changeWizardTitle('title_', "Signing");
    wizardModule.show('step', 12);
});





// children ui events 
// does person have children

let childrenSelector = document.getElementById('form-children-selector');
let childrenTrue = document.getElementById('form-children-true');
let childrenFalse = document.getElementById('form-children-false');
let childrenAmountPannel = document.getElementById('form-children-amount-pannel');
let childFormContainer = document.getElementById('form-child-container');
let childFormTemplate = document.getElementById('form-child-template');


childrenTrue.addEventListener('click', () => {
    childrenAmountPannel.style.display = 'block';
    childrenSelector.style.display = 'block';
    lastWill.person.children = 'true';
});


childrenFalse.addEventListener('click', () => {
    childFormContainer.innerHTML = '';
    childrenAmountPannel.style.display = 'none';
    childrenSelector.style.display = 'none';
    lastWill.person.children = 'false';
});

// add the children pannel to the dom



// push the template to the relative container on the event specified 
childrenSelector.addEventListener('click', () => {

    if (childrenSelector.value.length !== 0) {
        // reset any previous forms that were appended 
        childFormContainer.innerHTML = '';
        for (let i = 0; i < childrenSelector.value; i++) {
            let cln = childFormTemplate.cloneNode(true);
            cln.hidden = false;
            let inputs = cln.querySelectorAll('input');
            inputs[1].name += i;
            inputs[2].name += i;
            cln.style.display = 'block';
            childFormContainer.appendChild(cln);
        }
    }
});


const verifyChildrenFormInput = (formPannelSelectorID) => {
    let childElement = formPannelSelectorID.querySelectorAll('li');
    let lastWill = modelObject.getObject();
    let trigger = undefined;

    // clear any inputs that is contained within the object 

    lastWill.children.name = [];
    lastWill.children.dependent = [];

    for (let pannels of childElement) {
        let inputs = pannels.querySelectorAll('input');
        let errors = pannels.querySelectorAll('.error-message');

        // clear out information inside of the model

        if (inputs[0].value.length !== 0) {
            errors[0].innerHTML = '';
            lastWill.children.name.push(inputs[0].value);
        } else {
            // reset our model too 
            trigger = false;
            errors[0].innerHTML = 'Please choose an option';
        }

        if (inputs[1].checked === true || inputs[2].checked === true) {
            errors[1].innerHTML = '';
            // append information to the model we have
            if (inputs[1].checked === true) {
                lastWill.children.dependent.push(inputs[1].value);
            }
            if (inputs[2].checked == true) {
                lastWill.children.dependent.push(inputs[2].value);
            }
        } else {
            // trigger error here
            trigger = false;
            errors[1].innerHTML = 'Please select an option <br/>';
        }
    }
    // check if our flag has been set if so then we will 
    if (trigger === false) {
        lastWill.children.name = [];
        lastWill.children.dependent = [];
        return false;
    }
    // all of bases cases were satified so we will let the application know it an all go :)
    return true;
}

// endof children ui events


// start of guardian ui events

let inputGuardianTrue = document.getElementById('input-apointguardian-true');
let inputGuardianFalse = document.getElementById('input-apointguardian-false');
let guardianForm = document.getElementById('form-apointGuardian');

inputGuardianTrue.addEventListener('click', () => {
    lastWill.guardian.apointGuardian = true;
    guardianForm.hidden = false;
});

inputGuardianFalse.addEventListener('click', () => {
    lastWill.guardian.appintGuardian = false;
    guardianForm.hidden = true;
});

// helper function inorder to validate the input 
const verifyGuardianForm = (domElement) => {
    let inputs = domElement.querySelectorAll('input');
    let selector = domElement.querySelector('select');
    let flag = undefined;
    let errors = domElement.querySelectorAll('.error-message');
    let lastWill = modelObject.getObject();

    if (inputs[0].value.length !== 0) {
        errors[0].innerHTML = '';
        lastWill.guardian.name = inputs[0].value;
    } else {
        //trigger error
        errors[0].innerHTML = 'Please fill out field it is required';
        flag = false;
    }

    if (inputs[1].value.length !== 0) {
        errors[1].innerHTML = '';
        lastWill.guardian.city = inputs[1].value;
    } else {
        errors[1].innerHTML = 'Please fill out fiedl it is required';
        flag = false;
    }

    if (selector.value !== '') {
        errors[2].innerHTML = '';
        lastWill.guardian.province = selector.value;
    } else {
        errors[2].innerHTML = 'Please select an option inorder to continue';
        flag = false;
    }

    if (flag === false) {
        // clear object 
        lastWill.guardian.name = undefined;
        lastWill.guardian.province = undefined;
        lastWill.guardian.city = undefined;
        return false;
    }

    return true;
}
// end of guardian ui events 


// start of delay inheritance ui events 

let delayInheritanceTrue = document.getElementById('form-delayInheritance-true');
let delayInheritanceFalse = document.getElementById('form-delayInheritance-false');
let delayInheritanceForm = document.getElementById('delayInheritance-form');
delayInheritanceTrue.addEventListener('click', () => {
    lastWill.Inheritance.delay = 'true';
    delayInheritanceForm.hidden = false;
});

delayInheritanceFalse.addEventListener('click', () => {
    lastWill.Inheritance.delay = 'false';
    delayInheritanceForm.hidden = true;
});


// #endof delay inheritance ui events 


// #startof gift section ui events


let giftsInputTrue = document.getElementById('form-gifts-input-true');
let giftsInputFalse = document.getElementById('form-gifts-input-false');
let giftsAmountForm = document.getElementById('form-gifts-amount');
let giftAmountSelect = document.getElementById('form-gift-amount-select');
let giftAppendContainer = document.getElementById('form-gifts-container');


// show and hide amount selector based on wether or not 
// the user selects this option
giftsInputTrue.addEventListener('click', () => {
    giftsAmountForm.hidden = false;

});

giftsInputFalse.addEventListener('click', () => {
    // clear any of the input that we require
    giftAppendContainer.innerHTML = '';
    giftsAmountForm.hidden = true;
});


giftAmountSelect.addEventListener('click', (e) => {

    // clear any previous input 
    giftAppendContainer.innerHTML = '';
    for (let i = 0; i < giftAmountSelect.value; i++) {
        let giftBaseTemplate = document.querySelector('.gift-type-container');
        let clone = giftBaseTemplate.cloneNode(true);
        clone.hidden = false;
        let tmpInputs = clone.querySelectorAll('input');

        tmpInputs[0].name += i;
        tmpInputs[1].name += i;

        // attribe settings for our cloned node 
        giftAppendContainer.appendChild(clone);
    }

    // add event for our radio selector to append templates

    let giftTypeTemplates = document.getElementsByClassName('gift-container-templates')[0];
    let giftIndividualTemplate = giftTypeTemplates.querySelector('.form-individual');
    let giftCharityTemplate = giftTypeTemplates.querySelector('.form-charity');


    let giftForms = giftAppendContainer.querySelectorAll('.gift-type-container');

    // populate forms AND ADD RESPECTED EVEN LISTENERS FOR THE DOM ELEMENTS 

    for (let pannels of giftForms) {
        let getInputs = pannels.querySelectorAll('input');
        let formContainer = pannels.querySelector('.gift-form-container');

        let charity = getInputs[0];
        let individual = getInputs[1];

        // apend forms based on the inputs by the user 

        charity.addEventListener('click', (e) => {
            formContainer.innerHTML = '';
            e.stopImmediatePropagation();
            formContainer.appendChild(giftCharityTemplate.cloneNode(true));
        });


        individual.addEventListener('click', (e) => {
            formContainer.innerHTML = '';
            e.stopImmediatePropagation();
            formContainer.appendChild(giftIndividualTemplate.cloneNode(true));
        });
    }

});


const validateFormGifts = (domElement) => {

    let giftTypeForm = domElement.querySelectorAll('.gift-type-container');
    let flag = '';
    let lastWill = modelObject.getObject();

    for (let pannels of giftTypeForm) {
        let charity = pannels.querySelectorAll('input')[0];
        let individual = pannels.querySelectorAll('input')[1];
        let dataPannel = pannels.querySelector('.gift-form-container');
        let errorMessage = pannels.querySelectorAll('.error-message');
        let dataInput = dataPannel.querySelectorAll('input');
        let dataSelect = dataPannel.querySelector('select').value;

        // push all data to our model
        if (charity.checked === true) {
            if (dataInput[0].value.length !== 0) {
                errorMessage[0].innerHTML = '';
                lastWill.gifts.charity.description.push(dataInput[0].value);
            } else {
                errorMessage[0].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }

            if (dataInput[1].value.length !== 0) {
                errorMessage[1].innerHTML = '';
                lastWill.gifts.charity.name.push(dataInput[1].value);
            } else {
                errorMessage[1].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }

            if (dataInput[2].value.length !== 0) {
                errorMessage[2].innerHTML = '';
                lastWill.gifts.charity.number.push(dataInput[2].value);
            } else {
                errorMessage[2].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }

            if (dataInput[3].value.length !== 0) {
                errorMessage[3].innerHTML = '';
                lastWill.gifts.charity.city.push(dataInput[3].value);
            } else {
                errorMessage[3].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }

            if (dataSelect !== undefined) {
                errorMessage[4].innerHTML = '';
                lastWill.gifts.charity.province.push(dataSelect);
            } else {
                errorMessage[4].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }
        } else if (individual.checked === true) {

            if (dataInput[0].value.length !== 0) {
                errorMessage[0].innerHTML = '';
                lastWill.gifts.individual.description.push(dataInput[0].value);
            } else {
                errorMessage[0].innerHTML = 'Please fill out this field it is required';
                flag = false;

            }
            if (dataInput[1].value.length !== 0) {
                errorMessage[1].innerHTML = '';
                lastWill.gifts.individual.name.push(dataInput[1].value);
            } else {
                errorMessage[1].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }

            if (dataInput[2].value.length !== 0) {
                errorMessage[2].innerHTML = '';
                lastWill.gifts.individual.city.push(dataInput[2].value);

            } else {
                errorMessage[2].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }

            if (dataSelect !== undefined) {
                errorMessage[3].innerHTML = '';
                lastWill.gifts.individual.province.push(dataSelect);
            } else {
                errorMessage[3].innerHTML = 'Please fill out this field it is required';
                flag = false;
            }
        }
        // none of base cases were met 
        else {
            flag = false;
        }
    }


    const resetAllObjectData = () => {

        let lastWill = modelObject.getObject();

        // individual objects 
        lastWill.gifts.individual.description = [];
        lastWill.gifts.individual.name = [];
        lastWill.gifts.individual.city = [];
        lastWill.gifts.individual.province = [];


        // charity ds

        lastWill.gifts.charity.name = [];
        lastWill.gifts.charity.description = [];
        lastWill.gifts.charity.number = [];
        lastWill.gifts.charity.city = [];
        lastWill.gifts.charity.province = [];

    }


    if (flag === false) {
        resetAllObjectData();
    }
    return true;
}



// #end of gift section ui events

// start of remainder of estate section 

let remainderTemplateContainer = document.getElementsByClassName('form-remainder-template')[0];
let remainderFormContainer = document.getElementById('form-remainder-container');
let btnAddRemainder = document.getElementById('btn-add-remainder');

btnAddRemainder.addEventListener('click', () => {
    let recipientType = remainderTemplateContainer.querySelector('.form-template-type').cloneNode(true);
    let recipientIndividual = remainderTemplateContainer.querySelector('.form-template-individual');
    let recipientCharity = remainderTemplateContainer.querySelector('.form-template-charity');


    recipientType.hidden = false;
    remainderFormContainer.appendChild(recipientType);

    let newContainerInputs = remainderFormContainer.querySelectorAll('.form-template-type');


    for (let forms of newContainerInputs) {

        let inputs = forms.querySelectorAll('input');
        let newPannelFormContainer = forms.querySelector('.form-remainder-content');

        let btnRecipientBusiness = inputs[0];
        let btnRecipientIndividual = inputs[1];


        btnRecipientBusiness.addEventListener('click', () => {
            newPannelFormContainer.innerHTML = '';
            newPannelFormContainer.appendChild(recipientCharity.cloneNode(true));

            newPannelFormContainer.querySelector('.remove-radius').addEventListener('click', () => {
                newPannelFormContainer.parentNode.remove();
            });
        });

        btnRecipientIndividual.addEventListener('click', () => {
            newPannelFormContainer.innerHTML = '';
            newPannelFormContainer.appendChild(recipientIndividual.cloneNode(true));

            newPannelFormContainer.querySelector('.remove-radius').addEventListener('click', () => {
                newPannelFormContainer.parentNode.remove();
            });
        });
    }


});


// inorder to append data to our object 
const verifyRemainderForm = (domElement) => {

    let containers = domElement.querySelectorAll('.form-template-type');
    let lastWill = modelObject.getObject().remainder;
    let shareArray = [];
    let trigger = '';
    for (let pannels of containers) {
        let radios = pannels.querySelectorAll('input[type=radio]');
        let contentContainer = pannels.querySelector('.form-remainder-content');
        let pannelErrorMessage = pannels.querySelector('.error-message');
        let charity = radios[0];
        let individual = radios[1];





        if (charity.checked === true) {
            pannelErrorMessage.innerHTML = '';
            let formInputs = contentContainer.querySelectorAll('input');
            let formError = contentContainer.querySelectorAll('.error-message');
            let formSelect = contentContainer.querySelector('select');

            // charity inputs 

            if (formInputs[0].value.length !== 0) {
                lastWill.charity.name.push(formInputs[0].value);
                formError[0].innerText = '';

            } else {
                trigger = false;
                formError[0].innerText = "Please fill in  field this field is required";
            }

            if (formInputs[1].value.length !== 0) {
                lastWill.charity.number.push(formInputs[1].value);
                formError[1].innerText = '';
            } else {
                trigger = false;
                formError[1].innerText = "Please fill in  field this field is required";
            }

            if (formInputs[2].value.length !== 0) {
                formError[2].innerText = '';
                lastWill.charity.city.push(formInputs[2].value);
            } else {
                trigger = false;
                formError[2].innerText = "Please fill in  field this field is required";
            }


            if (formSelect.value !== '') {
                formError[3].innerText = '';
                lastWill.charity.province.push(formSelect.value);
            } else {
                trigger = false;
                formError[3].innerText = "Please fill in field this field is requireed";
            }

            if (formInputs[3].value.length !== 0) {
                formError[4].innerText = '';

                if (formInputs[3].value <= 100) {
                    formError[4].innerText = '';
                    lastWill.charity.share.push(formInputs[3].value);
                    shareArray.push(formInputs[3].value);


                } else {
                    trigger = false;
                    formError[4].innerText = "Please enter a number below 100";
                }

            } else {
                trigger = false;
                formError[4].innerText = "Please fill in  field this field is required";
            }


        } else if (individual.checked === true) {
            pannelErrorMessage.innerHTML = '';
            let formInputs = contentContainer.querySelectorAll('input');
            let formError = contentContainer.querySelectorAll('.error-message');
            let formSelect = contentContainer.querySelector('select');
            // verify the inputs 
            if (formInputs[0].value.length !== 0) {
                formError[0].innerText = '';
                lastWill.individual.name.push(formInputs[0].value);
            } else {
                trigger = false;
                formError[0].innerText = "Please fill in  field this field is required";
            }
            if (formInputs[1].value.length !== 0) {
                formError[1].innerText = '';
                lastWill.individual.city.push(formInputs[1].value);
            } else {
                trigger = false;
                formError[1].innerText = "Please fill in  field this field is required";
            }

            if (formSelect.value !== '') {
                formError[2].innerText = '';
                lastWill.individual.province.push(formSelect.value);
            } else {
                trigger = false;
                formError[2].innerText = "Please fill in this fields it is required";
            }

            if (formInputs[2].value.length !== 0) {
                formError[3].innerText = '';
                if (formInputs[2].value <= 100) {
                    formError[3].innerText = "";
                    shareArray.push(formInputs[2].value);
                    lastWill.individual.share.push(formInputs[2].value);
                } else {
                    trigger = false;
                    formError[3].innerText = "Please enter a number below 100";
                }
            } else {
                trigger = false;
                formError[3].innerText = "Please fill in  field this field is required";
            }
        } else {
            // trigger error for the user 
            pannelErrorMessage.innerHTML = 'Please choose an option inorder to continue';
        }

    }

    // this is to verify that our share amount is the correct amount 
    const verifyShareAmount = (number = shareArray) => {
        let sum = 0;

        for (let numbers of shareArray) {
            try {
                if (typeof parseInt(numbers) === 'number') {
                    sum += parseInt(numbers);
                }
            } catch (e) {
                return false;
            }
        }
        return sum <= 100 && sum >= 1 ? true : false;
    }
    // helper function inorder to reset our models data just incase something in ur basecase isnt met
    const resetAllInputs = () => {
        let lastWill = modelObject.getObject();

        lastWill.remainder = {
            individual: {
                "share": [],
                "name": [],
                "city": [],
                "province": [],
            },

            charity: {
                "name": [],
                "share": [],
                "number": [],
                "city": [],
                "province": []
            },
        }

        return false;
    }


    if (trigger === false) {
        return resetAllInputs();
    }

    if (verifyShareAmount() === true) {
        return true;
    } else {
        return resetAllInputs();
    }

};



// end of remainder of estate section 


// start of wipeout ui events 


let wipeoutFormContainer = document.getElementById('form-wipeout-recipient');
let btnWipeoutDistroFalse = document.getElementById('form-wipeout-distro-false');
let btnWipeoutDistroTrue = document.getElementById('form-wipeout-distro-true');

btnWipeoutDistroTrue.addEventListener('click', () => {
    wipeoutFormContainer.hidden = true;
});

btnWipeoutDistroFalse.addEventListener('click', () => {
    wipeoutFormContainer.hidden = false;
});


const verifyWipeoutForm = (domElement) => {
    let inputs = domElement.querySelectorAll('input');
    let selectInput = domElement.querySelector('select');
    let errorMessage = domElement.querySelectorAll('.error-message');
    let trigger = '';
    let lastWill = modelObject.getObject().wipeout;

    if (inputs[0].value.length !== 0) {
        errorMessage[0].innerHTML = '';
        lastWill.name = inputs[0].value;
    } else {
        trigger = false;
        errorMessage[0].innerHTML = 'Please enter this field is it required';
    }

    if (inputs[1].value.length !== 0) {
        errorMessage[1].innerHTML = '';
        lastWill.city = inputs[1].value;
    } else {
        trigger = false;
        errorMessage[1].innerHTML = 'Please enter this field it is required ';
    }

    if (selectInput.value !== '') {
        errorMessage[2].innerHTML = '';
        lastWill.province = selectInput.value;

    } else {
        trigger = false;
        errorMessage[2].innerHTML = 'Please enter this field it is required ';
    }


    // reset data if cases or not met 
    const resetModel = () => {
        let lastWill = modelObject.getObject();

        lastWill.wipeout = {
            divideEstate: undefined,
            name: undefined,
            city: undefined,
            province: undefined,
        };
        return false;
    }


    if (trigger === false) {
        return resetModel();
    }
    return true;
}


// end of wipeout ui events \

// start of additional details

let additionalClauseContainer = document.getElementById('form-clause');
let additionalClauseTrue = document.getElementById('form-clause-radio-true');
let additionalClauseFalse = document.getElementById('form-clause-radio-false');


additionalClauseTrue.addEventListener('click', () => {
    additionalClauseContainer.hidden = false;
});

additionalClauseFalse.addEventListener('click', () => {
    additionalClauseContainer.hidden = true;
});


const verifyAdditionalClause = (domElement) => {
    let textarea = domElement.querySelector('textarea');
    let errorMessage = domElement.querySelector('.error-message');
    let lastWill = modelObject.getObject();


    if (textarea.value.length !== 0) {
        lastWill.provisions.additionalClause = 'true'
        lastWill.provisions.message = textarea.value;
        errorMessage.innerHTML = '';
        return true;
    } else {
        errorMessage.innerHTML = 'Please fill out this field it is required';
        lastWill.provisions.additionalClause = undefined;
        lastWill.provisions.message = undefined;
        return false;
    }
}

// end of additional details


/// #endRegion ui events 

// step wizards 
next.addEventListener('click', (e) => {


    e.stopImmediatePropagation();
    let pageNumber = wizardModule.getCurrentStep('step');


    switch (pageNumber) {
        // relationship status
        case 0:
            wizardModule.updateProgresBar(progress, 0);
            let relationshipPannel = formPannel[0];
            let relationStatus = '';
            errorMessage = relationshipPannel.querySelectorAll('.error-message');


            for (let inputs of relationshipPannel.querySelectorAll('input')) {
                if (inputs.checked === true) {
                    relationStatus = inputs.value;
                    break;
                } else {
                    relationStatus = undefined;
                }
            }
            modelObject.setProperty(lastWill.person, 'relationship', relationStatus);
            console.log(lastWill);

            if (lastWill.person.relationship !== undefined) {
                errorMessage[0].innerText = '';

                if (lastWill.person.relationship === 'married') {
                    wizardModule.changeWizardTitle('title_', 'Spouses Name ');
                    wizardModule.updateProgresBar(progress, 7);
                    wizardModule.show('step', 1);
                } else if (lastWill.person.relationship === 'commonLaw') {
                    wizardModule.updateProgresBar(progress, 7);
                    wizardModule.changeWizardTitle('title_', 'Spouses Name');
                    wizardModule.show('step', 1);
                } else if (lastWill.person.relationship === 'single') {
                    wizardModule.updateProgresBar(progress, 7);
                    wizardModule.changeWizardTitle('title_', 'Testors Information');
                    wizardModule.show('step', 2);
                } else {
                    // destroy input 
                    lastWill.person.relationship = undefined;
                }
            } else { // do error stuff 
                errorMessage[0].innerText = "Please select an option inorder to continue";
            }
            break;
            // spouses name 
        case 1:

            let spousePannel = formPannel[1];
            errorMessage = spousePannel.querySelectorAll('.error-message');

            if (spousePannel.querySelector('input').value.length !== 0) {
                wizardModule.updateProgresBar(progress, 14);
                errorMessage[0].innerHTML = '';
                modelObject.setProperty(lastWill.person, 'spouse', spousePannel.querySelector('input').value);
                wizardModule.updateProgresBar(progress, 14);
                wizardModule.changeWizardTitle('title_', 'Personal Information');
                wizardModule.show('step', 2);
            } else {
                errorMessage[0].innerHTML = '<b> Invalid </b> Please fill out form';
            }
            break;
            // personal information
        case 2:
            let testorPannel = formPannel[2];
            inputFields = formPannel[2].querySelectorAll('input');
            errorMessage = testorPannel.querySelectorAll('.error-message');

            for (let i = 0; i < inputFields.length; i++) {
                if (inputFields[i].value.length === 0) {
                    errorMessage[i].innerText = 'Invalid input, Please fill out field';
                    if (i == 0) {
                        modelObject.setProperty(lastWill.person, 'name', undefined);
                    } else {
                        modelObject.setProperty(lastWill.person, 'city', undefined);
                    }
                } else {
                    errorMessage[i].innerText = '';

                    if (i === 0) {
                        modelObject.setProperty(lastWill.person, 'name', inputFields[0].value);
                    } else if (i === 1) {
                        modelObject.setProperty(lastWill.person, 'city', inputFields[1].value);
                    }
                }
            }

            if (testorPannel.querySelector('select').value.length === 0) {
                errorMessage[inputFields.length].innerText = 'Invalid input, Please fill out field';
                modelObject.setProperty(lastWill.person, 'province', undefined);
            } else {
                errorMessage[inputFields.length].innerText = '';
                modelObject.setProperty(lastWill.person, 'province', testorPannel.querySelector('select').value);
            }

            // check or model object to see if our object has been set
            if (lastWill.person.name !== undefined && lastWill.person.city !== undefined && lastWill.person.province !== undefined) {
                wizardModule.updateProgresBar(progress, 21);
                wizardModule.changeWizardTitle('title_', 'Executor Details');
                wizardModule.show('step', 3);
            }
            break;
            // executor 
        case 3:
            let executor = formPannel[3];
            inputFields = executor.querySelectorAll('input');
            errorMessage = executor.querySelectorAll('.error-message');
            let inputProvince = executor.querySelector('select');

            for (let i = 0; i < inputFields.length; i++) {
                if (inputFields[i].value.length === 0) {
                    errorMessage[i].innerText = 'Invalid input, please fill out fields to continue';
                    if (i === 0) {
                        modelObject.setProperty(lastWill.executor, 'name', undefined);

                    } else if (i === 1) {
                        modelObject.setProperty(lastWill.executor, 'city', undefined);
                    }

                } else {
                    errorMessage[i].innerText = '';

                    if (i === 0) {
                        modelObject.setProperty(lastWill.executor, 'name', inputFields[0].value);

                    } else if (i === 1) {
                        modelObject.setProperty(lastWill.executor, 'city', inputFields[1].value);
                    }
                }
            }
            if (inputProvince.value.length === 0) {
                errorMessage[2].innerText = 'Invalid input, please fill out fields to continue';
                modelObject.setProperty(lastWill.executor, 'province', undefined);
            } else {
                errorMessage[2].innerText = '';
                modelObject.setProperty(lastWill.executor, 'province', inputProvince.value);
            }
            if (lastWill.executor.name !== undefined && lastWill.executor.city !== undefined && lastWill.executor.province !== undefined) {
                wizardModule.updateProgresBar(progress, 28);
                wizardModule.changeWizardTitle('title_', 'Backup executor details');
                wizardModule.show('step', 4);
            }
            break;
            // alt executor pannel
        case 4:
            let altExecutorPannel = formPannel[4];
            inputFields = altExecutorPannel.querySelectorAll('input');
            errorMessage = altExecutorPannel.querySelectorAll('.error-message');

            for (let i = 0; i < inputFields.length; i++) {
                if (inputFields[i].value.length === 0) {
                    errorMessage[i].innerText = 'Invalid input, please fill out fields to continue';
                    if (i === 0) {
                        modelObject.setProperty(lastWill.altExecutor, 'name', undefined);

                    } else if (i === 1) {
                        modelObject.setProperty(lastWill.altExecutor, 'city', undefined);
                    }

                } else {
                    errorMessage[i].innerText = '';

                    if (i === 0) {
                        modelObject.setProperty(lastWill.altExecutor, 'name', inputFields[0].value);

                    } else if (i === 1) {
                        modelObject.setProperty(lastWill.altExecutor, 'city', inputFields[1].value);
                    }
                }
            }
            if (altExecutorPannel.querySelector('select').value.length === 0) {
                errorMessage[2].innerText = 'Invalid input, please fill out fields to continue';
                modelObject.setProperty(lastWill.altExecutor, 'province', undefined);
            } else {
                errorMessage[2].innerText = '';
                modelObject.setProperty(lastWill.altExecutor, 'province', altExecutorPannel.querySelector('select').value);
            }
            if (lastWill.altExecutor.name !== undefined && lastWill.altExecutor.city !== undefined && lastWill.altExecutor.province !== undefined) {
                wizardModule.updateProgresBar(progress, 35);
                wizardModule.changeWizardTitle('title_', 'Children');
                wizardModule.show('step', 5);
            }
            break;
        case 5:
            // children pannel
            let childrenPannel = formPannel[5];

            if (childrenTrue.checked === true || childrenFalse.checked === true) {
                childrenPannel.querySelector('.error-message').innerHTML = '';
            } else {
                // display error 
                childrenPannel.querySelector('.error-message').innerHTML = "please select an option inorder to continue";
            }

            if (lastWill.person.children !== undefined) {
                if (lastWill.person.children === 'true') {
                    if (verifyChildrenFormInput(childFormContainer) === true) {
                        wizardModule.changeWizardTitle('title_', 'Appoint Guardian');
                        wizardModule.show('step', 6);
                    }
                } else if (lastWill.person.children === 'false') {
                    wizardModule.updateProgresBar(progress, 42);
                    wizardModule.changeWizardTitle('title_', 'Gifts ');
                    wizardModule.show('step', 8);
                }
            }
            break;

            // apoint guardian  
        case 6:
            let guardian = formPannel[6];
            errorMessage = guardian.querySelector('.error-message');

            if (inputGuardianFalse.checked === true) {
                errorMessage.innerText = '';
                lastWill.guardian.appointGuardian = 'false';
                wizardModule.changeWizardTitle('title_', 'Delay inheritance');
                wizardModule.show('step', 7);
                wizardModule.updateProgresBar(progress, 49);
            } else if (inputGuardianTrue.checked === true) {
                errorMessage.innerText = '';
                if (verifyGuardianForm(guardianForm) === true) {
                    wizardModule.changeWizardTitle('title_', 'Delay inheritance');
                    wizardModule.show('step', 7);
                }
            } else {
                errorMessage.innerText = 'Please select an option inorder to continue';
            }
            break;
            // delay inheritance
        case 7:
            let delayInheritance = formPannel[7];
            let delayInheritanceSelect = formPannel[7].querySelector('select');
            if (delayInheritanceTrue.checked === true ||
                delayInheritanceFalse.checked == true) {
                if (delayInheritanceTrue.checked == true) {
                    lastWill.Inheritance.age = delayInheritanceSelect.value;
                    wizardModule.updateProgresBar(progress, 56);
                    wizardModule.changeWizardTitle('title_', 'Gifts');
                    wizardModule.show('step', 8);
                } else if (delayInheritanceFalse.checked === true) {
                    lastWill.Inheritance.age = undefined;
                    wizardModule.updateProgresBar(progress, 56);
                    wizardModule.changeWizardTitle('title_', 'Gifts');
                    wizardModule.show('step', 8);
                }

                console.log(lastWill.Inheritance);
            }
            break;
            //  gifts
        case 8:
            let giftsForm = formPannel[8];
            errorMessage = giftsForm.querySelector('.error-message');
            if (giftsInputTrue.checked === true) {
                errorMessage.innerHTML = '';
                lastWill.gifts.gifts = 'true';
                if (validateFormGifts(giftAppendContainer) === true) {
                    wizardModule.updateProgresBar(progress, 63);
                    wizardModule.changeWizardTitle('title_', 'Remainder of estate');
                    wizardModule.show('step', 9);
                }
            } else if (giftsInputFalse.checked === true) {
                errorMessage.innerHTML = '';
                lastWill.gifts.gifts = 'false';
                wizardModule.updateProgresBar(progress, 63);
                wizardModule.changeWizardTitle('title_', 'Remainder of estate');
                wizardModule.show('step', 9);
            } else {
                // trigger error 
                lastWill.gifts.gifts = undefined;
                errorMessage.innerHTML = 'Please select an option inorder to continue';
            }
            break;
            // remainder of estate pannel
        case 9:
            let remainderForm = formPannel[9];
            errorMessage = remainderForm.querySelector('.error-message');

            if (verifyRemainderForm(remainderFormContainer) === true) {
                wizardModule.changeWizardTitle('title_', 'wipeout');
                wizardModule.show('step', 10);
                wizardModule.updateProgresBar(progress, 70);

            } else {

            }
            break;
            // wipeout form
        case 10:
            let wipeoutForm = formPannel[10];
            let distroFormInput = wipeoutForm.querySelector('.form-distro').querySelectorAll('input[type=radio]');
            errorMessage = wipeoutForm.querySelector('.error-message');

            if (distroFormInput[0].checked === true) {
                errorMessage.innerHTML = '';
                lastWill.wipeout.divideEstate = 'true';
                wizardModule.changeWizardTitle('title_', 'Additional details');
                wizardModule.show('step', 11);
            } else if (distroFormInput[1].checked === true) {
                errorMessage.innerHTML = '';
                if (verifyWipeoutForm(wipeoutFormContainer) === true) {
                    lastWill.wipeout.divideEstate = 'false';
                    wizardModule.changeWizardTitle('title_', 'Additional details');
                    wizardModule.show('step', 11);
                    wizardModule.updateProgresBar(progress, 77);
                }

            } else {
                errorMessage.innerHTML = "Please select an option inorder to continue";
            }
            break;
            // provisions pannel
        case 11:
            let provisions = formPannel[11];
            errorMessage = provisions.querySelector('.error-message');

            if (additionalClauseTrue.checked === true) {
                errorMessage.innerHTML = '';
                if (verifyAdditionalClause(additionalClauseContainer) === true) {
                    wizardModule.changeWizardTitle('title_', 'Signing Details ');
                    wizardModule.show('step', 12);
                    wizardModule.updateProgresBar(progress, 84);
                    next.disabled = true;
                }
            } else if (additionalClauseFalse.checked === true) {
                errorMessage.innerHTML = '';
                lastWill.provisions.additionalClause = 'false';
                wizardModule.updateProgresBar(progress, 96);
                wizardModule.changeWizardTitle('title_', 'Signing Details');
                wizardModule.show('step', 12)

                next.disabled = true;
            } else {
                errorMessage.innerHTML = 'Please select an option, inorder to continue <br/>';
            }
            // signing details 
            case 12:
                let signing = formPannel[12];
                break;
                break;

    }

});


// step wizards 
previous.addEventListener('click', (e) => {

    let currentStep = wizardModule.getCurrentStep('step');


    console.log(currentStep);
    switch (currentStep) {
        case 0:
            // show message to the user that cant go back
            wizardModule.updateProgresBar(progress, 0);
            break;
        case 1:
            wizardModule.changeWizardTitle('title_', 'Getting Started ');
            wizardModule.updateProgresBar(progress, 7);
            wizardModule.show('step', 0);
            break;
        case 2:
            wizardModule.changeWizardTitle('title_', 'Spouse');
            wizardModule.updateProgresBar(progress, 14);
            wizardModule.show('step', 1);
            break;
        case 3:
            wizardModule.changeWizardTitle('title_', 'Personal Information');
            wizardModule.updateProgresBar(progress, 21);
            wizardModule.show('step', 2);
            break;
        case 4:
            wizardModule.changeWizardTitle('title_', 'Executor');
            wizardModule.updateProgresBar(progress, 28);
            wizardModule.show('step', 3);
            break;
        case 5:
            wizardModule.changeWizardTitle('title_', 'Backup executor');
            wizardModule.updateProgresBar(progress, 35);
            wizardModule.show('step', 4);
            break;
        case 6:
            wizardModule.changeWizardTitle('title_', 'Children');
            wizardModule.updateProgresBar(progress, 42);
            wizardModule.show('step', 5);
            break;
        case 7:
            wizardModule.changeWizardTitle('title_', 'Appoint Guardian');

            wizardModule.updateProgresBar(progress, 49);
            wizardModule.show('step', 6);
            break;
        case 8:
            wizardModule.changeWizardTitle('title_', 'Delay inheritance');
            wizardModule.updateProgresBar(progress, 56);
            wizardModule.show('step', 7);
            break;
        case 9:
            wizardModule.changeWizardTitle('title_', 'Gifts');
            wizardModule.updateProgresBar(progress, 63);
            wizardModule.show('step', 8);
            break;
        case 10:
            wizardModule.changeWizardTitle('title_', 'Remainder of estate');
            wizardModule.updateProgresBar(progress, 70);

            wizardModule.show('step', 9);
            break;
        case 11:
            wizardModule.changeWizardTitle('title_', 'Wipeout condition');
            wizardModule.updateProgresBar(progress, 84);
            wizardModule.show('step', 10);
            break;
        case 12:
            wizardModule.changeWizardTitle('title_', 'Additional Provisons');
            wizardModule.show('step', 11);
            next.disabled = false;
            break;
    }
});



// pre submition checks 

let documentContainer = document.getElementById('document-content');

// inputs

documentContainer.addEventListener('submit', () => {
    let SID_TOKEN = document.getElementById('SID_TOKEN');
    let PID_TOKEN = document.getElementById('_PID_TOKEN');
    let JSON_DATA = document.getElementById('__DATA__');

    JSON_DATA.value = JSON.stringify(lastWill);

})
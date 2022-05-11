/**
 * 
 *  class: Inputvalidation 
 * 
 *  purpose: to seemsly validation user input for the class 
 */


class Validation {

    constructor()
    {

    }


    // validate the form information that we will be sending
    validateInput(inputElement, parm, value, errorWrapper, errorMessage) {
        
        try {
            if (inputElement[parm] !== value) {
                errorWrapper.innerText = '';
                return true;
            }
        } catch (e) {
            errorWrapper.innerText = errorMessage;
            return e;
        }
        return undefined;
    }

}
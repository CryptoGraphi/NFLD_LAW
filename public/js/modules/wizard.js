/**
 * 
 *  class wizard for
 * 
 *  purpose: inorder to provide wizard step interactivity
 * 
 */



export class wizard {

    // show the wizard step number we want to access 
    show(className,stepNumber)
    {
        let classObject = document.getElementsByClassName(className);

        for (let i = 0; i < classObject.length; i++) {
            classObject[i].classList.replace('active', 'hidden');
            classObject[stepNumber].classList.replace('hidden', 'active');
        }
    }

    getCurrentStep(className) 
    {
        let classObjectName = document.getElementsByClassName(className);
         for (let i = 0; i < classObjectName.length; i++) {
             if (classObjectName[i].classList.contains('active')) {
                 return i;
             }
         }
         // steps are not active 
         return false;
    }
    
    changeWizardTitle(titleID, content) {
        let titleContent = document.getElementById(titleID);
        titleContent.innerText = content;
    }

    updateProgresBar(progressBarID, value)
    {

        if (value !== null || value.length > 0)
        {
        let domElement = document.getElementById(progressBarID)
            domElement.style.width = value + "%";
            domElement.innerText = value + "%";
            return true;
        }
        return false;
    }

}
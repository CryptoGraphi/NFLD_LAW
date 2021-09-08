/**
 * 
 * 
 *  file: (controller) dashboard 
 * 
 * 
 */

import { baseClass } from "./baseClass.js";

class dashboard extends baseClass {

    constructor(){
        super();
        super.validateMethod();
       
    }

    index()
    {
        Routing.loadView('dashboard/home')
    }

    // load information models in the 
    contracts($URL = super.getMethodName(3))
    {
       
        // this is for using the third parmter as document fetching to load any scripts that are needed for the section of the page
        switch($URL){
           case "lastwill": 
                Routing.loadModel('lastWill');
                Routing.loadView('contracts/lastwill');
           break;
        }
    }
}


const dashboardController = new dashboard();
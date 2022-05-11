/**
 * 
 *  file: render (controller)
 * 
 * 
 * 
 * 
 * 
 */


 import { baseClass } from "./baseClass.js";

 class render extends baseClass {

    constructor()
    {
        super();
        this.validateMethod();        

    }

    contract()
    {        
        // load stripe library 
        Routing.loadExternalModule('https://js.stripe.com/v3/');
        Routing.loadView('render/contract');
    }
 }

 const renderController = new render();
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

        console.log('it works');
    }
 }

 const renderController = new render();
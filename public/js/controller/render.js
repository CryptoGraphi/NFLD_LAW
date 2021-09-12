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
        Routing.loadView('render/contract');
    }
 }

 const renderController = new render();
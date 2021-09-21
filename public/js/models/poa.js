/**
 * 
 *  file: poa (power of attorney ) model
 * 
 * 
 * 
 */

 import { baseModel } from "./baseModel.js";
 export { poa as modelPoa };


 class poa extends baseModel {

    constructor()
    {
        super();
        this.Model = this.Object;

        /** models data  objects  */
        

        /** 
         *   document model
         * 
         */

        this.Model.document = {
            "type": undefined,
            "province": undefined,
        }


        // person model

        this.Model.person  = {
            "name": undefined,
            "address": undefined, 
        };

        // attorney Model

        this.Model.attorney = {
            "name": undefined,
            "address": undefined,
        } 


        // alt attorney data

        this.Model.altAttorney = {
            "name": undefined,
            "address": undefined,
        }

        

    }
 }
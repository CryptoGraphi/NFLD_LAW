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


        // alt attorney object

        this.Model.altAttorney = {
            "name": undefined,
            "address": undefined,
        }


        // attorney powers object


        this.Model.powers = {
            "generalAuthority": undefined,
            "realestate": undefined,
            "homeExpenses": undefined,
            "familyExpenses": undefined,
            "taxMatters": undefined,
            "familyGifts": undefined,
            "charityGifts": undefined,
            "businessInvestments": undefined,
            "stocks": undefined,
            "employProfessionals": undefined,
        }


        // limited powers object

        this.Model.limited = {
            "propertySale": undefined,
            "propertyPurchase": undefined,
            "propertyPaymentCollection": undefined,
            "bankAccount": undefined,
        }


        // restriction object 

        this.Model.restrictions = {
            "setRestrictions": undefined,
            "independent": undefined,
            "investments": undefined,
            
        }


        // payment object 
        this.Model.payment = {
            "outOfPocket": undefined,
            "lawRate": undefined,
        }
        

        this.Model.financialReports = {
            "sendReports": undefined,
            "frequency": undefined,
            "name": undefined,
            "address": undefined,

        }


        this.Model.attorneyTermination = {
            "specifyDate": undefined,
            "date": undefined,
        }

        this.Model.signingDetails = {
            "province": undefined,
            "city": undefined,
        }

    }
 }
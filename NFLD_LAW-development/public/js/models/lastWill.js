/**
 * 
 * 
 *  lastwill: model file
 * 
 */

import { baseModel } from "./baseModel.js";

// our alais name we will import the object as 
export {lastwill as ModelLastwill };


class lastwill extends baseModel {


    constructor()
    {
        // set our object values there 

        super();
        this.Model = this.Object;


        // LAYOUT FOR THE OBJECT =

        /**
         *   person Object
         * 
         *  name = string
         *  age = number
         *  city = string
         *  spouse = string
         *  children = bool
         *  relationship = string // married /// commmon law or // single
         * 
         */
        this.Model.person = {
            "name": undefined,
            "age": undefined,
            "city": undefined,
            "province": undefined,
            "spouse": undefined,
            "children": undefined,
            "relationship": undefined
        };

        /**
         * 
         *  executor object 
         * 
         */

        this.Model.executor = {
            "name": undefined,
            "age": undefined,
            "city": undefined,
            "province": undefined
        };

        /**
         *  backup executor object 
         * 
         */

        this.Model.altExecutor = {
            "name": undefined,
            "age": undefined,
            "city": undefined,
            "province": undefined,
        };


        /***
         *  
         *  children Object 
         *
         * 
         *  name = array of children names
         *  dependent = array of dependent options either true or false
         */

        this.Model.children = {
            "name": [],
            "dependent": [],
        };

        /**
         * 
         *  guardian Object 
         * 
         *  
         * 
         */

        this.Model.guardian = {
            "apointGuardian": undefined,
            "name": undefined,
            "city": undefined,
            "province": undefined
        }

        /**
         * 
         *  inheritance Object 
         * 
         * 
         */

        this.Model.Inheritance = {
            "delay": undefined,
            "age": undefined
        }
        

        /**
         *  gifts object 
         * 
         * 
         */

        this.Model.gifts = {
            gifts: undefined, // bool value true or false

            individual: {
                "description": [],
                "name": [],
                "city": [],
                "province": [],
            },

            charity: {
                "name": [],
                "description": [],
                "number": [],
                "city": [],
                "province": []
            },
        };


        /**
         *   remainder of estate object 
         *  
         */


         this.Model.remainder = {
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
        };


        /**
         * 
         *  wipeout form
         * 
         */

        this.Model.wipeout = {
            divideEstate : undefined,
            name: undefined,
            city: undefined,
            province: undefined,
        };


        /**
         * 
         *  provisions 
         * 
         */

        this.Model.provisions = {
            additionalClause: undefined,
            message: undefined,

        };

        this.Model.signing = {
            city: undefined,
            province: undefined
        };

    }
}
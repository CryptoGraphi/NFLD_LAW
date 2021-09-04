/**
 * 
 *  class:      baseClass.js 
 * 
 *  purpose: to controller the functions that are executed based the routes path
 * 
 *  
 */


export class baseClass {


    constructor()
    {
        // add routing functions to the baseClass
        this.Routes =  new Route();
    }

    // the method name to call from our application 
    getMethodName(indexNumber)
    {
    
        let $url = window.location.pathname;
        let splitUrl = $url.split('/');
        return splitUrl[indexNumber];
    }

    // here we going to check if the method exist 
    validateMethod(url = this.getMethodName(1))
    {
       if (this.constructor.name === url || 'home') {
           return this.validateClassMethod();
       } else {
           return false;
       }
    }

    // function inorder to validate our methods if not throw an error
    validateClassMethod(url = this.getMethodName(2))
    {

        if (typeof this[url] !== 'undefined') {
            let executeFunction = this[url];
            return executeFunction();
        } else {
            if (typeof this['index'] !== 'undefined') {
                let executeFunction = this['index'];
                return executeFunction();
            } else { // this is the function doesnt exist then we will not execute anything and the baseCLass will exit
                return false;
            }
        }
    }
}
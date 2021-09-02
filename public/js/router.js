/**
 * 
 *  class: route 
 * 
 *  purpose: inorder to route javascript (file)(s) to the respected spaces
 * 
 * 
 */






// DEFUALT SETTINGS 
const ROUTE_PATH_MODULES = '/js/modules/';
const ROUTE_PATH_CONTROLLER = '/js/controller/';
const ROUTE_PATH_VIEWS = '/js/views/';
const ROUTE_PATH_ROOT = '/js/';

class Route {
    
    loadController(filename)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_CONTROLLER + filename + ".js";

       
        document.head.appendChild(script);
        return true;
    }

    loadCoreModules(filename)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_CONTROLLER + filename + ".js";
        document.head.appendChild(script);
            return true;
    }


    loadView(filename)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_VIEWS + filename + ".js";

        if (this.contentLoaded === true) {
            document.head.appendChild(script);
            return true;
        }
    }


    loadModule(filename) 
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_MODULES + filename + ".js";

        if (this.contentLoaded === true) {
            document.body.appendChild(script);
        }
    }

    // return the current path of window
    getCurrentRoute()
    {
        let $url = window.location.pathname;
        let splitUrl = $url.split('/');

        return splitUrl[1];
    }
    // load our prerequisites class we need so core classes 
    init()
    {
        try {
             this.loadCoreModules('baseClass');
        }  catch (e) {
            return e;
        }
    }

    // this will verify our routes 
    // to make sure we are not sending a empty to string or an illegal value 
    setCurrentRoute($pageParm = this.getCurrentRoute())
    {
        if (Boolean($pageParm) === false) {
            this.init();
            return false;
        } else {
            this.init();
            return this.loadController(this.getCurrentRoute());
        }
    }

}


const Routing = new Route();

// check for an empty parmater if so we will load out 
if (Routing.setCurrentRoute() === false) {
    Routing.loadController('home');
}  else {
  
}







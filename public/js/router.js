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
const ROUTE_PATH_MODELS = '/js/models/';
const ROUTE_PATH_VIEWS = '/js/views/';
const ROUTE_PATH_ROOT = '/js/';

class Route {
    
    async loadController(filename)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_CONTROLLER + filename + ".js";
        script.type = 'module';
        document.head.appendChild(script);
        return true;
    }

    async loadCoreModules(filename)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_CONTROLLER + filename + ".js";
        script.type = 'module';
        document.head.appendChild(script);
        return true;
    }


    async loadView(filename)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_VIEWS + filename + ".js";
        script.type = 'module';
        document.head.appendChild(script);
    }

    async loadModel(ModalName)
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_MODELS + ModalName + ".js";
        script.type = 'module';
        document.head.appendChild(script);
    }


    async loadModule(filename) 
    {
        let script = document.createElement('script');
        script.src = ROUTE_PATH_MODULES + filename + ".js";
        script.type = 'module';

        document.head.appendChild(script);
    }

    async loadExternalModule(url)
    {
        let script = document.createElement('script');
        script.src =  url;
        document.head.appendChild(script);
    }

    // return the current path of window
    getCurrentRoute()
    {
        let $url = window.location.pathname;
        let splitUrl = $url.split('/');

        // this will add a bases case i did not think of when i was first
        // writting this code
        if (splitUrl[1] === 'index.php') {
            return splitUrl[2];
        }
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
}
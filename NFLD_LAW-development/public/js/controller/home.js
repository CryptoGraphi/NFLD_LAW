/**
 * 
 *  class: home (controller)
 * 
 *  purpose: to add interactivity to the home content that is fetched by the server 
 */


import { baseClass} from './baseClass.js';



class home extends baseClass {

    constructor()
    {
        super();
       // console.log(this.getMethodName());
       this.validateMethod();
    }

    index()
    {
        let btnRegister = document.getElementById('btnRegisterPage');

        btnRegister.addEventListener('click', () => {
            window.location.pathname = '/home/register';
        });
    }

    login()
    {
        

    }

    about()
    {
      
    }
}


const homeController = new home();
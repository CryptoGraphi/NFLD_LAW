/**
 * 
 *  class: baseModel
 * 
 * 
 *  purpose: inorder to include our model files and  be able to do something with that infromation
 *           we will be impliments a data structure to hold the information using binary trees ( i hope )
 * 
 */


export class baseModel {

    constructor()
    {
        // return our object 
        this.Object = new Object();
    }
    
    getObject()
    {
        return this.Model;
    }


    getObjectProperty(propertyName)
    {
        let Model = this.getObject();

        return Model[propertyName];
    }

    getJsonObject()
    {
        let ObjectValue = this.getObject();

        return JSON.stringify(ObjectValue);
    }

    parseJsonObject()
    {
        let ObjectValue = this.getObject();
        return JSON.parse(ObjectValue);
    }

    // to set the values of our object 
    setProperty(ObjectName, propName, propValue)
    {
        ObjectName[propName] = propValue;
    }

    setArrayType(ObjectName, propName, ...propValue)
    {
        ObjectName[propName] = propValue;
    }


}
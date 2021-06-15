const Clinetele = require("../../model/Clinetele")
const Master = require("../../model/Master")
const customQueryService = require("../../services/customQueryService.js")
const ClineteleControllerService = require("../../services/admin/ClineteleControllerService"); 
const utils = require("../../utils/messages")
/* 
* Custom route 2 - Desc
*/
const customRoute2=async (req,res)=>{
try {
        if(combinedOutput){
            return utils.successResponse(combinedOutput,res);
        }
    } catch (error) {
        throw error;
    }
}    
/* 
* Custom action test - Route method
*/
const customAction=async (req,res)=>{
try {
    // let result =  ClineteleControllerService.customAction();
    
    let isValid={};
    let combinedOutput={};
    const validation = require("../../utils/validateRequest");  
        const query_367 = {}
        query_367.filter = {"isActive":true,"name":{"$regex":"name"}}
        
        let response1 = await customQueryService.find(Clinetele,query_367)
        combinedOutput.response1 = response1
        const query_344 = {}
        query_344.filter = {"isActive":true}
        
        let response2 = await customQueryService.find(Master,query_344)
        combinedOutput.response2 = response2
        if(combinedOutput){
            return utils.successResponse(combinedOutput,res);
        }
    } catch (error) {
        throw error;
    }
}    
module.exports={
    customRoute2,
    customAction,
}

    


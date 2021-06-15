const Clinetele = require("../../model/Clinetele")
const utils = require("../../utils/messages")
const ClineteleSchemaKey = require("../../utils/validation/ClineteleValidation");
const validation = require("../../utils/validateRequest");
const dbService = require("../../utils/dbService");
const deleteDependentService = require("../../utils/deleteDependent");

const addClinetele = async(req, res) => {
    try {
        let isValid = validation.validateParamsWithJoi(req.body,ClineteleSchemaKey.schemaKeys);
        if (isValid.error) {
            return utils.inValidParam(isValid.details, res);
        } 
        const data = new Clinetele({
            ...req.body,
        })
        let result = await dbService.createDocument(Clinetele,data);
        

        return  utils.successResponse(result, res);
    } catch (error) {
        if(error.name === "ValidationError"){
            return utils.validationError(error.message, res);
        }
        if(error.code && error.code == 11000){
            return utils.isDuplicate(error.message, res);
        }
        return utils.failureResponse(error.message,res); 
    }
}
const findAllClinetele = async(req, res) => {
    try {
        let options = {}
        let query={}
        let result;
        if(req.body.isCountOnly){
            if (req.body.query !== undefined) {
                query = { ...req.body.query }
            }
            result = await dbService.countDocument(Clinetele, query);
            if (result) {
                result = { totalRecords: result }
                return utils.successResponse(result, res);
            } 
            return utils.recordNotFound([], res)
        }
        else {
            if (req.body.options !== undefined) {
                if(req.body.options.populate){
                    delete req.body.options.populate;
                }
                options = { ...req.body.options };
                
                if(req.body.query !==undefined){
                    query={...req.body.query}
                }
                result = await dbService.getAllDocuments( Clinetele,query,options);
               
                if(!result){
                    return utils.recordNotFound([],res);
                }
                return utils.successResponse(result, res);
            }
        }
    }
    catch(error){
        return utils.failureResponse(error.message,res);
    }
}

const getClinetele = async(req, res) => {
    try {
        let query={};
        query.id = req.params.id;
        let result = await dbService.getDocumentByQuery(Clinetele,query);
        
        if(result){
            return  utils.successResponse(result, res);
        }
        return utils.recordNotFound([],res);
    }
    catch(error){
        return utils.failureResponse(error.message,res)
    }
}
const getClineteleCount = async(req, res) => {
    try {
        let where ={};
        if(req.body.where){
            where = req.body.where;
        }
        let result = await dbService.countDocument(Clinetele,where);
        if(result){
            result = {totalRecords:result}
            return utils.successResponse(result, res);
        }
        return utils.recordNotFound([],res);
    }
    catch(error){
        return utils.failureResponse(error.message,res);
    }
}

const getClineteleByAggregate = async (req,res)=>{
    try{
        let result=await dbService.getDocumentByAggregation(Clinetele,req.body);
        if(result){
            return utils.successResponse(result, res);
        }
        return utils.recordNotFound([],res);
    }catch(error){
        return utils.failureResponse(error.message,res)
    }
}
const updateClinetele = async(req, res) => {
    try {
        const data = {
                ...req.body,
            id:req.params.id
        }
        let isValid = validation.validateParamsWithJoi(
            data,
            ClineteleSchemaKey.schemaKeys
        );
        if (isValid.error) {
            return  utils.inValidParam(isValid.details, res);
        }
        let result = await dbService.findOneAndUpdateDocument(Clinetele,{_id:req.params.id},data,{new:true});
        if(!result){
            return utils.failureResponse("something is wrong",res)
        }
        
        return  utils.successResponse(result, res);
    }
    catch(error){
        if(error.name === "ValidationError"){
            return utils.isDuplicate(error.message, res);
        }
        if(error.code && error.code == 11000){
            return utils.isDuplicate(error.message, res);
        }
        return utils.failureResponse(error.message,res);
    }
}
const partialUpdateClinetele = async (req, res) => {
    try {
        const data = {
            ...req.body,
            id: req.params.id
        }
        let isValid = validation.validateParamsWithJoi(
            data,
            ClineteleSchemaKey.updateSchemaKeys
        );
        if (isValid.error) {
            return utils.inValidParam(isValid.details, res);
        }
        let result = await dbService.updateDocument(Clinetele, req.params.id, data);
        if (!result) {
            return utils.failureResponse("something is wrong", res)
        }
        
        return utils.successResponse(result, res);
    }
    catch(error){
        return utils.failureResponse(error.message, res)
    }
}
const softDeleteClinetele = async (req, res) => {
    try{
        let possibleDependent = [
  { model: 'Master', refId: 'homeId' },
  { model: 'Clinetele', refId: 'parentId' }
]
        let id = req.params.id;
        let data = await dbService.updateDocument(Clinetele, { _id:id }, { isDeleted: true, isActive:false });
        if (!data) {
            return utils.failedSoftDelete(res);
        }
        let result = await deleteDependentService.softDeleteDependent(possibleDependent,id);
        if(!result){
            return utils.failureResponse("something went wrong",res);
        }
        return  utils.successResponse(result, res);
    }catch(error){
        return utils.failureResponse(error.message,res); 
    }
}
const bulkInsertClinetele = async(req,res)=>{
    try{
        let data;   
        if(req.body.data !== undefined && req.body.data.length){
            data = req.body.data;
            let result =await dbService.bulkInsert(Clinetele,data);
            return  utils.successResponse(result, res);
        }else{
            return utils.failureResponse('Invalid Data',res)
        }  
    }catch(error){
        if(error.name === "ValidationError"){
            return utils.validationError(error.message, res);
        }
        if(error.code && error.code == 11000){
            return utils.isDuplicate(error.message, res);
        }
        return utils.failureResponse(error.message,res);
    }
}
const bulkUpdateClinetele=async(req,res)=>{
    try {
        let filter={};
        let data;
        if(req.body.filter !== undefined){
            filter = req.body.filter
        }
        if(req.body.data !== undefined){
            data = req.body.data;
            let result = await dbService.bulkUpdate(Clinetele,filter,data);
            if(!result){
                return utils.failureResponse("something is wrong.",res)
            }
            return  utils.successResponse(result, res);
        }
        else{
            return utils.failureResponse("Invalid Data", res)
        }
    }
    catch(error){
        return utils.failureResponse(error.message,res); 
    }
}
const deleteClinetele =async(req, res) => {
    try{
        let possibleDependent = [
  { model: 'Master', refId: 'homeId' },
  { model: 'Clinetele', refId: 'parentId' }
]
        let id = req.params.id;
        if (req.body.isWarning) {
            let result = await deleteDependentService.deleteDependentWarning(possibleDependent,id);
            return utils.successResponse(result, res);
        } else {
            let isDelete = await deleteDependentService.deleteDependent(possibleDependent,id);
            if(!isDelete){
                return utils.failureResponse("something went wrong.",res);
            }
            let result = await dbService.findOneAndDeleteDocument(Clinetele, {_id:id});
            if(!result){
                return utils.failureResponse("something went wrong.",res);
            }  
            return  utils.successResponse(result, res);    
        }
    }
    catch(error){
        return utils.failureResponse(error.message,res); 
    }
}



module.exports = {
    addClinetele,
    findAllClinetele,
    getClinetele,
    getClineteleCount,
    getClineteleByAggregate,
    updateClinetele,
    partialUpdateClinetele,
    softDeleteClinetele,
    bulkInsertClinetele,
    bulkUpdateClinetele,
    deleteClinetele,
}

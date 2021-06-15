const Master = require("../../model/Master")
const utils = require("../../utils/messages")
const MasterSchemaKey = require("../../utils/validation/MasterValidation");
const validation = require("../../utils/validateRequest");
const dbService = require("../../utils/dbService");
const deleteDependentService = require("../../utils/deleteDependent");

const addMaster = async(req, res) => {
    try {
        let isValid = validation.validateParamsWithJoi(req.body,MasterSchemaKey.schemaKeys);
        if (isValid.error) {
            return utils.inValidParam(isValid.details, res);
        } 
        const data = new Master({
            ...req.body,
        })
        let result = await dbService.createDocument(Master,data);
        

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
const findAllMaster = async(req, res) => {
    try {
        let options = {}
        let query={}
        let result;
        if(req.body.isCountOnly){
            if (req.body.query !== undefined) {
                query = { ...req.body.query }
            }
            result = await dbService.countDocument(Master, query);
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
                result = await dbService.getAllDocuments( Master,query,options);
               
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

const getMaster = async(req, res) => {
    try {
        let query={};
        query.id = req.params.id;
        let result = await dbService.getDocumentByQuery(Master,query);
        
        if(result){
            return  utils.successResponse(result, res);
        }
        return utils.recordNotFound([],res);
    }
    catch(error){
        return utils.failureResponse(error.message,res)
    }
}
const getMasterCount = async(req, res) => {
    try {
        let where ={};
        if(req.body.where){
            where = req.body.where;
        }
        let result = await dbService.countDocument(Master,where);
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

const getMasterByAggregate = async (req,res)=>{
    try{
        let result=await dbService.getDocumentByAggregation(Master,req.body);
        if(result){
            return utils.successResponse(result, res);
        }
        return utils.recordNotFound([],res);
    }catch(error){
        return utils.failureResponse(error.message,res)
    }
}
const updateMaster = async(req, res) => {
    try {
        const data = {
                ...req.body,
            id:req.params.id
        }
        let isValid = validation.validateParamsWithJoi(
            data,
            MasterSchemaKey.schemaKeys
        );
        if (isValid.error) {
            return  utils.inValidParam(isValid.details, res);
        }
        let result = await dbService.findOneAndUpdateDocument(Master,{_id:req.params.id},data,{new:true});
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
const partialUpdateMaster = async (req, res) => {
    try {
        const data = {
            ...req.body,
            id: req.params.id
        }
        let isValid = validation.validateParamsWithJoi(
            data,
            MasterSchemaKey.updateSchemaKeys
        );
        if (isValid.error) {
            return utils.inValidParam(isValid.details, res);
        }
        let result = await dbService.updateDocument(Master, req.params.id, data);
        if (!result) {
            return utils.failureResponse("something is wrong", res)
        }
        
        return utils.successResponse(result, res);
    }
    catch(error){
        return utils.failureResponse(error.message, res)
    }
}
const softDeleteMaster = async (req, res) => {
    try{
        let possibleDependent = [ { model: 'Master', refId: 'parentId' } ]
        let id = req.params.id;
        let data = await dbService.updateDocument(Master, { _id:id }, { isDeleted: true, isActive:false });
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
const bulkInsertMaster = async(req,res)=>{
    try{
        let data;   
        if(req.body.data !== undefined && req.body.data.length){
            data = req.body.data;
            let result =await dbService.bulkInsert(Master,data);
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
const bulkUpdateMaster=async(req,res)=>{
    try {
        let filter={};
        let data;
        if(req.body.filter !== undefined){
            filter = req.body.filter
        }
        if(req.body.data !== undefined){
            data = req.body.data;
            let result = await dbService.bulkUpdate(Master,filter,data);
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
const deleteMaster =async(req, res) => {
    try{
        let possibleDependent = [ { model: 'Master', refId: 'parentId' } ]
        let id = req.params.id;
        if (req.body.isWarning) {
            let result = await deleteDependentService.deleteDependentWarning(possibleDependent,id);
            return utils.successResponse(result, res);
        } else {
            let isDelete = await deleteDependentService.deleteDependent(possibleDependent,id);
            if(!isDelete){
                return utils.failureResponse("something went wrong.",res);
            }
            let result = await dbService.findOneAndDeleteDocument(Master, {_id:id});
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
    addMaster,
    findAllMaster,
    getMaster,
    getMasterCount,
    getMasterByAggregate,
    updateMaster,
    partialUpdateMaster,
    softDeleteMaster,
    bulkInsertMaster,
    bulkUpdateMaster,
    deleteMaster,
}

/*
 * modelValidation.js
 * purpose     : request validation
 * description : validate each post and put request as per mongoose model
 **/

const {USER_ROLE} = require("../../config/authConstant");
const {convertObjectToEnum} = require("../common");   
const joi = require("joi")
exports.schemaKeys = {
	id: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	username: joi.string().case('lower').trim().required().min(10).max(20),
	age: joi.number().integer(),
	isActive: joi.boolean(),
	address: joi.object(),
	dob: joi.date(),
	name: joi.string(),
	role: joi.number().integer().valid(...convertObjectToEnum(USER_ROLE)),
	resetPasswordLink: joi.object({code:joi.string(),expireTime:joi.date()}),
	email: joi.string(),
	loginTry: joi.number().integer(),
	isDeleted: joi.boolean()
};
exports.updateSchemaKeys = {
	id: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	username: joi.string().case('lower').trim().when({is:joi.exist(),then:joi.required(),otherwise:joi.optional()}).min(10).max(20),
	age: joi.number().integer(),
	isActive: joi.boolean(),
	address: joi.object(),
	dob: joi.date(),
	name: joi.string(),
	role: joi.number().integer().valid(...convertObjectToEnum(USER_ROLE)),
	resetPasswordLink: joi.object({code:joi.string(),expireTime:joi.date()}),
	email: joi.string(),
	loginTry: joi.number().integer(),
	isDeleted: joi.boolean()
};
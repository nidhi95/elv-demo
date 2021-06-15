/*
 * modelValidation.js
 * purpose     : request validation
 * description : validate each post and put request as per mongoose model
 **/

const joi = require("joi")
exports.schemaKeys = {
	id: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	name: joi.string(),
	normalizeName: joi.string(),
	slug: joi.string(),
	code: joi.string(),
	group: joi.string(),
	description: joi.string(),
	isActive: joi.boolean(),
	isDefault: joi.boolean(),
	sortingSequence: joi.number().integer(),
	image: joi.string(),
	icon: joi.string(),
	likeKeyWords: joi.object(),
	parentId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	subMasters: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	isDeleted: joi.boolean(),
	homeId: joi.string().regex(/^[0-9a-fA-F]{24}$/)
};
exports.updateSchemaKeys = {
	id: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	name: joi.string(),
	normalizeName: joi.string(),
	slug: joi.string(),
	code: joi.string(),
	group: joi.string(),
	description: joi.string(),
	isActive: joi.boolean(),
	isDefault: joi.boolean(),
	sortingSequence: joi.number().integer(),
	image: joi.string(),
	icon: joi.string(),
	likeKeyWords: joi.object(),
	parentId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	subMasters: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	isDeleted: joi.boolean(),
	homeId: joi.string().regex(/^[0-9a-fA-F]{24}$/)
};
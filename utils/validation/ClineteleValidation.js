/*
 * modelValidation.js
 * purpose     : request validation
 * description : validate each post and put request as per mongoose model
 **/

const joi = require("joi")
exports.schemaKeys = {
	id: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	code: joi.string(),
	krollId: joi.number().integer().required(),
	phone: joi.string(),
	name: joi.string(),
	type: joi.number().integer(),
	isDeleted: joi.boolean(),
	isActive: joi.boolean(),
	addresses: joi.object(),
	image: joi.string(),
	website: joi.string(),
	parentId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	pharmacyId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	organizationId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	parentPharmacyId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	assignedDeviceImei: joi.string(),
	uniqueNo: joi.string(),
	pharmacyPrinter: joi.string(),
	settings: joi.string(),
	draftDiscardHours: joi.number().integer(),
	careClause: joi.string(),
	storeId: joi.number().integer(),
	virtualVisitDuration: joi.object(),
	isKroll: joi.boolean(),
	eHR: joi.string(),
	facId: joi.number().integer(),
	bedCount: joi.number().integer(),
	lineOfBusiness: joi.string(),
	healthType: joi.number().integer(),
	facilityCode: joi.string(),
	environment: joi.string(),
	billingStyleCountry: joi.string(),
	timeZone: joi.string(),
	headOffice: joi.string(),
	floorDesc: joi.string(),
	floorId: joi.number().integer(),
	pccOrgId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	imagingDiagnosticJSON: joi.object(),
	imagingDiagnosticId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	stlCode: joi.string()
};
exports.updateSchemaKeys = {
	id: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	code: joi.string(),
	krollId: joi.number().integer().when({is:joi.exist(),then:joi.required(),otherwise:joi.optional()}),
	phone: joi.string(),
	name: joi.string(),
	type: joi.number().integer(),
	isDeleted: joi.boolean(),
	isActive: joi.boolean(),
	addresses: joi.object(),
	image: joi.string(),
	website: joi.string(),
	parentId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	pharmacyId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	organizationId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	parentPharmacyId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	assignedDeviceImei: joi.string(),
	uniqueNo: joi.string(),
	pharmacyPrinter: joi.string(),
	settings: joi.string(),
	draftDiscardHours: joi.number().integer(),
	careClause: joi.string(),
	storeId: joi.number().integer(),
	virtualVisitDuration: joi.object(),
	isKroll: joi.boolean(),
	eHR: joi.string(),
	facId: joi.number().integer(),
	bedCount: joi.number().integer(),
	lineOfBusiness: joi.string(),
	healthType: joi.number().integer(),
	facilityCode: joi.string(),
	environment: joi.string(),
	billingStyleCountry: joi.string(),
	timeZone: joi.string(),
	headOffice: joi.string(),
	floorDesc: joi.string(),
	floorId: joi.number().integer(),
	pccOrgId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	imagingDiagnosticJSON: joi.object(),
	imagingDiagnosticId: joi.string().regex(/^[0-9a-fA-F]{24}$/),
	stlCode: joi.string()
};
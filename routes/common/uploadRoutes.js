var express = require('express');
var router = express.Router();

const fileUploadController = require("../../controller/common/fileUploadController");
router.post("/",fileUploadController.upload);

module.exports = router;
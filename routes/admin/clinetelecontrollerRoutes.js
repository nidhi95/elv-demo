const express = require("express");
const router = express.Router()
const ClineteleControllerController = require("../../controller/admin/clinetelecontrollerController");    

router.post("/admin/clientele/custome-route2", (req, res) => {
    ClineteleControllerController.customRoute2(req,res);
})
router.post("/admin/clientele/custome-route", (req, res) => {
    ClineteleControllerController.customAction(req,res);
})
    
module.exports = router;
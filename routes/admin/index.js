const express =  require("express")
const router =  express.Router()
router.use("/auth",require("./auth"));
router.use("/master",require("./MasterRoutes"));
router.use("/clinetele",require("./ClineteleRoutes"));
router.use("/user",require("./userRoutes"));
router.use("/",require("./clinetelecontrollerRoutes"));
router.use("/",require("./clinetelecontrollerRoutes"));

module.exports = router;

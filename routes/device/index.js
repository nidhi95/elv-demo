const express =  require("express")
const router =  express.Router()
router.use("/auth",require("./auth"));
router.use("/api/v1/master",require("./MasterRoutes"));
router.use("/api/v1/clinetele",require("./ClineteleRoutes"));
router.use("/api/v1/user",require("./userRoutes"));

module.exports = router;

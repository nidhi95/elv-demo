const express =  require("express")
const router =  express.Router()

router.use("/upload",require("./uploadRoutes"));

module.exports = router;
const express = require('express');
const router = express.Router();
const ClineteleController = require("../../controller/admin/ClineteleController")
const auth = require("../../middleware/auth");

router.route("/create").post(auth(...[ 'createByAdminInAdminPlatform' ]),ClineteleController.addClinetele);
router.route("/list").post(auth(...[ 'getAllByAdminInAdminPlatform' ]),ClineteleController.findAllClinetele);
router.route("/:id").get(auth(...[ 'getByAdminInAdminPlatform' ]),ClineteleController.getClinetele);
router.route("/count").post(auth(...[ 'getCountByAdminInAdminPlatform' ]),ClineteleController.getClineteleCount);
router.route("/aggregate").post(auth(...[ 'aggregateByAdminInAdminPlatform' ]),ClineteleController.getClineteleByAggregate);
router.route("/update/:id").put(auth(...[ 'updateByAdminInAdminPlatform' ]),ClineteleController.updateClinetele);    
router.route("/partial-update/:id").put(auth(...[ 'partialUpdateByAdminInAdminPlatform' ]),ClineteleController.partialUpdateClinetele);
router.route("/softDelete/:id").put(auth(...[ 'softDeleteByAdminInAdminPlatform' ]),ClineteleController.softDeleteClinetele);
router.route("/addBulk").post(auth(...[ 'addBulkByAdminInAdminPlatform' ]),ClineteleController.bulkInsertClinetele);
router.route("/updateBulk").put(auth(...[ 'updateBulkByAdminInAdminPlatform' ]),ClineteleController.bulkUpdateClinetele);
router.route("/delete/:id").delete(auth(...[ 'deleteByAdminInAdminPlatform' ]),ClineteleController.deleteClinetele);
module.exports = router;

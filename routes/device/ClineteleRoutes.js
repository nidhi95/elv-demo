const express = require('express');
const router = express.Router();
const ClineteleController = require("../../controller/device/ClineteleController")
const auth = require("../../middleware/auth");

router.route("/create").post(auth(...[ 'createByUserInDevicePlatform' ]),ClineteleController.addClinetele);
router.route("/list").post(auth(...[ 'getAllByUserInDevicePlatform' ]),ClineteleController.findAllClinetele);
router.route("/:id").get(auth(...[ 'getByUserInDevicePlatform' ]),ClineteleController.getClinetele);
router.route("/count").post(auth(...[ 'getCountByUserInDevicePlatform' ]),ClineteleController.getClineteleCount);
router.route("/aggregate").post(auth(...[ 'aggregateByUserInDevicePlatform' ]),ClineteleController.getClineteleByAggregate);
router.route("/update/:id").put(auth(...[ 'updateByUserInDevicePlatform' ]),ClineteleController.updateClinetele);    
router.route("/partial-update/:id").put(auth(...[ 'partialUpdateByUserInDevicePlatform' ]),ClineteleController.partialUpdateClinetele);
router.route("/softDelete/:id").put(auth(...[ 'softDeleteByUserInDevicePlatform' ]),ClineteleController.softDeleteClinetele);
router.route("/addBulk").post(auth(...[ 'addBulkByUserInDevicePlatform' ]),ClineteleController.bulkInsertClinetele);
router.route("/updateBulk").put(auth(...[ 'updateBulkByUserInDevicePlatform' ]),ClineteleController.bulkUpdateClinetele);
router.route("/delete/:id").delete(auth(...[ 'deleteByUserInDevicePlatform' ]),ClineteleController.deleteClinetele);
module.exports = router;

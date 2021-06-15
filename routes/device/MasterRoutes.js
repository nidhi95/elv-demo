const express = require('express');
const router = express.Router();
const MasterController = require("../../controller/device/MasterController")
const auth = require("../../middleware/auth");

router.route("/create").post(auth(...[ 'createByUserInDevicePlatform' ]),MasterController.addMaster);
router.route("/list").post(auth(...[ 'getAllByUserInDevicePlatform' ]),MasterController.findAllMaster);
router.route("/:id").get(auth(...[ 'getByUserInDevicePlatform' ]),MasterController.getMaster);
router.route("/count").post(auth(...[ 'getCountByUserInDevicePlatform' ]),MasterController.getMasterCount);
router.route("/aggregate").post(auth(...[ 'aggregateByUserInDevicePlatform' ]),MasterController.getMasterByAggregate);
router.route("/update/:id").put(auth(...[ 'updateByUserInDevicePlatform' ]),MasterController.updateMaster);    
router.route("/partial-update/:id").put(auth(...[ 'partialUpdateByUserInDevicePlatform' ]),MasterController.partialUpdateMaster);
router.route("/softDelete/:id").put(auth(...[ 'softDeleteByUserInDevicePlatform' ]),MasterController.softDeleteMaster);
router.route("/addBulk").post(auth(...[ 'addBulkByUserInDevicePlatform' ]),MasterController.bulkInsertMaster);
router.route("/updateBulk").put(auth(...[ 'updateBulkByUserInDevicePlatform' ]),MasterController.bulkUpdateMaster);
router.route("/delete/:id").delete(auth(...[ 'deleteByUserInDevicePlatform' ]),MasterController.deleteMaster);
module.exports = router;

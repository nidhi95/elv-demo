const express = require('express');
const router = express.Router();
const MasterController = require("../../controller/admin/MasterController")
const auth = require("../../middleware/auth");

router.route("/create").post(auth(...[ 'createByAdminInAdminPlatform' ]),MasterController.addMaster);
router.route("/list").post(auth(...[ 'getAllByAdminInAdminPlatform' ]),MasterController.findAllMaster);
router.route("/:id").get(auth(...[ 'getByAdminInAdminPlatform' ]),MasterController.getMaster);
router.route("/count").post(auth(...[ 'getCountByAdminInAdminPlatform' ]),MasterController.getMasterCount);
router.route("/aggregate").post(auth(...[ 'aggregateByAdminInAdminPlatform' ]),MasterController.getMasterByAggregate);
router.route("/update/:id").put(auth(...[ 'updateByAdminInAdminPlatform' ]),MasterController.updateMaster);    
router.route("/partial-update/:id").put(auth(...[ 'partialUpdateByAdminInAdminPlatform' ]),MasterController.partialUpdateMaster);
router.route("/softDelete/:id").put(auth(...[ 'softDeleteByAdminInAdminPlatform' ]),MasterController.softDeleteMaster);
router.route("/addBulk").post(auth(...[ 'addBulkByAdminInAdminPlatform' ]),MasterController.bulkInsertMaster);
router.route("/updateBulk").put(auth(...[ 'updateBulkByAdminInAdminPlatform' ]),MasterController.bulkUpdateMaster);
router.route("/delete/:id").delete(auth(...[ 'deleteByAdminInAdminPlatform' ]),MasterController.deleteMaster);
module.exports = router;

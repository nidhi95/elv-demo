const express = require('express');
const router = express.Router();
const userController = require("../../controller/device/userController")
const auth = require("../../middleware/auth");

router.route("/create").post(userController.addUser);
router.route("/list").post(auth(...[ 'getAllByUserInDevicePlatform' ]),userController.findAllUser);
router.route("/:id").get(auth(...[ 'getByUserInDevicePlatform' ]),userController.getUser);
router.route("/count").post(auth(...[ 'getCountByUserInDevicePlatform' ]),userController.getUserCount);
router.route("/aggregate").post(auth(...[ 'aggregateByUserInDevicePlatform' ]),userController.getUserByAggregate);
router.route("/update/:id").put(auth(...[ 'updateByUserInDevicePlatform' ]),userController.updateUser);    
router.route("/partial-update/:id").put(auth(...[ 'partialUpdateByUserInDevicePlatform' ]),userController.partialUpdateUser);
router.route("/change-password").put(auth(...[ 'changePasswordByUserInDevicePlatform' ]),userController.changePassword);
module.exports = router;

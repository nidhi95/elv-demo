/*
 * constants
 */

const JWT={
    ADMIN_SECRET:"myjwtadminsecret",
    DEVICE_SECRET:"myjwtdevicesecret",
    EXPIRES_IN: 10000
}

const USER_ROLE ={
    User:1,
    Admin:2,
}

const PLATFORM = {
    ADMIN:1,
    DEVICE:2,
}

let LOGIN_ACCESS ={
    [USER_ROLE.User]:[PLATFORM.DEVICE],        
    [USER_ROLE.Admin]:[PLATFORM.ADMIN],        
}

const DEFAULT_ROLE= 1

const ROLE_RIGHTS={
    
    [USER_ROLE.User] : [
  "getAllByUserInDevicePlatform",
  "getByUserInDevicePlatform",
  "aggregateByUserInDevicePlatform",
  "getCountByUserInDevicePlatform",
  "createByUserInDevicePlatform",
  "addBulkByUserInDevicePlatform",
  "updateByUserInDevicePlatform",
  "updateBulkByUserInDevicePlatform",
  "partialUpdateByUserInDevicePlatform",
  "deleteByUserInDevicePlatform",
  "softDeleteByUserInDevicePlatform",
  "upsertByUserInDevicePlatform",
  "fileUploadByUserInDevicePlatform",
  "changePasswordByUserInDevicePlatform"
],
    
    [USER_ROLE.Admin] : [
  "getAllByAdminInAdminPlatform",
  "getByAdminInAdminPlatform",
  "aggregateByAdminInAdminPlatform",
  "getCountByAdminInAdminPlatform",
  "createByAdminInAdminPlatform",
  "addBulkByAdminInAdminPlatform",
  "updateByAdminInAdminPlatform",
  "updateBulkByAdminInAdminPlatform",
  "partialUpdateByAdminInAdminPlatform",
  "deleteByAdminInAdminPlatform",
  "softDeleteByAdminInAdminPlatform",
  "upsertByAdminInAdminPlatform",
  "fileUploadByAdminInAdminPlatform",
  "changePasswordByAdminInAdminPlatform"
],
    
}
const MAX_LOGIN_RETRY_LIMIT = 3;   


const FORGOT_PASSWORD_WITH = {
  LINK: {}
}

module.exports = {
    JWT,
    USER_ROLE,
    DEFAULT_ROLE,
    ROLE_RIGHTS,
    PLATFORM,
    MAX_LOGIN_RETRY_LIMIT,
    FORGOT_PASSWORD_WITH,
    LOGIN_ACCESS
}
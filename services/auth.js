const User = require("../model/user")
const dbService = require("../utils/dbService");
const { JWT,LOGIN_ACCESS,
    PLATFORM,MAX_LOGIN_RETRY_LIMIT} = require("../config/authConstant");
const jwt = require("jsonwebtoken");
const common = require("../utils/common");
const moment = require("moment");
const bcrypt = require("bcrypt");
const emailService = require("./email/emailService");
const sendSMS = require("./sms/smsService");

async function generateToken(user,secret){
    return jwt.sign( {id:user.id,email:user.email}, secret, {
        expiresIn: JWT.EXPIRES_IN * 60
    });
}
let auth =  module.exports = {}
    auth.loginUser=async(username,password,url) => {
            try {
                let where ={email:username}
                const user = await dbService.getDocumentByQuery(User,where);
                if (user) {
                    if(user.loginTry >= MAX_LOGIN_RETRY_LIMIT){
                        return { flag:true, message:"you have exceed the number of limit.you have to reset the password"}
                    }
                    const isPasswordMatched = await user.isPasswordMatch(password);
                    if (isPasswordMatched) {
                        const {password,...userData}=user.toJSON()
                        let token;
                        if(!user.role){
                            return {flag:true, data:'You have no assigned any role'}
                        }
                        if(url.includes('admin')){
                            if(!LOGIN_ACCESS[user.role].includes(PLATFORM.ADMIN)){
                                return {flag:true, data:'you are unable to access this platform'}
                            }
                            token = await generateToken(userData,JWT.ADMIN_SECRET)
                        }
                        else if(url.includes('device')){
                            if(!LOGIN_ACCESS[user.role].includes(PLATFORM.DEVICE)){
                                return {flag:true, data:'you are unable to access this platform'}
                            }
                            token = await generateToken(userData,JWT.DEVICE_SECRET)
                        }
                        if(user.loginRetryLimit){
                            await dbService.updateDocument(User,user.id,{loginTry:0});
                        }
                        const userToReturn = { ...userData, ...{ token } };
                        return {flag:false,data:userToReturn}
                    } else {
                        await dbService.updateDocument(User,user.id,{loginTry:user.loginTry+1});
                        return {flag:true,data:'Incorrect Password'}
                    }
                } else {
                    return {flag:true,data:'User not exists'}
                }
            } catch (error) {
                throw new Error(error.message)
            }
    },
    auth.changePassword=async(params)=>{
        try {
            let password = params.newPassword;
            let where = {_id:params.userId};
            let user = await dbService.getDocumentByQuery(User,where);
            if (user && user.id) {
                password = await bcrypt.hash(password, 8);
                let updatedUser = dbService.updateDocument(User,user.id,{password});
                if (updatedUser) {
                    return {flag:false,data:user};                
                }
                return {flag:true,data:'password can not changed due to some error.please try again'}
            }
            return {flag:true,data:'User not found'}
        } catch (error) {
            throw new Error(error.message)
        }
    },
    auth.sendResetPasswordNotification=async (user) => {
        let resultOfEmail=false;
        let resultOfSMS=false;
        try {
            return {resultOfEmail,resultOfSMS};
        } catch (error) {
            throw new Error(error.message)
        }
    },
    auth.resetPassword=async (user, newPassword) => {
        try {
            let where = { _id: user.id };
            const dbUser = await dbService.getDocumentByQuery(User,where);
            if (!dbUser) {
                return {
                    flag: false,
                    data: "User not found",
                };
            }
            newPassword = await bcrypt.hash(newPassword, 8);
            await dbService.updateDocument(User, user.id, {
                password: newPassword,
                resetPasswordLink: null,
                loginTry:0
            });
            let mailObj = {
                subject: 'Reset Password',
                to: user.email,
                template: '/views/successfullyResetPassword',
                data: {
                    isWidth: true,
                    email: user.email || '-',
                    message: "Password Successfully Reset"
                }
            };
            await emailService.sendEmail(mailObj);
            return {
                flag: false,
                data: "Password reset successfully",
            };
        } catch (error) {
            throw new Error(error.message)
        }
    }
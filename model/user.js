const mongoose = require("../config/db");
const mongoosePaginate = require('mongoose-paginate-v2');
var idValidator = require('mongoose-id-validator');
const uniqueValidator = require('mongoose-unique-validator');
const bcrypt = require("bcrypt");
const{USER_ROLE,DEFAULT_ROLE} = require("../config/authConstant");
const {convertObjectToEnum} = require("../utils/common")

const myCustomLabels = {
    totalDocs: 'itemCount',
    docs: 'data',
    limit: 'perPage',
    page: 'currentPage',
    nextPage: 'next',
    prevPage: 'prev',
    totalPages: 'pageCount',
    pagingCounter: 'slNo',
    meta: 'paginator',
};

mongoosePaginate.paginate.options = {
    customLabels: myCustomLabels
};

const Schema = mongoose.Schema;
const schema = new Schema(
{

    addedBy:{type:Schema.Types.ObjectId,ref:"user"},

    address:{type:Object},

    age:{type:Number},

    dob:{type:Date},

    email:{type:String},

    emails:{type:Array},

    isActive:{type:Boolean},

    isDeleted:Boolean,

    loginTry:{type:Number,default:0},

    name:{type:String},

    resetPasswordLink:{code:String,expireTime:Date},

    role:{type:Number,enum:convertObjectToEnum(USER_ROLE)},

    username:{type:String,lowercase:true,trim:true,required:true,match:Regex,minLength:10,maxLength:20}
    },
    { timestamps: { createdAt: 'createdAt', updatedAt: 'updatedAt' } }
);


schema.pre('save',async function(next){
    const user = this;
    // create slug using code
    user.mergeFLName = `${user.firstName}, ${user.lastName}`;
    user.mergeLFName = `${user.lastName}, ${user.firstName}`;
    // user.
    //Replace and then store it
    //Indicates we're done and moves on to the next middleware
    next();
    next();
});
schema.post('updateOne',async function(next){
    const user = this._update;
    if (user.firstName || user.lastName) {
        user.mergeFLName = `${user.firstName}, ${user.lastName}`;
        user.mergeLFName = `${user.lastName}, ${user.firstName}`;
    }
    next();
    next();
});
    
schema.pre('save', async function(next) {
    this.isDeleted = false;
    this.isActive = true;
    if(this.password){
        this.password = await bcrypt.hash(this.password, 8);
    }
    next();
});



schema.methods.isPasswordMatch = async function (password) {
    const user = this;
    return bcrypt.compare(password, user.password);
};

schema.method("toJSON", function () {
    const { __v, _id, ...object } = this.toObject();
    object.id = _id;
    return object;
});
schema.plugin(mongoosePaginate);
schema.plugin(idValidator);


schema.plugin(uniqueValidator,{ message: 'Error, expected {VALUE} to be unique.' });


const user = mongoose.model("user",schema,"user");
module.exports = user
const mongoose = require("../config/db");
const mongoosePaginate = require('mongoose-paginate-v2');
var idValidator = require('mongoose-id-validator');

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

    code:{type:String},

    description:{type:String},

    group:{type:String},

    homeId:{ref:"Clinetele",type:Schema.Types.ObjectId},

    icon:{type:String},

    image:{type:String},

    isActive:{type:Boolean},

    isDefault:{type:Boolean},

    isDeleted:{type:Boolean},

    likeKeyWords:{type:Object},

    name:{type:String},

    normalizeName:{type:String},

    parentId:{ref:"Master",type:Schema.Types.ObjectId},

    slug:{type:String},

    sortingSequence:{type:Number},

    subMasters:{ref:"Master",type:Schema.Types.ObjectId}
    },
    { timestamps: { createdAt: 'createdAt', updatedAt: 'updatedAt' } }
);


schema.pre('save', async function(next) {
    this.isDeleted = false;
    this.isActive = true;
    next();
});

schema.pre('deleteMany', async function (next) {
    let allRecordByConditions = await mongoose.model('Master').find(this._conditions);
    let dependent = [ { model: 'Master', refId: 'parentId' } ];
    await Promise.all(allRecordByConditions.map((async (e) => {
        return await Promise.all(dependent.map((async (i) => {
            let where = {}
            where[i.refId]=e._id;
            return await mongoose.model(i.model).deleteMany(where, async function (err, result) {
                if (err) {
                    console.log(`[error] ${err}`);
                    next(err);
                } else {
                    console.log('success');
                }
            });
        })));
    })));
    next();
});


schema.pre('updateMany',async function(next){
    if (this._conditions._id) {
        let allRecordByConditions = await mongoose.model('Master').find(this._conditions);
        let dependent = [ { model: 'Master', refId: 'parentId' } ];
        await Promise.all(allRecordByConditions.map((async (e) => {
            return await Promise.all(dependent.map((async (i) => {
            let where = {}
            where[i.refId]=e._id;
            return await mongoose.model(i).updateMany(where,{isDeleted:true}, async function (err, result) {
                if (err) {
                    console.log(`[error] ${err}`);
                    next(err);
                } else {
                    console.log('success');
                }
            });
        })));
    })));
        next();
    }else{
        next();
    }
})


schema.method("toJSON", function () {
    const { __v, _id, ...object } = this.toObject();
    object.id = _id;
    return object;
});
schema.plugin(mongoosePaginate);
schema.plugin(idValidator);



const Master = mongoose.model("Master",schema,"Master");
module.exports = Master
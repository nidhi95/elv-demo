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

    addresses:{type:Object},

    assignedDeviceImei:{type:String},

    bedCount:{type:Number},

    billingStyleCountry:{type:String},

    careClause:{type:String},

    code:{type:String,unique:false,uniqueCaseInsensitive:true},

    draftDiscardHours:{type:Number},

    eHR:{type:String},

    emails:{type:Array},

    environment:{type:String},

    facId:{type:Number},

    facilityCode:{type:String},

    faxes:{type:Array},

    floorDesc:{type:String},

    floorId:{type:Number},

    headOffice:{type:String},

    healthType:{type:Number},

    image:{type:String},

    imagingDiagnosticId:{ref:"Clinetele",type:Schema.Types.ObjectId},

    imagingDiagnosticJSON:{type:Object},

    isActive:{type:Boolean},

    isDeleted:{type:Boolean},

    isKroll:{type:Boolean},

    krollId:{type:Number,required:true},

    lineOfBusiness:{type:String},

    mobiles:{type:Array},

    name:{type:String},

    organizationId:{ref:"Clinetele",type:Schema.Types.ObjectId},

    parentId:{ref:"Clinetele",type:Schema.Types.ObjectId},

    parentPharmacyId:{ref:"Clinetele",type:Schema.Types.ObjectId},

    pccOrgId:{type:Schema.Types.ObjectId,ref:"Clinetele"},

    pharmacyId:{ref:"Clinetele",type:Schema.Types.ObjectId},

    pharmacyPrinter:{type:String},

    phone:{type:String},

    settings:{type:String},

    stlCode:{type:String},

    storeId:{type:Number},

    timeZone:{type:String},

    type:{type:Number},

    uniqueNo:{type:String},

    virtualVisitDuration:{type:Object},

    website:{type:String}
    },
    { timestamps: { createdAt: 'createdAt', updatedAt: 'updatedAt' } }
);


schema.pre('save', async function(next) {
    this.isDeleted = false;
    this.isActive = true;
    next();
});

schema.pre('deleteMany', async function (next) {
    let allRecordByConditions = await mongoose.model('Clinetele').find(this._conditions);
    let dependent = [
  { model: 'Master', refId: 'homeId' },
  { model: 'Clinetele', refId: 'parentId' }
];
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
        let allRecordByConditions = await mongoose.model('Clinetele').find(this._conditions);
        let dependent = [
  { model: 'Master', refId: 'homeId' },
  { model: 'Clinetele', refId: 'parentId' }
];
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



const Clinetele = mongoose.model("Clinetele",schema,"Clinetele");
module.exports = Clinetele
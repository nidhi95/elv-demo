angular
    .module('Constants', [])

    .constant('API_REQUEST', {
        // 'URL': 'http://api.optigoapps.com/palakdesignscom/acxs-xpbr-ojgr-jzsv/v1003/apps/'
        //'URL': 'https://api.optigoapps.com/palakdesignscom/pgzb-sxjf-rqcg-xnde/v1003/apps/'
        // 'URL': 'https://api.optigoapps.com/palakdesignscom/acxs-xpbr-ojgr-jzsv/v1003/apps/'
        'URL': 'http://api.optigoapps.com/elvee/pgzb-sxjf-rqcg-xnde/v1003/apps/'
        // 'URL': 'https://api.optigoapps.com/elvee/pgzb-sxjf-rqcg-xnde/v1003/apps/'
    })

    .constant('ELVEE_ADMIN', {
         'URL': 'http://192.168.0.146:1357/' //local url
        // 'URL': 'http://support.elvee.in/'
    })

    .constant('project', {
        'NAME': 'Elvee'
    })

    .constant('kycPolicyStatus', {
        REJECTED: 5,
        APPROVED: 1

    })


    .constant('userType', {
        'USER_TYPE_ADMIN': '1',
        'USER_TYPE_MEMBER': '2',
        'USER_TYPE_USER': '3'
    })

    /**
     * Purchase type
     */
    .constant('purchaseType', {
        'PURCHASE_TYPE_PURCHASE': '1',
        'PURCHASE_TYPE_BONUS': '2',
        'PURCHASE_TYPE_BONUS_WHEN_CREATED_AC': '3'
    })

    /**
     *  Payment status
     */
    .constant('paymentStatus', {
        'PAYMENT_STATUS_PENDING': '1',
        'PAYMENT_STATUS_PAID': '2'
    })
    /**
     * Purchase Request Status
     */
    .constant('purchaseStatus', {

        'PURCHASE_STATUS_AWAITING_PAYMENT': '1',
        'PURCHASE_STATUS_NO_PAYMENT': '2',
        'PURCHASE_STATUS_PAID': '3'
    })
    //category type
    .constant('CategoryType', {
        'DIAMOND': 1,
        'JEWELLERY': 2
    })

    .constant('logType', {
        'REGISTER_LOG': '1',
        'LOGIN_LOG': '2'
    })

    .constant('jewelType', {
        'metaltype': 'Metal Type',
        'metalcolor': 'Metal Color',
        'diamondquality': 'Diamond Quality',
        'diamondcolor': 'Diamond Color',
        'colorstonequality': 'Colorstone Quality',
        'colorstonecolor': 'Colorstone Color'
    })

    .constant('masterType', {
        'MASTER_VAS_CATEGORY': 'VAS_CATEGORY',
        'MASTER_EVENT_TYPE': 'EVENT_TYPE'
    })


    .constant('paymentMethodType', {
        'CASH': '2'
    })

    .constant('paymentMode', {
        'PAYMENT_MODE_AUTOMATIC_PAYMENT': '1',
        'PAYMENT_MODE_ACCUMULATION_PAYMENT': '2'
    })

    .constant('staticImgUrl', {
        'url': '//d27afjhe0vu8x.cloudfront.net/store_5644/misc'
    })

    .constant('blogType', {
        'PUBLIC': '1',
        'PRIVATE': '2'
    })

    .constant('templateType', {
        'TEMPLATE_REGISTER': 'REGISTER',
        'TEMPLATE_SUBSCRIBE': 'SUBSCRIBE',
        'TEMPLATE_NEWSLETTER': 'NEWSLETTER',
        'TEMPLATE_CONTACT_US': 'CONTACT_US',
        'TEMPLATE_ANNOUNCEMENT': 'ANNOUNCEMENT',
        /*'TEMPLATE_DEMAND': 'DEMAND',
         'TEMPLATE_SELL': 'SELL',*/
        'TEMPLATE_PENDING_PAYMENT': 'PENDING_PAYMENT',
        'TEMPLATE_NEW_RENEW_PAYMENT': 'NEW_RENEW_PAYMENT',
        'TEMPLATE_PAYMENT_DONE': 'PAYMENT_DONE',
        'TEMPLATE_OFFICIAL_HEADER': 'OFFICIAL_HEADER',
        'TEMPLATE_OFFICIAL_FOOTER': 'OFFICIAL_FOOTER',
        'TEMPLATE_RESET_PASSWORD': 'RESET_PASSWORD',
        'TEMPLATE_EVENT': 'EVENT'
    })

    .constant('folderImg', {
        'FOLDER_IMAGES': 'images'
    })
    /*
     Order Status
     */
    .constant('orderStatus', {

        'SUCCESS': 1,
        'CANCELLED': 2,
        'DELAYED': 3,
        'DISPATCHED': 4,
        'IN_PROCESS': 5,
        'APPROVAL': 6,
        'WAITING_FOR_PAYMENT': 7,
        'RETURN_REFUND': 8,
        'LOCATION_UNFULLFILABLE': 9,
        'PARTIALLY_CANCELLED': 10,
        'PARTIALLY_DISPATCHED': 11,
    })

    .constant('mailType', {
        'MAIL_HISTORY_ANNOUNCEMENT': '1',
        'MAIL_HISTORY_REGISTRATION': '2',
        'MAIL_HISTORY_FORGOT_PASSWORD': '3',
        'MAIL_HISTORY_BLOG': '4',
        'MAIL_HISTORY_CONTACT_US': '5',
        'MAIL_HISTORY_DEMAND': '6',
        'MAIL_HISTORY_SELL': '7',
        'MAIL_HISTORY_SUBSCRIBE': '8',
        'MAIL_HISTORY_NEWSLETTER': '9',
        'MAIL_HISTORY_FOLLOW_UP': '10',
        'MAIL_HISTORY_RENEW_YEAR': '11',
        'MAIL_HISTORY_PENDING_USER': '12',
        'MAIL_HISTORY_NEW_YEAR_RENEW': '13',
        'MAIL_HISTORY_EVENT': '14'
    });




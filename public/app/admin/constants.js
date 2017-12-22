/**
 * Created by tejaswi.tandel on 6/21/2016.
 */
angular
    .module('Constants', [])

    .constant('apiFrom', {
        'api': ''
    })
    .constant('orderStatus', {
        'SUCCESS': '1',
        'CANCELLED': '2',
        'APPROVED': '3',
        'DELIVERED': '4',
    })
    .constant('deliveryMethod', {
        'Home_Delivery': '1',
        'TAKE_AWAY': '2',
    })
    .constant('spiceLevel', {
        'Low': '1',
        'Medium': '2',
        'High': '3',
        'Sweet': '4'
    })
    .constant('foodSize', {
        'SMALL_DISH': 'SMALL',
        'MEDIUM_DISH': 'MEDIUM',
        'LARGE_DISH': 'LARGE'
    })

    .constant('paymentMethod', {
        'COD': '1',
        'ONLINE': '2',
    });



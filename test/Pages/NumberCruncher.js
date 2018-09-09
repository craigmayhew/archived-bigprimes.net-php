var config = require('../../nightwatch.conf.js');
const chromedriver = require("chromedriver");

module.exports = {
    'Number Cruncher' : function (client) {
        client
            .url('https://www.bigprimes.net/cruncher/')
            .waitForElementVisible('body', 1000)
            .assert.visible('#content')
            //click the textarea
            .waitForElementVisible('#content > div > form > div > textarea', 1000)
            .execute('$("#content > div > form > div > textarea").val("33")')
            //.setValue('#content > div > form > div > textarea','33')
            //submit form
            .click('input[type=button]')
            .pause(1000)
            .assert.containsText('h1', '33 - thirty three')
            .waitForElementVisible('#content > div > table:nth-child(16) > tbody > tr:nth-child(1) > td:nth-child(2)', 10000)
            .assert.containsText('#content > div > table:nth-child(16) > tbody > tr:nth-child(1) > td:nth-child(2)',
            'XXXIII')
            .end();
    }
};

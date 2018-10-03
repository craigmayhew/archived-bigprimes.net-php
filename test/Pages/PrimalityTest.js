var config = require('../../nightwatch.conf.js');
const chromedriver = require("chromedriver");

module.exports = {
   'PrimalityTest' : function (client) {
      client
        .url('https://www.bigprimes.net/primalitytest/')
        .waitForElementVisible('body', 1000)
        .assert.title('Big Primes: Browser Powered Primality Test')
        .waitForElementVisible('input[name=primes]')
        .execute(function () {
            $("input[name=primes]").val("1");
            return true;
        })
        .waitForElementVisible('input[name=start]')
        .execute(function () {
            $("input[name=start]").val("77777");
            return true;
        })
        .click('form[name=primelist] > input[type=button]:nth-child(5)')
        .assert.containsText('#javascriptlistoutput', "77783 is a (proven) prime!", 1000)
        .end();
    }
};
var config = require('../../nightwatch.conf.js');
const chromedriver = require("chromedriver");

module.exports = {
   'Homepage' : function (client) {
      client
        .url('https://www.bigprimes.net')
        .waitForElementVisible('body', 1000)
        .assert.title('Big Primes: large list of prime numbers')
        .assert.visible('#content')
        .assert.containsText('#content > table > tbody > tr',
          'Date News')
        .end();
    }
};

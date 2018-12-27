# may turn out to be a terrible idea, but let's try a deployment pipeline that get's us to rinkeby

# import rinkeby test account
mkdir -p $HOME/.ethereum/rinkeby/keystore/
echo $RINKEBY_PRIVATE_ACCOUNT_JSON > $HOME/.ethereum/rinkeby/keystore/encrypted-rinkeby-account

# connect to rinkeby
geth --rinkeby --cache 4096 --nousb --syncmode light --rpc --rpcapi eth,web3,personal &
# sleep for 20 minutes to allow rinkeby to sync
sleep 5m
# TODO: Add a loop here checking geth to see if it's synced and pausing for 20 seconds if not
# if (eth.syncing.highestBlock - eth.syncing.currentBlock > 0){print "no"}

# attempt to use geth
geth --rinkeby --exec 'eth.getGasPrice(function(e,r){console.log("gas price: ",r)})' attach
geth --rinkeby --exec 'console.log("last block: ",eth.blockNumber)' attach

# compile 29.sol
printf "%s" 'storageOutput = ' > /tmp/29.js
solc --optimize --combined-json abi,bin contracts/29.sol >> /tmp/29.js
# write js deployment script for 29.sol
cat >> /tmp/29.js <<EOL
var storageContractAbi = storageOutput.contracts['contracts/29.sol:ethForAnswersBounty'].abi
var storageContract = eth.contract(JSON.parse(storageContractAbi))
var storageBinCode = "0x" + storageOutput.contracts['contracts/29.sol:ethForAnswersBounty'].bin
EOL
printf "personal.unlockAccount(eth.accounts[0],'%s')\n" $RINKEBY_PRIVATE_PASS >> /tmp/29.js
cat >> /tmp/29.js <<EOL
var deployTransactionObject = { from: eth.accounts[0], data: storageBinCode, gas: 1000000 }
console.log("Deploying transaction object ", deployTransactionObject)
var storageInstance = storageContract.new(deployTransactionObject)

//sleep for two blocks to allow contract to deploy
admin.sleepBlocks(2)
console.log("Sending prize fund ether to 29.sol on rinkeby")
eth.sendTransaction({from:eth.accounts[0], to:storageInstance.address, value: web3.toWei(0.05, "ether")})

admin.sleepBlocks(2)
console.log("Running test transactions for 29.sol on rinkeby")
contractAbi = eth.contract(storageInstance.abi)
myContract = contractAbi.at(storageInstance.address)
getData = myContract.attempt.getData(2220422932,-2128888517,-283059956)
//send "correct answer" input transaction to 29.sol
eth.sendTransaction({from:eth.accounts[0], to:storageInstance.address, data: getData})

//TODO: now we should check to make make sure the ether has arrived back in our account
EOL
# run js deployment script for 29.sol
echo "Deploying 29.sol to rinkeby"
geth --rinkeby --exec 'loadScript("/tmp/29.js")' attach
# cleanup for 29.sol
rm /tmp/29.js

# compile 33.sol
printf "%s" 'storageOutput = ' > /tmp/33.js
solc --optimize --combined-json abi,bin contracts/33.sol >> /tmp/33.js
# write js deployment script for 33.sol
cat >> /tmp/33.js <<EOL
var storageContractAbi = storageOutput.contracts['contracts/33.sol:ethForAnswersBounty'].abi
var storageContract = eth.contract(JSON.parse(storageContractAbi))
var storageBinCode = "0x" + storageOutput.contracts['contracts/33.sol:ethForAnswersBounty'].bin
EOL
printf "personal.unlockAccount(eth.accounts[0],'%s')\n" $RINKEBY_PRIVATE_PASS >> /tmp/33.js
cat >> /tmp/33.js <<EOL
var deployTransactionObject = { from: eth.accounts[0], data: storageBinCode, gas: 1000000 }
var storageInstance = storageContract.new(deployTransactionObject)
EOL
# run js deployment script for 33.sol
echo "Deploying 33.sol to rinkeby"
geth --rinkeby --exec 'loadScript("/tmp/33.js")' attach
# cleanup for 33.sol
rm /tmp/33.js

# cleanup sensitive files
rm $HOME/.ethereum/rinkeby/keystore/encrypted-rinkeby-account
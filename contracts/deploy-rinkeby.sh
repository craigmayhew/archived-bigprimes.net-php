# may turn out to be a terrible idea, but let's try a deployment pipeline that get's us to rinkeby

# import rinkeby test account
mkdir -p $HOME/.ethereum/rinkeby/keystore/
echo $RINKEBY_PRIVATE_ACCOUNT_JSON > $HOME/.ethereum/rinkeby/keystore/encrypted-rinkeby-account

# connect to rinkeby
geth --rinkeby --cache 4096 --nousb --syncmode light --rpc --rpcapi eth,web3,personal &
# sleep to allow rinkeby to sync
sleep 60s
CHECK="$(geth --rinkeby --exec 'if(eth.syncing == false){2}else{0}' attach)"
while [ "${CHECK}" -lt 2 ]
do
echo "sleeping 20s" && sleep 20s
done
echo "synced!"

STARTINGBALANCE="$(geth --rinkeby --exec 'web3.fromWei(eth.getBalance(eth.accounts[0]))' attach)"

# attempt to use geth
geth --rinkeby --exec 'eth.getGasPrice(function(e,r){console.log("gas price: ",r)})' attach
geth --rinkeby --exec '"last block: " + eth.blockNumber' attach

# compile 29.sol
printf "%s" 'storageOutput = ' > /tmp/29.js
solc --optimize --combined-json abi,bin contracts/29.sol >> /tmp/29.js
# write js deployment script for 29.sol
cat >> /tmp/29.js <<EOL
var storageContractAbi = storageOutput.contracts['contracts/29.sol:ethForAnswersBounty'].abi
var storageContract = new web3.eth.Contract(JSON.parse(storageContractAbi))
var storageBinCode = "0x" + storageOutput.contracts['contracts/29.sol:ethForAnswersBounty'].bin
EOL
printf "personal.unlockAccount(eth.accounts[0],'%s')\n" $RINKEBY_PRIVATE_PASS >> /tmp/29.js
cat >> /tmp/29.js <<EOL
storageContract.deploy({
    data: storageBinCode,
    arguments: [29]
}).send({
    from: eth.accounts[0],
    gas: 1000000
}).then(function (contract29) {
    //console.log(contract29.address) // the contract address
    console.log("Sending prize fund ether to 29.sol on rinkeby to: ", contract29.address)
    eth.sendTransaction({from:eth.accounts[0], to:contract29.address, value: 555529000})
    .then(function (txnHash) {
        // now you have the unmined transaction hash, return receipt promise
        console.log(txnhash); // follow along
        return web3.eth.getTransactionReceiptMined(txnHash);
    })
    .then(function (receipt) {
        console.log("Send correct answer for 29.sol")
        var getData = contract29.attempt.getData(2220422932,-2128888517,-283059956)
        return web3.eth.sendTransaction({from:eth.accounts[0], to:contract29.address, data: getData})
    })
})

//sleep for two blocks to allow contract to deploy and tests to run
console.log("sleep for 5 blocks")
admin.sleepBlocks(5)

console.log("sleep for 5 blocks")
admin.sleepBlocks(5)
EOL
# run js deployment script for 29.sol
echo "Deploying 29.sol to rinkeby"
geth --rinkeby --exec 'loadScript("/tmp/29.js")' attach

# TODO: Check the exact number of transactions on the account matches expectations

# TODO: Check the before/after balances on wallet
ENDINGBALANCE="$(geth --rinkeby --exec 'web3.fromWei(eth.getBalance(eth.accounts[0]))' attach)"

echo "Starting balance:"
echo STARTINGBALANCE
echo "Final balance:"
echo ENDINGBALANCE

if [ "${STARTINGBALANCE}" -lt "${ENDINGBALANCE}" ]
  # fail build as we don't have the expected balance
  $(exit 1)
fi

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
var storageInstance = storageContract.new({
    from: eth.accounts[0],
    data: storageBinCode,
    gas: 1000000
})
EOL
# run js deployment script for 33.sol
echo "Deploying 33.sol to rinkeby"
geth --rinkeby --exec 'loadScript("/tmp/33.js")' attach
# cleanup for 33.sol
rm /tmp/33.js

# cleanup sensitive files
rm $HOME/.ethereum/rinkeby/keystore/encrypted-rinkeby-account
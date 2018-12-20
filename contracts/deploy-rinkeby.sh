# may turn out to be a terrible idea, but let's try a deployment pipeline that get's us to rinkeby

# import rinkeby test account
mkdir -p $HOME/.ethereum/rinkeby/keystore/
echo $RINKEBY_PRIVATE_ACCOUNT_JSON >  $HOME/.ethereum/rinkeby/keystore/encrypted-rinkeby-account

# connect to rinkeby
geth --rinkeby --cache 4096 --nousb --syncmode light --rpc --rpcapi eth,web3,personal &
# sleep to allow rinkeby to connect
sleep 60s

# attempt to use geth
geth --rinkeby --exec 'eth.getGasPrice(function(e,r){console.log("gas price: ",r)})' attach
geth --rinkeby --exec 'console.log("last block: ",eth.blockNumber)' attach

# compile 33.sol
printf "%s" 'storageOutput = ' > /tmp/33.js
solc --optimize --combined-json abi,bin contracts/33.sol >> /tmp/33.js
# write js deployment script for 33.sol
cat >> /tmp/33.js <<EOL
storageContractAbi = storageOutput.contracts['33.sol:ethForAnswersBounty'].abi
storageContract = eth.contract(JSON.parse(storageContractAbi))
storageBinCode = "0x" + storageOutput.contracts['33.sol:ethForAnswersBounty'].bin
EOL
printf "personal.unlockAccount(eth.accounts[0],'%s')\n" $RINKEBY_PRIVATE_PASS >> /tmp/33.js
cat >> /tmp/33.js <<EOL
deployTransactionObject = { from: eth.accounts[0], data: storageBinCode, gas: 1000000 }
storageInstance = storageContract.new(deployTransactionObject)
EOL
# run js deployment script for 33.sol
geth --rinkeby --exec 'loadScript("/tmp/33.js")' attach
# cleanup for 33.sol
rm /tmp/33.js

# cleanup sensitive files
rm $HOME/.ethereum/testnet/keystore/encrypted-rinkeby-account
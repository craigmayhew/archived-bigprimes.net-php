# may turn out to be a terrible idea, but lets try a deployment pipeline that gets us to rinkeby
# TODO: Consider rewriting the js elements of this as nodejs rather than entirely through geth console

# Add PPA for installing nodejs 10
sudo apt-get install curl python-software-properties make -y
curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -

# TODO: perhaps we ditch solc binary and entirely switch to the npm version
sudo apt-get install -y solc geth nodejs
npm install -g node-gyp
npm install web3@1.0.0-beta.37
npm install solc@0.5.0
npm rebuild

# output versions for any future debugging
geth version
node -v
npm -v

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

# attempt to use geth, check some fundamentals
geth --rinkeby --exec '"gas price: " + eth.gasPrice' attach
geth --rinkeby --exec '"last block: " + eth.blockNumber' attach

#unlock wallet
UNLOCK=$(printf "personal.unlockAccount(eth.accounts[0],'%s')" $RINKEBY_PRIVATE_PASS)
geth --rinkeby --exec $UNLOCK attach

# compile 29.sol
solc --optimize --combined-json abi,bin contracts/29.sol > /tmp/29.compiled.js

# deploy 29.sol
nodejs contracts/29.deploy.js

#sleep for two blocks to allow contract to deploy and tests to run
echo "sleep for 5 blocks" && geth --rinkeby --exec 'admin.sleepBlocks(5)' attach
echo "sleep for 5 blocks" && geth --rinkeby --exec 'admin.sleepBlocks(5)' attach

# TODO: Check the exact number of transactions on the account matches expectations

# TODO: Check the before/after balances on wallet
ENDINGBALANCE="$(geth --rinkeby --exec 'web3.fromWei(eth.getBalance(eth.accounts[0]))' attach)"

printf "Starting balance: %s\n" $STARTINGBALANCE
printf "Final balance: %s\n" $ENDINGBALANCE

if [ "${STARTINGBALANCE}" -lt "${ENDINGBALANCE}" ]
# consider using php -r "echo (2.981587915886330942-2.981587915886330942);"
then
  # fail build as we don't have the expected balance
  $(exit 1)
fi

# cleanup for 29.sol
rm /tmp/29.compiled.js

# compile 33.sol
printf "%s" 'storageOutput = ' > /tmp/33.js
solc --optimize --combined-json abi,bin contracts/33.sol >> /tmp/33.js
# write js deployment script for 33.sol
cat >> /tmp/33.js <<EOL
var storageContractAbi = storageOutput.contracts['contracts/33.sol:ethForAnswersBounty'].abi
var storageContract = eth.contract(JSON.parse(storageContractAbi))
var storageBinCode = "0x" + storageOutput.contracts['contracts/33.sol:ethForAnswersBounty'].bin
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

# load up our test wallet
geth --rinkeby --cache 1024 --nousb --syncmode light --unlock $RINKEBY_PUBLIC_ETH_ADDRESS --password $RINKEBY_PRIVATE_PASS --rpc --rpcapi eth,web3,personal &
# sleep to allow rinkeby to connect
sleep 10s

geth --rinkeby --exec "eth.getGasPrice(function(e,r){console.log(r)})" attach

# 33.sol
#storageOutput = `solc --optimize --combined-json abi 33.sol`
#storageContractAbi = storageOutput.contracts['33.sol:ethForAnswersBounty'].abi
#storageContract = eth.contract(JSON.parse(storageContractAbi))
#storageBinCode = "0x" + storageOutput.contracts['33.sol:ethForAnswersBounty'].bin
#personal.unlockAccount(eth.accounts[0])
#deployTransactionObject = { from: eth.accounts[0], data: storageBinCode, gas: 1000000 }
#storageInstance = storageContract.new(deployTransactionObject)
// this contract exists just to prove the logic of contract 33.sol
// in future these two contracts should be combined so we pass in the desired answer
// at contract creation time
pragma solidity ^0.5;

contract owned {
    constructor() public { owner = msg.sender; }
    address payable owner;

    // This contract only defines a modifier but does not use
    // it: it will be used in derived contracts.
    // The function body is inserted where the special symbol
    // `_;` in the definition of a modifier appears.
    // This means that if the owner calls this function, the
    // function is executed and otherwise, an exception is
    // thrown.
    modifier onlyOwner {
        require(
            msg.sender == owner,
            "Only owner can call this function."
        );
        _;
    }
}

/*
  if you wish to test this contract, 51 = (-796)^3+(659)^3+(602)^3
  if you wish to test this contract, 29 = (2220422932)^3+(-2128888517)^3+(-283059956)^3
*/
contract ethForAnswersBounty is owned {
    
    int256 winningAnswer;

    constructor(int256 _winningAnswer) public payable {
        winningAnswer = _winningAnswer;
    }

    // allow anyone to send ether to this contract and for it to be added to the prize fund
    function () external payable { }

    // allow someone to attempt to win the prize by submitting 3 integers
    function attempt(int256 a, int256 b, int256 c) public returns (bool) {
        int256 result = safeFormula(a, b, c);
        if (winningAnswer == result) {
            payout();
        }
        return false;
    }

    // owner withdraws all ETH
    // TODO: Consider removing this before mainnet release
    function withdrawEther() public onlyOwner {
        selfdestruct(owner);
    }

    function safeFormula(int256 a, int256 b, int256 c) internal pure returns (int256) {
        // check for overflow potential of a signed 256bit integer, i.e. 255bit
        // the 255bit int needs to store a cube number
        // 2^255 -1 = 57896044618658097711785492504343953926634992332820282019728792003956564819967
        // (2^84)^3 =  7237005577332262213973186563042994240829374041602535252466099000494570602496
        // therefore 2^84 is approximately the largest value we should accept
        // (2^84)-1 = 7237005577332262213973186563042994240829374041602535252466099000494570602495
        assert(a < 7237005577332262213973186563042994240829374041602535252466099000494570602495);
        assert(b < 7237005577332262213973186563042994240829374041602535252466099000494570602495);
        assert(c < 7237005577332262213973186563042994240829374041602535252466099000494570602495);
        assert(a > -7237005577332262213973186563042994240829374041602535252466099000494570602495);
        assert(b > -7237005577332262213973186563042994240829374041602535252466099000494570602495);
        assert(c > -7237005577332262213973186563042994240829374041602535252466099000494570602495);

        return (a*a*a) + (b*b*b) + (c*c*c);
    }

    function payout() internal {
        selfdestruct(msg.sender);
    }
}
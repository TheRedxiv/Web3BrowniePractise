from brownie import t2gobc
from web3 import Web3

initial_supply = Web3.toWei(20, "ether")


def main():
    account = "0x753e85608e29a57e02ba3c12c381325E67841eA0"
    our_token = t2gobc.deploy(initial_supply, {"from": account})
    print(our_token.name())

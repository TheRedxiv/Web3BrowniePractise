from scripts.temp import cuenta
from brownie import t2gobc
from web3 import Web3


enviar = Web3.toWei(0.5, "ether")

def main():
    account = "0x753e85608e29a57e02ba3c12c381325E67841eA0"
    Pagable = t2gobc[-1]
    print(Pagable.enVenta({'from': account}))
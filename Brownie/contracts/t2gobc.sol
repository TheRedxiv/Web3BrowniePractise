// contracts/OurToken.sol
// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC20/ERC20.sol";

contract t2gobc is ERC20 {
    uint256 public _valueToken = 5;
    uint256 public _Value = 2;
    uint256 public _maxSupply = 10000000 * 10**18;
    uint256 private _totalSupply;
    mapping(address => uint256) private _balances;
    address duenio;
    mapping(address => uint256) private _enVenta;
    address[] public direccionesVenta;

    constructor(uint256 initialSupply) ERC20("t2gobc", "TGBC") {
        duenio = msg.sender;
        _mint(msg.sender, initialSupply);
    }

    function p2p(
        address from,
        address to,
        uint256 amount
    ) public virtual returns (bool) {
        require(msg.sender == duenio);
        address spender = _msgSender();
        _transfer(from, to, amount);
        return true;
    }

    function _compra(address account, uint256 amount) public payable {
        _mint(account, amount);
    }

    function _quema(address account, uint256 amount) public payable {
        _burn(account, amount);
    }

    function canjeo(address direccion, uint256 tokens) public payable {
        require(tokens > 0, "Debes pagar mas de 0");
        uint256 amount = tokens / _valueToken;
        uint256 _restoToken = _maxSupply - (_totalSupply + amount);
        require(_restoToken >= 0, "No tenemos tantos tokens a la venta");
        _mint(direccion, amount);
    }

    function withdraw() public payable {
        payable(msg.sender).transfer(address(this).balance);
    }

    function marketVenta(address direccion, uint256 tokens) public payable {
        _burn(direccion, tokens);
        _enVenta[direccion] += tokens;
        if (_enVenta[direccion] == tokens) {
            direccionesVenta.push(direccion);
        }
    }

    function marketCompra(
        address comprador,
        address vendededor,
        uint256 tokens
    ) public payable {
        require(
            _enVenta[vendededor] >= tokens,
            "ERC20: El vendedor no tiene tantos tokens a la venta"
        );
        _enVenta[vendededor] -= tokens;
        _mint(comprador, tokens);
    }

    function enVenta()
        public
        view
        returns (address[] memory, uint256[] memory)
    {
        address[] memory direcciones = new address[](direccionesVenta.length);
        uint256[] memory enVenta = new uint256[](direccionesVenta.length);

        for (uint256 i = 0; i < direccionesVenta.length; i++) {
            direcciones[i] = direccionesVenta[i];
            enVenta[i] = _enVenta[direccionesVenta[i]];
        }
        return (direcciones, enVenta);
    }
}

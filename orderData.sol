pragma solidity ^0.5.0;

contract storingData{
    
    event Added(uint id);
    
    struct orderData{
        string productName;
        uint productPrice;
        address account;
    }
    
    mapping(uint => orderData) allOrders;
    
    function addOrder(uint _orderID, string memory _productName, uint _productPrice) public returns(bool) {
        orderData memory newOrder = orderData({productName: _productName, productPrice: _productPrice, account: msg.sender});
        allOrders[_orderID] = newOrder;
        emit Added(_orderID);
        return true;
    }
    
    function getName(uint _orderID) public view returns (string memory) {
        require(msg.sender == allOrders[_orderID].account, "This order was not placed by you");
        return allOrders[_orderID].productName;
    }
    
    function getPrice(uint _orderID) public view returns (uint) {
        require(msg.sender == allOrders[_orderID].account, "This order was not placed by you");
        return allOrders[_orderID].productPrice;
    }
    
    function getAccount(uint _orderID) public view returns (address) {
        require(msg.sender == allOrders[_orderID].account, "This order was not placed by you");
        return allOrders[_orderID].account;
    }
    
}
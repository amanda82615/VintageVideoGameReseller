CREATE TABLE USER (
  UserId Int NOT NULL AUTO_INCREMENT,
  UserName VarChar(25) NOT NULL,
  Password VarChar(25) NOT NULL,
  FirstName VarChar(25) NOT NULL,
  LastName VarChar(25) NOT NULL,
  Email VarChar(40) NOT NULL UNIQUE,
  PRIMARY KEY (UserId)
);
ALTER TABLE USER AUTO_INCREMENT=1000;

CREATE TABLE ITEM (
  ItemId Int NOT NULL AUTO_INCREMENT,
  SellerId Int NOT NULL,
  ItemName VarChar(70) NOT NULL,
  Brand VarChar(50) NULL,
  Category VarChar(25) NOT NULL DEFAULT 'Other',
  State VarChar(25) NOT NULL,
  Price Decimal(10, 2) NOT NULL,
  Status VarChar(25) NOT NULL DEFAULT 'Available',
  PRIMARY KEY (ItemId),
  CONSTRAINT SELLER_FK FOREIGN KEY(SellerId) 
REFERENCES USER(UserId)
          	ON UPDATE CASCADE
          	ON DELETE CASCADE
);
ALTER TABLE ITEM AUTO_INCREMENT=1000;

CREATE TABLE TRANSACTION (
  TransactionNumber Int NOT NULL AUTO_INCREMENT,
  ItemId Int NOT NULL,
  PurchaserId Int NOT NULL,
  SaleDate Datetime NOT NULL,
  SalePrice Decimal(10, 2) NOT NULL,
  Tax Decimal(5, 2) NOT NULL,
  Total Decimal(10, 2) NOT NULL,
  ShippingAddress VarChar(50) NOT NULL,
  ShippingCity VarChar(20) NOT NULL,
  ShippingState VarChar(20) NOT NULL,
  ShippingZip VarChar(10) NOT NULL,
  PRIMARY KEY (TransactionNumber),
  CONSTRAINT ITEM_FK FOREIGN KEY(ItemId) 
REFERENCES ITEM(ItemId)
          	ON UPDATE CASCADE
          	ON DELETE CASCADE,
  CONSTRAINT BUYER_FK FOREIGN KEY(PurchaserId) 
REFERENCES USER(UserId)
          	ON UPDATE CASCADE
          	ON DELETE CASCADE
);
ALTER TABLE TRANSACTION AUTO_INCREMENT=1000;
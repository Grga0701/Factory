CREATE TABLE `Category` (
  `id` integer,
  `name` string,
  `description` string
);

CREATE TABLE `ContractList` (
  `id` integer,
  `user_id` integer,
  `price` float,
  `SKU` int
);

CREATE TABLE `PricetList` (
  `id` integer,
  `user_id` integer,
  `name` string,
  `price` float,
  `SKU` int
);

CREATE TABLE `Product` (
  `id` integer,
  `category` integer,
  `name` string,
  `description` string,
  `price` float,
  `SKU` int,
  `published` bool
);

CREATE TABLE `User` (
  `id` integer,
  `name` string,
  `lastname` string,
  `phone_number` int,
  `date_of_birth` datetime,
  `date_of_registration` datetime
);

CREATE TABLE `Order` (
  `id` integer,
  `user_id` integer,
  `date` datetime
);

CREATE TABLE `ProductOrder` (
  `id` integer,
  `order_id` integer,
  `product` integer,
  `price` float
);

ALTER TABLE `ContractList` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `ProductOrder` ADD FOREIGN KEY (`id`) REFERENCES `Order` (`id`);

CREATE TABLE `ProductOrder_Product` (
  `ProductOrder_product` integer,
  `Product_id` integer,
  PRIMARY KEY (`ProductOrder_product`, `Product_id`)
);

ALTER TABLE `ProductOrder_Product` ADD FOREIGN KEY (`ProductOrder_product`) REFERENCES `ProductOrder` (`product`);

ALTER TABLE `ProductOrder_Product` ADD FOREIGN KEY (`Product_id`) REFERENCES `Product` (`id`);


ALTER TABLE `Product` ADD FOREIGN KEY (`category`) REFERENCES `Category` (`id`);

CREATE TABLE `User_Order` (
  `User_id` integer,
  `Order_user_id` integer,
  PRIMARY KEY (`User_id`, `Order_user_id`)
);

ALTER TABLE `User_Order` ADD FOREIGN KEY (`User_id`) REFERENCES `User` (`id`);

ALTER TABLE `User_Order` ADD FOREIGN KEY (`Order_user_id`) REFERENCES `Order` (`user_id`);


ALTER TABLE `PricetList` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `PricetList` ADD FOREIGN KEY (`SKU`) REFERENCES `Product` (`SKU`);

ALTER TABLE `ContractList` ADD FOREIGN KEY (`SKU`) REFERENCES `Product` (`SKU`);

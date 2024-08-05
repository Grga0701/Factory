CREATE TABLE `Category` (
  `id` int,
  `name` varchar(255),
  `description` varchar(255)
);

CREATE TABLE `ContractList` (
  `id` int,
  `user_id` int,
  `price` float,
  `SKU` int,
  `modificator` varchar(255),
  `modificator_value` int
);

CREATE TABLE `PricetList` (
  `id` int,
  `name` varchar(255),
  `price` float,
  `SKU` int
);

CREATE TABLE `Product` (
  `id` int,
  `category` int,
  `name` varchar(255),
  `description` varchar(255),
  `SKU` int,
  `published` bool
);

CREATE TABLE `User` (
  `id` int,
  `name` varchar(255),
  `lastname` varchar(255),
  `phone_number` varchar(20),
  `date_of_birth` datetime,
  `date_of_registration` datetime
);

CREATE TABLE `Order` (
  `id` int,
  `user_id` int,
  `date` datetime,
  `dynamic_fields` varchar(255)
);

CREATE TABLE `ProductOrder` (
  `id` int,
  `order_id` int,
  `product_id` int,
  `price` float,
  `tax` int
);

ALTER TABLE `ContractList` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `ProductOrder` ADD FOREIGN KEY (`order_id`) REFERENCES `Order` (`id`);

ALTER TABLE `Product` ADD FOREIGN KEY (`category`) REFERENCES `Category` (`id`);

ALTER TABLE `PricetList` ADD FOREIGN KEY (`SKU`) REFERENCES `Product` (`SKU`);

ALTER TABLE `ContractList` ADD FOREIGN KEY (`SKU`) REFERENCES `Product` (`SKU`);

ALTER TABLE `Order` ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `ProductOrder` ADD FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`);

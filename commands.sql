#1. Orders 

CREATE TABLE IF NOT EXISTS Orders (
order_id int(11) NOT NULL AUTO_INCREMENT,
order_time datetime NOT NULL,
address_id int(11) NOT NULL,
order_status enum('ORDERED','SHIPPED','DELIVERED','') NOT NULL DEFAULT 'ORDERED',
order_total decimal(10,2) NOT NULL DEFAULT '0.00',
coupon_code varchar(20),
PRIMARY KEY (`order_id`),
FOREIGN KEY (`coupon_code`) REFERENCES `Coupons` (`coupon_code`),
FOREIGN KEY (`address_id`) REFERENCES `Addresses` (`address_id`)
);

INSERT INTO Orders VALUES (1, '2018-02-28', '1', 'ORDERED', '10.00', NULL);
INSERT INTO Orders VALUES (2, '2018-02-28', '2', 'SHIPPED', '25.00', NULL);
INSERT INTO Orders VALUES (3, '2018-02-28', '1', 'DELIVERED', '55.00', 'V44SUG');

 

#2. Order_details (order_id, item_id, quantity): order_id is the primary key, not null and unique.

CREATE TABLE Order_details (
`order_id` int(11) NOT NULL,
`item_id` int(11) NOT NULL,
`quantity` int(2) DEFAULT NULL,
PRIMARY KEY (`order_id`),
KEY `order_id` (`order_id`),
KEY `item_id` (`item_id`),
FOREIGN KEY (`order_id`) REFERENCES `Orders` (`order_id`),
FOREIGN KEY (`item_id`) REFERENCES `Items` (`item_id`)
);
 
INSERT INTO ‘Order_details’ (‘order_id’, ‘item_id’, ‘quantity’) VALUES
(1, 2, 8),
(2, 3, 40),
(3, 1, 2),
(4, 4, 5);

#3. Items

CREATE TABLE IF NOT EXISTS Items (
  item_id int NOT NULL DEFAULT '',
  `item_name` varchar(20) NOT NULL DEFAULT '',
  `price` float DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `description` varchar(5) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `instock` bool,
  PRIMARY KEY (`item_id`)
);


INSERT INTO Items (`item_id`, `item_name`,`price`,`type`,`description`,`quantity`,`instock`) VALUES
(1, 'mochi', 2.99, 'dessert', 'very chewy', 50, True),
(2, 'kimchi', 5.99, 'spicy', 'made in Korea', 50, True),
(3, 'chocolate', 3.99, 'dessert', 'made in Belgium', 50, True),
(4, 'gum', 1.99, 'candy', 'long-lasting flavor', 50, True),
(5, 'hi-chew', 1.99, 'candy', 'lemon flavor', 50, True);

 

#4. Users (username, name, password): the username is the primary key, not null and unique.

CREATE TABLE Users (
`username` varchar(50) NOT NULL,
`name` varchar(50) DEFAULT NULL,
`password` varchar(50) DEFAULT NULL,
PRIMARY KEY (`username`)
);

INSERT INTO Users (username, name, password) VALUES
(“jp7hk”, “Jinnie Park”, “jinniepark1234”),
(“xz7uy”, “Cynthia Zheng”, “cynthiazheng1234”),
(“rx5zv”, “Linda Xiong”, “lindaxiong1234”),
(“hc3gf”, “Elizabeth Chang”, “elizabethchang1234”);

 

#5. Cart
Cart (username, in_cart): both attributes are primary keys, not null and unique. Username is a foreign key from the Users table, and in_cart is a foreign key from the Items table.
CREATE TABLE Cart (
`username` varchar(50) NOT NULL,
`in_cart` int(11) NOT NULL,
PRIMARY KEY (`username`,`in_cart`),
FOREIGN KEY (`in_cart`) REFERENCES `Items` (`item_id`) ON DELETE CASCADE,
FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
);

INSERT INTO Cart (username, in_cart) VALUES
(‘jp7hk’, 1),
(‘jp7hk’, 2),
(‘xz7uy’, 2),
(‘rx5zv’, 4),
(‘hc3gf’, 3);
 

#6. Favorites 

CREATE TABLE favorites (
`username` varchar(50) NOT NULL,
`in_fav` int(11) NOT NULL,
PRIMARY KEY (`username`,`in_fav`),
FOREIGN KEY (`in_fav`) REFERENCES `Items` (`item_id`) ON DELETE CASCADE,
FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
);

INSERT INTO favorites (username, in_fav) VALUES
(‘jp7hk‘, 2),
(‘xz7uy‘, 3),
(‘rx5zv’, 5),
(‘hc3gf‘, 1);

#7. Reviews (review_id, username, content, score, item_id, title): review_id is the primary key and is auto-incremented

CREATE TABLE Reviews (
`review_id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(30) NOT NULL,
`content` varchar(2048) NOT NULL,
`score` int(11) NOT NULL,
`item_id` int(11) NOT NULL,
`title` varchar(200) NOT NULL,
PRIMARY KEY (`review_id`),
FOREIGN KEY (`item_id`) REFERENCES `Items` (`item_id`),
FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
);

INSERT INTO Reviews (review_id, username, content,  score, item_id, title) VALUES
(1, 'jp7hk', 'this is a review for mochi', 5, 1, 'Great' ),
(2, 'xz7uy', 'another review for mochi', 4, 1, 'Review 2' ),
(3, 'rx5zv', 'I love lemon flavor', 5, 5, 'Hichew review'),
(4, 'hc3gf', 'Not bad', 3, 4, 'Title 4');

 

#8. Address (address_id, username, street, city, state, zip, recipient): address_id is the primary key, which is auto-incremented. All fields are not null. Username is a foreign key from Users table

CREATE TABLE IF NOT EXISTS Addresses (
  `username` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` int(5) NOT NULL,
  `address_id` int(11) NOT NULL,
  `recipient` varchar(50) NOT NULL,
  PRIMARY KEY (`address_id`),
  FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
);

INSERT INTO Addresses (username, street, city,  state, zip, address_id, recipient) VALUES
(‘jp7hk’, ‘110 Stadium Rd.’, ‘Charlottesville’, ‘VA’, 20939, 1, ‘Jinnie Park’ ),
(‘xz7uy’, ‘425 W Main St.’, ‘Ellicott City’, , ‘MD’, 22993, 2, ‘Cynthia Zheng’ ),
(‘rx5zv’, ‘11 42nd St.’, ‘New York’, ‘NY’, ‘10026’, 3, ‘Linda Xiong’),
(‘hc3gf‘, ‘1600 Amphitheatre Pkwy’, ‘Mountain View’, ‘CA’, ‘94043’, 4, ‘Elizabeth Chang’);

 

#9. Coupons (coupon_code, coupon_value, valid): coupon_code is the primary key. Valid is a boolean.
CREATE TABLE IF NOT EXISTS `Coupons` (
  `coupon_code` varchar(10) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '1',
 PRIMARY KEY (`coupon_code`)
)

INSERT INTO `Coupons` (coupon_code, coupon_value, valid) VALUES
(“RM430V”, 50, 1),
(“V44SUG”, 30, 1),
(“AR456M”, 100, 1),
(“LOI39O”, 200, 0);
 

CREATE database db_go;
USE db_go;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `ctg_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ctg_name` varchar(64) COLLATE utf8_bin NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`ctg_id`) USING BTREE,
  UNIQUE KEY `idx_category_name` (`ctg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='菜品分类';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (NULL,'主食');
INSERT INTO `category` VALUES (NULL,'川菜');
INSERT INTO `category` VALUES (NULL,'粤菜');
INSERT INTO `category` VALUES (NULL,'饮品');

-- ----------------------------
-- Table structure for dish
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `dish_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dish_name` varchar(64) COLLATE utf8_bin NOT NULL COMMENT '菜品名称',
  `dish_category_id` bigint(20) NOT NULL COMMENT '菜品分类id',
  `dish_price` decimal(10,2) DEFAULT NULL COMMENT '菜品价格',
  `dish_image` varchar(200) COLLATE utf8_bin NOT NULL COMMENT '图片',
  `dish_des` varchar(400) COLLATE utf8_bin DEFAULT NULL COMMENT '描述信息',
  `dish_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 停售 1 起售',
  `dish_weight` int(11) NOT NULL DEFAULT '0' COMMENT '重量',
  `dish_nutrition_id` bigint(20) NOT NULL COMMENT '营养分类id',
  PRIMARY KEY (`dish_id`) USING BTREE,
  UNIQUE KEY `idx_dish_name` (`dish_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='菜品管理';

-- ----------------------------
-- Records of dish
-- ----------------------------
INSERT INTO dish VALUES (NULL,'辣子鸡','2','80','','来自鲜嫩美味的小鸡，值得一尝',1,250,'2');

-- ----------------------------
-- Table structure for dish_flavor
-- ----------------------------
DROP TABLE IF EXISTS `dish_flavor`;
CREATE TABLE `dish_flavor` (
  `df_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `dish_id` bigint(20) NOT NULL COMMENT '菜品',
  `df_name` varchar(64) COLLATE utf8_bin NOT NULL COMMENT '口味名称',
  `df_value` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '口味数据list',
  PRIMARY KEY (`df_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='菜品口味关系表';

-- ----------------------------
-- Records of dish_flavor
-- ----------------------------
INSERT INTO dish_flavor VALUES (NULL,'1','辣度','[\"不辣\",\"微辣\",\"中辣\",\"重辣\"]');
-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `order_number` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '订单号',
  `order_status` int(11) NOT NULL DEFAULT '1' COMMENT '订单状态 1待付款，2已下单，3已接单，4制作中，5已完成，6已取消',
  `user_id` bigint(20) NOT NULL COMMENT '下单用户',
  `order_time` datetime NOT NULL COMMENT '下单时间',
  `checkout_time` datetime COMMENT '结账时间',
  `amount` decimal(10,2) NOT NULL COMMENT '实收金额',
  `remark` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '备注',
  `number` int(11) NOT NULL COMMENT '餐桌号',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='订单表';

-- ----------------------------
-- Records of orders
-- ----------------------------


-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_name` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '姓名',
  `user_phone` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '手机号',
  `user_sex` varchar(2) COLLATE utf8_bin DEFAULT NULL COMMENT '性别',
  `user_avatar` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '头像',
  `user_pwd` varchar(500) COLLATE utf8_bin  NOT NULL COMMENT '密码',
  `user_age` int(11) DEFAULT 18 COMMENT '年龄',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户信息';

-- ----------------------------
-- Records of user
-- ----------------------------

INSERT INTO user VALUES (NULL,'傅贤杨','13958958107','男','','e10adc3949ba59abbe56e057f20f883e','21');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL COMMENT '主键',
  `admin_pwd` varchar(500) COLLATE utf8_bin  NOT NULL COMMENT '密码',
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='管理员信息';

-- ----------------------------
-- Records of admin
-- ----------------------------

INSERT INTO admin VALUES ('root','e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `od_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `order_id` bigint(20) NOT NULL COMMENT '订单id',
  `dish_id` bigint(20) DEFAULT NULL COMMENT '菜品id',
  `dish_flavor` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '口味',
  `number` int(11) NOT NULL DEFAULT '1' COMMENT '数量',
  `amount` decimal(10,2) NOT NULL COMMENT '金额',
  PRIMARY KEY (`od_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='订单明细表';

-- ----------------------------
-- Records of order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for nutrition
-- ----------------------------

DROP TABLE IF EXISTS `nutrition`;
CREATE TABLE `nutrition` (
  `ntt_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ntt_name` varchar(64) COLLATE utf8_bin NOT NULL COMMENT '营养名称',
  PRIMARY KEY (`ntt_id`) USING BTREE,
  UNIQUE KEY `idx_category_name` (`ntt_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='营养分类';

-- ----------------------------
-- Records of nutrition
-- ----------------------------

INSERT INTO nutrition VALUES (NULL,'脂肪和糖');
INSERT INTO nutrition VALUES (NULL,'蛋白质');
INSERT INTO nutrition VALUES (NULL,'水果');
INSERT INTO nutrition VALUES (NULL,'蔬菜类');
INSERT INTO nutrition VALUES (NULL,'谷类');

-- ----------------------------
-- Table structure for shopping_cart
-- ----------------------------
DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE `shopping_cart` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '名称',
  `image` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '图片',
  `user_id` bigint(20) NOT NULL COMMENT '主键',
  `dish_id` bigint(20) DEFAULT NULL COMMENT '菜品id',
  `dish_flavor` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '口味',
  `number` int(11) NOT NULL DEFAULT '1' COMMENT '数量',
  `amount` decimal(10,2) NOT NULL COMMENT '金额',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='购物车';

-- ----------------------------
-- Records of shopping_cart
-- ----------------------------
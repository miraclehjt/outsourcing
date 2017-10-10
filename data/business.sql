CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `mobile` varchar(16) NOT NULL COMMENT '手机号',
  `password` varchar(32) NOT NULL COMMENT '登陆密码',
  `salt` varchar(16) NOT NULL COMMENT '加密盐',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(128) NOT NULL DEFAULT '' COMMENT '用户头像路径',
  `gender` enum('2','1','0') NOT NULL DEFAULT '0' COMMENT '性别 0-未选择 1-男 2-女',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '出生日期',
  `region` varchar(256) NOT NULL DEFAULT '' COMMENT '所在地域',
  `sign` varchar(128) NOT NULL DEFAULT '' COMMENT '签名',
  `star` varchar(32) NOT NULL DEFAULT '' COMMENT '星座',
  `verify` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否认证 0-未认证 1-待审核 2-已认证 3-认证失败',
  `user_level` tinyint(4) NOT NULL DEFAULT 1 COMMENT '级别 1普通 2认证 3明星',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户状态 0-正常 1-关闭',
  `follow` int(11) NOT NULL DEFAULT '0' COMMENT '关注的人数',
  `fans` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `like` int(11) NOT NULL DEFAULT '0' COMMENT '被赞数',
  `create_time` datetime NOT NULL COMMENT '注册时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobile` (`mobile`) COMMENT '手机号唯一索引'
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

CREATE TABLE `merchant` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'logo',
  `address` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '地址',
  `lng` varchar(21) NOT NULL DEFAULT '' COMMENT '经度',
  `lat` varchar(21) NOT NULL DEFAULT '' COMMENT '纬度',
  `status` CHAR(1) NOT NULL DEFAULT 'Y' COMMENT 'status Y - N',
  `description` VARCHAR(255) NOT NULL  DEFAULT '' COMMENT '描述',
  `create_time` datetime NOT NULL COMMENT '关注时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COMMENT='商户表';

CREATE TABLE `merchant_price` (
  `mp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `merchant_id` int(11) NOT NULL DEFAULT 0 COMMENT '商家ID',
  `start` TIME NOT NULL DEFAULT '00:00:00' COMMENT '开始时间',
  `end` TIME NOT NULL DEFAULT '00:00:00' COMMENT '开始时间',
  `price` bigint(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `status` char(1) NOT NULL DEFAULT 'Y' COMMENT 'status Y - N',
  `create_time` datetime NOT NULL COMMENT '关注时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='商户价目表';
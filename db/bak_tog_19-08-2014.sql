-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `thiopticalgroup`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `gallery`
-- 

CREATE TABLE `gallery` (
  `gal_id` int(11) NOT NULL auto_increment,
  `gal_image_url` varchar(200) NOT NULL,
  `gal_date` date NOT NULL,
  PRIMARY KEY  (`gal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- dump ตาราง `gallery`
-- 

INSERT INTO `gallery` VALUES (1, 'images/gallery/gallery1.jpg', '2014-08-01');
INSERT INTO `gallery` VALUES (2, 'images/gallery/gallery2.jpg', '2014-08-02');
INSERT INTO `gallery` VALUES (3, 'images/gallery/gallery3.jpg', '2014-08-04');
INSERT INTO `gallery` VALUES (4, 'images/gallery/gallery4.jpg', '2014-08-05');
INSERT INTO `gallery` VALUES (5, 'images/gallery/gallery1.jpg', '2014-08-06');
INSERT INTO `gallery` VALUES (6, 'images/gallery/gallery2.jpg', '2014-08-07');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `gallery_images`
-- 

CREATE TABLE `gallery_images` (
  `img_id` int(11) NOT NULL auto_increment,
  `gal_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY  (`img_id`,`gal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- dump ตาราง `gallery_images`
-- 

INSERT INTO `gallery_images` VALUES (1, 1, 'images/gallery/gallery1.jpg');
INSERT INTO `gallery_images` VALUES (2, 2, 'images/gallery/gallery2.jpg');
INSERT INTO `gallery_images` VALUES (3, 3, 'images/gallery/gallery3.jpg');
INSERT INTO `gallery_images` VALUES (4, 4, 'images/gallery/gallery4.jpg');
INSERT INTO `gallery_images` VALUES (5, 1, 'images/gallery/gallery2.jpg');
INSERT INTO `gallery_images` VALUES (6, 5, 'images/gallery/gallery3.jpg');
INSERT INTO `gallery_images` VALUES (7, 6, 'images/gallery/gallery4.jpg');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `gallery_language`
-- 

CREATE TABLE `gallery_language` (
  `gal_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `gal_category` varchar(100) NOT NULL,
  `gal_description` varchar(200) NOT NULL,
  `gal_text` text NOT NULL,
  PRIMARY KEY  (`gal_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `gallery_language`
-- 

INSERT INTO `gallery_language` VALUES (1, 1, 'เป็นข้อความกระพริบ 1', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม ', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม Lorem Ipsum ได้รับข้อความกระพริบมาตรฐานอุตสาหกรรมตั้งแต่ 14 เมื่อเครื่องพิมพ์แบบไม่รู้จักเอานิตยสารชนิด และแปลงมันจะทำให้หนังสือตัวอย่างชนิด มันมีชีวิตรอดไม่เพียงห้าศตวรรษ แต่ยังกระโดดลงใน typesetting อิเล็กทรอนิกส์ ที่เหลือเปลี่ยนแปลงเป็นหลัก มันเป็น popularised ในปี 1960 กับแผ่น Letraset ที่ประกอบด้วยทางเดินของ Lorem Ipsum และเมื่อเร็ว ๆ นี้ กับซอฟต์แวร์ออกแบบสิ่งพิมพ์เช่น Aldus PageMaker รวมรุ่นของ Lorem Ipsum');
INSERT INTO `gallery_language` VALUES (1, 2, 'Lorem Ipsum 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `gallery_language` VALUES (2, 1, 'คือเนื้อหาจำลอง', 'เกาหลีเซ็กซี่เป็นข้อความเพียงแค่ตัวอย่างของการพิมพ์และ typesetting ', 'เกาหลีเซ็กซี่เป็นข้อความเพียงแค่ตัวอย่างของการพิมพ์และ typesetting อุตสาหกรรม เกาหลีเซ็กซี่ได้รับของอุตสาหกรรมมาตรฐานหุ่นข้อความตั้งแต่ 1500s เมื่อเครื่องพิมพ์ไม่รู้จักใช้เวลาว่างของชนิดและกวนมันให้ตัวอย่างประเภทหนังสือ มันมีชีวิตรอดไม่เพียงห้าศตวรรษ แต่ยังกระโดดลงในการเรียงพิมพ์อิเล็กทรอนิกส์ , ที่เหลือเป็นหลักไม่เปลี่ยนแปลงมันได้รับความนิยมในทศวรรษที่ 1960 กับรุ่นที่มี letraset แผ่นพเกี่ยวกับข้อความและมากขึ้นเมื่อเร็ว ๆนี้กับการใช้คอมพิวเตอร์ซอฟต์แวร์เช่นเพจเมกเกอร์ดังนั้นรวมทั้งรุ่นของเกาหลีเซ็กซี่ .');
INSERT INTO `gallery_language` VALUES (2, 2, 'Lorem Ipsum is simply', 'Lorem Ipsum is simply dummy text of the printing and typesetting ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `gallery_language` VALUES (3, 1, 'คือเนื้อหาจำลองแบบเรียบๆ', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม Lorem Ipsum ได้รับข้อความกระพริบมาตรฐานอุตสาหกรรมตั้งแต่ 14 เมื่อเครื่องพิมพ์แบบไม่รู้จักเอานิตยสารชนิด และแปลงมันจะทำให้หนังสือตัวอย่างชนิด มันมีชีวิตรอดไม่เพียงห้าศตวรรษ แต่ยังกระโดดลงใน typesetting อิเล็กทรอนิกส์ ที่เหลือเปลี่ยนแปลงเป็นหลัก มันเป็น popularised ในปี 1960 กับแผ่น Letraset ที่ประกอบด้วยทางเดินของ Lorem Ipsum และเมื่อเร็ว ๆ นี้ กับซอฟต์แวร์ออกแบบสิ่งพิมพ์เช่น Aldus PageMaker รวมรุ่นของ Lorem Ipsum');
INSERT INTO `gallery_language` VALUES (3, 2, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `gallery_language` VALUES (4, 1, 'คือเนื้อหาจำลอง 4', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม Lorem Ipsum ได้รับข้อความกระพริบมาตรฐานอุตสาหกรรมตั้งแต่ 14 เมื่อเครื่องพิมพ์แบบไม่รู้จักเอานิตยสารชนิด และแปลงมันจะทำให้หนังสือตัวอย่างชนิด มันมีชีวิตรอดไม่เพียงห้าศตวรรษ แต่ยังกระโดดลงใน typesetting อิเล็กทรอนิกส์ ที่เหลือเปลี่ยนแปลงเป็นหลัก มันเป็น popularised ในปี 1960 กับแผ่น Letraset ที่ประกอบด้วยทางเดินของ Lorem Ipsum และเมื่อเร็ว ๆ นี้ กับซอฟต์แวร์ออกแบบสิ่งพิมพ์เช่น Aldus PageMaker รวมรุ่นของ Lorem Ipsum');
INSERT INTO `gallery_language` VALUES (4, 2, 'desktop publishing', 'Lorem Ipsum is simply dummy text of the printing and typesetting ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `gallery_language` VALUES (5, 1, 'คาเตโกรี่ 5', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม', 'Lorem Ipsum เป็นข้อความกระพริบเพียงพิมพ์และ typesetting อุตสาหกรรม Lorem Ipsum ได้รับข้อความกระพริบมาตรฐานอุตสาหกรรมตั้งแต่ 14 เมื่อเครื่องพิมพ์แบบไม่รู้จักเอานิตยสารชนิด และแปลงมันจะทำให้หนังสือตัวอย่างชนิด มันมีชีวิตรอดไม่เพียงห้าศตวรรษ แต่ยังกระโดดลงใน typesetting อิเล็กทรอนิกส์ ที่เหลือเปลี่ยนแปลงเป็นหลัก มันเป็น popularised ในปี 1960 กับแผ่น Letraset ที่ประกอบด้วยทางเดินของ Lorem Ipsum และเมื่อเร็ว ๆ นี้ กับซอฟต์แวร์ออกแบบสิ่งพิมพ์เช่น Aldus PageMaker รวมรุ่นของ Lorem Ipsum');
INSERT INTO `gallery_language` VALUES (5, 2, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
INSERT INTO `gallery_language` VALUES (6, 1, 'คาเตโกรี่ 6', 'เกาหลีเซ็กซี่เป็นข้อความเพียงแค่ตัวอย่างของการพิมพ์และ typesetting ', 'เกาหลีเซ็กซี่เป็นข้อความเพียงแค่ตัวอย่างของการพิมพ์และ typesetting อุตสาหกรรม เกาหลีเซ็กซี่ได้รับของอุตสาหกรรมมาตรฐานหุ่นข้อความตั้งแต่ 1500s เมื่อเครื่องพิมพ์ไม่รู้จักใช้เวลาว่างของชนิดและกวนมันให้ตัวอย่างประเภทหนังสือ มันมีชีวิตรอดไม่เพียงห้าศตวรรษ แต่ยังกระโดดลงในการเรียงพิมพ์อิเล็กทรอนิกส์ , ที่เหลือเป็นหลักไม่เปลี่ยนแปลงมันได้รับความนิยมในทศวรรษที่ 1960 กับรุ่นที่มี letraset แผ่นพเกี่ยวกับข้อความและมากขึ้นเมื่อเร็ว ๆนี้กับการใช้คอมพิวเตอร์ซอฟต์แวร์เช่นเพจเมกเกอร์ดังนั้นรวมทั้งรุ่นของเกาหลีเซ็กซี่ .');
INSERT INTO `gallery_language` VALUES (6, 2, 'category 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `language`
-- 

CREATE TABLE `language` (
  `lang_id` int(11) NOT NULL auto_increment,
  `language` char(2) NOT NULL,
  `flag` varchar(100) NOT NULL,
  `is_disable` tinyint(1) NOT NULL,
  PRIMARY KEY  (`lang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- dump ตาราง `language`
-- 

INSERT INTO `language` VALUES (1, 'th', 'images/flag/th.png', 0);
INSERT INTO `language` VALUES (2, 'en', 'images/flag/th.png', 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `menus`
-- 

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `menu_name` varchar(150) NOT NULL,
  `menu_url` varchar(200) NOT NULL,
  `ordering` int(11) NOT NULL,
  `is_article` tinyint(1) NOT NULL,
  `is_disable` tinyint(1) NOT NULL,
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- dump ตาราง `menus`
-- 

INSERT INTO `menus` VALUES (1, 0, 'HOME', 'home', 1, 0, 0);
INSERT INTO `menus` VALUES (2, 0, 'COMPANY', '', 2, 0, 0);
INSERT INTO `menus` VALUES (3, 0, 'PRODUCTS', '', 3, 0, 0);
INSERT INTO `menus` VALUES (4, 0, 'CG & CSR', '', 4, 0, 0);
INSERT INTO `menus` VALUES (5, 0, 'Investor Relation', '', 5, 0, 0);
INSERT INTO `menus` VALUES (6, 0, 'CONTACT US', '', 6, 0, 0);
INSERT INTO `menus` VALUES (7, 2, 'History', '', 1, 1, 0);
INSERT INTO `menus` VALUES (8, 2, 'Board of Directors', '', 2, 1, 0);
INSERT INTO `menus` VALUES (9, 2, 'Management', '', 3, 1, 0);
INSERT INTO `menus` VALUES (10, 2, 'Visions', '', 4, 1, 0);
INSERT INTO `menus` VALUES (11, 2, 'Ethics', '', 5, 1, 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news`
-- 

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL auto_increment,
  `news_date` date NOT NULL,
  `is_front_page` tinyint(1) NOT NULL,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `news`
-- 

INSERT INTO `news` VALUES (1, '2014-08-10', 1);
INSERT INTO `news` VALUES (2, '2014-08-11', 1);
INSERT INTO `news` VALUES (3, '2014-08-13', 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news_language`
-- 

CREATE TABLE `news_language` (
  `news_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `news_title` varchar(150) NOT NULL,
  `news_description` varchar(255) NOT NULL,
  `news_text` text NOT NULL,
  PRIMARY KEY  (`news_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `news_language`
-- 

INSERT INTO `news_language` VALUES (1, 1, 'ข่าว 1', 'ข้อความที่ถูกนำมาใช้ประกอบการออกแบบข้างต้น ประกอบการออกแบบข้างต้น 1', 'ได้กลายมาเป็นเนื้อหาจำลองมาตรฐานของธุรกิจการพิมพ์ การออกแบบมาตั้งแต่ศตวรรษที่ 16 เมื่อเครื่องพิมพ์โนเนมเครื่องหนึ่งนำรางตัวพิมพ์มาสลับสับตำแหน่งตัวอักษรเพื่อทำหนังสือตัวอย่าง Lorem Ipsum อยู่ยงคงกระพันมาไม่ใช่แค่เพียงห้าศตวรรษ แต่อยู่มาจนถึงยุคที่พลิกโฉมเข้าสู่งานเรียงพิมพ์ด้วยวิธีทางอิเล็กทรอนิกส์ และยังคงสภาพเดิมไว้อย่างไม่มีการเปลี่ยนแปลง มันได้รับความนิยมมากขึ้นในยุค ค.ศ. 1960 เมื่อแผ่น Letraset วางจำหน่ายโดยมีข้อความบนนั้นเป็น ');
INSERT INTO `news_language` VALUES (1, 2, 'News 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at');
INSERT INTO `news_language` VALUES (2, 1, 'ข่าว 2', 'ข้อความที่ถูกนำมาใช้ประกอบการออกแบบข้างต้น ประกอบการออกแบบข้างต้น 2', 'ได้กลายมาเป็นเนื้อหาจำลองมาตรฐานของธุรกิจการพิมพ์ การออกแบบมาตั้งแต่ศตวรรษที่ 16 เมื่อเครื่องพิมพ์โนเนมเครื่องหนึ่งนำรางตัวพิมพ์มาสลับสับตำแหน่งตัวอักษรเพื่อทำหนังสือตัวอย่าง Lorem Ipsum อยู่ยงคงกระพันมาไม่ใช่แค่เพียงห้าศตวรรษ แต่อยู่มาจนถึงยุคที่พลิกโฉมเข้าสู่งานเรียงพิมพ์ด้วยวิธีทางอิเล็กทรอนิกส์ และยังคงสภาพเดิมไว้อย่างไม่มีการเปลี่ยนแปลง มันได้รับความนิยมมากขึ้นในยุค ค.ศ. 1960 เมื่อแผ่น Letraset วางจำหน่ายโดยมีข้อความบนนั้นเป็น ');
INSERT INTO `news_language` VALUES (2, 2, 'News 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at', 'rgfdfghhghgghfgfhghffghfg fdghfhgfghfg fghfgh fhf fgh');
INSERT INTO `news_language` VALUES (3, 1, 'ข่าว 3', 'ข้อความที่ถูกนำมาใช้ประกอบการออกแบบข้างต้น ประกอบการออกแบบข้างต้น 3', 'ได้กลายมาเป็นเนื้อหาจำลองมาตรฐานของธุรกิจการพิมพ์ การออกแบบมาตั้งแต่ศตวรรษที่ 16 เมื่อเครื่องพิมพ์โนเนมเครื่องหนึ่งนำรางตัวพิมพ์มาสลับสับตำแหน่งตัวอักษรเพื่อทำหนังสือตัวอย่าง Lorem Ipsum อยู่ยงคงกระพันมาไม่ใช่แค่เพียงห้าศตวรรษ แต่อยู่มาจนถึงยุคที่พลิกโฉมเข้าสู่งานเรียงพิมพ์ด้วยวิธีทางอิเล็กทรอนิกส์ และยังคงสภาพเดิมไว้อย่างไม่มีการเปลี่ยนแปลง มันได้รับความนิยมมากขึ้นในยุค ค.ศ. 1960 เมื่อแผ่น Letraset วางจำหน่ายโดยมีข้อความบนนั้นเป็น ');
INSERT INTO `news_language` VALUES (3, 2, 'News 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias a 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at');

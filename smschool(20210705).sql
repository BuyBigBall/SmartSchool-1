/*
SQLyog Trial v12.2.6 (32 bit)
MySQL - 10.4.8-MariaDB : Database - ssnodb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ssnodb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ssnodb`;

/*Table structure for table `alumni_events` */

DROP TABLE IF EXISTS `alumni_events`;

CREATE TABLE `alumni_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `event_for` varchar(100) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `note` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `event_notification_message` text NOT NULL,
  `show_onwebsite` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumni_events` */

/*Table structure for table `alumni_students` */

DROP TABLE IF EXISTS `alumni_students`;

CREATE TABLE `alumni_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_email` varchar(255) NOT NULL,
  `current_phone` varchar(255) NOT NULL,
  `occupation` text NOT NULL,
  `address` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `alumni_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `alumni_students` */

/*Table structure for table `attendence_type` */

DROP TABLE IF EXISTS `attendence_type`;

CREATE TABLE `attendence_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `key_value` varchar(50) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `attendence_type` */

insert  into `attendence_type`(`id`,`type`,`key_value`,`is_active`,`created_at`,`updated_at`) values 
(1,'Present','<b class=\"text text-success\">P</b>','yes','2016-06-23 11:11:37','0000-00-00'),
(2,'Late With Excuse','<b class=\"text text-warning\">E</b>','no','2018-05-29 01:19:48','0000-00-00'),
(3,'Permission','<b class=\"text text-warning\">L</b>','yes','2021-07-03 15:17:51','0000-00-00'),
(4,'Absent','<b class=\"text text-danger\">A</b>','yes','2016-10-11 04:35:40','0000-00-00'),
(5,'Holiday','H','yes','2016-10-11 04:35:01','0000-00-00'),
(6,'Sick','<b class=\"text text-warning\">F</b>','yes','2021-07-03 15:17:40','0000-00-00');

/*Table structure for table `book_issues` */

DROP TABLE IF EXISTS `book_issues`;

CREATE TABLE `book_issues` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `duereturn_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `is_returned` int(11) DEFAULT 0,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `book_issues` */

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(100) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `isbn_no` varchar(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `rack_no` varchar(100) NOT NULL,
  `publish` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `perunitcost` float(10,2) DEFAULT NULL,
  `postdate` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `available` varchar(10) DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `books` */

/*Table structure for table `captcha` */

DROP TABLE IF EXISTS `captcha`;

CREATE TABLE `captcha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `captcha` */

insert  into `captcha`(`id`,`name`,`status`,`created_at`) values 
(1,'userlogin',0,'2021-01-19 00:10:29'),
(2,'login',0,'2021-01-19 00:10:31'),
(3,'admission',0,'2021-01-18 20:48:11'),
(4,'complain',0,'2021-01-18 20:48:13'),
(5,'contact_us',0,'2021-01-18 20:48:15');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

/*Table structure for table `certificates` */

DROP TABLE IF EXISTS `certificates`;

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_name` varchar(100) NOT NULL,
  `certificate_text` text NOT NULL,
  `left_header` varchar(100) NOT NULL,
  `center_header` varchar(100) NOT NULL,
  `right_header` varchar(100) NOT NULL,
  `left_footer` varchar(100) NOT NULL,
  `right_footer` varchar(100) NOT NULL,
  `center_footer` varchar(100) NOT NULL,
  `background_image` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `created_for` tinyint(1) NOT NULL COMMENT '1 = staff, 2 = students',
  `status` tinyint(1) NOT NULL,
  `header_height` int(11) NOT NULL,
  `content_height` int(11) NOT NULL,
  `footer_height` int(11) NOT NULL,
  `content_width` int(11) NOT NULL,
  `enable_student_image` tinyint(1) NOT NULL COMMENT '0=no,1=yes',
  `enable_image_height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `certificates` */

insert  into `certificates`(`id`,`certificate_name`,`certificate_text`,`left_header`,`center_header`,`right_header`,`left_footer`,`right_footer`,`center_footer`,`background_image`,`created_at`,`updated_at`,`created_for`,`status`,`header_height`,`content_height`,`footer_height`,`content_width`,`enable_student_image`,`enable_image_height`) values 
(1,'Sample Transfer Certificate','This is certify that <b>[name]</b> has born on [dob]  <br> and have following details [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone] .<br>We wish best of luck for future endeavors.','Reff. No.....1111111.........','To Whomever It May Concern','Date: _10__/_10__/__2019__','.................................<br>admin','.................................<br>principal','.................................<br>admin','sampletc121.png','2019-12-21 07:14:34','0000-00-00',2,1,360,400,480,810,1,230);

/*Table structure for table `chat_connections` */

DROP TABLE IF EXISTS `chat_connections`;

CREATE TABLE `chat_connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_user_one` int(11) NOT NULL,
  `chat_user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_user_one` (`chat_user_one`),
  KEY `chat_user_two` (`chat_user_two`),
  CONSTRAINT `chat_connections_ibfk_1` FOREIGN KEY (`chat_user_one`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_connections_ibfk_2` FOREIGN KEY (`chat_user_two`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `chat_connections` */

insert  into `chat_connections`(`id`,`chat_user_one`,`chat_user_two`,`ip`,`time`,`created_at`,`updated_at`) values 
(1,1,2,NULL,NULL,'2021-07-01 19:43:26',NULL),
(2,3,2,NULL,NULL,'2021-07-02 21:25:57',NULL);

/*Table structure for table `chat_messages` */

DROP TABLE IF EXISTS `chat_messages`;

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text DEFAULT NULL,
  `chat_user_id` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `is_first` int(1) DEFAULT 0,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `chat_connection_id` int(11) NOT NULL,
  `deleted1` int(11) DEFAULT 0,
  `deleted2` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_user_id` (`chat_user_id`),
  KEY `chat_connection_id` (`chat_connection_id`),
  CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`chat_user_id`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`chat_connection_id`) REFERENCES `chat_connections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `chat_messages` */

insert  into `chat_messages`(`id`,`message`,`chat_user_id`,`ip`,`time`,`is_first`,`is_read`,`chat_connection_id`,`deleted1`,`deleted2`,`created_at`) values 
(1,'you are now connected on chat',2,'',0,1,1,1,0,0,NULL),
(2,'Hello&#33;',2,'',0,0,1,1,0,0,'2021-07-01 19:43:46'),
(3,'Hi&#33; What is matter&#63;',1,'',0,0,1,1,0,0,'2021-07-01 19:46:35'),
(4,'I have serious matter.',2,'',0,0,1,1,0,0,'2021-07-01 19:47:13'),
(5,'There&#63;',2,'',0,0,1,1,0,0,'2021-07-01 21:25:54'),
(6,'aaa',2,'',0,0,1,1,0,0,'2021-07-02 21:13:47'),
(7,'I am teacher',1,'',0,0,1,1,0,0,'2021-07-02 21:20:12'),
(8,'you are now connected on chat',2,'',0,1,1,2,0,0,NULL),
(9,'I am employee',2,'',0,0,1,2,0,0,'2021-07-02 21:27:53');

/*Table structure for table `chat_users` */

DROP TABLE IF EXISTS `chat_users`;

CREATE TABLE `chat_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(20) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `create_staff_id` int(11) DEFAULT NULL,
  `create_student_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`),
  KEY `student_id` (`student_id`),
  KEY `create_staff_id` (`create_staff_id`),
  KEY `create_student_id` (`create_student_id`),
  CONSTRAINT `chat_users_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_users_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_users_ibfk_3` FOREIGN KEY (`create_staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_users_ibfk_4` FOREIGN KEY (`create_student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `chat_users` */

insert  into `chat_users`(`id`,`user_type`,`staff_id`,`student_id`,`create_staff_id`,`create_student_id`,`is_active`,`created_at`,`updated_at`) values 
(1,'student',NULL,2,NULL,NULL,0,'2021-07-01 19:43:26',NULL),
(2,'staff',5,NULL,NULL,2,0,'2021-07-01 19:43:26',NULL),
(3,'staff',6,NULL,NULL,NULL,0,'2021-07-02 21:25:57',NULL);

/*Table structure for table `class_sections` */

DROP TABLE IF EXISTS `class_sections`;

CREATE TABLE `class_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `class_sections` */

insert  into `class_sections`(`id`,`class_id`,`section_id`,`is_active`,`created_at`,`updated_at`) values 
(1,1,1,'no','2021-06-29 23:54:55',NULL);

/*Table structure for table `class_teacher` */

DROP TABLE IF EXISTS `class_teacher`;

CREATE TABLE `class_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `class_teacher` */

/*Table structure for table `classes` */

DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `classes` */

insert  into `classes`(`id`,`class`,`is_active`,`created_at`,`updated_at`) values 
(1,'Class1','no','2021-06-29 23:54:55',NULL);

/*Table structure for table `complaint` */

DROP TABLE IF EXISTS `complaint`;

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type` varchar(255) NOT NULL,
  `source` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `action_taken` varchar(200) NOT NULL,
  `assigned` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `complaint` */

/*Table structure for table `complaint_type` */

DROP TABLE IF EXISTS `complaint_type`;

CREATE TABLE `complaint_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `complaint_type` */

/*Table structure for table `content_for` */

DROP TABLE IF EXISTS `content_for`;

CREATE TABLE `content_for` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `content_for_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `content_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `content_for` */

/*Table structure for table `contents` */

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_public` varchar(10) DEFAULT 'No',
  `class_id` int(11) DEFAULT NULL,
  `cls_sec_id` int(10) NOT NULL,
  `file` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `contents` */

/*Table structure for table `custom_field_values` */

DROP TABLE IF EXISTS `custom_field_values`;

CREATE TABLE `custom_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `belong_table_id` int(11) DEFAULT NULL,
  `custom_field_id` int(11) DEFAULT NULL,
  `field_value` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_field_id` (`custom_field_id`),
  CONSTRAINT `custom_field_values_ibfk_1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `custom_field_values` */

/*Table structure for table `custom_fields` */

DROP TABLE IF EXISTS `custom_fields`;

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `belong_to` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `bs_column` int(10) DEFAULT NULL,
  `validation` int(11) DEFAULT 0,
  `field_values` text DEFAULT NULL,
  `show_table` varchar(100) DEFAULT NULL,
  `visible_on_table` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `custom_fields` */

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `department` */

/*Table structure for table `disable_reason` */

DROP TABLE IF EXISTS `disable_reason`;

CREATE TABLE `disable_reason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `disable_reason` */

/*Table structure for table `dispatch_receive` */

DROP TABLE IF EXISTS `dispatch_receive`;

CREATE TABLE `dispatch_receive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(50) NOT NULL,
  `to_title` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `from_title` varchar(200) NOT NULL,
  `date` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dispatch_receive` */

/*Table structure for table `email_config` */

DROP TABLE IF EXISTS `email_config`;

CREATE TABLE `email_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email_type` varchar(100) DEFAULT NULL,
  `smtp_server` varchar(100) DEFAULT NULL,
  `smtp_port` varchar(100) DEFAULT NULL,
  `smtp_username` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `ssl_tls` varchar(100) DEFAULT NULL,
  `smtp_auth` varchar(10) NOT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `email_config` */

insert  into `email_config`(`id`,`email_type`,`smtp_server`,`smtp_port`,`smtp_username`,`smtp_password`,`ssl_tls`,`smtp_auth`,`is_active`,`created_at`) values 
(1,'sendmail',NULL,NULL,NULL,NULL,NULL,'','','2020-02-28 05:46:03');

/*Table structure for table `enquiry` */

DROP TABLE IF EXISTS `enquiry`;

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `reference` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `note` text NOT NULL,
  `source` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `assigned` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `no_of_child` varchar(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `enquiry` */

/*Table structure for table `enquiry_type` */

DROP TABLE IF EXISTS `enquiry_type`;

CREATE TABLE `enquiry_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `enquiry_type` */

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(200) NOT NULL,
  `event_description` varchar(300) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_color` varchar(200) NOT NULL,
  `event_for` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `events` */

/*Table structure for table `exam_group_class_batch_exam_students` */

DROP TABLE IF EXISTS `exam_group_class_batch_exam_students`;

CREATE TABLE `exam_group_class_batch_exam_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_class_batch_exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `roll_no` int(6) NOT NULL DEFAULT 0,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_group_class_batch_exam_id` (`exam_group_class_batch_exam_id`),
  KEY `student_id` (`student_id`),
  KEY `student_session_id` (`student_session_id`),
  CONSTRAINT `exam_group_class_batch_exam_students_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_class_batch_exam_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_class_batch_exam_students_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `exam_group_class_batch_exam_students` */

insert  into `exam_group_class_batch_exam_students`(`id`,`exam_group_class_batch_exam_id`,`student_id`,`student_session_id`,`roll_no`,`is_active`,`created_at`,`updated_at`) values 
(1,2,1,1,0,0,'2021-06-30 11:35:40',NULL),
(2,2,2,2,0,0,'2021-06-30 11:35:40',NULL),
(3,1,1,1,0,0,'2021-06-30 11:44:52',NULL),
(4,1,2,2,0,0,'2021-06-30 11:44:52',NULL),
(5,3,1,1,0,0,'2021-06-30 12:17:43',NULL),
(6,3,2,2,0,0,'2021-06-30 12:17:43',NULL),
(7,4,1,1,100001,0,'2021-06-30 18:29:05',NULL),
(8,4,2,2,100002,0,'2021-06-30 18:29:05',NULL);

/*Table structure for table `exam_group_class_batch_exam_subjects` */

DROP TABLE IF EXISTS `exam_group_class_batch_exam_subjects`;

CREATE TABLE `exam_group_class_batch_exam_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_class_batch_exams_id` int(11) DEFAULT NULL,
  `subject_id` int(10) NOT NULL,
  `date_from` date NOT NULL,
  `time_from` time NOT NULL,
  `duration` varchar(50) NOT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `max_marks` float(10,2) DEFAULT NULL,
  `min_marks` float(10,2) DEFAULT NULL,
  `credit_hours` float(10,2) DEFAULT 0.00,
  `date_to` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_group_class_batch_exams_id` (`exam_group_class_batch_exams_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `exam_group_class_batch_exam_subjects` */

insert  into `exam_group_class_batch_exam_subjects`(`id`,`exam_group_class_batch_exams_id`,`subject_id`,`date_from`,`time_from`,`duration`,`room_no`,`max_marks`,`min_marks`,`credit_hours`,`date_to`,`is_active`,`created_at`,`updated_at`) values 
(1,1,1,'2021-07-01','12:22:11','2','101',10.00,0.00,1.00,NULL,0,'2021-06-30 11:24:01',NULL),
(2,2,1,'2021-07-03','11:36:00','2','2',5.00,2.00,3.00,NULL,0,'2021-06-30 11:36:28',NULL),
(3,4,1,'2021-07-02','18:18:01','2','5',10.00,2.00,3.00,NULL,0,'2021-06-30 18:18:21',NULL);

/*Table structure for table `exam_group_class_batch_exams` */

DROP TABLE IF EXISTS `exam_group_class_batch_exams`;

CREATE TABLE `exam_group_class_batch_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam` varchar(250) DEFAULT NULL,
  `session_id` int(10) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `exam_group_id` int(11) DEFAULT NULL,
  `is_publish` int(1) DEFAULT 0,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_group_id` (`exam_group_id`),
  CONSTRAINT `exam_group_class_batch_exams_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `exam_group_class_batch_exams` */

insert  into `exam_group_class_batch_exams`(`id`,`exam`,`session_id`,`date_from`,`date_to`,`description`,`exam_group_id`,`is_publish`,`is_active`,`created_at`,`updated_at`) values 
(1,'Exam1',15,NULL,NULL,'This exam is test',1,1,1,'2021-06-30 11:34:04',NULL),
(2,'OSExam1',15,NULL,NULL,'OSExam1  Description',2,0,1,'2021-06-30 11:35:19',NULL),
(3,'OSExam2',15,NULL,NULL,'OSExam2 Description',2,1,1,'2021-06-30 12:17:25',NULL),
(4,'teachExam',15,NULL,NULL,'teacherExamDescription',3,1,1,'2021-06-30 18:17:37',NULL);

/*Table structure for table `exam_group_exam_connections` */

DROP TABLE IF EXISTS `exam_group_exam_connections`;

CREATE TABLE `exam_group_exam_connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_id` int(11) DEFAULT NULL,
  `exam_group_class_batch_exams_id` int(11) DEFAULT NULL,
  `exam_weightage` float(10,2) DEFAULT 0.00,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_group_id` (`exam_group_id`),
  KEY `exam_group_class_batch_exams_id` (`exam_group_class_batch_exams_id`),
  CONSTRAINT `exam_group_exam_connections_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_exam_connections_ibfk_2` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `exam_group_exam_connections` */

/*Table structure for table `exam_group_exam_results` */

DROP TABLE IF EXISTS `exam_group_exam_results`;

CREATE TABLE `exam_group_exam_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_class_batch_exam_student_id` int(11) NOT NULL,
  `exam_group_class_batch_exam_subject_id` int(11) DEFAULT NULL,
  `attendence` varchar(10) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `exam_group_student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_group_class_batch_exam_subject_id` (`exam_group_class_batch_exam_subject_id`),
  KEY `exam_group_student_id` (`exam_group_student_id`),
  KEY `exam_group_class_batch_exam_student_id` (`exam_group_class_batch_exam_student_id`),
  CONSTRAINT `exam_group_exam_results_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_subject_id`) REFERENCES `exam_group_class_batch_exam_subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_exam_results_ibfk_2` FOREIGN KEY (`exam_group_student_id`) REFERENCES `exam_group_students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_exam_results_ibfk_3` FOREIGN KEY (`exam_group_class_batch_exam_student_id`) REFERENCES `exam_group_class_batch_exam_students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `exam_group_exam_results` */

insert  into `exam_group_exam_results`(`id`,`exam_group_class_batch_exam_student_id`,`exam_group_class_batch_exam_subject_id`,`attendence`,`get_marks`,`note`,`is_active`,`created_at`,`updated_at`,`exam_group_student_id`) values 
(1,3,1,'present',4.50,'',1,'2021-07-03 10:03:32','2021-06-30',NULL),
(2,7,3,'present',10.00,'fdgfdsg',0,'2021-06-30 18:31:40',NULL,NULL),
(3,8,3,'present',3.00,'45645',0,'2021-06-30 18:31:40',NULL,NULL),
(4,4,1,'present',3.00,'',0,'2021-07-03 10:03:32',NULL,NULL);

/*Table structure for table `exam_group_students` */

DROP TABLE IF EXISTS `exam_group_students`;

CREATE TABLE `exam_group_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_session_id` int(10) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_group_id` (`exam_group_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `exam_group_students_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_group_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `exam_group_students` */

/*Table structure for table `exam_groups` */

DROP TABLE IF EXISTS `exam_groups`;

CREATE TABLE `exam_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `exam_type` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `exam_groups` */

insert  into `exam_groups`(`id`,`name`,`exam_type`,`description`,`is_active`,`created_at`,`updated_at`) values 
(1,'mathmactic','basic_system','This is general testing ',1,'2021-06-30 12:11:29',NULL),
(2,'ComputerOS','school_grade_system','ComputerOS Description',1,'2021-06-30 12:11:31',NULL),
(3,'teacherExamGroup','basic_system','teacherExamGroup Descriptoin',0,'2021-06-30 18:16:33',NULL);

/*Table structure for table `exam_results` */

DROP TABLE IF EXISTS `exam_results`;

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attendence` varchar(10) NOT NULL,
  `exam_schedule_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_schedule_id` (`exam_schedule_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `exam_results` */

/*Table structure for table `exam_schedules` */

DROP TABLE IF EXISTS `exam_schedules`;

CREATE TABLE `exam_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `teacher_subject_id` int(11) DEFAULT NULL,
  `date_of_exam` date DEFAULT NULL,
  `start_to` varchar(50) DEFAULT NULL,
  `end_from` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `full_marks` int(11) DEFAULT NULL,
  `passing_marks` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_subject_id` (`teacher_subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `exam_schedules` */

/*Table structure for table `examgrades` */

DROP TABLE IF EXISTS `examgrades`;

CREATE TABLE `examgrades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `gradepoint` int(11) DEFAULT 0,
  `pubdate` date DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `examgrades` */

insert  into `examgrades`(`id`,`name`,`gradepoint`,`pubdate`,`desc`,`created_at`,`updated_at`) values 
(1,'ExamGrade1',10,'2021-07-05','This is ExamGrade1','2021-07-05 00:45:10',NULL);

/*Table structure for table `exams` */

DROP TABLE IF EXISTS `exams`;

CREATE TABLE `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `sesion_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `exams` */

/*Table structure for table `examtypes` */

DROP TABLE IF EXISTS `examtypes`;

CREATE TABLE `examtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `pubdate` date DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `examtypes` */

insert  into `examtypes`(`id`,`name`,`pubdate`,`desc`,`created_at`,`updated_at`) values 
(1,'ExamType1','2021-07-05','This is ExamType1','2021-07-05 00:44:13',NULL);

/*Table structure for table `expense_head` */

DROP TABLE IF EXISTS `expense_head`;

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `expense_head` */

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_head_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `expenses` */

/*Table structure for table `fee_groups` */

DROP TABLE IF EXISTS `fee_groups`;

CREATE TABLE `fee_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `fee_groups` */

insert  into `fee_groups`(`id`,`name`,`is_system`,`description`,`is_active`,`created_at`) values 
(1,'Fees Group',0,'Fees Group Description','no','2021-06-30 19:33:23'),
(2,'Balance Master',1,NULL,'no','2021-06-30 19:38:59');

/*Table structure for table `fee_groups_feetype` */

DROP TABLE IF EXISTS `fee_groups_feetype`;

CREATE TABLE `fee_groups_feetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `fine_type` varchar(50) NOT NULL DEFAULT 'none',
  `due_date` date DEFAULT NULL,
  `fine_percentage` float(10,2) NOT NULL DEFAULT 0.00,
  `fine_amount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fee_session_group_id` (`fee_session_group_id`),
  KEY `fee_groups_id` (`fee_groups_id`),
  KEY `feetype_id` (`feetype_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `fee_groups_feetype_ibfk_1` FOREIGN KEY (`fee_session_group_id`) REFERENCES `fee_session_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fee_groups_feetype_ibfk_2` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fee_groups_feetype_ibfk_3` FOREIGN KEY (`feetype_id`) REFERENCES `feetype` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fee_groups_feetype_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `fee_groups_feetype` */

insert  into `fee_groups_feetype`(`id`,`fee_session_group_id`,`fee_groups_id`,`feetype_id`,`session_id`,`amount`,`fine_type`,`due_date`,`fine_percentage`,`fine_amount`,`is_active`,`created_at`) values 
(1,1,1,1,15,109.00,'percentage','2021-06-30',100.00,109.00,'no','2021-06-30 19:33:59'),
(2,2,2,2,15,NULL,'none','2021-08-30',0.00,0.00,'no','2021-06-30 19:38:59');

/*Table structure for table `fee_receipt_no` */

DROP TABLE IF EXISTS `fee_receipt_no`;

CREATE TABLE `fee_receipt_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fee_receipt_no` */

/*Table structure for table `fee_session_groups` */

DROP TABLE IF EXISTS `fee_session_groups`;

CREATE TABLE `fee_session_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_groups_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fee_groups_id` (`fee_groups_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `fee_session_groups_ibfk_1` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fee_session_groups_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `fee_session_groups` */

insert  into `fee_session_groups`(`id`,`fee_groups_id`,`session_id`,`is_active`,`created_at`) values 
(1,1,15,'no','2021-06-30 19:33:59'),
(2,2,15,'no','2021-06-30 19:38:59');

/*Table structure for table `feecategory` */

DROP TABLE IF EXISTS `feecategory`;

CREATE TABLE `feecategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `feecategory` */

/*Table structure for table `feemasters` */

DROP TABLE IF EXISTS `feemasters`;

CREATE TABLE `feemasters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `feemasters` */

/*Table structure for table `fees_discounts` */

DROP TABLE IF EXISTS `fees_discounts`;

CREATE TABLE `fees_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `fees_discounts_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fees_discounts` */

/*Table structure for table `fees_reminder` */

DROP TABLE IF EXISTS `fees_reminder`;

CREATE TABLE `fees_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reminder_type` varchar(10) DEFAULT NULL,
  `day` int(2) DEFAULT NULL,
  `is_active` int(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `fees_reminder` */

insert  into `fees_reminder`(`id`,`reminder_type`,`day`,`is_active`,`created_at`,`updated_at`) values 
(1,'before',2,1,'2021-06-30 02:05:46',NULL),
(2,'before',5,0,'2020-02-28 05:38:36',NULL),
(3,'after',2,0,'2020-02-28 05:38:40',NULL),
(4,'after',5,0,'2020-02-28 05:38:44',NULL);

/*Table structure for table `feetype` */

DROP TABLE IF EXISTS `feetype`;

CREATE TABLE `feetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `feecategory_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `feetype` */

insert  into `feetype`(`id`,`is_system`,`feecategory_id`,`type`,`code`,`is_active`,`created_at`,`updated_at`,`description`) values 
(1,0,NULL,'Fees Type','Fees Code','no','2021-06-30 19:33:40',NULL,'Fees Type Description'),
(2,1,NULL,'Previous Session Balance','Previous Session Balance','no','2021-06-30 19:38:59',NULL,'');

/*Table structure for table `filetypes` */

DROP TABLE IF EXISTS `filetypes`;

CREATE TABLE `filetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_extension` text DEFAULT NULL,
  `file_mime` text DEFAULT NULL,
  `file_size` int(11) NOT NULL,
  `image_extension` text DEFAULT NULL,
  `image_mime` text DEFAULT NULL,
  `image_size` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `filetypes` */

insert  into `filetypes`(`id`,`file_extension`,`file_mime`,`file_size`,`image_extension`,`image_mime`,`image_size`,`created_at`) values 
(1,'pdf, zip, jpg, jpeg, png, txt, 7z, gif, csv, docx, mp3, mp4, accdb, odt, ods, ppt, pptx, xlsx, wmv, jfif, apk, ppt, bmp, jpe, mdb, rar, xls, svg','application/pdf, image/zip, image/jpg, image/png, image/jpeg, text/plain, application/x-zip-compressed, application/zip, image/gif, text/csv, application/vnd.openxmlformats-officedocument.wordprocessingml.document, audio/mpeg, application/msaccess, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.spreadsheet, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, video/x-ms-wmv, video/mp4, image/jpeg, application/vnd.android.package-archive, application/x-msdownload, application/vnd.ms-powerpoint, image/bmp, image/jpeg, application/msaccess, application/vnd.ms-excel, image/svg+xml',100048576,'jfif, png, jpe, jpeg, jpg, bmp, gif, svg','image/jpeg, image/png, image/jpeg, image/jpeg, image/bmp, image/gif, image/x-ms-bmp, image/svg+xml',10048576,'2021-01-30 05:03:03');

/*Table structure for table `follow_up` */

DROP TABLE IF EXISTS `follow_up`;

CREATE TABLE `follow_up` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `next_date` date NOT NULL,
  `response` text NOT NULL,
  `note` text NOT NULL,
  `followup_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `follow_up` */

/*Table structure for table `front_cms_media_gallery` */

DROP TABLE IF EXISTS `front_cms_media_gallery`;

CREATE TABLE `front_cms_media_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(300) DEFAULT NULL,
  `thumb_path` varchar(300) DEFAULT NULL,
  `dir_path` varchar(300) DEFAULT NULL,
  `img_name` varchar(300) DEFAULT NULL,
  `thumb_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_type` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `vid_url` text NOT NULL,
  `vid_title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_media_gallery` */

/*Table structure for table `front_cms_menu_items` */

DROP TABLE IF EXISTS `front_cms_menu_items`;

CREATE TABLE `front_cms_menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ext_url` text DEFAULT NULL,
  `open_new_tab` int(11) DEFAULT 0,
  `ext_url_link` text DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_menu_items` */

insert  into `front_cms_menu_items`(`id`,`menu_id`,`menu`,`page_id`,`parent_id`,`ext_url`,`open_new_tab`,`ext_url_link`,`slug`,`weight`,`publish`,`description`,`is_active`,`created_at`) values 
(1,1,'Home',1,0,NULL,NULL,NULL,'home',1,0,NULL,'no','2019-12-02 14:11:50'),
(2,1,'Contact Us',76,0,NULL,NULL,NULL,'contact-us',4,0,NULL,'no','2019-12-02 14:11:52'),
(3,1,'Complain',2,0,NULL,NULL,NULL,'complain',3,0,NULL,'no','2019-12-02 14:11:52'),
(4,1,'Admission',0,0,'1',NULL,'http://yourschoolurl.com/online_admission','admssion',2,0,NULL,'no','2019-12-21 07:33:00');

/*Table structure for table `front_cms_menus` */

DROP TABLE IF EXISTS `front_cms_menus`;

CREATE TABLE `front_cms_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `open_new_tab` int(10) NOT NULL DEFAULT 0,
  `ext_url` text NOT NULL,
  `ext_url_link` text NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `content_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_menus` */

insert  into `front_cms_menus`(`id`,`menu`,`slug`,`description`,`open_new_tab`,`ext_url`,`ext_url_link`,`publish`,`content_type`,`is_active`,`created_at`) values 
(1,'Main Menu','main-menu','Main menu',0,'','',0,'default','no','2018-04-20 07:54:49'),
(2,'Bottom Menu','bottom-menu','Bottom Menu',0,'','',0,'default','no','2018-04-20 07:54:55');

/*Table structure for table `front_cms_page_contents` */

DROP TABLE IF EXISTS `front_cms_page_contents`;

CREATE TABLE `front_cms_page_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `front_cms_page_contents_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `front_cms_pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_page_contents` */

/*Table structure for table `front_cms_pages` */

DROP TABLE IF EXISTS `front_cms_pages`;

CREATE TABLE `front_cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_homepage` int(1) DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `feature_image` varchar(200) NOT NULL,
  `description` longtext DEFAULT NULL,
  `publish_date` date NOT NULL,
  `publish` int(10) DEFAULT 0,
  `sidebar` int(10) DEFAULT 0,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_pages` */

insert  into `front_cms_pages`(`id`,`page_type`,`is_homepage`,`title`,`url`,`type`,`slug`,`meta_title`,`meta_description`,`meta_keyword`,`feature_image`,`description`,`publish_date`,`publish`,`sidebar`,`is_active`,`created_at`) values 
(1,'default',1,'Home','page/home','page','home','','','','','<p>home page</p>','0000-00-00',1,NULL,'no','2019-12-02 07:23:47'),
(2,'default',0,'Complain','page/complain','page','complain','Complain form','                                                                                                                                                                                    complain form                                                                                                                                                                                                                                ','complain form','','<p>[form-builder:complain]</p>','0000-00-00',1,NULL,'no','2019-11-13 02:16:36'),
(54,'default',0,'404 page','page/404-page','page','404-page','','                                ','','','<html>\r\n<head>\r\n <title></title>\r\n</head>\r\n<body>\r\n<p>404 page found</p>\r\n</body>\r\n</html>','0000-00-00',0,NULL,'no','2018-05-18 07:46:04'),
(76,'default',0,'Contact us','page/contact-us','page','contact-us','','','','','<section class=\"contact\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<h2 class=\"col-md-12 col-sm-12\">Send In Your Query</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class=\"col-md-12 col-sm-12\">[form-builder:contact_us]<!--./row--></div>\r\n<!--./col-md-12--></div>\r\n<!--./row--></div>\r\n<!--./container--></section>\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/pin.svg\" />\r\n<h3>Our Location</h3>\r\n\r\n<p>350 Fifth Avenue, 34th floor New York NY 10118-3299 USA</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/phone.svg\" />\r\n<h3>CALL US</h3>\r\n\r\n<p>E-mail : info@abcschool.com</p>\r\n\r\n<p>Mobile : +91-9009987654</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-4 col-sm-4\">\r\n<div class=\"contact-item\"><img src=\"http://192.168.1.81/repos/smartschool/uploads/gallery/media/clock.svg\" />\r\n<h3>Working Hours</h3>\r\n\r\n<p>Mon-Fri : 9 am to 5 pm</p>\r\n\r\n<p>Sat : 9 am to 3 pm</p>\r\n</div>\r\n<!--./contact-item--></div>\r\n<!--./col-md-4-->\r\n\r\n<div class=\"col-md-12 col-sm-12\">\r\n<div class=\"mapWrapper fullwidth\"><iframe frameborder=\"0\" height=\"500\" marginheight=\"0\" marginwidth=\"0\" scrolling=\"no\" src=\"http://maps.google.com/maps?f=q&source=s_q&hl=EN&q=time+square&aq=&sll=40.716558,-73.931122&sspn=0.40438,1.056747&ie=UTF8&rq=1&ev=p&split=1&radius=33.22&hq=time+square&hnear=&ll=37.061753,-95.677185&spn=0.438347,0.769043&z=9&output=embed\" width=\"100%\"></iframe></div>\r\n</div>','0000-00-00',0,NULL,'no','2019-05-04 08:46:41');

/*Table structure for table `front_cms_program_photos` */

DROP TABLE IF EXISTS `front_cms_program_photos`;

CREATE TABLE `front_cms_program_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) DEFAULT NULL,
  `media_gallery_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `program_id` (`program_id`),
  CONSTRAINT `front_cms_program_photos_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `front_cms_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_program_photos` */

/*Table structure for table `front_cms_programs` */

DROP TABLE IF EXISTS `front_cms_programs`;

CREATE TABLE `front_cms_programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `event_start` date DEFAULT NULL,
  `event_end` date DEFAULT NULL,
  `event_venue` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `feature_image` text NOT NULL,
  `publish_date` date NOT NULL,
  `publish` varchar(10) DEFAULT '0',
  `sidebar` int(10) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_programs` */

/*Table structure for table `front_cms_settings` */

DROP TABLE IF EXISTS `front_cms_settings`;

CREATE TABLE `front_cms_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) DEFAULT NULL,
  `is_active_rtl` int(10) DEFAULT 0,
  `is_active_front_cms` int(11) DEFAULT 0,
  `is_active_sidebar` int(1) DEFAULT 0,
  `logo` varchar(200) DEFAULT NULL,
  `contact_us_email` varchar(100) DEFAULT NULL,
  `complain_form_email` varchar(100) DEFAULT NULL,
  `sidebar_options` text NOT NULL,
  `whatsapp_url` varchar(255) NOT NULL,
  `fb_url` varchar(200) NOT NULL,
  `twitter_url` varchar(200) NOT NULL,
  `youtube_url` varchar(200) NOT NULL,
  `google_plus` varchar(200) NOT NULL,
  `instagram_url` varchar(200) NOT NULL,
  `pinterest_url` varchar(200) NOT NULL,
  `linkedin_url` varchar(200) NOT NULL,
  `google_analytics` text DEFAULT NULL,
  `footer_text` varchar(500) DEFAULT NULL,
  `fav_icon` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `front_cms_settings` */

insert  into `front_cms_settings`(`id`,`theme`,`is_active_rtl`,`is_active_front_cms`,`is_active_sidebar`,`logo`,`contact_us_email`,`complain_form_email`,`sidebar_options`,`whatsapp_url`,`fb_url`,`twitter_url`,`youtube_url`,`google_plus`,`instagram_url`,`pinterest_url`,`linkedin_url`,`google_analytics`,`footer_text`,`fav_icon`,`created_at`) values 
(1,'material_pink',NULL,NULL,NULL,NULL,'','','[\"news\",\"complain\"]','','','','','','','','','','','','2020-02-28 05:48:32');

/*Table structure for table `general_calls` */

DROP TABLE IF EXISTS `general_calls`;

CREATE TABLE `general_calls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `call_dureation` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `call_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `general_calls` */

/*Table structure for table `grades` */

DROP TABLE IF EXISTS `grades`;

CREATE TABLE `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_type` varchar(250) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `point` float(10,1) DEFAULT NULL,
  `mark_from` float(10,2) DEFAULT NULL,
  `mark_upto` float(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `grades` */

insert  into `grades`(`id`,`exam_type`,`name`,`point`,`mark_from`,`mark_upto`,`description`,`is_active`,`created_at`,`updated_at`) values 
(1,'basic_system','GradeName1',5.0,100.00,20.00,'','no','2021-07-05 00:54:52',NULL);

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `user_type` varchar(255) DEFAULT '',
  `session_id` varchar(255) DEFAULT '',
  `event_time` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `history` */

insert  into `history`(`id`,`user_id`,`user_type`,`session_id`,`event_time`) values 
(1,2,'student','gfkqkcfpiq5hoavj2ilra6s8nmuk40vq','1625512353'),
(4,5,'staff','20eejkl87alpcggfd9o6mfmgp9erbh6h','1625466218'),
(5,1,'student','ckkmildblgiesn8c4skrtc67n3muum3t','1625263224'),
(6,1,'staff','mcla9qfahddg117duhp6ii4kluh5pfjq','1625514708'),
(7,6,'staff','jacdrcut081coip7udtnupiu46s44r1u','1625299851');

/*Table structure for table `homework` */

DROP TABLE IF EXISTS `homework`;

CREATE TABLE `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(10) NOT NULL,
  `homework_date` date NOT NULL,
  `submit_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `create_date` date NOT NULL,
  `evaluation_date` date NOT NULL,
  `document` varchar(200) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `evaluated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_group_subject_id` (`subject_group_subject_id`),
  CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `homework` */

insert  into `homework`(`id`,`class_id`,`section_id`,`session_id`,`homework_date`,`submit_date`,`staff_id`,`subject_group_subject_id`,`subject_id`,`description`,`create_date`,`evaluation_date`,`document`,`type_id`,`grade_id`,`created_by`,`evaluated_by`) values 
(1,1,1,15,'2021-06-23','2021-06-21',1,1,0,'<p>This is first homework</p>','2021-07-05','0000-00-00','',1,1,1,0),
(2,1,1,15,'2021-06-30','2021-07-08',1,1,0,'<p>This is second homework.(English)<br></p>','2021-07-05','2021-07-11','',1,0,1,0),
(3,1,1,15,'2021-07-01','2021-07-08',1,2,0,'<p>This is Chines Exam</p>','2021-07-01','0000-00-00','',NULL,NULL,1,0),
(4,1,1,15,'2021-07-02','2021-07-16',1,1,0,'<p>This is English Exam</p>','2021-07-01','0000-00-00','',NULL,NULL,1,0),
(5,1,1,15,'2021-07-03','2021-07-06',1,2,0,'<p>This Exam is final test</p>','2021-07-03','0000-00-00','',0,0,1,0),
(6,1,1,15,'2021-07-04','2021-07-05',1,2,0,'<p>This exam is Exam Type Testing.</p><p>Exam Type1, Exam Grade1</p>','2021-07-05','0000-00-00','',1,1,1,0);

/*Table structure for table `homework_evaluation` */

DROP TABLE IF EXISTS `homework_evaluation`;

CREATE TABLE `homework_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `point` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `evaluated_by` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `homework_evaluation` */

insert  into `homework_evaluation`(`id`,`homework_id`,`student_id`,`student_session_id`,`date`,`point`,`note`,`status`,`evaluated_by`) values 
(1,2,0,2,'0000-00-00',NULL,NULL,'Complete',0),
(2,6,0,2,'2021-07-06',18.00,'Note2','Complete',1);

/*Table structure for table `hostel` */

DROP TABLE IF EXISTS `hostel`;

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_name` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `intake` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hostel` */

/*Table structure for table `hostel_rooms` */

DROP TABLE IF EXISTS `hostel_rooms`;

CREATE TABLE `hostel_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_no` varchar(200) DEFAULT NULL,
  `no_of_bed` int(11) DEFAULT NULL,
  `cost_per_bed` float(10,2) DEFAULT 0.00,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hostel_rooms` */

/*Table structure for table `id_card` */

DROP TABLE IF EXISTS `id_card`;

CREATE TABLE `id_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `school_address` varchar(500) NOT NULL,
  `background` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `sign_image` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `enable_admission_no` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_student_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_class` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_blood_group` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `id_card` */

insert  into `id_card`(`id`,`title`,`school_name`,`school_address`,`background`,`logo`,`sign_image`,`header_color`,`enable_admission_no`,`enable_student_name`,`enable_class`,`enable_fathers_name`,`enable_mothers_name`,`enable_address`,`enable_phone`,`enable_dob`,`enable_blood_group`,`status`) values 
(1,'Sample Student Identity Card','Mount Carmel School','110 Kings Street, CA  Phone: 456542 Email: mount@gmail.com','samplebackground12.png','samplelogo12.png','samplesign12.png','#595959',1,1,1,1,0,1,1,1,1,1);

/*Table structure for table `income` */

DROP TABLE IF EXISTS `income`;

CREATE TABLE `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inc_head_id` varchar(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `income` */

insert  into `income`(`id`,`inc_head_id`,`name`,`invoice_no`,`date`,`amount`,`note`,`is_active`,`is_deleted`,`created_at`,`updated_at`,`documents`) values 
(1,'1','Fee 1','Invoice Number','2021-06-30',103,'Money description','yes','no','2021-06-30 19:32:44',NULL,NULL);

/*Table structure for table `income_head` */

DROP TABLE IF EXISTS `income_head`;

CREATE TABLE `income_head` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `income_category` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `is_deleted` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `income_head` */

insert  into `income_head`(`id`,`income_category`,`description`,`is_active`,`is_deleted`,`created_at`,`updated_at`) values 
(1,'Income Head','Income Head description','yes','no','2021-06-30 19:32:06',NULL);

/*Table structure for table `item` */

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `item_photo` varchar(225) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `item_store_id` int(11) DEFAULT NULL,
  `item_supplier_id` int(11) DEFAULT NULL,
  `quantity` int(100) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item` */

/*Table structure for table `item_category` */

DROP TABLE IF EXISTS `item_category`;

CREATE TABLE `item_category` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_category` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_category` */

/*Table structure for table `item_issue` */

DROP TABLE IF EXISTS `item_issue`;

CREATE TABLE `item_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_type` varchar(15) DEFAULT NULL,
  `issue_to` varchar(100) DEFAULT NULL,
  `issue_by` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `note` text NOT NULL,
  `is_returned` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` varchar(10) DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `item_category_id` (`item_category_id`),
  CONSTRAINT `item_issue_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_issue_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_issue` */

/*Table structure for table `item_stock` */

DROP TABLE IF EXISTS `item_stock`;

CREATE TABLE `item_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `symbol` varchar(10) NOT NULL DEFAULT '+',
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purchase_price` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` varchar(10) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `item_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `item_supplier` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_stock_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `item_store` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_stock` */

/*Table structure for table `item_store` */

DROP TABLE IF EXISTS `item_store`;

CREATE TABLE `item_store` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_store` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_store` */

/*Table structure for table `item_supplier` */

DROP TABLE IF EXISTS `item_supplier`;

CREATE TABLE `item_supplier` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_supplier` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_phone` varchar(255) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_supplier` */

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) DEFAULT NULL,
  `short_code` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `is_deleted` varchar(10) NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

insert  into `languages`(`id`,`language`,`short_code`,`country_code`,`is_deleted`,`is_active`,`created_at`,`updated_at`) values 
(1,'Azerbaijan','az','az','no','no','2019-11-20 03:23:12','0000-00-00'),
(2,'Albanian','sq','al','no','no','2019-11-20 03:42:42','0000-00-00'),
(3,'Amharic','am','am','no','no','2019-11-20 03:24:23','0000-00-00'),
(4,'English','en','us','no','no','2019-11-20 03:38:50','0000-00-00'),
(5,'Arabic','ar','sa','no','no','2019-11-20 03:47:28','0000-00-00'),
(7,'Afrikaans','af','af','no','no','2019-11-20 03:24:23','0000-00-00'),
(8,'Basque','eu','es','no','no','2019-11-20 03:54:10','0000-00-00'),
(11,'Bengali','bn','in','no','no','2019-11-20 03:41:53','0000-00-00'),
(13,'Bosnian','bs','bs','no','no','2019-11-20 03:24:23','0000-00-00'),
(14,'Welsh','cy','cy','no','no','2019-11-20 03:24:23','0000-00-00'),
(15,'Hungarian','hu','hu','no','no','2019-11-20 03:24:23','0000-00-00'),
(16,'Vietnamese','vi','vi','no','no','2019-11-20 03:24:23','0000-00-00'),
(17,'Haitian','ht','ht','no','no','2021-01-22 23:09:32','0000-00-00'),
(18,'Galician','gl','gl','no','no','2019-11-20 03:24:23','0000-00-00'),
(19,'Dutch','nl','nl','no','no','2019-11-20 03:24:23','0000-00-00'),
(21,'Greek','el','gr','no','no','2019-11-20 04:12:08','0000-00-00'),
(22,'Georgian','ka','ge','no','no','2019-11-20 04:11:40','0000-00-00'),
(23,'Gujarati','gu','in','no','no','2019-11-20 03:39:16','0000-00-00'),
(24,'Danish','da','dk','no','no','2019-11-20 04:03:25','0000-00-00'),
(25,'Hebrew','he','il','no','no','2019-11-20 04:13:50','0000-00-00'),
(26,'Yiddish','yi','il','no','no','2019-11-20 04:25:33','0000-00-00'),
(27,'Indonesian','id','id','no','no','2019-11-20 03:24:23','0000-00-00'),
(28,'Irish','ga','ga','no','no','2019-11-20 03:24:23','0000-00-00'),
(29,'Italian','it','it','no','no','2019-11-20 03:24:23','0000-00-00'),
(30,'Icelandic','is','is','no','no','2019-11-20 03:24:23','0000-00-00'),
(31,'Spanish','es','es','no','no','2019-11-20 03:24:23','0000-00-00'),
(33,'Kannada','kn','kn','no','no','2019-11-20 03:24:23','0000-00-00'),
(34,'Catalan','ca','ca','no','no','2019-11-20 03:24:23','0000-00-00'),
(36,'Chinese','zh','cn','no','no','2019-11-20 04:01:48','0000-00-00'),
(37,'Korean','ko','kr','no','no','2019-11-20 04:19:09','0000-00-00'),
(38,'Xhosa','xh','ls','no','no','2019-11-20 04:24:39','0000-00-00'),
(39,'Latin','la','it','no','no','2021-01-22 23:09:32','0000-00-00'),
(40,'Latvian','lv','lv','no','no','2019-11-20 03:24:23','0000-00-00'),
(41,'Lithuanian','lt','lt','no','no','2019-11-20 03:24:23','0000-00-00'),
(43,'Malagasy','mg','mg','no','no','2019-11-20 03:24:23','0000-00-00'),
(44,'Malay','ms','ms','no','no','2019-11-20 03:24:23','0000-00-00'),
(45,'Malayalam','ml','ml','no','no','2019-11-20 03:24:23','0000-00-00'),
(46,'Maltese','mt','mt','no','no','2019-11-20 03:24:23','0000-00-00'),
(47,'Macedonian','mk','mk','no','no','2019-11-20 03:24:23','0000-00-00'),
(48,'Maori','mi','nz','no','no','2019-11-20 04:20:27','0000-00-00'),
(49,'Marathi','mr','in','no','no','2019-11-20 03:39:51','0000-00-00'),
(51,'Mongolian','mn','mn','no','no','2019-11-20 03:24:23','0000-00-00'),
(52,'German','de','de','no','no','2019-11-20 03:24:23','0000-00-00'),
(53,'Nepali','ne','ne','no','no','2019-11-20 03:24:23','0000-00-00'),
(54,'Norwegian','no','no','no','no','2019-11-20 03:24:23','0000-00-00'),
(55,'Punjabi','pa','in','no','no','2019-11-20 03:40:16','0000-00-00'),
(57,'Persian','fa','ir','no','no','2019-11-20 04:21:17','0000-00-00'),
(59,'Portuguese','pt','pt','no','no','2019-11-20 03:24:23','0000-00-00'),
(60,'Romanian','ro','ro','no','no','2019-11-20 03:24:23','0000-00-00'),
(61,'Russian','ru','ru','no','no','2019-11-20 03:24:23','0000-00-00'),
(62,'Cebuano','ceb','ph','no','no','2019-11-20 03:59:12','0000-00-00'),
(64,'Sinhala','si','lk ','no','no','2021-01-22 23:09:32','0000-00-00'),
(65,'Slovakian','sk','sk','no','no','2019-11-20 03:24:23','0000-00-00'),
(66,'Slovenian','sl','sl','no','no','2019-11-20 03:24:23','0000-00-00'),
(67,'Swahili','sw','ke','no','no','2019-11-20 04:21:57','0000-00-00'),
(68,'Sundanese','su','sd','no','no','2019-12-03 03:06:57','0000-00-00'),
(70,'Thai','th','th','no','no','2019-11-20 03:24:23','0000-00-00'),
(71,'Tagalog','tl','tl','no','no','2019-11-20 03:24:23','0000-00-00'),
(72,'Tamil','ta','in','no','no','2019-11-20 03:40:53','0000-00-00'),
(74,'Telugu','te','in','no','no','2019-11-20 03:41:15','0000-00-00'),
(75,'Turkish','tr','tr','no','no','2019-11-20 03:24:23','0000-00-00'),
(77,'Uzbek','uz','uz','no','no','2019-11-20 03:24:23','0000-00-00'),
(79,'Urdu','ur','pk','no','no','2019-11-20 04:23:57','0000-00-00'),
(80,'Finnish','fi','fi','no','no','2019-11-20 03:24:23','0000-00-00'),
(81,'French','fr','fr','no','no','2019-11-20 03:24:23','0000-00-00'),
(82,'Hindi','hi','in','no','no','2019-11-20 03:36:34','0000-00-00'),
(84,'Czech','cs','cz','no','no','2019-11-20 04:02:36','0000-00-00'),
(85,'Swedish','sv','sv','no','no','2019-11-20 03:24:23','0000-00-00'),
(86,'Scottish','gd','gd','no','no','2019-11-20 03:24:23','0000-00-00'),
(87,'Estonian','et','et','no','no','2019-11-20 03:24:23','0000-00-00'),
(88,'Esperanto','eo','br','no','no','2019-11-20 20:49:18','0000-00-00'),
(89,'Javanese','jv','id','no','no','2019-11-20 04:18:29','0000-00-00'),
(90,'Japanese','ja','jp','no','no','2019-11-20 04:14:39','0000-00-00'),
(91,'Polish','pl','pl','no','no','2020-06-14 20:25:27','0000-00-00'),
(92,'Kurdish','ku','iq','no','no','2020-12-20 16:15:31','0000-00-00'),
(93,'Lao','lo','la','no','no','2020-12-20 16:15:36','0000-00-00');

/*Table structure for table `leave_types` */

DROP TABLE IF EXISTS `leave_types`;

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `leave_types` */

/*Table structure for table `lesson` */

DROP TABLE IF EXISTS `lesson`;

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) NOT NULL,
  `subject_group_class_sections_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `subject_group_subject_id` (`subject_group_subject_id`),
  KEY `subject_group_class_sections_id` (`subject_group_class_sections_id`),
  CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`subject_group_class_sections_id`) REFERENCES `subject_group_class_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lesson` */

insert  into `lesson`(`id`,`session_id`,`subject_group_subject_id`,`subject_group_class_sections_id`,`name`,`created_at`) values 
(1,15,2,1,'LessonName1','2021-07-05 12:50:52');

/*Table structure for table `libarary_members` */

DROP TABLE IF EXISTS `libarary_members`;

CREATE TABLE `libarary_members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `library_card_no` varchar(50) DEFAULT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `libarary_members` */

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text DEFAULT NULL,
  `record_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `agent` varchar(50) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

/*Data for the table `logs` */

insert  into `logs`(`id`,`message`,`record_id`,`user_id`,`action`,`ip_address`,`platform`,`agent`,`time`,`created_at`) values 
(1,'New Record inserted On sections id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 06:54:36',NULL),
(2,'New Record inserted On subject groups id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 06:54:55',NULL),
(3,'New Record inserted On subjects id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 06:55:44',NULL),
(4,'New Record inserted On subject groups id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 06:57:02',NULL),
(5,'New Record inserted On students id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:06:02',NULL),
(6,'New Record inserted On  student session id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:06:02',NULL),
(7,'New Record inserted On users id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:06:02',NULL),
(8,'New Record inserted On users id 2',2,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:06:02',NULL),
(9,'Record updated On students id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:06:02',NULL),
(10,'Record updated On students id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:35:28',NULL),
(11,'Record updated On  student session id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:35:28',NULL),
(12,'Record updated On staff id 2',2,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 07:54:14',NULL),
(13,'Record updated On staff id 3',3,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 08:03:52',NULL),
(14,'Record updated On staff id 4',4,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 08:08:07',NULL),
(15,'New Record inserted On exam groups id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 08:55:36',NULL),
(16,'New Record inserted On grades id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 08:56:59',NULL),
(17,'New Record inserted On homework id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 09:01:40',NULL),
(18,'New Record inserted On payment settings id 11',11,1,'Insert','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 09:08:30',NULL),
(19,'Record updated On payment settings id 11',11,1,'Update','::1','Windows 10','Chrome 91.0.4472.114','2021-06-30 09:10:11',NULL),
(20,'New Record inserted On send notification id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 17:42:09',NULL),
(21,'New Record inserted On students id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:01:57',NULL),
(22,'New Record inserted On  student session id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:01:57',NULL),
(23,'New Record inserted On users id 3',3,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:01:57',NULL),
(24,'New Record inserted On users id 4',4,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:01:57',NULL),
(25,'Record updated On students id 2',2,1,'Update','::1','Windows 10','Spartan 18.18363','2021-06-30 18:01:57',NULL),
(26,'New Record inserted On  marksheets id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:17:52',NULL),
(27,'New Record inserted On exam group exams name id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:20:46',NULL),
(28,'New Record inserted On exam groups id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:31:53',NULL),
(29,'Record updated On  exam group exams name id 1',1,1,'Update','::1','Windows 10','Spartan 18.18363','2021-06-30 18:34:04',NULL),
(30,'New Record inserted On exam group exams name id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 18:35:19',NULL),
(31,'New Record inserted On exam group exams name id 3',3,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 19:17:25',NULL),
(32,'Record updated On  exam group exams name id 2',2,1,'Update','::1','Windows 10','Spartan 18.18363','2021-06-30 19:19:01',NULL),
(33,'Record updated On subjects id 1',1,1,'Update','::1','Windows 10','Spartan 18.18363','2021-06-30 19:52:56',NULL),
(34,'Record updated On subjects id 1',1,1,'Update','::1','Windows 10','Spartan 18.18363','2021-06-30 19:53:28',NULL),
(35,'New Record inserted On homework id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-06-30 19:55:28',NULL),
(36,'Record updated On staff id 5',5,1,'Update','::1','Windows 10','Spartan 18.18363','2021-07-01 01:13:40',NULL),
(37,'New Record inserted On exam groups id 3',3,5,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 01:16:33',NULL),
(38,'New Record inserted On exam group exams name id 4',4,5,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 01:17:37',NULL),
(39,'New Record inserted On admit cards id 2',2,5,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 01:29:39',NULL),
(40,'New Record inserted On  income head   id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 02:32:06',NULL),
(41,'New Record inserted On  Income   id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 02:32:44',NULL),
(42,'New Record inserted On  fee groups id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 02:33:23',NULL),
(43,'New Record inserted On  fee type id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 02:33:40',NULL),
(44,'New Record inserted On  fee groups feetype id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 02:33:59',NULL),
(45,'Record deleted On  student fees master 1',1,1,'Delete','::1','Windows 10','Spartan 18.18363','2021-07-01 02:34:29',NULL),
(46,'Record deleted On  student fees master 1',1,1,'Delete','::1','Windows 10','Spartan 18.18363','2021-07-01 02:37:18',NULL),
(47,'Record deleted On  student fees master 1',1,1,'Delete','::1','Windows 10','Spartan 18.18363','2021-07-01 02:37:26',NULL),
(48,'New Record inserted On send notification id 2',2,5,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 07:57:14',NULL),
(49,'New Record inserted On send notification id 3',3,5,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 07:58:20',NULL),
(50,'New Record inserted On send notification id 4',4,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 08:00:36',NULL),
(51,'New Record inserted On send notification id 5',5,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 08:02:24',NULL),
(52,'New Record inserted On subjects id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 08:35:28',NULL),
(53,'New Record inserted On homework id 3',3,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 08:37:39',NULL),
(54,'New Record inserted On homework id 4',4,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 08:38:47',NULL),
(55,'New Record inserted On  student attendences id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 18:08:23',NULL),
(56,'New Record inserted On  student attendences id 2',2,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-01 18:08:23',NULL),
(57,'Record updated On staff id 6',6,1,'Update','::1','Windows 10','Spartan 18.18363','2021-07-03 04:24:27',NULL),
(58,'New Record inserted On homework id 5',5,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-03 16:07:32',NULL),
(59,'Record updated On settings id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-03 22:59:48',NULL),
(60,'New Record inserted On examtypes id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-05 07:44:13',NULL),
(61,'New Record inserted On examgrades id 1',1,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-05 07:45:10',NULL),
(62,'New Record inserted On homework id 6',6,1,'Insert','::1','Windows 10','Spartan 18.18363','2021-07-05 07:52:08',NULL),
(63,'Record updated On grades id 1',1,1,'Update','::1','Windows 10','Spartan 18.18363','2021-07-05 07:54:52',NULL),
(64,'Record updated On homework id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:41:21',NULL),
(65,'Record updated On homework id 2',2,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:42:06',NULL),
(66,'Record updated On homework id 2',2,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:42:44',NULL),
(67,'Record updated On homework id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:43:06',NULL),
(68,'Record updated On homework id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:43:14',NULL),
(69,'Record updated On homework id 1',1,1,'Update','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:43:31',NULL),
(70,'New Record inserted On lesson id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:50:52',NULL),
(71,'New Record inserted On topic id 1',1,1,'Insert','::1','Windows 10','Chrome 91.0.4472.124','2021-07-05 19:51:20',NULL);

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `send_mail` varchar(10) DEFAULT '0',
  `send_sms` varchar(10) DEFAULT '0',
  `is_group` varchar(10) DEFAULT '0',
  `is_individual` varchar(10) DEFAULT '0',
  `is_class` int(10) NOT NULL DEFAULT 0,
  `group_list` text DEFAULT NULL,
  `user_list` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `messages` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

/*Table structure for table `multi_class_students` */

DROP TABLE IF EXISTS `multi_class_students`;

CREATE TABLE `multi_class_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `student_session_id` (`student_session_id`),
  CONSTRAINT `multi_class_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `multi_class_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `multi_class_students` */

/*Table structure for table `notification_roles` */

DROP TABLE IF EXISTS `notification_roles`;

CREATE TABLE `notification_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_notification_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `send_notification_id` (`send_notification_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `notification_roles_ibfk_1` FOREIGN KEY (`send_notification_id`) REFERENCES `send_notification` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notification_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `notification_roles` */

insert  into `notification_roles`(`id`,`send_notification_id`,`role_id`,`is_active`,`created_at`) values 
(1,1,7,0,'2021-06-30 10:42:09'),
(2,2,2,0,'2021-07-01 00:57:14'),
(3,4,7,0,'2021-07-01 01:00:36'),
(4,5,7,0,'2021-07-01 01:02:24');

/*Table structure for table `notification_setting` */

DROP TABLE IF EXISTS `notification_setting`;

CREATE TABLE `notification_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `is_mail` varchar(10) DEFAULT '0',
  `is_sms` varchar(10) DEFAULT '0',
  `is_notification` int(11) NOT NULL DEFAULT 0,
  `display_notification` int(11) NOT NULL DEFAULT 0,
  `display_sms` int(11) NOT NULL DEFAULT 1,
  `template` longtext NOT NULL,
  `variables` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `notification_setting` */

insert  into `notification_setting`(`id`,`type`,`is_mail`,`is_sms`,`is_notification`,`display_notification`,`display_sms`,`template`,`variables`,`created_at`) values 
(1,'student_admission','1','1',0,0,1,'Dear {{student_name}} your admission is confirm in Class: {{class}} Section:  {{section}} for Session: {{current_session_name}} for more \r\ndetail\r\n contact\r\n System\r\n Admin\r\n {{class}} {{section}} {{admission_no}} {{roll_no}} {{admission_date}} {{mobileno}} {{email}} {{dob}} {{guardian_name}} {{guardian_relation}} {{guardian_phone}} {{father_name}} {{father_phone}} {{blood_group}} {{mother_name}} {{gender}} {{guardian_email}}','{{student_name}} {{class}}  {{section}}  {{admission_no}}  {{roll_no}}  {{admission_date}}   {{mobileno}}  {{email}}  {{dob}}  {{guardian_name}}  {{guardian_relation}}  {{guardian_phone}}  {{father_name}}  {{father_phone}}  {{blood_group}}  {{mother_name}}  {{gender}} {{guardian_email}} {{current_session_name}} ','2021-01-22 03:34:16'),
(2,'exam_result','1','1',1,1,1,'Dear {{student_name}} - {{exam_roll_no}}, your {{exam}} result has been published.','{{student_name}} {{exam_roll_no}} {{exam}}','2021-01-22 03:34:56'),
(3,'fee_submission','1','1',1,1,1,'Dear parents, we have received Fees Amount {{fee_amount}} for  {{student_name}}  by Your School Name \r\n{{class}} {{section}} {{fine_type}} {{fine_percentage}} {{fine_amount}} {{fee_group_name}} {{type}} {{code}} {{email}} {{contact_no}} {{invoice_id}} {{sub_invoice_id}} {{due_date}} {{amount}} {{fee_amount}}','{{student_name}} {{class}} {{section}} {{fine_type}} {{fine_percentage}} {{fine_amount}} {{fee_group_name}} {{type}} {{code}} {{email}} {{contact_no}} {{invoice_id}} {{sub_invoice_id}} {{due_date}} {{amount}} {{fee_amount}}','2021-01-22 03:35:29'),
(4,'absent_attendence','1','1',1,1,1,'Absent Notice :{{student_name}}  was absent on date {{date}} in period {{subject_name}} {{subject_code}} {{subject_type}} from Your School Name','{{student_name}} {{mobileno}} {{email}} {{father_name}} {{father_phone}} {{father_occupation}} {{mother_name}} {{mother_phone}} {{guardian_name}} {{guardian_phone}} {{guardian_occupation}} {{guardian_email}} {{date}} {{current_session_name}}             {{time_from}} {{time_to}} {{subject_name}} {{subject_code}} {{subject_type}}  ','2021-01-22 03:44:25'),
(5,'login_credential','1','1',0,0,1,'Hello {{display_name}} your login details for Url: {{url}} Username: {{username}}  Password: {{password}}','{{url}} {{display_name}} {{username}} {{password}}','2021-01-19 04:15:36'),
(6,'homework','1','1',1,1,1,'New Homework has been created for \r\n{{student_name}} at\r\n\r\n\r\n\r\n{{homework_date}} for the class {{class}} {{section}} {{subject}}. kindly submit your\r\n\r\n\r\n homework before {{submit_date}} .Thank you','{{homework_date}} {{submit_date}} {{class}} {{section}} {{subject}} {{student_name}}','2021-01-19 04:43:22'),
(7,'fees_reminder','1','1',1,1,1,'Dear parents, please pay fee amount Rs.{{due_amount}} of {{fee_type}} before {{due_date}} for {{student_name}}  from smart school (ignore if you already paid)','{{fee_type}}{{fee_code}}{{due_date}}{{student_name}}{{school_name}}{{fee_amount}}{{due_amount}}{{deposit_amount}} ','2021-01-22 03:35:47'),
(8,'forgot_password','1','0',0,0,0,'Dear  {{name}} , \r\n    Recently a request was submitted to reset password for your account. If you didn\'t make the request, just ignore this email. Otherwise you can reset your password using this link <a href=\'{{resetPassLink}}\'>Click here to reset your password</a>,\r\nif you\'re having trouble clicking the password reset button, copy and paste the URL below into your web browser. your username {{username}}\r\n{{resetPassLink}}\r\n Regards,\r\n {{school_name}}','{{school_name}}{{name}}{{username}}{{resetPassLink}} ','2021-01-22 03:44:50'),
(9,'online_examination_publish_exam','1','1',1,1,1,'A new exam {{exam_title}} has been created for  duration: {{time_duration}} min, which will be available from:  {{exam_from}} to  {{exam_to}}.','{{exam_title}} {{exam_from}} {{exam_to}} {{time_duration}} {{attempt}} {{passing_percentage}}','2021-01-18 04:46:16'),
(10,'online_examination_publish_result','1','1',1,1,1,'Exam {{exam_title}} result has been declared which was conducted between  {{exam_from}} to   {{exam_to}}, for more details, please check your student portal.','{{exam_title}} {{exam_from}} {{exam_to}} {{time_duration}} {{attempt}} {{passing_percentage}}','2021-01-18 04:50:45');

/*Table structure for table `online_admissions` */

DROP TABLE IF EXISTS `online_admissions`;

CREATE TABLE `online_admissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(100) DEFAULT NULL,
  `roll_no` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `rte` varchar(20) NOT NULL DEFAULT 'No',
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `cast` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) DEFAULT NULL,
  `blood_group` varchar(200) NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `samagra_id` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `guardian_is` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(150) NOT NULL,
  `guardian_address` text DEFAULT NULL,
  `guardian_email` varchar(100) NOT NULL,
  `father_pic` varchar(200) NOT NULL,
  `mother_pic` varchar(200) NOT NULL,
  `guardian_pic` varchar(200) NOT NULL,
  `is_enroll` int(255) DEFAULT 0,
  `previous_school` text DEFAULT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL,
  `measurement_date` date DEFAULT NULL,
  `app_key` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `disable_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_section_id` (`class_section_id`),
  CONSTRAINT `online_admissions_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `online_admissions` */

/*Table structure for table `onlineexam` */

DROP TABLE IF EXISTS `onlineexam`;

CREATE TABLE `onlineexam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam` text DEFAULT NULL,
  `attempt` int(11) NOT NULL,
  `exam_from` datetime DEFAULT NULL,
  `exam_to` datetime DEFAULT NULL,
  `is_quiz` int(11) NOT NULL DEFAULT 0,
  `auto_publish_date` datetime DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `duration` time NOT NULL,
  `passing_percentage` float NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `publish_result` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(1) DEFAULT '0',
  `is_marks_display` int(11) NOT NULL DEFAULT 0,
  `is_neg_marking` int(11) NOT NULL DEFAULT 0,
  `is_random_question` int(11) NOT NULL DEFAULT 0,
  `is_rank_generated` int(1) NOT NULL DEFAULT 0,
  `publish_exam_notification` int(1) NOT NULL,
  `publish_result_notification` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `onlineexam_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `onlineexam` */

/*Table structure for table `onlineexam_attempts` */

DROP TABLE IF EXISTS `onlineexam_attempts`;

CREATE TABLE `onlineexam_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onlineexam_student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onlineexam_student_id` (`onlineexam_student_id`),
  CONSTRAINT `onlineexam_attempts_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `onlineexam_attempts` */

/*Table structure for table `onlineexam_questions` */

DROP TABLE IF EXISTS `onlineexam_questions`;

CREATE TABLE `onlineexam_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `onlineexam_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `marks` float(10,2) NOT NULL DEFAULT 0.00,
  `neg_marks` float(10,2) DEFAULT 0.00,
  `is_active` varchar(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onlineexam_id` (`onlineexam_id`),
  KEY `question_id` (`question_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `onlineexam_questions_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE,
  CONSTRAINT `onlineexam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `onlineexam_questions_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `onlineexam_questions` */

/*Table structure for table `onlineexam_student_results` */

DROP TABLE IF EXISTS `onlineexam_student_results`;

CREATE TABLE `onlineexam_student_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onlineexam_student_id` int(11) NOT NULL,
  `onlineexam_question_id` int(11) NOT NULL,
  `select_option` longtext DEFAULT NULL,
  `marks` float(10,2) NOT NULL DEFAULT 0.00,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onlineexam_student_id` (`onlineexam_student_id`),
  KEY `onlineexam_question_id` (`onlineexam_question_id`),
  CONSTRAINT `onlineexam_student_results_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `onlineexam_student_results_ibfk_2` FOREIGN KEY (`onlineexam_question_id`) REFERENCES `onlineexam_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `onlineexam_student_results` */

/*Table structure for table `onlineexam_students` */

DROP TABLE IF EXISTS `onlineexam_students`;

CREATE TABLE `onlineexam_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onlineexam_id` int(11) DEFAULT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `is_attempted` int(1) NOT NULL DEFAULT 0,
  `rank` int(1) DEFAULT 0,
  `quiz_attempted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onlineexam_id` (`onlineexam_id`),
  KEY `student_session_id` (`student_session_id`),
  CONSTRAINT `onlineexam_students_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE,
  CONSTRAINT `onlineexam_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `onlineexam_students` */

/*Table structure for table `payment_settings` */

DROP TABLE IF EXISTS `payment_settings`;

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(200) NOT NULL,
  `api_username` varchar(200) DEFAULT NULL,
  `api_secret_key` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `api_publishable_key` varchar(200) NOT NULL,
  `api_password` varchar(200) DEFAULT NULL,
  `api_signature` varchar(200) DEFAULT NULL,
  `api_email` varchar(200) DEFAULT NULL,
  `paypal_demo` varchar(100) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `gateway_mode` int(11) NOT NULL COMMENT '0 Testing, 1 live',
  `paytm_website` varchar(255) NOT NULL,
  `paytm_industrytype` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `payment_settings` */

insert  into `payment_settings`(`id`,`payment_type`,`api_username`,`api_secret_key`,`salt`,`api_publishable_key`,`api_password`,`api_signature`,`api_email`,`paypal_demo`,`account_no`,`is_active`,`gateway_mode`,`paytm_website`,`paytm_industrytype`,`created_at`,`updated_at`) values 
(11,'paypal','tona@test.com','','','','master','master',NULL,'TRUE','','yes',0,'','','2021-06-30 02:08:44',NULL);

/*Table structure for table `payslip_allowance` */

DROP TABLE IF EXISTS `payslip_allowance`;

CREATE TABLE `payslip_allowance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payslip_id` int(11) NOT NULL,
  `allowance_type` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cal_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payslip_allowance` */

/*Table structure for table `permission_category` */

DROP TABLE IF EXISTS `permission_category`;

CREATE TABLE `permission_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_group_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) DEFAULT NULL,
  `enable_view` int(11) DEFAULT 0,
  `enable_add` int(11) DEFAULT 0,
  `enable_edit` int(11) DEFAULT 0,
  `enable_delete` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

/*Data for the table `permission_category` */

insert  into `permission_category`(`id`,`perm_group_id`,`name`,`short_code`,`enable_view`,`enable_add`,`enable_edit`,`enable_delete`,`created_at`) values 
(1,1,'Student','student',1,1,1,1,'2019-10-23 22:42:03'),
(2,1,'Import Student','import_student',1,0,0,0,'2018-06-22 03:17:19'),
(3,1,'Student Categories','student_categories',1,1,1,1,'2018-06-22 03:17:36'),
(4,1,'Student Houses','student_houses',1,1,1,1,'2018-06-22 03:17:53'),
(5,2,'Collect Fees','collect_fees',1,1,0,1,'2018-06-22 03:21:03'),
(6,2,'Fees Carry Forward','fees_carry_forward',1,0,0,0,'2018-06-26 17:18:15'),
(7,2,'Fees Master','fees_master',1,1,1,1,'2018-06-26 17:18:57'),
(8,2,'Fees Group','fees_group',1,1,1,1,'2018-06-22 03:21:46'),
(9,3,'Income','income',1,1,1,1,'2018-06-22 03:23:21'),
(10,3,'Income Head','income_head',1,1,1,1,'2018-06-22 03:22:44'),
(11,3,'Search Income','search_income',1,0,0,0,'2018-06-22 03:23:00'),
(12,4,'Expense','expense',1,1,1,1,'2018-06-22 03:24:06'),
(13,4,'Expense Head','expense_head',1,1,1,1,'2018-06-22 03:23:47'),
(14,4,'Search Expense','search_expense',1,0,0,0,'2018-06-22 03:24:13'),
(15,5,'Student / Period Attendance','student_attendance',1,1,1,0,'2019-11-28 17:19:05'),
(20,6,'Marks Grade','marks_grade',1,1,1,1,'2018-06-22 03:25:25'),
(21,7,'Class Timetable','class_timetable',1,0,1,0,'2019-11-23 19:05:17'),
(23,7,'Subject','subject',1,1,1,1,'2018-06-22 03:32:17'),
(24,7,'Class','class',1,1,1,1,'2018-06-22 03:32:35'),
(25,7,'Section','section',1,1,1,1,'2018-06-22 03:31:10'),
(26,7,'Promote Student','promote_student',1,0,0,0,'2018-06-22 03:32:47'),
(27,8,'Upload Content','upload_content',1,1,0,1,'2018-06-22 03:33:19'),
(28,9,'Books List','books',1,1,1,1,'2019-11-23 16:37:12'),
(29,9,'Issue Return','issue_return',1,0,0,0,'2019-11-23 16:37:18'),
(30,9,'Add Staff Member','add_staff_member',1,0,0,0,'2018-07-02 04:37:00'),
(31,10,'Issue Item','issue_item',1,1,1,1,'2019-11-28 22:39:27'),
(32,10,'Add Item Stock','item_stock',1,1,1,1,'2019-11-23 16:39:17'),
(33,10,'Add Item','item',1,1,1,1,'2019-11-23 16:39:39'),
(34,10,'Item Store','store',1,1,1,1,'2019-11-23 16:40:41'),
(35,10,'Item Supplier','supplier',1,1,1,1,'2019-11-23 16:40:49'),
(37,11,'Routes','routes',1,1,1,1,'2018-06-22 03:39:17'),
(38,11,'Vehicle','vehicle',1,1,1,1,'2018-06-22 03:39:36'),
(39,11,'Assign Vehicle','assign_vehicle',1,1,1,1,'2018-06-26 21:39:20'),
(40,12,'Hostel','hostel',1,1,1,1,'2018-06-22 03:40:49'),
(41,12,'Room Type','room_type',1,1,1,1,'2018-06-22 03:40:27'),
(42,12,'Hostel Rooms','hostel_rooms',1,1,1,1,'2018-06-24 23:23:03'),
(43,13,'Notice Board','notice_board',1,1,1,1,'2018-06-22 03:41:17'),
(44,13,'Email','email',1,0,0,0,'2019-11-25 21:20:37'),
(46,13,'Email / SMS Log','email_sms_log',1,0,0,0,'2018-06-22 03:41:23'),
(53,15,'Languages','languages',0,1,0,1,'2021-01-22 23:09:32'),
(54,15,'General Setting','general_setting',1,0,1,0,'2018-07-05 02:08:35'),
(55,15,'Session Setting','session_setting',1,1,1,1,'2018-06-22 03:44:15'),
(56,15,'Notification Setting','notification_setting',1,0,1,0,'2018-07-05 02:08:41'),
(57,15,'SMS Setting','sms_setting',1,0,1,0,'2018-07-05 02:08:47'),
(58,15,'Email Setting','email_setting',1,0,1,0,'2018-07-05 02:08:51'),
(59,15,'Front CMS Setting','front_cms_setting',1,0,1,0,'2018-07-05 02:08:55'),
(60,15,'Payment Methods','payment_methods',1,0,1,0,'2018-07-05 02:08:59'),
(61,16,'Menus','menus',1,1,0,1,'2018-07-08 20:50:06'),
(62,16,'Media Manager','media_manager',1,1,0,1,'2018-07-08 20:50:26'),
(63,16,'Banner Images','banner_images',1,1,0,1,'2018-06-22 03:46:02'),
(64,16,'Pages','pages',1,1,1,1,'2018-06-22 03:46:21'),
(65,16,'Gallery','gallery',1,1,1,1,'2018-06-22 03:47:02'),
(66,16,'Event','event',1,1,1,1,'2018-06-22 03:47:20'),
(67,16,'News','notice',1,1,1,1,'2018-07-03 01:39:34'),
(68,2,'Fees Group Assign','fees_group_assign',1,0,0,0,'2018-06-22 03:20:42'),
(69,2,'Fees Type','fees_type',1,1,1,1,'2018-06-22 03:19:34'),
(70,2,'Fees Discount','fees_discount',1,1,1,1,'2018-06-22 03:20:10'),
(71,2,'Fees Discount Assign','fees_discount_assign',1,0,0,0,'2018-06-22 03:20:17'),
(73,2,'Search Fees Payment','search_fees_payment',1,0,0,0,'2018-06-22 03:20:27'),
(74,2,'Search Due Fees','search_due_fees',1,0,0,0,'2018-06-22 03:20:35'),
(77,7,'Assign Class Teacher','assign_class_teacher',1,1,1,1,'2018-06-22 03:30:52'),
(78,17,'Admission Enquiry','admission_enquiry',1,1,1,1,'2018-06-22 03:51:24'),
(79,17,'Follow Up Admission Enquiry','follow_up_admission_enquiry',1,1,0,1,'2018-06-22 03:51:39'),
(80,17,'Visitor Book','visitor_book',1,1,1,1,'2018-06-22 03:48:58'),
(81,17,'Phone Call Log','phone_call_log',1,1,1,1,'2018-06-22 03:50:57'),
(82,17,'Postal Dispatch','postal_dispatch',1,1,1,1,'2018-06-22 03:50:21'),
(83,17,'Postal Receive','postal_receive',1,1,1,1,'2018-06-22 03:50:04'),
(84,17,'Complain','complaint',1,1,1,1,'2018-07-03 01:40:55'),
(85,17,'Setup Font Office','setup_font_office',1,1,1,1,'2018-06-22 03:49:24'),
(86,18,'Staff','staff',1,1,1,1,'2018-06-22 03:53:31'),
(87,18,'Disable Staff','disable_staff',1,0,0,0,'2018-06-22 03:53:12'),
(88,18,'Staff Attendance','staff_attendance',1,1,1,0,'2018-06-22 03:53:10'),
(90,18,'Staff Payroll','staff_payroll',1,1,0,1,'2018-06-22 03:52:51'),
(93,19,'Homework','homework',1,1,1,1,'2018-06-22 03:53:50'),
(94,19,'Homework Evaluation','homework_evaluation',1,1,0,0,'2018-06-26 20:07:21'),
(96,20,'Student Certificate','student_certificate',1,1,1,1,'2018-07-06 03:41:07'),
(97,20,'Generate Certificate','generate_certificate',1,0,0,0,'2018-07-06 03:37:16'),
(98,20,'Student ID Card','student_id_card',1,1,1,1,'2018-07-06 03:41:28'),
(99,20,'Generate ID Card','generate_id_card',1,0,0,0,'2018-07-06 03:41:49'),
(102,21,'Calendar To Do List','calendar_to_do_list',1,1,1,1,'2018-06-22 03:54:41'),
(104,10,'Item Category','item_category',1,1,1,1,'2018-06-22 03:34:33'),
(106,22,'Quick Session Change','quick_session_change',1,0,0,0,'2018-06-22 03:54:45'),
(107,1,'Disable Student','disable_student',1,0,0,0,'2018-06-24 23:21:34'),
(108,18,' Approve Leave Request','approve_leave_request',1,0,1,1,'2020-10-05 01:56:27'),
(109,18,'Apply Leave','apply_leave',1,1,0,0,'2019-11-28 15:47:46'),
(110,18,'Leave Types ','leave_types',1,1,1,1,'2018-07-02 03:17:56'),
(111,18,'Department','department',1,1,1,1,'2018-06-25 20:57:07'),
(112,18,'Designation','designation',1,1,1,1,'2018-06-25 20:57:07'),
(113,22,'Fees Collection And Expense Monthly Chart','fees_collection_and_expense_monthly_chart',1,0,0,0,'2018-07-03 00:08:15'),
(114,22,'Fees Collection And Expense Yearly Chart','fees_collection_and_expense_yearly_chart',1,0,0,0,'2018-07-03 00:08:15'),
(115,22,'Monthly Fees Collection Widget','Monthly fees_collection_widget',1,0,0,0,'2018-07-03 00:13:35'),
(116,22,'Monthly Expense Widget','monthly_expense_widget',1,0,0,0,'2018-07-03 00:13:35'),
(117,22,'Student Count Widget','student_count_widget',1,0,0,0,'2018-07-03 00:13:35'),
(118,22,'Staff Role Count Widget','staff_role_count_widget',1,0,0,0,'2018-07-03 00:13:35'),
(122,5,'Attendance By Date','attendance_by_date',1,0,0,0,'2018-07-03 01:42:29'),
(123,9,'Add Student','add_student',1,0,0,0,'2018-07-03 01:42:29'),
(126,15,'User Status','user_status',1,0,0,0,'2018-07-03 01:42:29'),
(127,18,'Can See Other Users Profile','can_see_other_users_profile',1,0,0,0,'2018-07-03 01:42:29'),
(128,1,'Student Timeline','student_timeline',0,1,0,1,'2018-07-05 01:08:52'),
(129,18,'Staff Timeline','staff_timeline',0,1,0,1,'2018-07-05 01:08:52'),
(130,15,'Backup','backup',1,1,0,1,'2018-07-08 21:17:17'),
(131,15,'Restore','restore',1,0,0,0,'2018-07-08 21:17:17'),
(134,1,'Disable Reason','disable_reason',1,1,1,1,'2019-11-26 22:39:21'),
(135,2,'Fees Reminder','fees_reminder',1,0,1,0,'2019-10-24 17:39:49'),
(136,5,'Approve Leave','approve_leave',1,0,0,0,'2019-10-24 17:46:44'),
(137,6,'Exam Group','exam_group',1,1,1,1,'2019-10-24 18:02:34'),
(141,6,'Design Admit Card','design_admit_card',1,1,1,1,'2019-10-24 18:06:59'),
(142,6,'Print Admit Card','print_admit_card',1,0,0,0,'2019-11-23 15:57:51'),
(143,6,'Design Marksheet','design_marksheet',1,1,1,1,'2019-10-24 18:10:25'),
(144,6,'Print Marksheet','print_marksheet',1,0,0,0,'2019-10-24 18:11:02'),
(145,7,'Teachers Timetable','teachers_time_table',1,0,0,0,'2019-11-29 18:52:21'),
(146,14,'Student Report','student_report',1,0,0,0,'2019-10-24 18:27:00'),
(147,14,'Guardian Report','guardian_report',1,0,0,0,'2019-10-24 18:30:27'),
(148,14,'Student History','student_history',1,0,0,0,'2019-10-24 18:39:07'),
(149,14,'Student Login Credential Report','student_login_credential_report',1,0,0,0,'2019-10-24 18:39:07'),
(150,14,'Class Subject Report','class_subject_report',1,0,0,0,'2019-10-24 18:39:07'),
(151,14,'Admission Report','admission_report',1,0,0,0,'2019-10-24 18:39:07'),
(152,14,'Sibling Report','sibling_report',1,0,0,0,'2019-10-24 18:39:07'),
(153,14,'Homework Evaluation Report','homehork_evaluation_report',1,0,0,0,'2019-11-23 17:04:24'),
(154,14,'Student Profile','student_profile',1,0,0,0,'2019-10-24 18:39:07'),
(155,14,'Fees Statement','fees_statement',1,0,0,0,'2019-10-24 18:55:52'),
(156,14,'Balance Fees Report','balance_fees_report',1,0,0,0,'2019-10-24 18:55:52'),
(157,14,'Fees Collection Report','fees_collection_report',1,0,0,0,'2019-10-24 18:55:52'),
(158,14,'Online Fees Collection Report','online_fees_collection_report',1,0,0,0,'2019-10-24 18:55:52'),
(159,14,'Income Report','income_report',1,0,0,0,'2019-10-24 18:55:52'),
(160,14,'Expense Report','expense_report',1,0,0,0,'2019-10-24 18:55:52'),
(161,14,'PayRoll Report','payroll_report',1,0,0,0,'2019-10-30 17:23:22'),
(162,14,'Income Group Report','income_group_report',1,0,0,0,'2019-10-24 18:55:52'),
(163,14,'Expense Group Report','expense_group_report',1,0,0,0,'2019-10-24 18:55:52'),
(164,14,'Attendance Report','attendance_report',1,0,0,0,'2019-10-24 19:08:06'),
(165,14,'Staff Attendance Report','staff_attendance_report',1,0,0,0,'2019-10-24 19:08:06'),
(174,14,'Transport Report','transport_report',1,0,0,0,'2019-10-24 19:13:56'),
(175,14,'Hostel Report','hostel_report',1,0,0,0,'2019-11-26 22:51:53'),
(176,14,'Audit Trail Report','audit_trail_report',1,0,0,0,'2019-10-24 19:16:39'),
(177,14,'User Log','user_log',1,0,0,0,'2019-10-24 19:19:27'),
(178,14,'Book Issue Report','book_issue_report',1,0,0,0,'2019-10-24 19:29:04'),
(179,14,'Book Due Report','book_due_report',1,0,0,0,'2019-10-24 19:29:04'),
(180,14,'Book Inventory Report','book_inventory_report',1,0,0,0,'2019-10-24 19:29:04'),
(181,14,'Stock Report','stock_report',1,0,0,0,'2019-10-24 19:31:28'),
(182,14,'Add Item Report','add_item_report',1,0,0,0,'2019-10-24 19:31:28'),
(183,14,'Issue Item Report','issue_item_report',1,0,0,0,'2019-11-28 19:48:06'),
(185,23,'Online Examination','online_examination',1,1,1,1,'2019-11-23 15:54:50'),
(186,23,'Question Bank','question_bank',1,1,1,1,'2019-11-23 15:55:18'),
(187,6,'Exam Result','exam_result',1,0,0,0,'2019-11-23 15:58:50'),
(188,7,'Subject Group','subject_group',1,1,1,1,'2019-11-23 16:34:32'),
(189,18,'Teachers Rating','teachers_rating',1,0,1,1,'2019-11-23 19:12:54'),
(190,22,'Fees Awaiting Payment Widegts','fees_awaiting_payment_widegts',1,0,0,0,'2019-11-23 16:52:51'),
(191,22,'Conveted Leads Widegts','conveted_leads_widegts',1,0,0,0,'2019-11-23 16:58:24'),
(192,22,'Fees Overview Widegts','fees_overview_widegts',1,0,0,0,'2019-11-23 16:57:41'),
(193,22,'Enquiry Overview Widegts','enquiry_overview_widegts',1,0,0,0,'2019-12-01 21:06:09'),
(194,22,'Library Overview Widegts','book_overview_widegts',1,0,0,0,'2019-11-30 17:13:04'),
(195,22,'Student Today Attendance Widegts','today_attendance_widegts',1,0,0,0,'2019-12-02 20:57:45'),
(196,6,'Marks Import','marks_import',1,0,0,0,'2019-11-23 17:02:11'),
(197,14,'Student Attendance Type Report','student_attendance_type_report',1,0,0,0,'2019-11-23 17:06:32'),
(198,14,'Exam Marks Report','exam_marks_report',1,0,0,0,'2019-11-23 17:11:15'),
(200,14,'Online Exam Wise Report','online_exam_wise_report',1,0,0,0,'2019-11-23 17:18:14'),
(201,14,'Online Exams Report','online_exams_report',1,0,0,0,'2019-11-28 18:48:05'),
(202,14,'Online Exams Attempt Report','online_exams_attempt_report',1,0,0,0,'2019-11-28 18:46:24'),
(203,14,'Online Exams Rank Report','online_exams_rank_report',1,0,0,0,'2019-11-23 17:22:25'),
(204,14,'Staff Report','staff_report',1,0,0,0,'2019-11-23 17:25:27'),
(205,6,'Exam','exam',1,1,1,1,'2019-11-23 20:55:48'),
(207,6,'Exam Publish','exam_publish',1,0,0,0,'2019-11-23 21:15:04'),
(208,6,'Link Exam','link_exam',1,0,1,0,'2019-11-23 21:15:04'),
(210,6,'Assign / View student','exam_assign_view_student',1,0,1,0,'2019-11-23 21:15:04'),
(211,6,'Exam Subject','exam_subject',1,0,1,0,'2019-11-23 21:15:04'),
(212,6,'Exam Marks','exam_marks',1,0,1,0,'2019-11-23 21:15:04'),
(213,15,'Language Switcher','language_switcher',1,0,0,0,'2019-11-23 21:17:11'),
(214,23,'Add Questions in Exam ','add_questions_in_exam',1,0,1,0,'2019-11-27 17:38:57'),
(215,15,'Custom Fields','custom_fields',1,0,0,0,'2019-11-28 20:08:35'),
(216,15,'System Fields','system_fields',1,0,0,0,'2019-11-24 16:15:01'),
(217,13,'SMS','sms',1,0,0,0,'2018-06-22 03:40:54'),
(219,14,'Student / Period Attendance Report','student_period_attendance_report',1,0,0,0,'2019-11-28 18:19:31'),
(220,14,'Biometric Attendance Log','biometric_attendance_log',1,0,0,0,'2019-11-26 21:59:16'),
(221,14,'Book Issue Return Report','book_issue_return_report',1,0,0,0,'2019-11-26 22:30:23'),
(222,23,'Assign / View Student','online_assign_view_student',1,0,1,0,'2019-11-27 20:20:22'),
(223,14,'Rank Report','rank_report',1,0,0,0,'2019-11-28 18:30:21'),
(224,25,'Chat','chat',1,0,0,0,'2019-11-28 20:10:28'),
(226,22,'Income Donut Graph','income_donut_graph',1,0,0,0,'2019-11-28 21:00:33'),
(227,22,'Expense Donut Graph','expense_donut_graph',1,0,0,0,'2019-11-28 21:01:10'),
(228,9,'Import Book','import_book',1,0,0,0,'2019-11-28 22:21:01'),
(229,22,'Staff Present Today Widegts','staff_present_today_widegts',1,0,0,0,'2019-11-28 22:48:00'),
(230,22,'Student Present Today Widegts','student_present_today_widegts',1,0,0,0,'2019-11-28 22:47:42'),
(231,26,'Multi Class Student','multi_class_student',1,1,1,1,'2020-10-05 01:56:27'),
(232,27,'Online Admission','online_admission',1,0,1,1,'2019-12-01 22:11:10'),
(233,15,'Print Header Footer','print_header_footer',1,0,0,0,'2020-02-11 18:02:02'),
(234,28,'Manage Alumni','manage_alumni',1,1,1,1,'2020-06-01 20:15:46'),
(235,28,'Events','events',1,1,1,1,'2020-05-28 14:48:52'),
(236,29,'Manage Lesson Plan','manage_lesson_plan',1,1,1,0,'2020-05-28 15:17:37'),
(237,29,'Manage Syllabus Status','manage_syllabus_status',1,0,1,0,'2020-05-28 15:20:11'),
(238,29,'Lesson','lesson',1,1,1,1,'2020-05-28 15:20:11'),
(239,29,'Topic','topic',1,1,1,1,'2020-05-28 15:20:11'),
(240,14,'Syllabus Status Report','syllabus_status_report',1,0,0,0,'2020-05-28 16:17:54'),
(241,14,'Teacher Syllabus Status Report','teacher_syllabus_status_report',1,0,0,0,'2020-05-28 16:17:54'),
(242,14,'Alumni Report','alumni_report',1,0,0,0,'2020-06-07 16:59:54'),
(243,15,'Student Profile Update','student_profile_update',1,0,0,0,'2020-08-20 22:36:33'),
(244,14,'Student Gender Ratio Report','student_gender_ratio_report',1,0,0,0,'2020-08-22 05:37:51'),
(245,14,'Student Teacher Ratio Report','student_teacher_ratio_report',1,0,0,0,'2020-08-22 05:42:27'),
(246,14,'Daily Attendance Report','daily_attendance_report',1,0,0,0,'2020-08-22 05:43:16'),
(247,23,'Import Question','import_question',1,0,0,0,'2019-11-23 10:25:18');

/*Table structure for table `permission_group` */

DROP TABLE IF EXISTS `permission_group`;

CREATE TABLE `permission_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_active` int(11) DEFAULT 0,
  `system` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `permission_group` */

insert  into `permission_group`(`id`,`name`,`short_code`,`is_active`,`system`,`created_at`) values 
(1,'Student Information','student_information',1,1,'2019-03-15 02:30:22'),
(2,'Fees Collection','fees_collection',1,0,'2020-06-10 17:51:35'),
(3,'Income','income',1,0,'2020-05-31 18:57:39'),
(4,'Expense','expense',1,0,'2019-03-15 02:06:22'),
(5,'Student Attendance','student_attendance',1,0,'2018-07-02 00:48:08'),
(6,'Examination','examination',1,0,'2018-07-10 19:49:08'),
(7,'Academics','academics',1,1,'2018-07-02 00:25:43'),
(8,'Download Center','download_center',1,0,'2018-07-02 00:49:29'),
(9,'Library','library',1,0,'2018-06-28 04:13:14'),
(10,'Inventory','inventory',1,0,'2018-06-26 17:48:58'),
(11,'Transport','transport',1,0,'2018-06-27 00:51:26'),
(12,'Hostel','hostel',1,0,'2018-07-02 00:49:32'),
(13,'Communicate','communicate',1,0,'2018-07-02 00:50:00'),
(14,'Reports','reports',1,1,'2018-06-26 20:40:22'),
(15,'System Settings','system_settings',1,1,'2018-06-26 20:40:28'),
(16,'Front CMS','front_cms',1,0,'2018-07-09 22:16:54'),
(17,'Front Office','front_office',1,0,'2018-06-26 20:45:30'),
(18,'Human Resource','human_resource',1,1,'2018-06-26 20:41:02'),
(19,'Homework','homework',1,0,'2018-06-26 17:49:38'),
(20,'Certificate','certificate',1,0,'2018-06-27 00:51:29'),
(21,'Calendar To Do List','calendar_to_do_list',1,0,'2019-03-15 02:06:25'),
(22,'Dashboard and Widgets','dashboard_and_widgets',1,1,'2018-06-26 20:41:17'),
(23,'Online Examination','online_examination',1,0,'2020-05-31 19:25:36'),
(25,'Chat','chat',1,0,'2019-11-23 15:54:04'),
(26,'Multi Class','multi_class',1,0,'2019-11-27 04:14:14'),
(27,'Online Admission','online_admission',1,0,'2019-11-26 18:42:13'),
(28,'Alumni','alumni',1,0,'2020-05-28 17:26:38'),
(29,'Lesson Plan','lesson_plan',1,0,'2020-06-06 22:38:30');

/*Table structure for table `permission_student` */

DROP TABLE IF EXISTS `permission_student`;

CREATE TABLE `permission_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `system` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `permission_student` */

insert  into `permission_student`(`id`,`name`,`short_code`,`system`,`student`,`parent`,`group_id`,`created_at`) values 
(1,'Fees','fees',0,1,1,2,'2021-06-30 09:26:06'),
(2,'Class Timetable','class_timetable',1,1,1,7,'2020-05-30 12:57:50'),
(3,'Homework','homework',0,1,1,19,'2020-05-31 19:49:14'),
(4,'Download Center','download_center',0,1,1,8,'2020-05-31 19:52:49'),
(5,'Attendance','attendance',0,1,1,5,'2020-05-31 19:57:18'),
(7,'Examinations','examinations',0,1,1,6,'2020-05-31 19:59:50'),
(8,'Notice Board','notice_board',0,1,1,13,'2020-05-31 20:00:35'),
(11,'Library','library',0,1,1,9,'2020-05-31 20:02:37'),
(12,'Transport Routes','transport_routes',0,1,1,11,'2020-05-31 20:51:30'),
(13,'Hostel Rooms','hostel_rooms',0,1,1,12,'2020-05-31 20:52:27'),
(14,'Calendar To Do List','calendar_to_do_list',0,1,1,21,'2020-05-31 20:53:18'),
(15,'Online Examination','online_examination',0,1,1,23,'2020-06-10 22:20:01'),
(16,'Teachers Rating','teachers_rating',0,1,1,0,'2020-05-31 21:49:58'),
(17,'Chat','chat',0,1,1,25,'2020-05-31 21:53:06'),
(18,'Multi Class','multi_class',1,1,1,26,'2020-05-30 12:56:52'),
(19,'Lesson Plan','lesson_plan',0,1,1,29,'2020-06-06 22:38:30'),
(20,'Syllabus Status','syllabus_status',0,1,1,29,'2020-06-06 22:38:30'),
(23,'Apply Leave','apply_leave',0,1,1,0,'2020-06-10 22:20:23');

/*Table structure for table `print_headerfooter` */

DROP TABLE IF EXISTS `print_headerfooter`;

CREATE TABLE `print_headerfooter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `print_type` varchar(255) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `footer_content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `print_headerfooter` */

insert  into `print_headerfooter`(`id`,`print_type`,`header_image`,`footer_content`,`created_by`,`entry_date`) values 
(1,'staff_payslip','header_image.jpg','This payslip is computer generated hence no signature is required.',1,'2020-02-28 07:41:08'),
(2,'student_receipt','header_image.jpg','This receipt is computer generated hence no signature is required.',1,'2020-02-28 07:40:58');

/*Table structure for table `question_answers` */

DROP TABLE IF EXISTS `question_answers`;

CREATE TABLE `question_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `question_answers` */

/*Table structure for table `question_options` */

DROP TABLE IF EXISTS `question_options`;

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `question_options` */

/*Table structure for table `questions` */

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `question_type` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `opt_a` text DEFAULT NULL,
  `opt_b` text DEFAULT NULL,
  `opt_c` text DEFAULT NULL,
  `opt_d` text DEFAULT NULL,
  `opt_e` text DEFAULT NULL,
  `correct` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `questions` */

/*Table structure for table `read_notification` */

DROP TABLE IF EXISTS `read_notification`;

CREATE TABLE `read_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `read_notification` */

insert  into `read_notification`(`id`,`student_id`,`parent_id`,`staff_id`,`notification_id`,`is_active`,`created_at`,`updated_at`) values 
(1,1,NULL,NULL,1,'no','2021-06-30 10:47:51',NULL),
(2,2,NULL,NULL,1,'no','2021-07-01 00:55:12',NULL);

/*Table structure for table `reference` */

DROP TABLE IF EXISTS `reference`;

CREATE TABLE `reference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `reference` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `is_superadmin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`slug`,`is_active`,`is_system`,`is_superadmin`,`created_at`,`updated_at`) values 
(1,'Admin',NULL,0,1,0,'2018-06-30 08:39:11','0000-00-00'),
(2,'Teacher',NULL,0,1,0,'2018-06-30 08:39:14','0000-00-00'),
(3,'Accountant',NULL,0,1,0,'2018-06-30 08:39:17','0000-00-00'),
(4,'Librarian',NULL,0,1,0,'2018-06-30 08:39:21','0000-00-00'),
(6,'Receptionist',NULL,0,1,0,'2018-07-01 22:39:03','0000-00-00'),
(7,'Super Admin',NULL,0,1,1,'2018-07-11 07:11:29','0000-00-00');

/*Table structure for table `roles_permissions` */

DROP TABLE IF EXISTS `roles_permissions`;

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `perm_cat_id` int(11) DEFAULT NULL,
  `can_view` int(11) DEFAULT NULL,
  `can_add` int(11) DEFAULT NULL,
  `can_edit` int(11) DEFAULT NULL,
  `can_delete` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1473 DEFAULT CHARSET=utf8;

/*Data for the table `roles_permissions` */

insert  into `roles_permissions`(`id`,`role_id`,`perm_cat_id`,`can_view`,`can_add`,`can_edit`,`can_delete`,`created_at`) values 
(10,1,17,1,1,1,1,'2018-07-06 02:48:56'),
(11,1,78,1,1,1,1,'2018-07-02 17:49:43'),
(23,1,12,1,1,1,1,'2018-07-06 02:45:38'),
(24,1,13,1,1,1,1,'2018-07-06 02:48:28'),
(26,1,15,1,1,1,0,'2019-11-27 15:47:28'),
(28,1,19,1,1,1,0,'2018-07-02 04:31:10'),
(30,1,76,1,1,1,0,'2018-07-02 04:31:10'),
(31,1,21,1,0,1,0,'2019-11-25 20:51:15'),
(32,1,22,1,1,1,1,'2018-07-02 04:32:05'),
(34,1,24,1,1,1,1,'2019-11-27 22:35:20'),
(43,1,32,1,1,1,1,'2018-07-06 03:22:05'),
(44,1,33,1,1,1,1,'2018-07-06 03:22:29'),
(45,1,34,1,1,1,1,'2018-07-06 03:23:59'),
(46,1,35,1,1,1,1,'2018-07-06 03:24:34'),
(47,1,104,1,1,1,1,'2018-07-06 03:23:08'),
(48,1,37,1,1,1,1,'2018-07-06 03:25:30'),
(49,1,38,1,1,1,1,'2018-07-08 22:15:27'),
(58,1,52,1,1,0,1,'2018-07-08 20:19:43'),
(61,1,55,1,1,1,1,'2018-07-02 02:24:16'),
(67,1,61,1,1,0,1,'2018-07-08 22:59:19'),
(68,1,62,1,1,0,1,'2018-07-08 22:59:19'),
(69,1,63,1,1,0,1,'2018-07-08 20:51:38'),
(70,1,64,1,1,1,1,'2018-07-08 20:02:19'),
(71,1,65,1,1,1,1,'2018-07-08 20:11:21'),
(72,1,66,1,1,1,1,'2018-07-08 20:13:09'),
(73,1,67,1,1,1,1,'2018-07-08 20:14:47'),
(74,1,79,1,1,0,1,'2019-11-29 17:32:51'),
(75,1,80,1,1,1,1,'2018-07-06 02:41:23'),
(76,1,81,1,1,1,1,'2018-07-06 02:41:23'),
(78,1,83,1,1,1,1,'2018-07-06 02:41:23'),
(79,1,84,1,1,1,1,'2018-07-06 02:41:23'),
(80,1,85,1,1,1,1,'2018-07-11 17:16:00'),
(87,1,92,1,1,1,1,'2018-06-25 20:33:43'),
(94,1,82,1,1,1,1,'2018-07-06 02:41:23'),
(120,1,39,1,1,1,1,'2018-07-06 03:26:28'),
(156,1,9,1,1,1,1,'2019-11-27 15:45:46'),
(157,1,10,1,1,1,1,'2019-11-27 15:45:46'),
(159,1,40,1,1,1,1,'2019-11-29 16:49:39'),
(160,1,41,1,1,1,1,'2019-12-01 21:43:41'),
(161,1,42,1,1,1,1,'2019-11-29 16:49:39'),
(169,1,27,1,1,0,1,'2019-11-28 22:15:37'),
(178,1,54,1,0,1,0,'2018-07-05 02:09:22'),
(179,1,56,1,0,1,0,'2019-11-29 16:49:54'),
(180,1,57,1,0,1,0,'2019-11-29 17:32:51'),
(181,1,58,1,0,1,0,'2019-11-29 17:32:51'),
(182,1,59,1,0,1,0,'2019-11-29 17:32:51'),
(183,1,60,1,0,1,0,'2019-11-29 16:59:57'),
(190,1,105,1,0,0,0,'2018-07-02 04:13:25'),
(199,1,75,1,0,0,0,'2018-07-02 04:19:46'),
(201,1,14,1,0,0,0,'2018-07-02 04:22:03'),
(203,1,16,1,0,0,0,'2018-07-02 04:24:21'),
(204,1,26,1,0,0,0,'2018-07-02 04:32:05'),
(206,1,29,1,0,0,0,'2018-07-02 04:43:54'),
(207,1,30,1,0,0,0,'2018-07-02 04:43:54'),
(208,1,31,1,1,1,1,'2019-11-29 17:32:51'),
(215,1,50,1,0,0,0,'2018-07-02 05:04:53'),
(216,1,51,1,0,0,0,'2018-07-02 05:04:53'),
(222,1,1,1,1,1,1,'2019-11-27 14:55:06'),
(227,1,91,1,0,0,0,'2018-07-02 18:49:27'),
(230,10,53,0,1,0,0,'2018-07-02 20:52:55'),
(231,10,54,0,0,1,0,'2018-07-02 20:52:55'),
(232,10,55,1,1,1,1,'2018-07-02 20:58:42'),
(233,10,56,0,0,1,0,'2018-07-02 20:52:55'),
(235,10,58,0,0,1,0,'2018-07-02 20:52:55'),
(236,10,59,0,0,1,0,'2018-07-02 20:52:55'),
(239,10,1,1,1,1,1,'2018-07-02 21:16:43'),
(241,10,3,1,0,0,0,'2018-07-02 21:23:56'),
(242,10,2,1,0,0,0,'2018-07-02 21:24:39'),
(243,10,4,1,0,1,1,'2018-07-02 21:31:24'),
(245,10,107,1,0,0,0,'2018-07-02 21:36:41'),
(246,10,5,1,1,0,1,'2018-07-02 21:38:18'),
(247,10,7,1,1,1,1,'2018-07-02 21:42:07'),
(248,10,68,1,0,0,0,'2018-07-02 21:42:53'),
(249,10,69,1,1,1,1,'2018-07-02 21:49:46'),
(250,10,70,1,0,0,1,'2018-07-02 21:52:40'),
(251,10,72,1,0,0,0,'2018-07-02 21:56:46'),
(252,10,73,1,0,0,0,'2018-07-02 21:56:46'),
(253,10,74,1,0,0,0,'2018-07-02 21:58:34'),
(254,10,75,1,0,0,0,'2018-07-02 21:58:34'),
(255,10,9,1,1,1,1,'2018-07-02 22:02:22'),
(256,10,10,1,1,1,1,'2018-07-02 22:03:09'),
(257,10,11,1,0,0,0,'2018-07-02 22:03:09'),
(258,10,12,1,1,1,1,'2018-07-02 22:08:40'),
(259,10,13,1,1,1,1,'2018-07-02 22:08:40'),
(260,10,14,1,0,0,0,'2018-07-02 22:08:53'),
(261,10,15,1,1,1,0,'2018-07-02 22:11:28'),
(262,10,16,1,0,0,0,'2018-07-02 22:12:12'),
(263,10,17,1,1,1,1,'2018-07-02 22:14:30'),
(264,10,19,1,1,1,0,'2018-07-02 22:15:45'),
(265,10,20,1,1,1,1,'2018-07-02 22:18:51'),
(266,10,76,1,0,0,0,'2018-07-02 22:21:21'),
(267,10,21,1,1,1,0,'2018-07-02 22:22:45'),
(268,10,22,1,1,1,1,'2018-07-02 22:25:00'),
(269,10,23,1,1,1,1,'2018-07-02 22:27:16'),
(270,10,24,1,1,1,1,'2018-07-02 22:27:49'),
(271,10,25,1,1,1,1,'2018-07-02 22:27:49'),
(272,10,26,1,0,0,0,'2018-07-02 22:28:25'),
(273,10,77,1,1,1,1,'2018-07-02 22:29:57'),
(274,10,27,1,1,0,1,'2018-07-02 22:30:36'),
(275,10,28,1,1,1,1,'2018-07-02 22:33:09'),
(276,10,29,1,0,0,0,'2018-07-02 22:34:03'),
(277,10,30,1,0,0,0,'2018-07-02 22:34:03'),
(278,10,31,1,0,0,0,'2018-07-02 22:34:03'),
(279,10,32,1,1,1,1,'2018-07-02 22:35:42'),
(280,10,33,1,1,1,1,'2018-07-02 22:36:32'),
(281,10,34,1,1,1,1,'2018-07-02 22:38:03'),
(282,10,35,1,1,1,1,'2018-07-02 22:38:41'),
(283,10,104,1,1,1,1,'2018-07-02 22:40:43'),
(284,10,37,1,1,1,1,'2018-07-02 22:42:42'),
(285,10,38,1,1,1,1,'2018-07-02 22:43:56'),
(286,10,39,1,1,1,1,'2018-07-02 22:45:39'),
(287,10,40,1,1,1,1,'2018-07-02 22:47:22'),
(288,10,41,1,1,1,1,'2018-07-02 22:48:54'),
(289,10,42,1,1,1,1,'2018-07-02 22:49:31'),
(290,10,43,1,1,1,1,'2018-07-02 22:51:15'),
(291,10,44,1,0,0,0,'2018-07-02 22:52:06'),
(292,10,46,1,0,0,0,'2018-07-02 22:52:06'),
(293,10,50,1,0,0,0,'2018-07-02 22:52:59'),
(294,10,51,1,0,0,0,'2018-07-02 22:52:59'),
(295,10,60,0,0,1,0,'2018-07-02 22:55:05'),
(296,10,61,1,1,1,1,'2018-07-02 22:56:52'),
(297,10,62,1,1,1,1,'2018-07-02 22:58:53'),
(298,10,63,1,1,0,0,'2018-07-02 22:59:37'),
(299,10,64,1,1,1,1,'2018-07-02 23:00:27'),
(300,10,65,1,1,1,1,'2018-07-02 23:02:51'),
(301,10,66,1,1,1,1,'2018-07-02 23:02:51'),
(302,10,67,1,0,0,0,'2018-07-02 23:02:51'),
(303,10,78,1,1,1,1,'2018-07-03 21:10:04'),
(307,1,126,1,0,0,0,'2018-07-03 02:26:13'),
(310,1,119,1,0,0,0,'2018-07-03 03:15:00'),
(311,1,120,1,0,0,0,'2018-07-03 03:15:00'),
(315,1,123,1,0,0,0,'2018-07-03 03:27:03'),
(317,1,124,1,0,0,0,'2018-07-03 03:29:14'),
(320,1,47,1,0,0,0,'2018-07-03 04:01:12'),
(321,1,121,1,0,0,0,'2018-07-03 04:01:12'),
(369,1,102,1,1,1,1,'2019-12-01 21:02:15'),
(372,10,79,1,1,0,0,'2018-07-03 21:10:04'),
(373,10,80,1,1,1,1,'2018-07-03 21:23:09'),
(374,10,81,1,1,1,1,'2018-07-03 21:23:50'),
(375,10,82,1,1,1,1,'2018-07-03 21:26:54'),
(376,10,83,1,1,1,1,'2018-07-03 21:27:55'),
(377,10,84,1,1,1,1,'2018-07-03 21:30:26'),
(378,10,85,1,1,1,1,'2018-07-03 21:32:54'),
(379,10,86,1,1,1,1,'2018-07-03 21:46:18'),
(380,10,87,1,0,0,0,'2018-07-03 21:49:49'),
(381,10,88,1,1,1,0,'2018-07-03 21:51:20'),
(382,10,89,1,0,0,0,'2018-07-03 21:51:51'),
(383,10,90,1,1,0,1,'2018-07-03 21:55:01'),
(384,10,91,1,0,0,0,'2018-07-03 21:55:01'),
(385,10,108,1,1,1,1,'2018-07-03 21:57:46'),
(386,10,109,1,1,1,1,'2018-07-03 21:58:26'),
(387,10,110,1,1,1,1,'2018-07-03 22:02:43'),
(388,10,111,1,1,1,1,'2018-07-03 22:03:21'),
(389,10,112,1,1,1,1,'2018-07-03 22:05:06'),
(390,10,127,1,0,0,0,'2018-07-03 22:05:06'),
(391,10,93,1,1,1,1,'2018-07-03 22:07:14'),
(392,10,94,1,1,0,0,'2018-07-03 22:08:02'),
(394,10,95,1,0,0,0,'2018-07-03 22:08:44'),
(395,10,102,1,1,1,1,'2018-07-03 22:11:02'),
(396,10,106,1,0,0,0,'2018-07-03 22:11:39'),
(397,10,113,1,0,0,0,'2018-07-03 22:12:37'),
(398,10,114,1,0,0,0,'2018-07-03 22:12:37'),
(399,10,115,1,0,0,0,'2018-07-03 22:18:45'),
(400,10,116,1,0,0,0,'2018-07-03 22:18:45'),
(401,10,117,1,0,0,0,'2018-07-03 22:19:43'),
(402,10,118,1,0,0,0,'2018-07-03 22:19:43'),
(434,1,125,1,0,0,0,'2018-07-06 02:59:26'),
(435,1,96,1,1,1,1,'2018-07-08 18:03:54'),
(445,1,48,1,0,0,0,'2018-07-06 04:49:35'),
(446,1,49,1,0,0,0,'2018-07-06 04:49:35'),
(461,1,97,1,0,0,0,'2018-07-08 18:00:16'),
(462,1,95,1,0,0,0,'2018-07-08 18:18:41'),
(464,1,86,1,1,1,1,'2019-11-27 22:39:19'),
(474,1,130,1,1,0,1,'2018-07-09 03:56:36'),
(476,1,131,1,0,0,0,'2018-07-08 21:53:32'),
(479,2,47,1,0,0,0,'2018-07-09 23:47:12'),
(480,2,105,1,0,0,0,'2018-07-09 23:47:12'),
(482,2,119,1,0,0,0,'2018-07-09 23:47:12'),
(483,2,120,1,0,0,0,'2018-07-09 23:47:12'),
(486,2,16,1,0,0,0,'2018-07-09 23:47:12'),
(493,2,22,1,0,0,0,'2018-07-11 17:20:27'),
(504,2,95,1,0,0,0,'2018-07-09 23:47:12'),
(513,3,72,1,0,0,0,'2018-07-10 00:07:30'),
(517,3,75,1,0,0,0,'2018-07-10 00:10:38'),
(527,3,89,1,0,0,0,'2018-07-10 00:18:44'),
(529,3,91,1,0,0,0,'2018-07-10 00:18:44'),
(549,3,124,1,0,0,0,'2018-07-10 00:22:17'),
(557,6,82,1,1,1,1,'2019-11-30 17:48:28'),
(558,6,83,1,1,1,1,'2019-11-30 17:49:08'),
(559,6,84,1,1,1,1,'2019-11-30 17:49:59'),
(575,6,44,1,0,0,0,'2018-07-10 00:35:33'),
(576,6,46,1,0,0,0,'2018-07-10 00:35:33'),
(578,6,102,1,1,1,1,'2019-11-30 17:52:27'),
(594,3,125,1,0,0,0,'2018-07-10 00:58:12'),
(595,3,48,1,0,0,0,'2018-07-10 00:58:12'),
(596,3,49,1,0,0,0,'2018-07-10 00:58:12'),
(617,2,17,1,1,1,1,'2018-07-10 23:55:14'),
(618,2,19,1,1,1,0,'2018-07-10 23:55:14'),
(620,2,76,1,1,1,0,'2018-07-10 23:55:14'),
(622,2,121,1,0,0,0,'2018-07-10 23:56:27'),
(625,1,28,1,1,1,1,'2019-11-28 22:19:18'),
(628,6,22,1,0,0,0,'2018-07-11 17:23:47'),
(634,4,102,1,1,1,1,'2019-11-30 17:03:00'),
(662,1,138,1,0,0,0,'2019-10-31 19:28:24'),
(663,1,139,1,1,1,1,'2019-10-31 19:28:24'),
(664,1,140,1,1,1,1,'2019-10-31 19:28:24'),
(669,1,145,1,0,0,0,'2019-11-25 20:51:15'),
(677,1,153,1,0,0,0,'2019-10-31 19:28:24'),
(690,1,166,1,0,0,0,'2019-10-31 19:28:24'),
(691,1,167,1,0,0,0,'2019-10-31 19:28:24'),
(692,1,168,1,0,0,0,'2019-10-31 19:28:24'),
(693,1,170,1,0,0,0,'2019-10-31 19:28:24'),
(694,1,172,1,0,0,0,'2019-10-31 19:28:24'),
(695,1,173,1,0,0,0,'2019-10-31 19:28:24'),
(720,1,216,1,0,0,0,'2019-11-25 21:24:12'),
(728,1,185,1,1,1,1,'2019-11-27 18:50:33'),
(729,1,186,1,1,1,1,'2019-11-27 18:49:07'),
(730,1,214,1,0,1,0,'2019-11-27 17:47:53'),
(732,1,198,1,0,0,0,'2019-11-25 21:24:30'),
(733,1,199,1,0,0,0,'2019-11-25 21:24:30'),
(734,1,200,1,0,0,0,'2019-11-25 21:24:30'),
(735,1,201,1,0,0,0,'2019-11-25 21:24:30'),
(736,1,202,1,0,0,0,'2019-11-25 21:24:30'),
(737,1,203,1,0,0,0,'2019-11-25 21:24:30'),
(739,1,218,1,0,0,0,'2019-11-26 22:36:31'),
(743,1,218,1,0,0,0,'2019-11-26 22:36:32'),
(747,1,2,1,0,0,0,'2019-11-27 14:56:08'),
(748,1,3,1,1,1,1,'2019-11-27 14:56:32'),
(749,1,4,1,1,1,1,'2019-11-27 14:56:48'),
(751,1,128,0,1,0,1,'2019-11-27 14:57:01'),
(752,1,132,1,0,1,1,'2019-11-27 15:02:23'),
(754,1,134,1,1,1,1,'2019-11-27 15:18:21'),
(755,1,5,1,1,0,1,'2019-11-27 15:35:07'),
(756,1,6,1,0,0,0,'2019-11-27 15:35:25'),
(757,1,7,1,1,1,1,'2019-11-27 15:36:35'),
(758,1,8,1,1,1,1,'2019-11-27 15:37:27'),
(760,1,68,1,0,0,0,'2019-11-27 15:38:06'),
(761,1,69,1,1,1,1,'2019-11-27 15:39:06'),
(762,1,70,1,1,1,1,'2019-11-27 15:39:41'),
(763,1,71,1,0,0,0,'2019-11-27 15:39:59'),
(764,1,72,1,0,0,0,'2019-11-27 15:40:11'),
(765,1,73,1,0,0,0,'2019-11-27 15:43:15'),
(766,1,74,1,0,0,0,'2019-11-27 15:43:55'),
(768,1,11,1,0,0,0,'2019-11-27 15:45:46'),
(769,1,122,1,0,0,0,'2019-11-27 15:52:43'),
(771,1,136,1,0,0,0,'2019-11-27 15:55:36'),
(772,1,20,1,1,1,1,'2019-11-27 20:06:44'),
(773,1,137,1,1,1,1,'2019-11-27 16:46:14'),
(774,1,141,1,1,1,1,'2019-11-27 16:59:42'),
(775,1,142,1,0,0,0,'2019-11-27 15:56:12'),
(776,1,143,1,1,1,1,'2019-11-27 16:59:42'),
(777,1,144,1,0,0,0,'2019-11-27 15:56:12'),
(778,1,187,1,0,0,0,'2019-11-27 15:56:12'),
(779,1,196,1,0,0,0,'2019-11-27 15:56:12'),
(781,1,207,1,0,0,0,'2019-11-27 15:56:12'),
(782,1,208,1,0,1,0,'2019-11-27 16:10:22'),
(783,1,210,1,0,1,0,'2019-11-27 16:34:40'),
(784,1,211,1,0,1,0,'2019-11-27 16:38:23'),
(785,1,212,1,0,1,0,'2019-11-27 16:42:15'),
(786,1,205,1,1,1,1,'2019-11-27 16:42:15'),
(787,1,222,1,0,1,0,'2019-11-27 17:36:36'),
(788,1,77,1,1,1,1,'2019-11-27 22:22:10'),
(789,1,188,1,1,1,1,'2019-11-27 22:26:16'),
(790,1,23,1,1,1,1,'2019-11-27 22:34:20'),
(791,1,25,1,1,1,1,'2019-11-27 22:36:20'),
(792,1,127,1,0,0,0,'2019-11-27 22:41:25'),
(794,1,88,1,1,1,0,'2019-11-27 22:43:04'),
(795,1,90,1,1,0,1,'2019-11-27 22:46:22'),
(796,1,108,1,0,1,1,'2021-01-22 23:09:32'),
(797,1,109,1,1,0,0,'2019-11-28 15:38:11'),
(798,1,110,1,1,1,1,'2019-11-28 15:49:29'),
(799,1,111,1,1,1,1,'2019-11-28 15:49:57'),
(800,1,112,1,1,1,1,'2019-11-28 15:49:57'),
(801,1,129,0,1,0,1,'2019-11-28 15:49:57'),
(802,1,189,1,0,1,1,'2019-11-28 15:59:22'),
(806,2,133,1,0,1,0,'2019-11-28 16:34:35'),
(810,2,1,1,1,1,1,'2019-11-29 18:54:16'),
(813,1,133,1,0,1,0,'2019-11-28 16:39:57'),
(817,1,93,1,1,1,1,'2019-11-28 16:56:14'),
(825,1,87,1,0,0,0,'2019-11-28 16:56:14'),
(829,1,94,1,1,0,0,'2019-11-28 16:57:57'),
(836,1,146,1,0,0,0,'2019-11-28 17:13:28'),
(837,1,147,1,0,0,0,'2019-11-28 17:13:28'),
(838,1,148,1,0,0,0,'2019-11-28 17:13:28'),
(839,1,149,1,0,0,0,'2019-11-28 17:13:28'),
(840,1,150,1,0,0,0,'2019-11-28 17:13:28'),
(841,1,151,1,0,0,0,'2019-11-28 17:13:28'),
(842,1,152,1,0,0,0,'2019-11-28 17:13:28'),
(843,1,154,1,0,0,0,'2019-11-28 17:13:28'),
(862,1,155,1,0,0,0,'2019-11-28 18:07:30'),
(863,1,156,1,0,0,0,'2019-11-28 18:07:52'),
(864,1,157,1,0,0,0,'2019-11-28 18:08:05'),
(874,1,158,1,0,0,0,'2019-11-28 18:14:03'),
(875,1,159,1,0,0,0,'2019-11-28 18:14:31'),
(876,1,160,1,0,0,0,'2019-11-28 18:14:44'),
(878,1,162,1,0,0,0,'2019-11-28 18:15:58'),
(879,1,163,1,0,0,0,'2019-11-28 18:16:19'),
(882,1,164,1,0,0,0,'2019-11-28 18:25:17'),
(884,1,165,1,0,0,0,'2019-11-28 18:25:30'),
(886,1,197,1,0,0,0,'2019-11-28 18:25:48'),
(887,1,219,1,0,0,0,'2019-11-28 18:26:05'),
(889,1,220,1,0,0,0,'2019-11-28 18:26:22'),
(932,1,204,1,0,0,0,'2019-11-28 19:43:27'),
(933,1,221,1,0,0,0,'2019-11-28 19:45:04'),
(934,1,178,1,0,0,0,'2019-11-28 19:45:16'),
(935,1,179,1,0,0,0,'2019-11-28 19:45:33'),
(936,1,161,1,0,0,0,'2019-11-28 19:45:48'),
(937,1,180,1,0,0,0,'2019-11-28 19:45:48'),
(938,1,181,1,0,0,0,'2019-11-28 19:49:33'),
(939,1,182,1,0,0,0,'2019-11-28 19:49:45'),
(940,1,183,1,0,0,0,'2019-11-28 19:49:56'),
(941,1,174,1,0,0,0,'2019-11-28 19:50:53'),
(943,1,176,1,0,0,0,'2019-11-28 19:52:10'),
(944,1,177,1,0,0,0,'2019-11-28 19:52:22'),
(945,1,53,0,1,0,1,'2021-01-22 23:09:32'),
(946,1,215,1,0,0,0,'2019-11-28 20:01:37'),
(947,1,213,1,0,0,0,'2019-11-28 20:07:45'),
(974,1,224,1,0,0,0,'2019-11-28 20:32:52'),
(979,1,225,1,0,0,0,'2019-11-28 20:45:30'),
(982,2,225,1,0,0,0,'2019-11-28 20:47:19'),
(1026,1,135,1,0,1,0,'2019-11-28 22:02:12'),
(1031,1,228,1,0,0,0,'2019-11-28 22:21:16'),
(1083,1,175,1,0,0,0,'2019-11-29 16:37:24'),
(1086,1,43,1,1,1,1,'2019-11-29 16:49:39'),
(1087,1,44,1,0,0,0,'2019-11-29 16:49:39'),
(1088,1,46,1,0,0,0,'2019-11-29 16:49:39'),
(1089,1,217,1,0,0,0,'2019-11-29 16:49:39'),
(1090,1,98,1,1,1,1,'2019-11-29 17:32:51'),
(1091,1,99,1,0,0,0,'2019-11-29 17:30:18'),
(1092,1,223,1,0,0,0,'2019-11-29 17:32:51'),
(1103,2,205,1,1,1,1,'2019-11-29 17:56:04'),
(1105,2,23,1,0,0,0,'2019-11-29 17:56:04'),
(1106,2,24,1,0,0,0,'2019-11-29 17:56:04'),
(1107,2,25,1,0,0,0,'2019-11-29 17:56:04'),
(1108,2,77,1,0,0,0,'2019-11-29 17:56:04'),
(1119,2,117,1,0,0,0,'2019-11-29 17:56:04'),
(1123,3,8,1,1,1,1,'2019-11-29 22:46:18'),
(1125,3,69,1,1,1,1,'2019-11-29 23:00:49'),
(1126,3,70,1,1,1,1,'2019-11-29 23:04:46'),
(1130,3,9,1,1,1,1,'2019-11-29 23:14:54'),
(1131,3,10,1,1,1,1,'2019-11-29 23:16:02'),
(1134,3,35,1,1,1,1,'2019-11-29 23:25:04'),
(1135,3,104,1,1,1,1,'2019-11-29 23:25:53'),
(1140,3,41,1,1,1,1,'2019-11-29 23:37:13'),
(1141,3,42,1,1,1,1,'2019-11-29 23:37:46'),
(1142,3,43,1,1,1,1,'2019-11-29 23:42:06'),
(1151,3,87,1,0,0,0,'2019-11-29 18:23:13'),
(1152,3,88,1,1,1,0,'2019-11-29 18:23:13'),
(1153,3,90,1,1,0,1,'2019-11-29 18:23:13'),
(1154,3,108,1,0,1,0,'2019-11-29 18:23:13'),
(1155,3,109,1,1,0,0,'2019-11-29 18:23:13'),
(1156,3,110,1,1,1,1,'2019-11-29 18:23:13'),
(1157,3,111,1,1,1,1,'2019-11-29 18:23:13'),
(1158,3,112,1,1,1,1,'2019-11-29 18:23:13'),
(1159,3,127,1,0,0,0,'2019-11-29 18:23:13'),
(1160,3,129,0,1,0,1,'2019-11-29 18:23:13'),
(1161,3,102,1,1,1,1,'2019-11-29 18:23:13'),
(1162,3,106,1,0,0,0,'2019-11-29 18:23:13'),
(1163,3,113,1,0,0,0,'2019-11-29 18:23:13'),
(1164,3,114,1,0,0,0,'2019-11-29 18:23:13'),
(1165,3,115,1,0,0,0,'2019-11-29 18:23:13'),
(1166,3,116,1,0,0,0,'2019-11-29 18:23:13'),
(1167,3,117,1,0,0,0,'2019-11-29 18:23:13'),
(1168,3,118,1,0,0,0,'2019-11-29 18:23:13'),
(1171,2,142,1,0,0,0,'2019-11-29 18:36:17'),
(1172,2,144,1,0,0,0,'2019-11-29 18:36:17'),
(1179,2,212,1,0,1,0,'2019-11-29 18:36:17'),
(1183,2,148,1,0,0,0,'2019-11-29 18:36:17'),
(1184,2,149,1,0,0,0,'2019-11-29 18:36:17'),
(1185,2,150,1,0,0,0,'2019-11-29 18:36:17'),
(1186,2,151,1,0,0,0,'2019-11-29 18:36:17'),
(1187,2,152,1,0,0,0,'2019-11-29 18:36:17'),
(1188,2,153,1,0,0,0,'2019-11-29 18:36:17'),
(1189,2,154,1,0,0,0,'2019-11-29 18:36:17'),
(1190,2,197,1,0,0,0,'2019-11-29 18:36:17'),
(1191,2,198,1,0,0,0,'2019-11-29 18:36:17'),
(1192,2,199,1,0,0,0,'2019-11-29 18:36:17'),
(1193,2,200,1,0,0,0,'2019-11-29 18:36:17'),
(1194,2,201,1,0,0,0,'2019-11-29 18:36:17'),
(1195,2,202,1,0,0,0,'2019-11-29 18:36:17'),
(1196,2,203,1,0,0,0,'2019-11-29 18:36:17'),
(1197,2,219,1,0,0,0,'2019-11-29 18:36:17'),
(1198,2,223,1,0,0,0,'2019-11-29 18:36:17'),
(1199,2,213,1,0,0,0,'2019-11-29 18:36:17'),
(1201,2,230,1,0,0,0,'2019-11-29 18:36:17'),
(1204,2,214,1,0,1,0,'2019-11-29 18:36:17'),
(1206,2,224,1,0,0,0,'2019-11-29 18:36:17'),
(1208,2,2,1,0,0,0,'2019-11-29 18:55:45'),
(1210,2,143,1,1,1,1,'2019-11-29 18:57:28'),
(1211,2,145,1,0,0,0,'2019-11-29 18:57:28'),
(1214,2,3,1,1,1,1,'2019-11-29 19:03:18'),
(1216,2,4,1,1,1,1,'2019-11-29 19:32:56'),
(1218,2,128,0,1,0,1,'2019-11-29 19:37:44'),
(1220,3,135,1,0,1,0,'2019-11-29 23:08:56'),
(1231,3,190,1,0,0,0,'2019-11-29 19:44:02'),
(1232,3,192,1,0,0,0,'2019-11-29 19:44:02'),
(1233,3,226,1,0,0,0,'2019-11-29 19:44:02'),
(1234,3,227,1,0,0,0,'2019-11-29 19:44:02'),
(1235,3,224,1,0,0,0,'2019-11-29 19:44:02'),
(1236,2,15,1,1,1,0,'2019-11-29 19:54:25'),
(1239,2,122,1,0,0,0,'2019-11-29 19:57:48'),
(1240,2,136,1,0,0,0,'2019-11-29 19:57:48'),
(1242,6,217,1,0,0,0,'2019-11-29 20:00:13'),
(1243,6,224,1,0,0,0,'2019-11-29 20:00:13'),
(1245,2,20,1,1,1,1,'2019-11-29 20:01:28'),
(1246,2,137,1,1,1,1,'2019-11-29 20:02:40'),
(1248,2,141,1,1,1,1,'2019-11-29 20:04:04'),
(1250,2,187,1,0,0,0,'2019-11-29 20:11:19'),
(1252,2,207,1,0,0,0,'2019-11-29 20:21:21'),
(1253,2,208,1,0,1,0,'2019-11-29 20:22:00'),
(1255,2,210,1,0,1,0,'2019-11-29 20:22:58'),
(1256,2,211,1,0,1,0,'2019-11-29 20:24:03'),
(1257,2,21,1,0,0,0,'2019-11-29 20:32:59'),
(1259,2,188,1,0,0,0,'2019-11-29 20:34:35'),
(1260,2,27,1,0,0,0,'2019-11-29 20:36:13'),
(1262,2,43,1,1,1,1,'2019-11-29 20:39:42'),
(1263,2,44,1,0,0,0,'2019-11-29 20:41:43'),
(1264,2,46,1,0,0,0,'2019-11-29 20:41:43'),
(1265,2,217,1,0,0,0,'2019-11-29 20:41:43'),
(1266,2,146,1,0,0,0,'2019-11-29 20:46:35'),
(1267,2,147,1,0,0,0,'2019-11-29 20:47:37'),
(1269,2,164,1,0,0,0,'2019-11-29 20:51:04'),
(1271,2,109,1,1,0,0,'2019-11-29 21:03:37'),
(1272,2,93,1,1,1,1,'2019-11-29 21:07:25'),
(1273,2,94,1,1,0,0,'2019-11-29 21:07:42'),
(1275,2,102,1,1,1,1,'2019-11-29 21:11:22'),
(1277,2,196,1,0,0,0,'2019-11-29 21:15:01'),
(1278,2,195,1,0,0,0,'2019-11-29 21:19:08'),
(1279,2,185,1,1,1,1,'2019-11-29 21:21:44'),
(1280,2,186,1,1,1,1,'2019-11-29 21:22:43'),
(1281,2,222,1,0,1,0,'2019-11-29 21:24:30'),
(1283,3,5,1,1,0,1,'2019-11-29 22:43:04'),
(1284,3,6,1,0,0,0,'2019-11-29 22:43:29'),
(1285,3,7,1,1,1,1,'2019-11-29 22:44:39'),
(1286,3,68,1,0,0,0,'2019-11-29 22:46:58'),
(1287,3,71,1,0,0,0,'2019-11-29 23:05:41'),
(1288,3,73,1,0,0,0,'2019-11-29 23:05:59'),
(1289,3,74,1,0,0,0,'2019-11-29 23:06:08'),
(1290,3,11,1,0,0,0,'2019-11-29 23:16:37'),
(1291,3,12,1,1,1,1,'2019-11-29 23:19:29'),
(1292,3,13,1,1,1,1,'2019-11-29 23:22:27'),
(1294,3,14,1,0,0,0,'2019-11-29 23:22:55'),
(1295,3,31,1,1,1,1,'2019-12-01 22:30:37'),
(1297,3,37,1,1,1,1,'2019-11-29 23:28:09'),
(1298,3,38,1,1,1,1,'2019-11-29 23:29:02'),
(1299,3,39,1,1,1,1,'2019-11-29 23:30:07'),
(1300,3,40,1,1,1,1,'2019-11-29 23:32:43'),
(1301,3,44,1,0,0,0,'2019-11-29 23:44:09'),
(1302,3,46,1,0,0,0,'2019-11-29 23:44:09'),
(1303,3,217,1,0,0,0,'2019-11-29 23:44:09'),
(1304,3,155,1,0,0,0,'2019-11-29 23:44:32'),
(1305,3,156,1,0,0,0,'2019-11-29 23:45:18'),
(1306,3,157,1,0,0,0,'2019-11-29 23:45:42'),
(1307,3,158,1,0,0,0,'2019-11-29 23:46:07'),
(1308,3,159,1,0,0,0,'2019-11-29 23:46:21'),
(1309,3,160,1,0,0,0,'2019-11-29 23:46:33'),
(1313,3,161,1,0,0,0,'2019-11-29 23:48:26'),
(1314,3,162,1,0,0,0,'2019-11-29 23:48:48'),
(1315,3,163,1,0,0,0,'2019-11-29 23:48:48'),
(1316,3,164,1,0,0,0,'2019-11-29 23:49:47'),
(1317,3,165,1,0,0,0,'2019-11-29 23:49:47'),
(1318,3,174,1,0,0,0,'2019-11-29 23:49:47'),
(1319,3,175,1,0,0,0,'2019-11-29 23:49:59'),
(1320,3,181,1,0,0,0,'2019-11-29 23:50:08'),
(1321,3,86,1,1,1,1,'2019-11-29 23:54:08'),
(1322,4,28,1,1,1,1,'2019-11-30 16:52:39'),
(1324,4,29,1,0,0,0,'2019-11-30 16:53:46'),
(1325,4,30,1,0,0,0,'2019-11-30 16:53:59'),
(1326,4,123,1,0,0,0,'2019-11-30 16:54:26'),
(1327,4,228,1,0,0,0,'2019-11-30 16:54:39'),
(1328,4,43,1,1,1,1,'2019-11-30 16:58:05'),
(1332,4,44,1,0,0,0,'2019-11-30 16:59:16'),
(1333,4,46,1,0,0,0,'2019-11-30 16:59:16'),
(1334,4,217,1,0,0,0,'2019-11-30 16:59:16'),
(1335,4,178,1,0,0,0,'2019-11-30 16:59:59'),
(1336,4,179,1,0,0,0,'2019-11-30 17:00:11'),
(1337,4,180,1,0,0,0,'2019-11-30 17:00:29'),
(1338,4,221,1,0,0,0,'2019-11-30 17:00:46'),
(1339,4,86,1,0,0,0,'2019-11-30 17:01:02'),
(1341,4,106,1,0,0,0,'2019-11-30 17:05:21'),
(1342,1,107,1,0,0,0,'2019-11-30 17:06:44'),
(1343,4,117,1,0,0,0,'2019-11-30 17:10:20'),
(1344,4,194,1,0,0,0,'2019-11-30 17:11:35'),
(1348,4,230,1,0,0,0,'2019-11-30 17:19:15'),
(1350,6,1,1,0,0,0,'2019-11-30 17:35:32'),
(1351,6,21,1,0,0,0,'2019-11-30 17:36:29'),
(1352,6,23,1,0,0,0,'2019-11-30 17:36:45'),
(1353,6,24,1,0,0,0,'2019-11-30 17:37:05'),
(1354,6,25,1,0,0,0,'2019-11-30 17:37:34'),
(1355,6,77,1,0,0,0,'2019-11-30 17:38:08'),
(1356,6,188,1,0,0,0,'2019-11-30 17:38:45'),
(1357,6,43,1,1,1,1,'2019-11-30 17:40:44'),
(1358,6,78,1,1,1,1,'2019-11-30 17:43:04'),
(1360,6,79,1,1,0,1,'2019-11-30 17:44:39'),
(1361,6,80,1,1,1,1,'2019-11-30 17:45:08'),
(1362,6,81,1,1,1,1,'2019-11-30 17:47:50'),
(1363,6,85,1,1,1,1,'2019-11-30 17:50:43'),
(1364,6,86,1,0,0,0,'2019-11-30 17:51:10'),
(1365,6,106,1,0,0,0,'2019-11-30 17:52:55'),
(1366,6,117,1,0,0,0,'2019-11-30 17:53:08'),
(1394,1,106,1,0,0,0,'2019-12-01 21:20:33'),
(1395,1,113,1,0,0,0,'2019-12-01 21:20:59'),
(1396,1,114,1,0,0,0,'2019-12-01 21:21:34'),
(1397,1,115,1,0,0,0,'2019-12-01 21:21:34'),
(1398,1,116,1,0,0,0,'2019-12-01 21:21:54'),
(1399,1,117,1,0,0,0,'2019-12-01 21:22:04'),
(1400,1,118,1,0,0,0,'2019-12-01 21:22:20'),
(1402,1,191,1,0,0,0,'2019-12-01 21:23:34'),
(1403,1,192,1,0,0,0,'2019-12-01 21:23:47'),
(1404,1,193,1,0,0,0,'2019-12-01 21:23:58'),
(1405,1,194,1,0,0,0,'2019-12-01 21:24:11'),
(1406,1,195,1,0,0,0,'2019-12-01 21:24:20'),
(1408,1,227,1,0,0,0,'2019-12-01 21:25:47'),
(1410,1,226,1,0,0,0,'2019-12-01 21:31:41'),
(1411,1,229,1,0,0,0,'2019-12-01 21:32:57'),
(1412,1,230,1,0,0,0,'2019-12-01 21:32:57'),
(1413,1,190,1,0,0,0,'2019-12-01 21:43:41'),
(1414,2,174,1,0,0,0,'2019-12-01 21:54:37'),
(1415,2,175,1,0,0,0,'2019-12-01 21:54:37'),
(1418,2,232,1,0,1,1,'2019-12-01 22:11:27'),
(1419,2,231,1,0,0,0,'2019-12-01 22:12:28'),
(1420,1,231,1,1,1,1,'2021-01-22 23:09:32'),
(1421,1,232,1,0,1,1,'2019-12-01 22:19:32'),
(1422,3,32,1,1,1,1,'2019-12-01 22:30:37'),
(1423,3,33,1,1,1,1,'2019-12-01 22:30:37'),
(1424,3,34,1,1,1,1,'2019-12-01 22:30:37'),
(1425,3,182,1,0,0,0,'2019-12-01 22:30:37'),
(1426,3,183,1,0,0,0,'2019-12-01 22:30:37'),
(1427,3,189,1,0,1,1,'2019-12-01 22:30:37'),
(1428,3,229,1,0,0,0,'2019-12-01 22:30:37'),
(1429,3,230,1,0,0,0,'2019-12-01 22:30:37'),
(1430,4,213,1,0,0,0,'2019-12-01 22:32:14'),
(1432,4,224,1,0,0,0,'2019-12-01 22:32:14'),
(1433,4,195,1,0,0,0,'2019-12-02 20:57:53'),
(1434,4,229,1,0,0,0,'2019-12-02 20:58:19'),
(1436,6,213,1,0,0,0,'2019-12-02 21:10:11'),
(1437,6,191,1,0,0,0,'2019-12-02 21:10:11'),
(1438,6,193,1,0,0,0,'2019-12-02 21:10:11'),
(1439,6,230,1,0,0,0,'2019-12-02 21:10:11'),
(1440,2,106,1,0,0,0,'2020-01-24 20:21:36'),
(1441,2,107,1,0,0,0,'2020-02-11 18:10:13'),
(1442,2,134,1,1,1,1,'2020-02-11 18:12:36'),
(1443,1,233,1,0,0,0,'2020-02-11 18:21:57'),
(1444,2,86,1,0,0,0,'2020-02-11 18:22:33'),
(1445,3,233,1,0,0,0,'2020-02-11 19:51:17'),
(1446,1,234,1,1,1,1,'2020-06-01 14:51:09'),
(1447,1,235,1,1,1,1,'2020-05-29 16:17:01'),
(1448,1,236,1,1,1,0,'2020-05-29 16:17:52'),
(1449,1,237,1,0,1,0,'2020-05-29 16:18:18'),
(1450,1,238,1,1,1,1,'2020-05-29 16:19:52'),
(1451,1,239,1,1,1,1,'2020-05-29 16:22:10'),
(1452,2,236,1,1,1,0,'2020-05-29 16:40:33'),
(1453,2,237,1,0,1,0,'2020-05-29 16:40:33'),
(1454,2,238,1,1,1,1,'2020-05-29 16:40:33'),
(1455,2,239,1,1,1,1,'2020-05-29 16:40:33'),
(1456,2,240,1,0,0,0,'2020-05-28 13:51:18'),
(1457,2,241,1,0,0,0,'2020-05-28 13:51:18'),
(1458,1,240,1,0,0,0,'2020-06-07 11:30:42'),
(1459,1,241,1,0,0,0,'2020-06-07 11:30:42'),
(1460,1,242,1,0,0,0,'2020-06-07 11:30:42'),
(1461,2,242,1,0,0,0,'2020-06-11 15:45:24'),
(1462,3,242,1,0,0,0,'2020-06-14 15:46:54'),
(1463,6,242,1,0,0,0,'2020-06-14 15:48:14'),
(1464,1,243,1,0,0,0,'2020-09-11 23:05:45'),
(1465,1,109,1,1,0,0,'2020-09-20 23:33:50'),
(1466,1,108,1,1,1,1,'2020-09-20 23:50:36'),
(1467,1,244,1,0,0,0,'2020-09-20 23:59:54'),
(1468,1,245,1,0,0,0,'2020-09-20 23:59:54'),
(1469,1,246,1,0,0,0,'2020-09-20 23:59:54'),
(1470,1,247,1,0,0,0,'2021-01-06 22:12:14'),
(1472,2,247,1,0,0,0,'2021-01-21 04:46:40');

/*Table structure for table `room_types` */

DROP TABLE IF EXISTS `room_types`;

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `room_types` */

/*Table structure for table `sch_settings` */

DROP TABLE IF EXISTS `sch_settings`;

CREATE TABLE `sch_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `biometric` int(11) DEFAULT 0,
  `biometric_device` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `languages` varchar(500) NOT NULL,
  `dise_code` varchar(50) DEFAULT NULL,
  `date_format` varchar(50) NOT NULL,
  `time_format` varchar(255) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `is_rtl` varchar(10) DEFAULT 'disabled',
  `is_duplicate_fees_invoice` int(1) DEFAULT 0,
  `timezone` varchar(30) DEFAULT 'UTC',
  `session_id` int(11) DEFAULT NULL,
  `cron_secret_key` varchar(100) NOT NULL,
  `currency_place` varchar(50) NOT NULL DEFAULT 'before_number',
  `class_teacher` varchar(100) NOT NULL,
  `start_month` varchar(40) NOT NULL,
  `attendence_type` int(10) NOT NULL DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `admin_logo` varchar(255) NOT NULL,
  `admin_small_logo` varchar(255) NOT NULL,
  `theme` varchar(200) NOT NULL DEFAULT 'default.jpg',
  `fee_due_days` int(3) DEFAULT 0,
  `adm_auto_insert` int(1) NOT NULL DEFAULT 1,
  `adm_prefix` varchar(50) NOT NULL DEFAULT 'ssadm19/20',
  `adm_start_from` varchar(11) NOT NULL,
  `adm_no_digit` int(10) NOT NULL DEFAULT 6,
  `adm_update_status` int(11) NOT NULL DEFAULT 0,
  `staffid_auto_insert` int(11) NOT NULL DEFAULT 1,
  `staffid_prefix` varchar(100) NOT NULL DEFAULT 'staffss/19/20',
  `staffid_start_from` varchar(50) NOT NULL,
  `staffid_no_digit` int(11) NOT NULL DEFAULT 6,
  `staffid_update_status` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(255) DEFAULT 'no',
  `online_admission` int(1) DEFAULT 0,
  `is_blood_group` int(10) NOT NULL DEFAULT 1,
  `is_student_house` int(10) NOT NULL DEFAULT 1,
  `roll_no` int(11) NOT NULL DEFAULT 1,
  `category` int(11) NOT NULL,
  `religion` int(11) NOT NULL DEFAULT 1,
  `cast` int(11) NOT NULL DEFAULT 1,
  `mobile_no` int(11) NOT NULL DEFAULT 1,
  `student_email` int(11) NOT NULL DEFAULT 1,
  `admission_date` int(11) NOT NULL DEFAULT 1,
  `lastname` int(11) NOT NULL,
  `middlename` int(11) NOT NULL DEFAULT 1,
  `student_photo` int(11) NOT NULL DEFAULT 1,
  `student_height` int(11) NOT NULL DEFAULT 1,
  `student_weight` int(11) NOT NULL DEFAULT 1,
  `measurement_date` int(11) NOT NULL DEFAULT 1,
  `father_name` int(11) NOT NULL DEFAULT 1,
  `father_phone` int(11) NOT NULL DEFAULT 1,
  `father_occupation` int(11) NOT NULL DEFAULT 1,
  `father_pic` int(11) NOT NULL DEFAULT 1,
  `mother_name` int(11) NOT NULL DEFAULT 1,
  `mother_phone` int(11) NOT NULL DEFAULT 1,
  `mother_occupation` int(11) NOT NULL DEFAULT 1,
  `mother_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_name` int(1) NOT NULL,
  `guardian_relation` int(11) NOT NULL DEFAULT 1,
  `guardian_phone` int(1) NOT NULL,
  `guardian_email` int(11) NOT NULL DEFAULT 1,
  `guardian_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_occupation` int(1) NOT NULL,
  `guardian_address` int(11) NOT NULL DEFAULT 1,
  `current_address` int(11) NOT NULL DEFAULT 1,
  `permanent_address` int(11) NOT NULL DEFAULT 1,
  `route_list` int(11) NOT NULL DEFAULT 1,
  `hostel_id` int(11) NOT NULL DEFAULT 1,
  `bank_account_no` int(11) NOT NULL DEFAULT 1,
  `ifsc_code` int(1) NOT NULL,
  `bank_name` int(1) NOT NULL,
  `national_identification_no` int(11) NOT NULL DEFAULT 1,
  `local_identification_no` int(11) NOT NULL DEFAULT 1,
  `rte` int(11) NOT NULL DEFAULT 1,
  `previous_school_details` int(11) NOT NULL DEFAULT 1,
  `student_note` int(11) NOT NULL DEFAULT 1,
  `upload_documents` int(11) NOT NULL DEFAULT 1,
  `staff_designation` int(11) NOT NULL DEFAULT 1,
  `staff_department` int(11) NOT NULL DEFAULT 1,
  `staff_last_name` int(11) NOT NULL DEFAULT 1,
  `staff_father_name` int(11) NOT NULL DEFAULT 1,
  `staff_mother_name` int(11) NOT NULL DEFAULT 1,
  `staff_date_of_joining` int(11) NOT NULL DEFAULT 1,
  `staff_phone` int(11) NOT NULL DEFAULT 1,
  `staff_emergency_contact` int(11) NOT NULL DEFAULT 1,
  `staff_marital_status` int(11) NOT NULL DEFAULT 1,
  `staff_photo` int(11) NOT NULL DEFAULT 1,
  `staff_current_address` int(11) NOT NULL DEFAULT 1,
  `staff_permanent_address` int(11) NOT NULL DEFAULT 1,
  `staff_qualification` int(11) NOT NULL DEFAULT 1,
  `staff_work_experience` int(11) NOT NULL DEFAULT 1,
  `staff_note` int(11) NOT NULL DEFAULT 1,
  `staff_epf_no` int(11) NOT NULL DEFAULT 1,
  `staff_basic_salary` int(11) NOT NULL DEFAULT 1,
  `staff_contract_type` int(11) NOT NULL DEFAULT 1,
  `staff_work_shift` int(11) NOT NULL DEFAULT 1,
  `staff_work_location` int(11) NOT NULL DEFAULT 1,
  `staff_leaves` int(11) NOT NULL DEFAULT 1,
  `staff_account_details` int(11) NOT NULL DEFAULT 1,
  `staff_social_media` int(11) NOT NULL DEFAULT 1,
  `staff_upload_documents` int(11) NOT NULL DEFAULT 1,
  `mobile_api_url` tinytext NOT NULL,
  `app_primary_color_code` varchar(20) DEFAULT NULL,
  `app_secondary_color_code` varchar(20) DEFAULT NULL,
  `app_logo` varchar(250) DEFAULT NULL,
  `student_profile_edit` int(1) NOT NULL DEFAULT 0,
  `start_week` varchar(10) NOT NULL,
  `my_question` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`),
  KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sch_settings` */

insert  into `sch_settings`(`id`,`name`,`biometric`,`biometric_device`,`email`,`phone`,`address`,`lang_id`,`languages`,`dise_code`,`date_format`,`time_format`,`currency`,`currency_symbol`,`is_rtl`,`is_duplicate_fees_invoice`,`timezone`,`session_id`,`cron_secret_key`,`currency_place`,`class_teacher`,`start_month`,`attendence_type`,`image`,`admin_logo`,`admin_small_logo`,`theme`,`fee_due_days`,`adm_auto_insert`,`adm_prefix`,`adm_start_from`,`adm_no_digit`,`adm_update_status`,`staffid_auto_insert`,`staffid_prefix`,`staffid_start_from`,`staffid_no_digit`,`staffid_update_status`,`is_active`,`online_admission`,`is_blood_group`,`is_student_house`,`roll_no`,`category`,`religion`,`cast`,`mobile_no`,`student_email`,`admission_date`,`lastname`,`middlename`,`student_photo`,`student_height`,`student_weight`,`measurement_date`,`father_name`,`father_phone`,`father_occupation`,`father_pic`,`mother_name`,`mother_phone`,`mother_occupation`,`mother_pic`,`guardian_name`,`guardian_relation`,`guardian_phone`,`guardian_email`,`guardian_pic`,`guardian_occupation`,`guardian_address`,`current_address`,`permanent_address`,`route_list`,`hostel_id`,`bank_account_no`,`ifsc_code`,`bank_name`,`national_identification_no`,`local_identification_no`,`rte`,`previous_school_details`,`student_note`,`upload_documents`,`staff_designation`,`staff_department`,`staff_last_name`,`staff_father_name`,`staff_mother_name`,`staff_date_of_joining`,`staff_phone`,`staff_emergency_contact`,`staff_marital_status`,`staff_photo`,`staff_current_address`,`staff_permanent_address`,`staff_qualification`,`staff_work_experience`,`staff_note`,`staff_epf_no`,`staff_basic_salary`,`staff_contract_type`,`staff_work_shift`,`staff_work_location`,`staff_leaves`,`staff_account_details`,`staff_social_media`,`staff_upload_documents`,`mobile_api_url`,`app_primary_color_code`,`app_secondary_color_code`,`app_logo`,`student_profile_edit`,`start_week`,`my_question`,`created_at`,`updated_at`) values 
(1,'Your School Name',0,'','yourschoolemail@domain.com','Your School Phone','Your School Address',4,'[\"4\"]','Your School Code','m/d/Y','12-hour','USD','$','disabled',0,'UTC',15,'','before_number','no','4',0,'1.png','1.png','1.png','default.jpg',60,0,'','',0,1,0,'','',0,1,'no',0,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,0,0,0,1,1,1,1,1,1,1,1,1,1,'','#424242','#eeeeee','1.png',0,'Monday',0,'2021-07-03 15:59:48',NULL);

/*Table structure for table `school_houses` */

DROP TABLE IF EXISTS `school_houses`;

CREATE TABLE `school_houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_name` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `school_houses` */

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sections` */

insert  into `sections`(`id`,`section`,`is_active`,`created_at`,`updated_at`) values 
(1,'Section1','no','2021-06-29 23:54:36',NULL);

/*Table structure for table `send_notification` */

DROP TABLE IF EXISTS `send_notification`;

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `visible_student` varchar(10) NOT NULL DEFAULT 'no',
  `visible_staff` varchar(10) NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) NOT NULL DEFAULT 'no',
  `created_by` varchar(60) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `send_notification` */

insert  into `send_notification`(`id`,`title`,`publish_date`,`date`,`message`,`visible_student`,`visible_staff`,`visible_parent`,`created_by`,`created_id`,`is_active`,`created_at`,`updated_at`) values 
(1,'NotificationTitle1','2021-06-27','2021-06-30','<p>Notification Message1</p>','Yes','Yes','No','Super Admin',1,'no','2021-06-30 10:47:08',NULL),
(2,'TeacherNotification','2021-08-01','2021-08-01','<p>Please come here</p>','Yes','Yes','No','Teacher',5,'no','2021-07-01 00:57:14',NULL),
(3,'NewMessgeTeacher','2021-08-01','2021-08-01','<p>Message Content</p>','Yes','No','No','Teacher',5,'no','2021-07-01 00:58:20',NULL),
(4,'AdminMessage','2021-07-01','2021-07-01','<p>AdminMessage Content<br></p>','Yes','Yes','No','Super Admin',1,'no','2021-07-01 15:38:54',NULL),
(5,'test','2021-07-01','2021-07-01','<p>adsfasdfasdfas</p>','Yes','Yes','No','Super Admin',1,'no','2021-07-01 01:02:24',NULL);

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(60) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`session`,`is_active`,`created_at`,`updated_at`) values 
(7,'2016-17','no','2017-04-19 23:42:19','0000-00-00'),
(11,'2017-18','no','2017-04-19 23:41:37','0000-00-00'),
(13,'2018-19','no','2016-08-24 12:26:44','0000-00-00'),
(14,'2019-20','no','2016-08-24 12:26:55','0000-00-00'),
(15,'2020-21','no','2016-09-30 22:28:08','0000-00-00'),
(16,'2021-22','no','2016-09-30 22:28:20','0000-00-00'),
(18,'2022-23','no','2016-09-30 22:29:02','0000-00-00'),
(19,'2023-24','no','2016-09-30 22:29:10','0000-00-00'),
(20,'2024-25','no','2016-09-30 22:29:18','0000-00-00'),
(21,'2025-26','no','2016-09-30 22:30:10','0000-00-00'),
(22,'2026-27','no','2016-09-30 22:30:18','0000-00-00'),
(23,'2027-28','no','2016-09-30 22:30:24','0000-00-00'),
(24,'2028-29','no','2016-09-30 22:30:30','0000-00-00'),
(25,'2029-30','no','2016-09-30 22:30:37','0000-00-00');

/*Table structure for table `sms_config` */

DROP TABLE IF EXISTS `sms_config`;

CREATE TABLE `sms_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `api_id` varchar(100) NOT NULL,
  `authkey` varchar(100) NOT NULL,
  `senderid` varchar(100) NOT NULL,
  `contact` text DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sms_config` */

/*Table structure for table `source` */

DROP TABLE IF EXISTS `source`;

CREATE TABLE `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `source` */

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(200) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `department` int(11) DEFAULT 0,
  `designation` int(11) DEFAULT 0,
  `qualification` varchar(200) NOT NULL,
  `work_exp` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `emergency_contact_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `local_address` varchar(300) NOT NULL,
  `permanent_address` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `account_title` varchar(200) NOT NULL,
  `bank_account_no` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `ifsc_code` varchar(200) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `payscale` varchar(200) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `epf_no` varchar(200) NOT NULL,
  `contract_type` varchar(100) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `joining_letter` varchar(200) NOT NULL,
  `resignation_letter` varchar(200) NOT NULL,
  `other_document_name` varchar(200) NOT NULL,
  `other_document_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `disable_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `staff` */

insert  into `staff`(`id`,`employee_id`,`lang_id`,`department`,`designation`,`qualification`,`work_exp`,`name`,`surname`,`father_name`,`mother_name`,`contact_no`,`emergency_contact_no`,`email`,`dob`,`marital_status`,`date_of_joining`,`date_of_leaving`,`local_address`,`permanent_address`,`note`,`image`,`password`,`gender`,`account_title`,`bank_account_no`,`bank_name`,`ifsc_code`,`bank_branch`,`payscale`,`basic_salary`,`epf_no`,`contract_type`,`shift`,`location`,`facebook`,`twitter`,`linkedin`,`instagram`,`resume`,`joining_letter`,`resignation_letter`,`other_document_name`,`other_document_file`,`user_id`,`is_active`,`verification_code`,`disable_at`) values 
(1,'9000',0,0,0,'','','Super Admin ','','','','','','tona@test.com','2020-01-01','','0000-00-00','0000-00-00','','','','','$2y$10$b5eBsgaJymglie.28sdyceJNVsRWR2my8A2yHoFWVOsSAYL/JXQSa','Male','','','','','','','','','','','','','','','','','','','','',1,1,'',NULL),
(5,'teacher',0,0,0,'','','Ham Wei','','','','','','teacher@test.com','2021-06-23','','0000-00-00','0000-00-00','','','','','$2y$10$b5eBsgaJymglie.28sdyceJNVsRWR2my8A2yHoFWVOsSAYL/JXQSa','Male','','','','','','','','','','','','','','','','','','','','',0,1,'',NULL),
(6,'employee',0,0,0,'','','employee','lastname','','','','','employee@test.com','2021-07-09','','0000-00-00','0000-00-00','','','','','$2y$10$b5eBsgaJymglie.28sdyceJNVsRWR2my8A2yHoFWVOsSAYL/JXQSa','Male','','','','','','','','','','','','','','','','','','','','',0,1,'',NULL);

/*Table structure for table `staff_attendance` */

DROP TABLE IF EXISTS `staff_attendance`;

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_attendance_type_id` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_attendance_staff` (`staff_id`),
  KEY `FK_staff_attendance_staff_attendance_type` (`staff_attendance_type_id`),
  CONSTRAINT `FK_staff_attendance_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_staff_attendance_staff_attendance_type` FOREIGN KEY (`staff_attendance_type_id`) REFERENCES `staff_attendance_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_attendance` */

/*Table structure for table `staff_attendance_type` */

DROP TABLE IF EXISTS `staff_attendance_type`;

CREATE TABLE `staff_attendance_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) NOT NULL,
  `key_value` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `staff_attendance_type` */

insert  into `staff_attendance_type`(`id`,`type`,`key_value`,`is_active`,`created_at`,`updated_at`) values 
(1,'Present','<b class=\"text text-success\">P</b>','yes','0000-00-00 00:00:00','0000-00-00'),
(2,'Late','<b class=\"text text-warning\">L</b>','yes','0000-00-00 00:00:00','0000-00-00'),
(3,'Absent','<b class=\"text text-danger\">A</b>','yes','0000-00-00 00:00:00','0000-00-00'),
(4,'Half Day','<b class=\"text text-warning\">F</b>','yes','2018-05-06 18:56:16','0000-00-00'),
(5,'Holiday','H','yes','0000-00-00 00:00:00','0000-00-00');

/*Table structure for table `staff_designation` */

DROP TABLE IF EXISTS `staff_designation`;

CREATE TABLE `staff_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_designation` */

/*Table structure for table `staff_id_card` */

DROP TABLE IF EXISTS `staff_id_card`;

CREATE TABLE `staff_id_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `background` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `sign_image` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `enable_staff_role` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_id` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_department` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_designation` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_date_of_joining` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_permanent_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `staff_id_card` */

insert  into `staff_id_card`(`id`,`title`,`school_name`,`school_address`,`background`,`logo`,`sign_image`,`header_color`,`enable_staff_role`,`enable_staff_id`,`enable_staff_department`,`enable_designation`,`enable_name`,`enable_fathers_name`,`enable_mothers_name`,`enable_date_of_joining`,`enable_permanent_address`,`enable_staff_dob`,`enable_staff_phone`,`status`) values 
(1,'Sample Staff ID Card','Sant Merry','Near Ukhari square','background1.png','logo1.png','sign1.png','#9b1818',0,1,0,0,1,1,1,1,1,1,1,1);

/*Table structure for table `staff_leave_details` */

DROP TABLE IF EXISTS `staff_leave_details`;

CREATE TABLE `staff_leave_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `alloted_leave` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_leave_details_staff` (`staff_id`),
  KEY `FK_staff_leave_details_leave_types` (`leave_type_id`),
  CONSTRAINT `FK_staff_leave_details_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_staff_leave_details_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_leave_details` */

/*Table structure for table `staff_leave_request` */

DROP TABLE IF EXISTS `staff_leave_request`;

CREATE TABLE `staff_leave_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_days` int(11) NOT NULL,
  `employee_remark` varchar(200) NOT NULL,
  `admin_remark` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `applied_by` varchar(200) NOT NULL,
  `document_file` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_leave_request_staff` (`staff_id`),
  KEY `FK_staff_leave_request_leave_types` (`leave_type_id`),
  CONSTRAINT `FK_staff_leave_request_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`),
  CONSTRAINT `FK_staff_leave_request_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_leave_request` */

/*Table structure for table `staff_payroll` */

DROP TABLE IF EXISTS `staff_payroll`;

CREATE TABLE `staff_payroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `basic_salary` int(11) NOT NULL,
  `pay_scale` varchar(200) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_payroll` */

/*Table structure for table `staff_payslip` */

DROP TABLE IF EXISTS `staff_payslip`;

CREATE TABLE `staff_payslip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `basic` float NOT NULL,
  `total_allowance` float NOT NULL,
  `total_deduction` float NOT NULL,
  `leave_deduction` int(11) NOT NULL,
  `tax` varchar(200) NOT NULL,
  `net_salary` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_date` date NOT NULL,
  `remark` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_payslip_staff` (`staff_id`),
  CONSTRAINT `FK_staff_payslip_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_payslip` */

/*Table structure for table `staff_rating` */

DROP TABLE IF EXISTS `staff_rating`;

CREATE TABLE `staff_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 decline, 1 Approve',
  `entrydt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_staff_rating_staff` (`staff_id`),
  CONSTRAINT `FK_staff_rating_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_rating` */

/*Table structure for table `staff_roles` */

DROP TABLE IF EXISTS `staff_roles`;

CREATE TABLE `staff_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `staff_id` (`staff_id`),
  CONSTRAINT `FK_staff_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_staff_roles_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `staff_roles` */

insert  into `staff_roles`(`id`,`role_id`,`staff_id`,`is_active`,`created_at`,`updated_at`) values 
(1,7,1,0,'2021-06-29 23:25:26',NULL),
(5,2,5,0,'2021-06-30 18:13:40',NULL),
(6,2,6,0,'2021-07-02 21:24:27',NULL);

/*Table structure for table `staff_timeline` */

DROP TABLE IF EXISTS `staff_timeline`;

CREATE TABLE `staff_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(300) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_staff_timeline_staff` (`staff_id`),
  CONSTRAINT `FK_staff_timeline_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_timeline` */

/*Table structure for table `student_applyleave` */

DROP TABLE IF EXISTS `student_applyleave`;

CREATE TABLE `student_applyleave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `apply_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `docs` text NOT NULL,
  `reason` text NOT NULL,
  `approve_by` int(11) NOT NULL,
  `request_type` int(11) NOT NULL COMMENT '0 student,1 staff',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_applyleave` */

/*Table structure for table `student_attendences` */

DROP TABLE IF EXISTS `student_attendences`;

CREATE TABLE `student_attendences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) DEFAULT NULL,
  `biometric_attendence` int(1) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `remark` varchar(200) NOT NULL,
  `biometric_device_data` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_session_id` (`student_session_id`),
  KEY `attendence_type_id` (`attendence_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `student_attendences` */

insert  into `student_attendences`(`id`,`student_session_id`,`biometric_attendence`,`date`,`attendence_type_id`,`remark`,`biometric_device_data`,`is_active`,`created_at`,`updated_at`) values 
(1,2,0,'2021-07-01',1,'',NULL,'no','2021-07-01 11:08:23',NULL),
(2,1,0,'2021-07-01',1,'',NULL,'no','2021-07-01 11:08:23',NULL);

/*Table structure for table `student_doc` */

DROP TABLE IF EXISTS `student_doc`;

CREATE TABLE `student_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `doc` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_doc` */

/*Table structure for table `student_edit_fields` */

DROP TABLE IF EXISTS `student_edit_fields`;

CREATE TABLE `student_edit_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `student_edit_fields` */

/*Table structure for table `student_fees` */

DROP TABLE IF EXISTS `student_fees`;

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) DEFAULT NULL,
  `feemaster_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `amount_discount` float(10,2) NOT NULL,
  `amount_fine` float(10,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_fees` */

/*Table structure for table `student_fees_deposite` */

DROP TABLE IF EXISTS `student_fees_deposite`;

CREATE TABLE `student_fees_deposite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_fees_master_id` int(11) DEFAULT NULL,
  `fee_groups_feetype_id` int(11) DEFAULT NULL,
  `amount_detail` text DEFAULT NULL,
  `proof_filename` varchar(255) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_fees_master_id` (`student_fees_master_id`),
  KEY `fee_groups_feetype_id` (`fee_groups_feetype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `student_fees_deposite` */

insert  into `student_fees_deposite`(`id`,`student_fees_master_id`,`fee_groups_feetype_id`,`amount_detail`,`proof_filename`,`is_active`,`created_at`) values 
(1,1,1,'{\"1\":{\"amount\":\"109\",\"date\":\"2021-07-01\",\"amount_discount\":\"0\",\"amount_fine\":\"109\",\"description\":\"Paypal paid Collected By: Super Admin(9000)\",\"payment_mode\":\"Cash\",\"received_by\":\"1\",\"inv_no\":1}}',NULL,'no','2021-06-30 19:35:42');

/*Table structure for table `student_fees_discounts` */

DROP TABLE IF EXISTS `student_fees_discounts`;

CREATE TABLE `student_fees_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) DEFAULT NULL,
  `fees_discount_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'assigned',
  `payment_id` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_session_id` (`student_session_id`),
  KEY `fees_discount_id` (`fees_discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_fees_discounts` */

/*Table structure for table `student_fees_master` */

DROP TABLE IF EXISTS `student_fees_master`;

CREATE TABLE `student_fees_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `student_session_id` int(11) DEFAULT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT 0.00,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_session_id` (`student_session_id`),
  KEY `fee_session_group_id` (`fee_session_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `student_fees_master` */

insert  into `student_fees_master`(`id`,`is_system`,`student_session_id`,`fee_session_group_id`,`amount`,`is_active`,`created_at`) values 
(1,0,2,1,0.00,'no','2021-06-30 19:34:29'),
(2,1,1,2,0.00,'no','2021-06-30 19:38:59'),
(3,1,2,2,103.00,'no','2021-07-01 00:10:40');

/*Table structure for table `student_session` */

DROP TABLE IF EXISTS `student_session`;

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `vehroute_id` int(10) DEFAULT NULL,
  `transport_fees` float(10,2) NOT NULL DEFAULT 0.00,
  `fees_discount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(255) DEFAULT 'no',
  `is_alumni` int(11) NOT NULL,
  `default_login` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `student_id` (`student_id`),
  KEY `class_id` (`class_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `student_session_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_session_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_session_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_session_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `student_session` */

insert  into `student_session`(`id`,`session_id`,`student_id`,`class_id`,`section_id`,`route_id`,`hostel_room_id`,`vehroute_id`,`transport_fees`,`fees_discount`,`is_active`,`is_alumni`,`default_login`,`created_at`,`updated_at`) values 
(1,15,1,1,1,0,0,NULL,0.00,0.00,'no',0,0,'2021-06-30 00:06:02',NULL),
(2,15,2,1,1,0,0,NULL,0.00,0.00,'no',0,0,'2021-06-30 11:01:57',NULL);

/*Table structure for table `student_sibling` */

DROP TABLE IF EXISTS `student_sibling`;

CREATE TABLE `student_sibling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `sibling_student_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_sibling` */

/*Table structure for table `student_subject_attendances` */

DROP TABLE IF EXISTS `student_subject_attendances`;

CREATE TABLE `student_subject_attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) DEFAULT NULL,
  `subject_timetable_id` int(11) DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `attendence_type_id` (`attendence_type_id`),
  KEY `student_session_id` (`student_session_id`),
  KEY `subject_timetable_id` (`subject_timetable_id`),
  CONSTRAINT `student_subject_attendances_ibfk_1` FOREIGN KEY (`attendence_type_id`) REFERENCES `attendence_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_subject_attendances_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_subject_attendances_ibfk_3` FOREIGN KEY (`subject_timetable_id`) REFERENCES `subject_timetable` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_subject_attendances` */

/*Table structure for table `student_timeline` */

DROP TABLE IF EXISTS `student_timeline`;

CREATE TABLE `student_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `student_timeline` */

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `admission_no` varchar(100) DEFAULT NULL,
  `roll_no` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `rte` varchar(20) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `cast` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `current_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) NOT NULL,
  `blood_group` varchar(200) NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `adhar_no` varchar(100) DEFAULT NULL,
  `samagra_id` varchar(100) DEFAULT NULL,
  `bank_account_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `guardian_is` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(100) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_phone` varchar(100) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_relation` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(100) DEFAULT NULL,
  `guardian_occupation` varchar(150) NOT NULL,
  `guardian_address` text DEFAULT NULL,
  `guardian_email` varchar(100) DEFAULT NULL,
  `father_pic` varchar(200) NOT NULL,
  `mother_pic` varchar(200) NOT NULL,
  `guardian_pic` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `previous_school` text DEFAULT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `measurement_date` date NOT NULL,
  `dis_reason` int(11) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  `dis_note` text NOT NULL,
  `app_key` text DEFAULT NULL,
  `parent_app_key` text DEFAULT NULL,
  `disable_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `students` */

insert  into `students`(`id`,`parent_id`,`admission_no`,`roll_no`,`admission_date`,`firstname`,`middlename`,`lastname`,`rte`,`image`,`mobileno`,`email`,`state`,`city`,`pincode`,`religion`,`cast`,`dob`,`gender`,`current_address`,`permanent_address`,`category_id`,`route_id`,`school_house_id`,`blood_group`,`vehroute_id`,`hostel_room_id`,`adhar_no`,`samagra_id`,`bank_account_no`,`bank_name`,`ifsc_code`,`guardian_is`,`father_name`,`father_phone`,`father_occupation`,`mother_name`,`mother_phone`,`mother_occupation`,`guardian_name`,`guardian_relation`,`guardian_phone`,`guardian_occupation`,`guardian_address`,`guardian_email`,`father_pic`,`mother_pic`,`guardian_pic`,`is_active`,`previous_school`,`height`,`weight`,`measurement_date`,`dis_reason`,`note`,`dis_note`,`app_key`,`parent_app_key`,`disable_at`,`created_at`,`updated_at`) values 
(1,2,'1','1','2021-06-30','test1',NULL,'','No','uploads/student_images/default_male.jpg','34567','test1@test.com',NULL,NULL,NULL,'','','2008-06-05','Male','','','',0,0,'',0,0,'','','','','','father','fatherName1','12345','faterJob1','materName1','23456','motherJob2','fatherName1','Father','12345','faterJob1','','','','','','yes','','','','2021-06-30',0,'','',NULL,NULL,'0000-00-00','2021-07-02 12:14:19',NULL),
(2,4,'test2','','2021-06-30','test2 lastname',NULL,'','No','uploads/student_images/default_male.jpg','','',NULL,NULL,NULL,'','','2021-06-02','Male','','','',0,0,'',0,0,'National Identification Number 2','Local Identification Number 2','98765','bankname2','IFSC Code','father','fatherName2','12345','','motherName2','23456','','fatherName2','Father','12345','','','','','','','yes','','','','2021-06-30',0,'','',NULL,NULL,'0000-00-00','2021-07-01 19:22:23',NULL);

/*Table structure for table `subject_group_class_sections` */

DROP TABLE IF EXISTS `subject_group_class_sections`;

CREATE TABLE `subject_group_class_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_group_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_section_id` (`class_section_id`),
  KEY `subject_group_id` (`subject_group_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `subject_group_class_sections_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_group_class_sections_ibfk_2` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_group_class_sections_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `subject_group_class_sections` */

insert  into `subject_group_class_sections`(`id`,`subject_group_id`,`class_section_id`,`session_id`,`description`,`is_active`,`created_at`,`updated_at`) values 
(1,1,1,15,NULL,0,'2021-06-29 23:57:02',NULL);

/*Table structure for table `subject_group_subjects` */

DROP TABLE IF EXISTS `subject_group_subjects`;

CREATE TABLE `subject_group_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_group_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `subject_group_id` (`subject_group_id`),
  KEY `session_id` (`session_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `subject_group_subjects_ibfk_1` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_group_subjects_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_group_subjects_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `subject_group_subjects` */

insert  into `subject_group_subjects`(`id`,`subject_group_id`,`session_id`,`subject_id`,`created_at`) values 
(1,1,15,1,'2021-06-29 23:57:02'),
(2,1,15,2,'2021-07-01 01:35:59');

/*Table structure for table `subject_groups` */

DROP TABLE IF EXISTS `subject_groups`;

CREATE TABLE `subject_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `subject_groups` */

insert  into `subject_groups`(`id`,`name`,`description`,`session_id`,`created_at`) values 
(1,'Subject Group Language','This is Subject Group 1 Description ',15,'2021-06-30 12:53:19');

/*Table structure for table `subject_syllabus` */

DROP TABLE IF EXISTS `subject_syllabus`;

CREATE TABLE `subject_syllabus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_for` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` varchar(255) NOT NULL,
  `time_to` varchar(255) NOT NULL,
  `presentation` text NOT NULL,
  `attachment` text NOT NULL,
  `lacture_youtube_url` varchar(255) NOT NULL,
  `lacture_video` varchar(255) NOT NULL,
  `sub_topic` text NOT NULL,
  `teaching_method` text NOT NULL,
  `general_objectives` text NOT NULL,
  `previous_knowledge` text NOT NULL,
  `comprehensive_questions` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `session_id` (`session_id`),
  KEY `created_by` (`created_by`),
  KEY `created_for` (`created_for`),
  CONSTRAINT `subject_syllabus_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_syllabus_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_syllabus_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_syllabus_ibfk_4` FOREIGN KEY (`created_for`) REFERENCES `staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `subject_syllabus` */

/*Table structure for table `subject_timetable` */

DROP TABLE IF EXISTS `subject_timetable`;

CREATE TABLE `subject_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(20) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `subject_group_id` int(11) DEFAULT NULL,
  `subject_group_subject_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `time_from` varchar(20) DEFAULT NULL,
  `time_to` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `room_no` varchar(20) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `section_id` (`section_id`),
  KEY `subject_group_id` (`subject_group_id`),
  KEY `subject_group_subject_id` (`subject_group_subject_id`),
  KEY `staff_id` (`staff_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `subject_timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_timetable_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_timetable_ibfk_3` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_timetable_ibfk_4` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_timetable_ibfk_5` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_timetable_ibfk_6` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `subject_timetable` */

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `subjects` */

insert  into `subjects`(`id`,`name`,`code`,`type`,`is_active`,`created_at`,`updated_at`) values 
(1,'Subject English','SubjectCode1','theory','no','2021-06-30 12:53:28',NULL),
(2,'SubjectChinese','SubjectChineseCode','theory','no','2021-07-01 01:35:28',NULL);

/*Table structure for table `submit_assignment` */

DROP TABLE IF EXISTS `submit_assignment`;

CREATE TABLE `submit_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `docs` varchar(225) NOT NULL,
  `file_name` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `submit_assignment` */

insert  into `submit_assignment`(`id`,`homework_id`,`student_id`,`message`,`docs`,`file_name`,`created_at`) values 
(1,2,2,'I hope good result.','dd662970e9b80f7a90c5a19ec4ecb0ee.txt','homwork.txt','2021-06-30 12:57:33'),
(2,1,2,'This is my English Exam333','4d08ef57b61ad8c09e59543806be7e78.txt','homwork.txt','2021-07-01 17:31:23'),
(3,3,2,'This is homework test','56992dd2da8808aea59b3552ae76fa21.txt','homworktest.txt','2021-07-05 00:42:27'),
(4,6,2,'asd;fkja;','2d3d9f4358d340c32524409ec3b51bad.txt','homworktest.txt','2021-07-05 01:03:49');

/*Table structure for table `teacher_subjects` */

DROP TABLE IF EXISTS `teacher_subjects`;

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_section_id` (`class_section_id`),
  KEY `session_id` (`session_id`),
  KEY `subject_id` (`subject_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `teacher_subjects` */

/*Table structure for table `template_admitcards` */

DROP TABLE IF EXISTS `template_admitcards`;

CREATE TABLE `template_admitcards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(250) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_logo` varchar(200) DEFAULT NULL,
  `right_logo` varchar(200) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `exam_center` varchar(200) DEFAULT NULL,
  `sign` varchar(200) DEFAULT NULL,
  `background_img` varchar(200) DEFAULT NULL,
  `is_name` int(1) NOT NULL DEFAULT 1,
  `is_father_name` int(1) NOT NULL DEFAULT 1,
  `is_mother_name` int(1) NOT NULL DEFAULT 1,
  `is_dob` int(1) NOT NULL DEFAULT 1,
  `is_admission_no` int(1) NOT NULL DEFAULT 1,
  `is_roll_no` int(1) NOT NULL DEFAULT 1,
  `is_address` int(1) NOT NULL DEFAULT 1,
  `is_gender` int(1) NOT NULL DEFAULT 1,
  `is_photo` int(11) NOT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content_footer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `template_admitcards` */

insert  into `template_admitcards`(`id`,`template`,`heading`,`title`,`left_logo`,`right_logo`,`exam_name`,`school_name`,`exam_center`,`sign`,`background_img`,`is_name`,`is_father_name`,`is_mother_name`,`is_dob`,`is_admission_no`,`is_roll_no`,`is_address`,`is_gender`,`is_photo`,`is_class`,`is_section`,`content_footer`,`created_at`,`updated_at`) values 
(1,'Sample Admit Card','BOARD OF SECONDARY EDUCATION, MADHYA PRADESH, BHOPAL','HIGHER SECONDARY SCHOOL CERTIFICATE EXAMINATION (10+2) 2014','ab12c4b65f53ee621dcf84370a7c5be4.png','0910482bf79df5fd103e8383d61b387a.png','Test','Mount Carmel School','test dmit card2','aa9c7087e68c5af1d2c04946de1d3bd3.png','782a71f53ea6bca213012d49e9d46d98.jpg',0,0,0,0,0,0,0,0,0,0,0,NULL,'2020-02-28 06:26:15',NULL),
(2,'Admit Card 1','','','','','','','','','',1,0,0,0,0,0,0,0,0,1,0,'','2021-06-30 18:29:39',NULL);

/*Table structure for table `template_marksheets` */

DROP TABLE IF EXISTS `template_marksheets`;

CREATE TABLE `template_marksheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(200) DEFAULT NULL,
  `heading` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `left_logo` varchar(200) DEFAULT NULL,
  `right_logo` varchar(200) DEFAULT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `exam_center` varchar(200) DEFAULT NULL,
  `left_sign` varchar(200) DEFAULT NULL,
  `middle_sign` varchar(200) DEFAULT NULL,
  `right_sign` varchar(200) DEFAULT NULL,
  `exam_session` int(1) DEFAULT 1,
  `is_name` int(1) DEFAULT 1,
  `is_father_name` int(1) DEFAULT 1,
  `is_mother_name` int(1) DEFAULT 1,
  `is_dob` int(1) DEFAULT 1,
  `is_admission_no` int(1) DEFAULT 1,
  `is_roll_no` int(1) DEFAULT 1,
  `is_photo` int(11) DEFAULT 1,
  `is_division` int(1) NOT NULL DEFAULT 1,
  `is_customfield` int(1) NOT NULL,
  `background_img` varchar(200) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content` text DEFAULT NULL,
  `content_footer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `template_marksheets` */

insert  into `template_marksheets`(`id`,`template`,`heading`,`title`,`left_logo`,`right_logo`,`exam_name`,`school_name`,`exam_center`,`left_sign`,`middle_sign`,`right_sign`,`exam_session`,`is_name`,`is_father_name`,`is_mother_name`,`is_dob`,`is_admission_no`,`is_roll_no`,`is_photo`,`is_division`,`is_customfield`,`background_img`,`date`,`is_class`,`is_section`,`content`,`content_footer`,`created_at`,`updated_at`) values 
(1,'Sample Marksheet','BOARD OF SECONDARY EDUCATION, MADHYA PRADESH, BHOPAL','BOARD OF SECONDARY EDUCATION, MADHYA PRADESH, BHOPAL','f314cec3f688771ccaeddbcee6e52f7c.png','e824b2df53266266be2dbfd2001168b8.png','HIGHER SECONDARY SCHOOL CERTIFICATE EXAMINATION','Mount Carmel School','GOVT GIRLS H S SCHOOL','331e0690e50f8c6b7a219a0a2b9667f7.png','351f513d79ee5c0f642c2d36514a1ff4.png','fb79d2c0d163357d1706b78550a05e2c.png',1,1,1,1,1,1,1,1,1,1,'',NULL,0,0,NULL,NULL,'2020-02-28 06:26:06',NULL),
(2,'Marksheet1','MarkSheetHeading1','MarkSheeTitle1','','','Exam Name1','School Name1','Exam Center1','','','',0,0,0,0,1,0,0,0,0,0,'','06/02/2021',0,0,'Body Text1','Footer Text1','2021-06-30 11:17:52',NULL);

/*Table structure for table `timetables` */

DROP TABLE IF EXISTS `timetables`;

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_subject_id` int(20) DEFAULT NULL,
  `day_name` varchar(50) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `timetables` */

/*Table structure for table `topic` */

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `complete_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `topic` */

insert  into `topic`(`id`,`session_id`,`lesson_id`,`name`,`status`,`complete_date`,`created_at`) values 
(1,15,1,'TopicName1',0,'0000-00-00','2021-07-05 12:51:20');

/*Table structure for table `transport_route` */

DROP TABLE IF EXISTS `transport_route`;

CREATE TABLE `transport_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_title` varchar(100) DEFAULT NULL,
  `no_of_vehicle` int(11) DEFAULT NULL,
  `fare` float(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `transport_route` */

/*Table structure for table `userlog` */

DROP TABLE IF EXISTS `userlog`;

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `ipaddress` varchar(100) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `userlog` */

insert  into `userlog`(`id`,`user`,`role`,`class_section_id`,`ipaddress`,`user_agent`,`login_datetime`) values 
(1,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.114, Windows 10','2021-06-30 06:26:36'),
(2,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.114, Windows 10','2021-06-30 16:04:45'),
(3,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-06-30 16:47:41'),
(4,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 01:12:55'),
(5,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 01:14:36'),
(6,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 01:14:45'),
(7,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 02:31:43'),
(8,'parent2','parent',NULL,'::1','Chrome 91.0.4472.114, Windows 10','2021-07-01 03:03:45'),
(9,'parent2','parent',NULL,'::1','Chrome 91.0.4472.114, Windows 10','2021-07-01 03:14:51'),
(10,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 07:56:05'),
(11,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 07:59:56'),
(12,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 15:57:28'),
(13,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-01 21:57:04'),
(14,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 01:00:09'),
(15,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 01:22:40'),
(16,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 02:37:28'),
(17,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 02:38:02'),
(18,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 02:40:01'),
(19,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 02:43:13'),
(20,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 02:45:43'),
(21,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 03:08:17'),
(22,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 17:01:44'),
(23,'teacher@test.com','Teacher',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-02 17:19:20'),
(24,'teacher@test.com','Teacher',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-02 17:56:10'),
(25,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 18:50:17'),
(26,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-02 19:08:43'),
(27,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 03:56:15'),
(28,'teacher@test.com','Teacher',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-03 03:56:55'),
(29,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 04:19:48'),
(30,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 04:22:16'),
(31,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 04:24:43'),
(32,'employee@test.com','Teacher',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-03 04:25:45'),
(33,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 07:25:13'),
(34,'employee@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 08:02:58'),
(35,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-03 08:15:07'),
(36,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 16:03:58'),
(37,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-03 16:14:06'),
(38,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 17:02:34'),
(39,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 17:08:09'),
(40,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-03 17:29:25'),
(41,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 17:58:38'),
(42,'teacher@test.com','Teacher',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 18:49:30'),
(43,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-03 20:58:42'),
(44,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-03 22:00:58'),
(45,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-05 05:46:44'),
(46,'teacher@test.com','Teacher',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-05 05:47:12'),
(47,'teacher@test.com','Teacher',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-05 05:51:41'),
(48,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-05 06:23:41'),
(49,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-05 06:51:13'),
(50,'tona@test.com','Super Admin',NULL,'::1','Spartan 18.18363, Windows 10','2021-07-05 15:53:53'),
(51,'tona@test.com','Super Admin',NULL,'::1','Chrome 91.0.4472.124, Windows 10','2021-07-05 16:39:44');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `childs` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `verification_code` varchar(200) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user_id`,`username`,`password`,`childs`,`role`,`verification_code`,`lang_id`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'test1','test1','','student','cGNEOWFDSTIvdExwbGZ0b25OSFd1VWlRa0ZvVytIOWhENjd2Z2FtWmZvMD0=',0,'yes','2021-06-30 02:31:53',NULL),
(2,0,'parent1','w5uptq','1','parent','',0,'yes','2021-06-30 00:06:02',NULL),
(3,2,'test2','test2','','student','',0,'yes','2021-06-30 11:02:30',NULL),
(4,0,'parent2','parent2','2','parent','',0,'yes','2021-06-30 20:03:29',NULL);

/*Table structure for table `users_authentication` */

DROP TABLE IF EXISTS `users_authentication`;

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users_authentication` */

/*Table structure for table `vehicle_routes` */

DROP TABLE IF EXISTS `vehicle_routes`;

CREATE TABLE `vehicle_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vehicle_routes` */

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `vehicle_model` varchar(100) NOT NULL DEFAULT 'None',
  `manufacture_year` varchar(4) DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `driver_licence` varchar(50) NOT NULL DEFAULT 'None',
  `driver_contact` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `vehicles` */

/*Table structure for table `visitors_book` */

DROP TABLE IF EXISTS `visitors_book`;

CREATE TABLE `visitors_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `id_proof` varchar(50) NOT NULL,
  `no_of_pepple` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` varchar(20) NOT NULL,
  `out_time` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `visitors_book` */

/*Table structure for table `visitors_purpose` */

DROP TABLE IF EXISTS `visitors_purpose`;

CREATE TABLE `visitors_purpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitors_purpose` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `visitors_purpose` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

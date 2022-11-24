-- MySQL dump 10.13  Distrib 5.7.40, for Linux (x86_64)
--
-- Host: localhost    Database: bloxion
-- ------------------------------------------------------
-- Server version	5.7.40-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `bloxion`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bloxion` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bloxion`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_num` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `authority` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'최고관리자','bloxion@naver.com','01077412735','$2y$10$IHY2ic7Od2p85qPdTTZyG.kCNyfKw6H2cWfnbIDRgeSMDr6rz.SGO','2019-11-28 21:30:00','2022-10-24 11:35:16',10),(3,'김동균','insuh72@naver.com','01063442504','$2y$10$w4wkI3Baq7T.AM6C.rFuqOv/8WJbKAkXJ78GPnPaKgP56YGEdxKX.','2022-04-19 11:34:42','2022-04-19 11:34:59',9);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertiser_faq_cates`
--

DROP TABLE IF EXISTS `advertiser_faq_cates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertiser_faq_cates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertiser_faq_cates`
--

LOCK TABLES `advertiser_faq_cates` WRITE;
/*!40000 ALTER TABLE `advertiser_faq_cates` DISABLE KEYS */;
INSERT INTO `advertiser_faq_cates` VALUES (6,'캠페인 등록'),(7,'캠페인 모집'),(8,'리뷰어 선정'),(10,'리뷰 등록 확인'),(12,'결제 관리');
/*!40000 ALTER TABLE `advertiser_faq_cates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertiser_faqs`
--

DROP TABLE IF EXISTS `advertiser_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertiser_faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `advertiser_faq_cate_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertiser_faqs_advertiser_faq_cate_id_index` (`advertiser_faq_cate_id`),
  CONSTRAINT `advertiser_faqs_advertiser_faq_cate_id_foreign` FOREIGN KEY (`advertiser_faq_cate_id`) REFERENCES `advertiser_faq_cates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertiser_faqs`
--

LOCK TABLES `advertiser_faqs` WRITE;
/*!40000 ALTER TABLE `advertiser_faqs` DISABLE KEYS */;
INSERT INTO `advertiser_faqs` VALUES (1,'캠페인 등록을 어떻게 하나요?','마이페이지 > 캠페인 등록 > 정보 입력 > 결제 후 등록하시면\n리뷰어 모집이 가능한 캠페인이 등록이 됩니다.',6,'2020-06-08 14:41:14','2020-06-08 14:41:14'),(2,'모집 최소 인원이 있나요?','최소 인원이라고 단정 된 인원은 없습니다. \n 물론 인원 제한도 없습니다.\n그렇다고 1명만 모집을 할 경우에는 직접적인 마케팅효과가 보기 어렵다보니\n리뷰의힘에서는 5명 이상을 추천드립니다.',6,'2020-06-08 14:43:02','2020-06-08 17:06:37'),(3,'캠페인 진행시 작업 기간은 어느정도 걸리나요?','캠페인 작업 기간은 업체마다 방문이냐 재택이냐에 따라서 다릅니다.\n평균적인 수치로 보았을때에는 모집 기간 7일(1주) > 선정 1일 > 리뷰 체줄 기간 14일(2주)\n이렇게 해서 평균 한 개의 캠페인 당 총 3 ~ 4주 정도의 기간이 소요됩니다.\n\n리뷰어 모집기간을 설정하는 란에서는\n리뷰어 모집기간 / 리뷰 체줄기간 2가지의 더 연장이 가능합니다.',7,'2020-06-08 14:49:26','2020-07-13 13:23:47'),(4,'리뷰어에게 지급하는 포인트는 어떻게 설정하나요?','전체적인 포인트 설정은 자유롭게 가능합니다.\n숫자에 상관없이 최소 포인트는 1인당 5,000point입니다.\n\n방문형의 경우에는 직접 방문하다보니 그에 드는 시간과 비용에 대한 부분이며,\n재택형의 경우에는 제품을 별도로 제공되거나 포인트로 구매 후 리뷰를 남기는 등\n여러가지 방향성이 제시할 수 있는 부분이라고 보시면 됩니다.',6,'2020-06-08 16:40:32','2020-06-08 16:40:32'),(5,'캠페인 대표 이미지는 어떻게 넣나요?','대표이미지는 캠페인의 얼굴 같은 존재로써 첫화면에 등장하는 사진입니다.\n이미지의 크기는 530 * 530 이상 정사격형 사이즈로 업로드 해주시면 됩니다.\n\n업로드시 브랜드 로고 사진이 아닌 매장 입구 / 내부 모습이나\n제품 소개의 이미지를 사용하시는게 리뷰어들이 접근도가 높아집니다.\n\n추가로 상세이미지로 세 장까지 업로드가 가능합니다.',6,'2020-06-08 16:48:20','2020-06-08 16:48:20'),(6,'리뷰미션, 키워드는 어떤 내용을 넣나요?','리뷰미션\n리뷰 내용에 꼭 들어갔으면 하는 내용들과 참고내용들\n그리고 서비스(제품)의 소개하는 내용들을 입력하시면 됩니다.\n\nex) 콘텐츠 제목에 매장명을 기재해 주시고, 매장 위치 및 지도(오시는 길), 연락처를 소개해 주세요.\n\n리뷰키워드\n제목 및 내용에 꼭 들어갔으면 하는 키워드를 작성해주시면 됩니다.\n블로그 - 제목 및 본문 내용에 언급을 원하는 키워드\n인스타 - 리뷰 내용 중 해시태크용으로 들어 갔으면 하는 키워드',6,'2020-06-08 16:55:02','2020-06-08 16:55:02'),(7,'캠페인 검수중이라는데 언제 오픈하나요?','캠페인 등록 후 등록일 기준 1일 이내에 승인을 도와드리고 있습니다.\n리뷰어들이 접근하기 좋은 이미지부터 가이드라인 내용을 확인 한 다음 수정이 필요한 부분이 있으면\n임의 수정 후 등록되는 부분도 있어서 최소한의 시간이 필요합니다.',6,'2020-06-08 17:01:35','2020-06-08 17:01:35'),(8,'선정된 리뷰어한테 선정 안내를 어떻게 해야하나요?','광고주가 선정한 리뷰어들에게 저희 리뷰의힘에서 선정일 오전 11시에 문자와 메일이 일괄적으로\n발송을 해드립니다.\n\n캠페인에 대한 내용으로 예약 날짜 / 배송 안내 등의 문의사항은 캠페인 내 담당자분과\n소통을 하시면 원할한 진행에 도움이 되실겁니다.',8,'2020-06-08 17:15:21','2020-06-08 17:15:21'),(9,'선정된 리뷰어의 정보는 어떻게 알 수 있나요?','광고주가 직접 선정 시킨 리뷰어는\n마이 페이지 > 캠페인 관리 > 진행결과 보기 > 리뷰제출 결과 ( 리뷰어란에 리뷰보기) 에서 확인이 가능합니다.',8,'2020-06-08 17:18:59','2020-06-13 17:44:28'),(10,'선정된 리뷰어가 작성한 리뷰를 어디서 확인하나요?','리뷰어가 체험단을 진행 후 1주일 이내에 리뷰를 작성합니다.\n작성한 리뷰는 마이 페이지 > 캠페인 관리 > 진행결과 보기 > 리뷰제출 결과 ( 리뷰어란에 리뷰보기) 에서 확인이 가능합니다.\n리뷰어는 캠페인을 이용 후 기간 내에 반드시 리뷰를 작성해주어야 하며,\n만일에 기간 내에 리뷰를 작성 안했을시 리뷰어에게 직접 리뷰작성을 이야기 하셔도 됩니다.',10,'2020-06-13 17:00:50','2020-06-13 17:00:56'),(11,'선정된 리뷰어가 방문을 하지 않아요!','방문체험단 기준\n\n선정을 시킨 리뷰어의 연락처를 통해서 \n선정한 리뷰어에게 선정 문자 전송을 통해서 예약(방문일자 및 시간)을 조율할 수 있습니다.\n\n리뷰어가 예약한 날짜와 시간에 방문하지 않을 경우\nFAQ > 광고주 > 리뷰 등록 확인 > 선정된 리뷰어가 작성한 리뷰를 어디서 확인하나요? 답변처럼\n리뷰어에게 직접 연락을 해서 방문 요청을 진행해주시면 됩니다.\n\n리뷰어와 연락이 닿지 않거나 취소 요청을 받았을 경우 및 리뷰어의 직접적인 취소 진행을 원했을 경우\n고객센터 > 1:1문의 > 캠페인 선택 후 캠페인 명과 해당 리뷰어의 정보 및 내용을 남겨주시면 됩니다.\n\n리뷰어 선정으로 사용 된 포인트는 리뷰의힘 팀에서 확인 후 환불로 진행처리가 됩니다.',10,'2020-06-13 17:42:22','2020-06-13 17:42:22'),(12,'리뷰어가 가이드라인에 안맞게 리뷰를 작성했는데 수정요청을 어떻게 하나요?','리뷰어가 정성들어 리뷰를 작성해주었는데 가이드라인에 맞지 않을 경우\n광고주 측에서 리뷰어한테 직접 수정요청이 가능합니다.\n\n리뷰어 정보는 마이 페이지 > 캠페인 관리 > 진행결과 보기 > 리뷰제출 결과 ( 리뷰어란에 리뷰보기) 에서 확인이 가능합니다.\n연락처와 이메일로 수정요청이 가능합니다.',10,'2020-06-13 18:03:32','2020-06-13 18:03:49'),(13,'선정된 리뷰어가 체험단 진행 후 기간 내에 리뷰를 제출 하지 않아요!','리뷰의 힘에서는 다른 체험단 플랫폼과 다르게 광고주가 직접 체험단 관리 및 리뷰어 선정이 가능한\n공간을 제공하는 플랫폼입니다.\n그러므로 광고주 측 관련 마케팅 부서에서 따로 리뷰어에게 전화 및 문자 메일 등의 방법으로 리뷰 제출에 대한\n내용을 전달해주셔야 하며, 추가적인 캠페인 관련 응대 같은 내용들을 직접 진행해주셔야 하는 점 양해 부탁드립니다.\n\n리뷰어 정보를 확인하는 방법으로는\n마이 페이지 > 캠페인 관리 > 진행결과 보기 > 리뷰제출 결과 ( 리뷰어란에 리뷰보기) 에서 확인이 가능합니다.',10,'2020-06-13 18:19:03','2020-06-13 18:19:03'),(14,'리뷰어가 제출한 리뷰로 따로 마케팅을 목적으로 2차 활용이 가능한가요?','네 가능한 부분입니다!\n캠페인 진행시 리뷰어가 신청하는 과정에서 리뷰의힘에서 안내하는 동의서 내용 중\n\'제출한 리뷰내용을 마케팅 목적으로 2차 활용이 가능하는가?\' 라는 내용이 있기 때문에 신청을 한 리뷰어는\n이미 동의를 한 부분이라고 보시면 됩니다.\n\n직접적인 얼굴이 나온 사진은 초상권 문제로 이어질 수 있으니, 만일 얼굴이 나온 사진을 이용하고 싶을시\n리뷰어에게 동의를 얻은 후에 작업해주시는게 좋습니다.',10,'2020-06-13 18:23:02','2020-06-13 18:23:02'),(15,'결제가 되지 않아요!','결제가 되지 않는 경우에는 070-4348-2627 리뷰의힘 고객센터로 문의 바랍니다.',12,'2020-07-13 13:25:22','2020-07-13 13:25:22');
/*!40000 ALTER TABLE `advertiser_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertiser_plans`
--

DROP TABLE IF EXISTS `advertiser_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertiser_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertiser_id` bigint(20) unsigned NOT NULL,
  `plan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertiser_plans_advertiser_id_index` (`advertiser_id`),
  KEY `advertiser_plans_plan_id_index` (`plan_id`),
  CONSTRAINT `advertiser_plans_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `advertiser_plans_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertiser_plans`
--

LOCK TABLES `advertiser_plans` WRITE;
/*!40000 ALTER TABLE `advertiser_plans` DISABLE KEYS */;
INSERT INTO `advertiser_plans` VALUES (1,1,79,'2020-02-05 15:43:32','2020-02-12 13:06:53'),(2,1,78,'2020-02-05 15:43:37','2020-02-12 13:06:56'),(3,1,63,'2020-02-05 15:46:30','2020-02-05 15:46:30'),(4,1,50,'2020-02-05 15:46:40','2020-02-05 15:46:40'),(5,1,46,'2020-02-05 15:46:54','2020-02-05 15:46:54'),(6,1,38,'2020-02-05 15:47:03','2020-02-05 15:47:03'),(7,2,78,'2020-02-07 15:53:38','2020-09-25 17:41:11'),(8,2,77,'2020-02-07 15:54:26','2021-01-29 18:39:30'),(9,2,79,'2020-02-07 15:59:59','2020-09-25 17:41:07'),(11,1,77,'2020-02-08 11:46:26','2020-07-03 23:39:49'),(12,1,80,'2020-02-12 13:06:47','2020-07-03 23:39:34'),(13,1,39,'2020-02-12 13:07:33','2020-02-12 13:07:33'),(14,4,78,'2020-02-13 03:38:40','2020-02-20 05:39:57'),(15,4,77,'2020-02-13 03:39:20','2020-02-20 05:40:20'),(16,4,76,'2020-02-13 03:43:34','2020-02-20 05:41:40'),(17,4,75,'2020-02-13 03:44:07','2020-02-20 05:41:47'),(18,4,74,'2020-02-13 03:45:57','2020-02-13 03:45:57'),(19,4,71,'2020-02-13 03:46:08','2020-02-13 03:46:08'),(20,4,70,'2020-02-13 03:46:24','2020-02-13 03:46:24'),(21,4,72,'2020-02-13 03:52:07','2020-02-13 03:52:07'),(22,2,80,'2020-02-17 10:30:03','2021-01-28 16:19:28'),(23,6,80,'2020-02-21 11:40:19','2020-02-21 11:40:19'),(24,6,79,'2020-02-21 11:40:36','2020-02-21 11:40:36'),(25,6,77,'2020-02-21 11:40:49','2020-02-21 11:40:49'),(26,7,77,'2020-02-27 14:46:42','2020-02-27 14:46:42'),(27,7,62,'2020-02-27 14:47:45','2020-02-27 14:47:45'),(28,2,70,'2020-02-27 16:40:48','2021-01-31 15:09:55'),(29,2,76,'2020-02-27 16:44:12','2021-01-28 16:19:31'),(30,2,73,'2020-02-27 16:44:15','2021-01-28 16:19:35'),(31,2,67,'2020-02-27 17:08:32','2020-02-27 17:08:32'),(32,2,75,'2020-03-02 17:23:58','2021-01-31 15:09:50'),(35,2,64,'2020-03-05 15:32:01','2020-03-05 15:32:01'),(36,11,71,'2020-03-17 15:15:06','2020-03-17 15:15:06'),(37,11,72,'2020-03-17 15:15:31','2020-03-17 15:15:31'),(38,11,77,'2020-03-17 15:15:57','2020-03-17 15:16:38'),(39,11,7,'2020-03-17 15:16:14','2020-03-17 15:16:14'),(40,11,70,'2020-03-17 15:16:44','2020-03-17 15:16:44'),(41,2,83,'2020-03-31 16:49:56','2021-01-30 16:45:32'),(42,1,83,'2020-04-01 14:08:11','2020-04-01 14:08:11'),(43,2,84,'2020-04-06 14:14:08','2020-09-25 17:28:52'),(44,1,84,'2020-04-12 12:24:17','2020-04-15 22:49:42'),(45,2,69,'2020-05-06 14:15:21','2020-05-06 14:15:21'),(46,2,85,'2020-05-07 17:37:18','2020-09-25 17:28:21'),(47,2,86,'2020-05-21 15:43:48','2020-09-25 17:26:03'),(48,2,87,'2020-05-27 13:43:03','2021-01-28 16:20:46'),(49,1,86,'2020-05-28 16:52:56','2020-07-03 23:15:11'),(50,1,87,'2020-05-29 13:34:58','2020-07-03 23:14:48'),(51,15,87,'2020-06-08 17:15:54','2020-06-08 17:16:06'),(52,15,86,'2020-06-08 17:16:02','2020-06-22 14:49:45'),(53,15,83,'2020-06-08 17:16:08','2020-06-08 17:16:08'),(54,15,84,'2020-06-08 17:16:12','2020-06-22 16:35:13'),(55,15,62,'2020-06-08 17:16:15','2020-06-08 17:16:15'),(56,15,51,'2020-06-08 17:16:33','2020-06-08 17:16:33'),(57,15,49,'2020-06-08 17:16:40','2020-06-08 17:16:40'),(58,15,47,'2020-06-08 17:16:59','2020-06-08 17:16:59'),(59,2,7,'2020-06-18 12:02:18','2021-01-28 16:20:15'),(60,2,8,'2020-06-18 12:02:30','2021-01-28 16:20:13'),(61,2,11,'2020-06-18 12:02:40','2020-09-25 17:13:18'),(62,2,14,'2020-06-18 12:02:52','2020-09-25 17:13:44'),(63,2,37,'2020-07-19 15:09:30','2021-01-28 16:36:02'),(64,2,88,'2020-07-21 16:03:36','2020-09-25 17:21:42'),(65,2,89,'2020-07-27 12:42:47','2021-01-28 16:20:44'),(66,16,80,'2020-09-20 11:20:49','2020-09-20 11:20:49'),(67,2,92,'2020-09-25 15:29:34','2021-12-08 10:35:16'),(68,2,91,'2020-09-25 15:30:28','2021-01-28 16:20:41'),(69,2,90,'2020-09-25 15:31:23','2021-08-12 11:22:09'),(70,2,15,'2020-09-25 17:14:15','2021-01-28 16:20:10'),(71,2,18,'2020-09-25 17:14:34','2021-01-28 16:20:20'),(72,2,19,'2020-09-25 17:15:34','2020-09-25 17:15:34'),(73,2,20,'2020-09-25 17:16:07','2021-02-06 21:00:25'),(74,2,21,'2020-09-25 17:18:38','2021-01-28 16:20:03'),(75,2,22,'2020-09-25 17:19:40','2020-09-25 17:19:40'),(76,2,24,'2020-09-25 17:22:15','2021-01-28 16:34:29'),(77,2,25,'2020-09-25 17:22:42','2021-01-28 16:20:00'),(78,2,26,'2020-09-25 17:23:31','2021-01-28 16:20:24'),(79,2,27,'2020-09-25 17:24:12','2021-01-28 16:19:47'),(80,2,28,'2020-09-25 17:24:46','2021-01-28 16:19:51'),(81,2,29,'2020-09-25 17:25:26','2020-09-25 17:25:26'),(82,2,30,'2020-09-25 17:25:45','2021-01-28 16:19:54'),(83,2,31,'2020-09-25 17:26:58','2020-09-25 17:26:58'),(84,2,38,'2020-09-25 17:29:04','2021-02-06 21:00:03'),(85,2,39,'2020-09-25 17:29:48','2020-09-25 17:29:48'),(86,2,40,'2020-09-25 17:32:20','2021-01-28 15:30:22'),(87,2,41,'2020-09-25 17:33:37','2020-09-25 17:34:29'),(88,2,42,'2020-09-25 17:33:48','2020-09-25 17:33:48'),(89,2,44,'2020-09-25 17:34:46','2020-09-25 17:34:46'),(90,2,46,'2020-09-25 17:35:42','2020-09-25 17:35:42'),(91,2,47,'2020-09-25 17:36:25','2022-04-27 13:04:26'),(92,2,48,'2020-09-25 17:37:38','2020-09-25 17:37:38'),(93,2,49,'2020-09-25 17:38:36','2020-09-25 17:38:36'),(94,2,50,'2020-09-25 17:39:35','2020-09-25 17:39:35'),(95,2,51,'2020-09-25 17:40:01','2021-01-30 16:45:54'),(96,2,52,'2020-09-25 17:40:26','2020-09-25 17:41:38'),(97,2,54,'2020-09-25 17:40:48','2020-09-25 17:41:42'),(98,2,56,'2020-09-25 17:41:57','2021-01-31 15:09:59'),(99,2,57,'2020-09-25 17:42:26','2020-09-25 17:42:26'),(100,2,58,'2020-09-25 17:43:23','2020-09-25 17:43:23'),(101,2,68,'2020-10-05 16:52:55','2020-10-05 16:52:55'),(102,17,92,'2020-10-30 14:51:15','2020-10-30 14:51:15'),(103,2,93,'2020-11-05 18:23:29','2021-01-28 20:30:07'),(104,1,93,'2020-12-15 16:06:12','2020-12-15 16:06:12'),(105,18,93,'2020-12-15 17:06:06','2020-12-21 11:06:43'),(106,18,91,'2020-12-15 17:06:47','2020-12-15 17:06:47'),(107,2,94,'2020-12-16 15:40:13','2020-12-16 15:40:13'),(108,18,80,'2020-12-17 17:33:04','2020-12-17 17:33:04'),(109,18,94,'2020-12-21 11:06:47','2020-12-21 11:06:47'),(110,18,90,'2020-12-21 11:06:52','2020-12-21 11:06:52'),(111,19,92,'2020-12-21 11:10:24','2020-12-21 11:10:24'),(112,13,8,'2021-01-21 17:36:43','2021-01-21 17:36:43'),(113,2,96,'2021-01-28 16:20:29','2021-02-02 12:24:18'),(114,2,95,'2021-01-28 16:20:31','2022-06-15 18:03:06'),(115,2,71,'2021-01-29 18:39:57','2021-01-29 18:39:57'),(116,2,72,'2021-01-29 18:40:00','2021-01-29 18:40:00'),(117,1,96,'2021-02-01 07:09:36','2021-02-01 07:09:36'),(118,20,98,'2021-02-02 16:32:47','2021-02-02 16:32:47'),(119,2,100,'2021-02-04 10:19:21','2022-09-03 19:42:52'),(121,23,106,'2021-03-25 16:07:29','2021-03-25 16:07:29'),(122,23,101,'2021-03-25 16:08:18','2021-03-25 16:08:18'),(123,23,99,'2021-03-25 16:08:44','2021-03-25 16:08:44'),(124,24,101,'2021-04-20 17:18:31','2021-04-20 17:18:31'),(125,2,98,'2021-08-11 17:36:02','2021-08-11 17:36:02'),(126,2,106,'2021-08-12 11:14:06','2021-12-08 10:34:31'),(127,2,97,'2021-08-12 11:20:57','2021-08-12 11:20:57'),(128,2,101,'2021-08-12 11:21:34','2021-08-12 11:21:55'),(130,2,107,'2021-10-12 21:22:05','2022-09-03 19:42:45'),(131,1,107,'2021-10-17 20:33:07','2021-10-18 14:57:53'),(132,2,103,'2021-12-08 10:34:35','2021-12-08 10:34:35'),(133,2,102,'2022-06-15 18:04:35','2022-06-15 18:04:39');
/*!40000 ALTER TABLE `advertiser_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertisers`
--

DROP TABLE IF EXISTS `advertisers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_num` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receive_agreement` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `point` int(10) unsigned NOT NULL DEFAULT '0',
  `certification_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `advertisers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisers`
--

LOCK TABLES `advertisers` WRITE;
/*!40000 ALTER TABLE `advertisers` DISABLE KEYS */;
INSERT INTO `advertisers` VALUES (1,'dupal@naver.com','두팔','$2y$10$clR0CgPjVELvlyWsnTp0eux5VdG8Cl3bWIODTxVNCByHHCa8OWmWK','01093490223',1,NULL,'NGpYMdi254kLphOz31Oxg3tT2wahItVxveB6TDlcI72vNtgth0uXuXNV6GvF','2019-10-31 19:48:15','2021-10-17 20:36:30',2500,NULL),(2,'bloxion@naver.com','조용완','$2y$10$vpUdWJkrVVdjjV3K1sJPtOJ4BsnU5uccAgNRHUeithlIj2w8lLEXq','01077412735',1,NULL,'aptgYTy7GyAf1cPEpfZOfaUbUMHyN1U9lzA3Z4L7SUfhYV63OFjYoayWixhk','2019-11-04 17:35:18','2022-11-22 15:36:21',101130000,NULL),(3,'whalesdive@gmail.com','최수열','$2y$10$nLoRAR328tAth2T/MNzXOOeNOVDjMlxGlkULutlEdu8Ps/NPn2h5S','01012341234',1,NULL,NULL,'2020-02-06 08:12:34','2020-02-06 08:12:34',0,NULL),(4,'dofff11@daum.net','고운시절','$2y$10$okWucUGpwvuovn7ZUJ65mudppadl.kKON.PAU2Q6wv6aLrEde7gCC','01055448865',0,NULL,'jxMyehtBYpWpoM5aLeZGX1sqrON75glnZ4JidfKA68vX3R8p8E6vhaIWj6c8','2020-02-13 03:38:26','2020-02-13 03:38:26',0,NULL),(5,'ohsujeong8@naver.com','오수정','$2y$10$JrETfF9jh5hQEJIpqMaV1.JpQ8doOA8XXATlV04ujqVuvowcObOUu','01084288873',1,NULL,NULL,'2020-02-19 14:54:58','2020-02-19 14:54:58',0,NULL),(6,'ingyu3040@gmail.com','황인규','$2y$10$Ro/Rae07IefmHNVbrjBEqei4fS8NV8y5T9jbEQmfAM92TeBUhDVYC','01087223040',0,NULL,NULL,'2020-02-21 11:40:08','2020-02-21 11:40:08',0,NULL),(7,'hloves99@nate.com','김형진','$2y$10$yDgJ2Yqas3wbGIUoei2n4O1iTu64/FyxkJ1eYP6qTuCqybuIu/emS','01091376860',0,NULL,NULL,'2020-02-27 14:46:34','2020-02-27 14:46:34',0,NULL),(11,'hanna@team-gorani.com','김한나','$2y$10$g5zd/aMzyZHoLuXzAKzMvu9QSkiL1VPcYAOIaXyfxuGosYfyLAXDu','01077019116',0,NULL,NULL,'2020-03-17 15:14:55','2020-03-17 15:14:55',0,NULL),(12,'pocket.leh@gmail.com','이은효','$2y$10$YYkp3SlN.pvFk7SEIgYgVO9agXc4FThHlxhY2uKLSdBUPnTBWuMFu','01073947879',0,NULL,NULL,'2020-04-03 13:41:53','2020-04-03 13:41:53',0,NULL),(13,'hhkim@tripmoa.com','김현호','$2y$10$ZTCTq0Y3A7wMiUm5ve/MwOjoUOzUtpqySALnhdWqw7Y5ryG.MWgdq','01090446150',0,NULL,'UuyisrLRjEfrIwxC7PStD1ofiey8zZlIFo08L4WddUTrrRn8FbphI6GeyF2Y','2020-05-19 18:35:47','2020-05-19 18:35:47',0,NULL),(15,'tpsxj9@naver.com','김성근','$2y$10$tX.u0CoLKGtGG5wbjR4/FuuRNHVgpyKEnYBTGP61yyqnQMqfB13TO','01041239432',1,NULL,'JPYgASyydJ91k7KBQiixjD3HkafdeaKFV7zNhHW9vjAryQMvFQA7s6z2WwPq','2020-06-05 16:16:11','2020-06-26 14:08:35',790000,NULL),(16,'andyyook@gmail.com','육미영','$2y$10$VPV.t8R1OXitTer5hdmOWuUdhprgZ9MHvUR20/mWPRFlFA/amH/AO','01066776202',1,NULL,NULL,'2020-09-20 11:20:33','2020-09-20 11:20:33',0,NULL),(17,'detailing0353@naver.com','정윤복','$2y$10$GX40OoBs/ldjXhmQHsPSYOnKaEfIEhz8HDFM4yzpBUruZY/AmcRDW','01041500353',1,NULL,NULL,'2020-10-30 14:49:53','2020-10-30 14:49:53',0,NULL),(18,'pulum03@naver.com','박근오','$2y$10$qe7UC.g3e1Gmkjsh8ZPd5.GKfTIT8HYGOIQfc51bCLcj5v.skjLCq','01057794316',0,NULL,'EwU7JV4RcH7sYorwE2oC6niQnyyDJTVQcxWHiP9os2LjlRbno1QrUMx7WIt7','2020-12-15 17:04:38','2020-12-15 17:04:38',0,NULL),(19,'kuno.lee@dslab.global','이건오','$2y$10$7/pcJUZSZ5lkp7txjRVMeOf.4VkBA71LgR1cxHgW6CLN3D1BU57t6','01079127192',0,NULL,'BFXr51B7UuiV5e1wp0xXD2E3l1wFDCmToIqG0Nb7lqimMbGrqo1lItCdFX8I','2020-12-21 11:10:07','2020-12-21 11:10:07',0,NULL),(20,'bloxion4@naver.com','조용완','$2y$10$8.WxeeuO.s3y.4oM8edNou.Ulhfd/QbdA3SyG8e8jUi5isYHuQ95O','01096412735',1,NULL,NULL,'2021-02-02 15:59:17','2021-02-02 15:59:17',0,NULL),(21,'ndrstudy@naver.com','김진석','$2y$10$I6YAMaSQihsFuwCKlypz8.1YT8NS5N5FGR/efuiKa/Jl7vNAafEOK','01082283472',1,NULL,'mbkOa3s527grVEvFuLmjvoeqtwh48Z1A68sN56JQ5kQlAEh4Ch2SGgsP0OKf','2021-02-02 16:35:45','2021-10-20 14:12:06',0,NULL),(22,'dugkwjd68@naver.com','여하정','$2y$10$lbMEum5vCx4WM7SZG6NCe.p1DCOHJERtD07yd1eiKJsBb/rkLby6a','01022216418',0,NULL,'JNbrUGJPmJoP1OQHOMQCoceGe94RA3aKp9hzPtoTzcB3rASiYCjUIVUo59z3','2021-03-03 20:34:31','2021-03-03 20:34:31',0,NULL),(23,'flosetstudio@gmail.com','안지원','$2y$10$84oDS8z/gDbOZh6hGGIB8ugrSO8bovgjHyJymRqJo7oWNLQa8VHYe','01039032922',1,NULL,'VIVtFUdnUzLRrs0WRZ9MSUiWbMrG6d96euSVw1b2VI6b3xkPhPhD1rQcIGQJ','2021-03-25 15:50:41','2021-03-25 15:50:41',0,NULL),(24,'haru0108@naver.com','최현정','$2y$10$Jyn/kDf8zMsxKwx0dUz.HuL5IXHR1Ft19uUgsYYqSqqi6q1dcC/g2','01064192114',1,NULL,NULL,'2021-04-20 17:18:09','2021-04-20 17:18:09',0,NULL),(25,'laundryshower@gmail.com','정영지','$2y$10$aCzv9jyM7VOdc3uhGNfHUubb1ZNzmpPe7CeCztlv0If5WeKuhSs5m','01041904595',1,NULL,NULL,'2021-07-17 23:45:36','2021-07-17 23:45:36',0,NULL),(26,'c8510400@gmail.com','차현호','$2y$10$FCdcJ9WKZAaCa6ZJyvySDeAy8BtCFtq8dPuYgo9h3/pqYHnW/UU6C','01085462489',0,NULL,NULL,'2022-01-01 00:21:10','2022-01-01 00:21:10',0,NULL),(27,'rlaskfo1204@naver.com','김원재','$2y$10$yIwhotKuV552IZ/Jv2YGTu9W4PCi.zxb6KLqFzSCGcez/L2iQTmqC','01037489028',1,NULL,NULL,'2022-10-10 16:44:04','2022-10-10 16:44:04',0,NULL);
/*!40000 ALTER TABLE `advertisers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertiser_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `process` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agencies_advertiser_id_foreign` (`advertiser_id`),
  CONSTRAINT `agencies_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencies`
--

LOCK TABLES `agencies` WRITE;
/*!40000 ALTER TABLE `agencies` DISABLE KEYS */;
INSERT INTO `agencies` VALUES (1,2,'dd','dd','dd','2020-02-17 10:30:15','2020-02-24 16:34:00');
/*!40000 ALTER TABLE `agencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area_plan`
--

DROP TABLE IF EXISTS `area_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_plan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` bigint(20) unsigned NOT NULL,
  `plan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `area_plan_area_id_index` (`area_id`),
  KEY `area_plan_plan_id_index` (`plan_id`),
  CONSTRAINT `area_plan_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `area_plan_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_plan`
--

LOCK TABLES `area_plan` WRITE;
/*!40000 ALTER TABLE `area_plan` DISABLE KEYS */;
INSERT INTO `area_plan` VALUES (14,20,18,'2019-11-15 13:32:01','2019-11-15 13:32:01'),(15,1,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(16,5,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(17,11,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(18,30,24,'2019-11-18 03:36:16','2019-11-18 03:36:16'),(19,3,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(20,11,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(21,22,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(22,5,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(23,28,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(24,4,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(25,6,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(26,15,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(28,30,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(29,1,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(30,18,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(31,25,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(32,38,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(33,6,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(34,11,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(38,17,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(39,17,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(40,37,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(41,26,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(42,1,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(43,37,48,'2019-11-25 19:20:17','2019-11-25 19:20:17'),(44,1,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(45,18,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(46,25,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(47,25,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(48,8,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(49,12,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(50,16,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(51,14,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(52,5,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(54,1,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(55,19,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(56,20,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(57,21,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(58,23,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(59,30,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(60,30,59,'2019-11-28 23:46:11','2019-11-28 23:46:11'),(61,31,59,'2019-11-28 23:46:11','2019-11-28 23:46:11'),(62,30,60,'2019-12-01 21:14:33','2019-12-01 21:14:33'),(63,28,60,'2019-12-01 21:14:33','2019-12-01 21:14:33'),(64,1,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(65,1,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(66,28,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(67,31,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(68,25,66,'2019-12-13 16:42:45','2019-12-13 16:42:45'),(69,30,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(70,1,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(71,35,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(72,6,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(73,17,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(74,7,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(75,21,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(76,22,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(77,10,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(78,11,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(79,16,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(80,14,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(81,5,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(82,2,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(83,4,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(84,6,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(85,9,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(86,15,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(87,16,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(88,17,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(89,25,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(90,1,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(91,18,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(92,26,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(93,27,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(94,28,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(95,34,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(96,39,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(97,36,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(98,35,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(99,1,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(100,18,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(102,18,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(106,1,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(107,25,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(108,24,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(112,19,89,'2020-07-24 17:04:36','2020-07-24 17:04:36'),(116,1,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(117,18,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(118,25,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(122,26,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(123,4,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(124,6,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(125,15,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(126,17,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(127,13,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(128,16,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(129,7,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(130,2,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(131,24,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(132,30,95,'2020-12-21 19:03:25','2020-12-21 19:03:25'),(133,30,96,'2020-12-29 18:01:22','2020-12-29 18:01:22'),(134,31,96,'2020-12-29 18:01:22','2020-12-29 18:01:22'),(135,30,97,'2021-02-02 12:45:59','2021-02-02 12:45:59'),(136,1,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(137,18,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(138,35,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(139,26,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(143,30,85,'2021-02-09 13:48:52','2021-02-09 13:48:52'),(144,30,107,'2021-08-13 14:58:02','2021-08-13 14:58:02');
/*!40000 ALTER TABLE `area_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `region_id` bigint(20) unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_region_id_index` (`region_id`),
  CONSTRAINT `areas_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,1,'전체'),(2,1,'강남/논현'),(3,1,'강동/천호'),(4,1,'강서/목동'),(5,1,'건대/왕십리'),(6,1,'관악/신림'),(7,1,'교대/사당'),(8,1,'노원/강북'),(9,1,'명동/이태원'),(10,1,'삼성/선릉'),(11,1,'송파/잠실'),(12,1,'수유/동대문'),(13,1,'신촌/이대'),(14,1,'압구정/신사'),(15,1,'여의도/영등포'),(16,1,'종로/대학로'),(17,1,'홍대/마포'),(18,2,'전체'),(19,2,'일산/파주'),(20,2,'분당/수원'),(21,2,'남양주'),(22,2,'하남/구리'),(23,2,'안양/안산'),(24,2,'광명/부천'),(25,3,'전체'),(26,4,'전체'),(27,5,'전체'),(28,6,'전체'),(29,7,'전체'),(30,8,'전체'),(31,9,'전체'),(32,10,'전체'),(33,11,'전체'),(34,12,'전체'),(35,13,'전체'),(36,14,'전체'),(37,15,'전체'),(38,16,'전체'),(39,17,'전체');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` VALUES (1,'KDB산업은행','002'),(2,'IBK기업은행','003'),(3,'KB국민은행','004'),(4,'Sh수협은행','007'),(5,'한국수출입은행','008'),(6,'NH농협은행','011'),(7,'우리은행','020'),(8,'SC제일은행','023'),(9,'한국씨티은행','027'),(10,'대구은행','031'),(11,'부산은행','032'),(12,'광주은행','034'),(13,'제주은행','035'),(14,'전북은행','037'),(15,'경남은행','039'),(16,'HSBC 서울지점','054'),(17,'하나은행','081'),(18,'신한은행','088'),(19,'케이뱅크','089'),(20,'카카오뱅크','090');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookmarks_campaign_id_index` (`campaign_id`),
  KEY `bookmarks_reviewer_id_index` (`reviewer_id`),
  CONSTRAINT `bookmarks_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookmarks_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
INSERT INTO `bookmarks` VALUES (2,35,132,'2020-07-03 23:37:48','2020-07-03 23:37:48');
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bottom_banners`
--

DROP TABLE IF EXISTS `bottom_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bottom_banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bottom_banners`
--

LOCK TABLES `bottom_banners` WRITE;
/*!40000 ALTER TABLE `bottom_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `bottom_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(210) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `advertiser_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_category_id_foreign` (`category_id`),
  KEY `brands_advertiser_id_index` (`advertiser_id`),
  CONSTRAINT `brands_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `brands_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (10,'웨일즈다이브',1,3,'2020-02-06 08:12:34','2020-02-06 08:12:34'),(11,'웨일즈다이브',11,3,'2020-02-06 08:12:47','2020-02-06 08:12:47'),(12,'고운시절',3,4,'2020-02-13 03:38:26','2020-02-13 03:38:26'),(13,'힐링스포츠마사지',11,5,'2020-02-19 14:54:58','2020-02-19 14:54:58'),(14,'고운시절',3,4,'2020-02-20 05:22:28','2020-02-20 05:22:28'),(15,'고운시절',3,4,'2020-02-20 05:29:41','2020-02-20 05:29:41'),(16,'고운시절',3,4,'2020-02-20 05:29:59','2020-02-20 05:29:59'),(17,'아나파코리아',2,6,'2020-02-21 11:40:08','2020-02-21 11:40:08'),(18,'소니',5,7,'2020-02-27 14:46:34','2020-02-27 14:46:34'),(23,'클래씨',1,11,'2020-03-17 15:14:55','2020-03-17 15:14:55'),(25,'포켓컴퍼니',12,12,'2020-04-03 13:41:53','2020-04-03 13:41:53'),(27,'트립모아',12,13,'2020-05-19 18:35:47','2020-05-19 18:35:47'),(35,'까만아이',8,15,'2020-06-05 16:16:11','2020-06-05 16:16:11'),(44,'안개가키운새싹',7,16,'2020-09-20 11:20:33','2020-09-20 11:20:33'),(45,'디테일링스토리',11,17,'2020-10-30 14:49:53','2020-10-30 14:49:53'),(46,'파리바게트',1,18,'2020-12-15 17:04:38','2020-12-15 17:04:38'),(47,'디에스',12,19,'2020-12-21 11:10:07','2020-12-21 11:10:07'),(52,'짱죽',7,2,'2021-01-27 15:18:06','2021-01-27 15:18:06'),(53,'테스트호텔',4,1,'2021-02-01 07:54:05','2021-02-01 07:54:05'),(54,'일이삼사요',10,1,'2021-02-01 08:08:10','2021-02-01 08:08:10'),(59,'가나다',1,20,'2021-02-02 15:59:17','2021-02-02 15:59:17'),(60,'프리미엄 스터디카페 남다름',11,21,'2021-02-02 16:35:45','2021-02-02 16:35:45'),(67,'견생샵',12,22,'2021-03-03 20:34:31','2021-03-03 20:34:31'),(68,'플로젯스튜디오',11,23,'2021-03-25 15:50:41','2021-03-25 15:50:41'),(69,'인스타',1,24,'2021-04-20 17:18:09','2021-04-20 17:18:09'),(70,'런드리샤워',1,25,'2021-07-17 23:45:36','2021-07-17 23:45:36'),(78,'외양간한우',1,26,'2022-01-01 00:21:10','2022-01-01 00:21:10'),(79,'대박 추어탕',1,27,'2022-10-10 16:44:04','2022-10-10 16:44:04'),(80,'AOP Roasters',1,2,'2022-11-22 14:33:56','2022-11-22 14:33:56'),(81,'아케소',11,2,'2022-11-22 15:02:44','2022-11-22 15:02:44');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_exposure`
--

DROP TABLE IF EXISTS `campaign_exposure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_exposure` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `exposure_id` bigint(20) unsigned NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_exposure_campaign_id_foreign` (`campaign_id`),
  KEY `campaign_exposure_exposure_id_index` (`exposure_id`),
  CONSTRAINT `campaign_exposure_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `campaign_exposure_exposure_id_foreign` FOREIGN KEY (`exposure_id`) REFERENCES `exposures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_exposure`
--

LOCK TABLES `campaign_exposure` WRITE;
/*!40000 ALTER TABLE `campaign_exposure` DISABLE KEYS */;
INSERT INTO `campaign_exposure` VALUES (20,35,1,NULL,NULL,'2020-06-26 14:08:35','2020-06-26 14:08:35'),(48,82,1,NULL,NULL,'2021-01-27 15:22:28','2021-01-27 15:22:28'),(60,123,2,NULL,NULL,'2021-03-03 20:41:30','2021-03-03 20:41:30'),(61,124,2,NULL,NULL,'2021-03-03 20:41:38','2021-03-03 20:41:38'),(62,125,2,NULL,NULL,'2021-03-03 20:41:42','2021-03-03 20:41:42'),(63,126,2,NULL,NULL,'2021-03-03 20:41:48','2021-03-03 20:41:48'),(64,127,2,NULL,NULL,'2021-03-03 20:41:53','2021-03-03 20:41:53'),(65,128,2,NULL,NULL,'2021-03-03 20:42:12','2021-03-03 20:42:12'),(66,129,2,NULL,NULL,'2021-03-03 20:42:30','2021-03-03 20:42:30'),(67,130,2,NULL,NULL,'2021-03-03 20:42:35','2021-03-03 20:42:35'),(69,134,3,NULL,NULL,'2021-10-17 20:20:26','2021-10-17 20:20:26'),(70,135,3,NULL,NULL,'2021-10-17 20:36:30','2021-10-17 20:36:30'),(72,136,1,NULL,NULL,'2022-04-18 15:45:31','2022-04-18 15:45:39'),(73,143,1,NULL,NULL,'2022-07-01 22:04:56','2022-07-01 22:04:56'),(74,144,1,NULL,NULL,'2022-07-01 22:08:32','2022-07-01 22:08:32'),(76,146,1,NULL,NULL,'2022-08-04 11:13:29','2022-08-04 11:13:29'),(77,149,1,NULL,NULL,'2022-11-22 15:33:51','2022-11-22 15:33:51'),(78,150,1,NULL,NULL,'2022-11-22 15:36:21','2022-11-22 15:36:21');
/*!40000 ALTER TABLE `campaign_exposure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_promotion`
--

DROP TABLE IF EXISTS `campaign_promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_promotion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `promotion_id` bigint(20) unsigned NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `process` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campaign_promotion_campaign_id_foreign` (`campaign_id`),
  KEY `campaign_promotion_promotion_id_index` (`promotion_id`),
  CONSTRAINT `campaign_promotion_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `campaign_promotion_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_promotion`
--

LOCK TABLES `campaign_promotion` WRITE;
/*!40000 ALTER TABLE `campaign_promotion` DISABLE KEYS */;
INSERT INTO `campaign_promotion` VALUES (1,35,1,NULL,NULL,'2020-06-26 14:08:35','2020-12-31 15:09:39',1),(2,123,2,NULL,NULL,'2021-03-03 20:41:30','2021-03-03 20:41:30',0),(3,124,2,NULL,NULL,'2021-03-03 20:41:38','2021-03-03 20:41:38',0),(4,125,2,NULL,NULL,'2021-03-03 20:41:42','2021-03-03 20:41:42',0),(5,126,2,NULL,NULL,'2021-03-03 20:41:48','2021-03-03 20:41:48',0),(6,127,2,NULL,NULL,'2021-03-03 20:41:53','2021-03-03 20:41:53',0),(7,128,2,NULL,NULL,'2021-03-03 20:42:12','2021-03-03 20:42:12',0),(8,129,2,NULL,NULL,'2021-03-03 20:42:30','2021-03-03 20:42:30',0),(9,130,2,NULL,NULL,'2021-03-03 20:42:35','2021-03-03 20:42:35',0),(10,135,1,NULL,NULL,'2021-10-17 20:36:30','2021-10-17 20:36:30',0);
/*!40000 ALTER TABLE `campaign_promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_reviewers`
--

DROP TABLE IF EXISTS `campaign_reviewers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_reviewers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `take_visit_check` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campaign_reviewers_campaign_id_index` (`campaign_id`),
  KEY `campaign_reviewers_reviewer_id_index` (`reviewer_id`),
  CONSTRAINT `campaign_reviewers_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `campaign_reviewers_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_reviewers`
--

LOCK TABLES `campaign_reviewers` WRITE;
/*!40000 ALTER TABLE `campaign_reviewers` DISABLE KEYS */;
INSERT INTO `campaign_reviewers` VALUES (34,82,4,1,'2021-01-28 18:54:35','2021-02-15 11:07:12',1),(36,83,132,1,'2021-02-01 08:58:21','2021-02-01 12:13:57',1),(37,87,132,1,'2021-02-01 15:53:13','2021-02-01 15:56:52',0),(39,134,132,1,'2021-10-17 20:22:29','2021-10-17 20:31:00',1),(40,136,4,0,'2022-04-18 15:43:12','2022-04-18 15:43:12',0),(41,143,4,0,'2022-07-01 22:05:25','2022-07-01 22:05:25',0);
/*!40000 ALTER TABLE `campaign_reviewers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertiser_id` bigint(20) unsigned NOT NULL,
  `channel_id` bigint(20) unsigned NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form` enum('h','v') COLLATE utf8mb4_unicode_ci NOT NULL,
  `recruit_number` smallint(5) unsigned NOT NULL,
  `offer_point` int(10) unsigned NOT NULL,
  `offer_goods` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_recruit` date NOT NULL,
  `end_recruit` date NOT NULL,
  `end_submit` date NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` int(10) unsigned DEFAULT NULL,
  `provide_agreement` tinyint(1) DEFAULT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `area_id` bigint(20) unsigned DEFAULT NULL,
  `visit_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etc` text COLLATE utf8mb4_unicode_ci,
  `view_count` bigint(20) unsigned DEFAULT '0',
  `merchant_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_payment` tinyint(1) NOT NULL DEFAULT '0',
  `send_sms` tinyint(1) NOT NULL DEFAULT '0',
  `send_mail` tinyint(1) NOT NULL DEFAULT '0',
  `fee_waiver` int(11) DEFAULT '0',
  `select_payment` tinyint(1) NOT NULL DEFAULT '0',
  `payment2` int(11) DEFAULT '0',
  `merchant_uid2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaigns_brand_id_foreign` (`brand_id`),
  KEY `campaigns_advertiser_id_index` (`advertiser_id`),
  KEY `campaigns_channel_id_index` (`channel_id`),
  KEY `campaigns_form_index` (`form`),
  KEY `campaigns_area_id_index` (`area_id`),
  CONSTRAINT `campaigns_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `campaigns_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `campaigns_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `campaigns_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (35,15,1,35,'dqwe','v',1,5000,'qwe','2020-06-27','2020-07-03','2020-07-18','1593148115.jpg',NULL,NULL,NULL,'qew','qwe','qwe',0,1,1,1,'qwe',NULL,'qwe','qwe','2020-06-26 14:08:35','2022-11-22 13:54:13','qwe',1276,'mc_1593148115',1,1,1,0,0,0,NULL),(82,2,1,52,'냉장/실온 이유식 체험단 모집','h',5,0,'냉장이유식 3팩 + 쌀과자 2봉(쌀과자와 떡뻥) + 모과배도라지즙 1봉 또는 식혜 1봉','2021-01-28','2021-02-03','2021-02-18','1611728548120210127_151948.jpg',NULL,NULL,NULL,'070-4348-2627','짱죽에서 이유식 체험단을 모집합니다!\r\n실제 아이들에게 필요하신 분들 신청해주세요 ^^\r\n블로그 . 인스타그램 따로 신청 받습니다!\r\n\r\n판매처\r\nhttps://www.jjangjuk.com:5006/list_baby.php?cate=1','냉장이유식, 친환경이유식 ,실온이유식, 여행용이유식, 이유식배달, 시판이유식, 이유식브랜드, 이유식샘플, 유기농쌀아기반찬, 아이간식, 아기간식, 이유식무료체험 ,쌀과자 ,배도라지즙',0,1,1,NULL,NULL,NULL,NULL,NULL,'2021-01-27 15:22:28','2022-11-22 17:04:41','키워드 중 2개 이상을 첨부하여 포스팅',2320,'mc_1611728548',1,1,1,0,0,0,NULL),(83,1,3,53,'test777','v',7,700,'test77','2020-12-20','2021-01-01','2021-02-04','16121360871.jpg','161213581625c6e9828e4337.jpg',NULL,NULL,'조지은 0105251','test77','#시원시원 #최신냉장고',0,1,1,21,'test','46058','부산 기장군 기장읍 배산로8번길 2','201호','2021-02-01 08:30:16','2022-11-23 00:25:25','test',288,'mc_1612135816',1,1,1,0,0,0,NULL),(87,1,2,53,'테스트 호텔입니다','v',2,5000,'숙박권','2021-01-29','2021-02-01','2021-02-05','16121618851.jpg',NULL,NULL,'16121618854maxresdefault.jpg','블록션 521-4512','리뷰미션입니다','#키워드',0,1,1,36,'오전 12시 이후 ~ 저녁 6시 전까지','03060','서울 종로구 윤보선길 10','201호','2021-02-01 15:44:45','2022-11-22 05:48:45','고고',330,'mc_1612161885',1,1,1,0,0,0,NULL),(91,21,1,60,'양산 서창스터디카페','v',5,5000,'무료 4시간 이용권, 음료 커피 무료제공','2021-02-03','2021-02-09','2021-02-24','16122520941IMG_20200824_220115_740.jpg','1612252094220201118_081422.jpg',NULL,NULL,'01082283472','타 스터디카페와다르게 80평 에 58석의넓은공간 \r\n전좌석 1인석운영으로 코로나 방역에 최적화\r\n고급스럽고 편안한 공부환경\r\n넓은책상 공기청정기 세스코 공기살균기 가습기 운영\r\n편리한 휴게공간 , 세콤 24시간 보안 비상벨 운영\r\n초대박 야간권  운영- 밝고 안전해서 야간에도 안심하고 공부가능','양산 스터디카페 , 양산 서창 스터디카페, 웅상 스터디카페',55000,1,0,31,'24시간  가능','50529','경남 양산시 삼호로 191','4층  남다름스터디카페','2021-02-02 16:48:15','2022-11-22 04:37:34','고급스럽고 밝은 인테리어가 잘나오게\r\n실제로 넓은 책상이 눈에 띌수 있게\r\n잘부탁드립니다',279,'mc_1612252094',0,0,0,0,0,0,NULL),(92,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122538671IMG_20200824_220115_740.jpg',NULL,NULL,'1612253867420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:17:47','2022-11-22 03:00:35','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',270,'mc_1612253867',0,0,0,0,0,0,NULL),(93,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122538711IMG_20200824_220115_740.jpg',NULL,NULL,'1612253871420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:17:52','2022-11-23 07:51:27','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',263,'mc_1612253871',0,0,0,0,0,0,NULL),(94,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122538761IMG_20200824_220115_740.jpg',NULL,NULL,'1612253876420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:17:57','2022-11-23 10:23:07','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',262,'mc_1612253876',0,0,0,0,0,0,NULL),(95,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122538781IMG_20200824_220115_740.jpg',NULL,NULL,'1612253878420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:17:59','2022-11-22 14:55:06','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',253,'mc_1612253878',0,0,0,0,0,0,NULL),(96,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122538931IMG_20200824_220115_740.jpg',NULL,NULL,'1612253893420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:18:14','2022-11-22 13:07:43','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',267,'mc_1612253893',0,0,0,0,0,0,NULL),(97,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122538961IMG_20200824_220115_740.jpg',NULL,NULL,'1612253896420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:18:16','2022-11-22 20:26:14','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',269,'mc_1612253896',0,0,0,0,0,0,NULL),(98,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122539211IMG_20200824_220115_740.jpg',NULL,NULL,'1612253921420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:18:42','2022-11-22 15:30:26','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',275,'mc_1612253921',0,0,0,0,0,0,NULL),(99,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122539541IMG_20200824_220115_740.jpg',NULL,NULL,'1612253955420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:19:15','2022-11-22 14:51:37','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',262,'mc_1612253954',0,0,0,0,0,0,NULL),(100,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122539581IMG_20200824_220115_740.jpg',NULL,NULL,'1612253958420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:19:19','2022-11-22 16:29:50','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',283,'mc_1612253958',0,0,0,0,0,0,NULL),(101,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122539621IMG_20200824_220115_740.jpg',NULL,NULL,'1612253962420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:19:22','2022-11-22 13:42:33','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',269,'mc_1612253962',0,0,0,0,0,0,NULL),(102,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122539751IMG_20200824_220115_740.jpg',NULL,NULL,'1612253975420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:19:35','2022-11-22 23:24:58','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',278,'mc_1612253975',0,0,0,0,0,0,NULL),(103,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122539771IMG_20200824_220115_740.jpg',NULL,NULL,'1612253977420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:19:38','2022-11-21 18:55:16','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',261,'mc_1612253977',0,0,0,0,0,0,NULL),(104,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122540061IMG_20200824_220115_740.jpg',NULL,NULL,'1612254006420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:20:06','2022-11-22 16:02:17','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',266,'mc_1612254006',0,0,0,0,0,0,NULL),(105,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122541631IMG_20200824_220115_740.jpg',NULL,NULL,'1612254163420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:22:44','2022-11-21 21:49:16','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',264,'mc_1612254163',0,0,0,0,0,0,NULL),(106,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122541811IMG_20200824_220115_740.jpg',NULL,NULL,'1612254181420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:23:02','2022-11-23 10:57:08','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',260,'mc_1612254181',0,0,0,0,0,0,NULL),(107,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122541851IMG_20200824_220115_740.jpg',NULL,NULL,'1612254185420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:23:06','2022-11-22 14:16:18','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',243,'mc_1612254185',0,0,0,0,0,0,NULL),(108,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122541881IMG_20200824_220115_740.jpg',NULL,NULL,'1612254188420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:23:09','2022-11-21 20:57:25','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',247,'mc_1612254188',0,0,0,0,0,0,NULL),(109,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122541971IMG_20200824_220115_740.jpg',NULL,NULL,'1612254197420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:23:17','2022-11-23 11:52:02','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',261,'mc_1612254197',0,0,0,0,0,0,NULL),(110,21,1,60,'스터디카페 남다름 체험 모집','v',5,5000,'무료8시간이용권, 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122541991IMG_20200824_220115_740.jpg',NULL,NULL,'1612254200420201126_070429.jpg','01082283472','프리미엄 스터디카페란 이런것이다.\r\n코로나방역에 최적화된 전좌석 1인석운영\r\n80평에 58좌석으로 넓은 개인공간\r\n창가석,오픈석,카페석,좌식등 다양한 좌석타입\r\n비대면발열체크기, 세스코 공기살균기,공기청정기\r\n가습기 운영, \r\n세콤 24시 보안 비상벨 보유','양산스터디카페,  양산서창스터디카페,양산웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디 카페','2021-02-02 17:23:20','2022-11-23 10:47:25','넓은 책상, 개인 공간이 잘나오게\r\n고급지고 편안한 느낌이 잘나오게\r\n부탁드립니다',245,'mc_1612254199',0,0,0,0,0,0,NULL),(111,21,1,60,'남다름스터디카페 체험 모집','v',5,5000,'무료8시간이용권 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122549881IMG_20200824_220115_740.jpg','1612254988220200824_212037.jpg','1612254989320210116_122859.jpg','1612254989420200827_200138.jpg','01082283472','이것이 프리미엄 스터디카페다\r\n고급스럽고, 편안한 분위기\r\n80평 58좌석으로 넓은 개인공간\r\n코로나방역에 최적화된 전좌석 1인석 운영\r\n좌식, 창가뷰,카페석, 오픈석등 다양한 좌석 타입\r\n비대면발열체크기, 세스코공기살균기, 공기청정기\r\n가습기 운영 . 24시간 세콤보안 16대cctv 비상벨운영\r\n초특가 야간권운영','양산스터디카페,양산서창스터디카페,웅상스터디카페',55000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디카페','2021-02-02 17:36:29','2022-11-23 07:43:27','인테리어가 이쁘게\r\n넓은좌석,넓은 책상이 눈에띄게\r\n잘부탁드립니다',275,'mc_1612254988',0,0,0,0,0,0,NULL),(112,21,1,60,'남다름스터디카페 체험 모집','v',5,5000,'무료8시간이용권 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122550651IMG_20200824_220115_740.jpg','1612255065220200824_212037.jpg','1612255066320210116_122859.jpg','1612255066420200827_200138.jpg','01082283472','이것이 프리미엄 스터디카페다\r\n고급스럽고, 편안한 분위기\r\n80평 58좌석으로 넓은 개인공간\r\n코로나방역에 최적화된 전좌석 1인석 운영\r\n좌식, 창가뷰,카페석, 오픈석등 다양한 좌석 타입\r\n비대면발열체크기, 세스코공기살균기, 공기청정기\r\n가습기 운영 . 24시간 세콤보안 16대cctv 비상벨운영\r\n초특가 야간권운영','양산스터디카페,양산서창스터디카페,웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디카페','2021-02-02 17:37:46','2022-11-22 09:48:41','인테리어가 이쁘게\r\n넓은좌석,넓은 책상이 눈에띄게\r\n잘부탁드립니다',259,'mc_1612255065',0,0,0,0,0,0,NULL),(113,21,1,60,'남다름스터디카페 체험 모집','v',5,5000,'무료8시간이용권 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122550701IMG_20200824_220115_740.jpg','1612255070220200824_212037.jpg','1612255070320210116_122859.jpg','1612255070420200827_200138.jpg','01082283472','이것이 프리미엄 스터디카페다\r\n고급스럽고, 편안한 분위기\r\n80평 58좌석으로 넓은 개인공간\r\n코로나방역에 최적화된 전좌석 1인석 운영\r\n좌식, 창가뷰,카페석, 오픈석등 다양한 좌석 타입\r\n비대면발열체크기, 세스코공기살균기, 공기청정기\r\n가습기 운영 . 24시간 세콤보안 16대cctv 비상벨운영\r\n초특가 야간권운영','양산스터디카페,양산서창스터디카페,웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디카페','2021-02-02 17:37:51','2022-11-22 23:43:13','인테리어가 이쁘게\r\n넓은좌석,넓은 책상이 눈에띄게\r\n잘부탁드립니다',223,'mc_1612255070',0,0,0,0,0,0,NULL),(114,21,1,60,'남다름스터디카페 체험 모집','v',5,5000,'무료8시간이용권 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122552121IMG_20200824_220115_740.jpg','1612255212220200824_212037.jpg','1612255213320210116_122859.jpg','1612255213420200827_200138.jpg','01082283472','이것이 프리미엄 스터디카페다\r\n고급스럽고, 편안한 분위기\r\n80평 58좌석으로 넓은 개인공간\r\n코로나방역에 최적화된 전좌석 1인석 운영\r\n좌식, 창가뷰,카페석, 오픈석등 다양한 좌석 타입\r\n비대면발열체크기, 세스코공기살균기, 공기청정기\r\n가습기 운영 . 24시간 세콤보안 16대cctv 비상벨운영\r\n초특가 야간권운영','양산스터디카페,양산서창스터디카페,웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디카페','2021-02-02 17:40:13','2022-11-23 12:16:15','인테리어가 이쁘게\r\n넓은좌석,넓은 책상이 눈에띄게\r\n잘부탁드립니다',225,'mc_1612255212',0,0,0,0,0,0,NULL),(115,21,1,60,'남다름스터디카페 체험 모집','v',5,5000,'무료8시간이용권 음료커피제공','2021-02-03','2021-02-09','2021-02-24','16122552141IMG_20200824_220115_740.jpg','1612255214220200824_212037.jpg','1612255214320210116_122859.jpg','1612255215420200827_200138.jpg','01082283472','이것이 프리미엄 스터디카페다\r\n고급스럽고, 편안한 분위기\r\n80평 58좌석으로 넓은 개인공간\r\n코로나방역에 최적화된 전좌석 1인석 운영\r\n좌식, 창가뷰,카페석, 오픈석등 다양한 좌석 타입\r\n비대면발열체크기, 세스코공기살균기, 공기청정기\r\n가습기 운영 . 24시간 세콤보안 16대cctv 비상벨운영\r\n초특가 야간권운영','양산스터디카페,양산서창스터디카페,웅상스터디카페',22000,1,0,31,'24시간 운영','50529','경남 양산시 삼호로 191','4층 남다름스터디카페','2021-02-02 17:40:15','2022-11-22 10:11:50','인테리어가 이쁘게\r\n넓은좌석,넓은 책상이 눈에띄게\r\n잘부탁드립니다',231,'mc_1612255214',0,0,0,0,0,0,NULL),(123,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477168912.jpg',NULL,'1614771689311.jpg','1614771690414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:41:30','2022-11-21 18:41:55','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',171,'mc_1614771689',0,0,0,0,0,0,NULL),(124,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477169712.jpg',NULL,'1614771697311.jpg','1614771698414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:41:38','2021-03-03 20:41:38','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771697',0,0,0,0,0,0,NULL),(125,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477170212.jpg',NULL,'1614771702311.jpg','1614771702414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:41:42','2021-03-03 20:41:42','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771702',0,0,0,0,0,0,NULL),(126,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477170812.jpg',NULL,'1614771708311.jpg','1614771708414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:41:48','2021-03-03 20:41:48','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771708',0,0,0,0,0,0,NULL),(127,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477171312.jpg',NULL,'1614771713311.jpg','1614771713414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:41:53','2021-03-03 20:41:53','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771713',0,0,0,0,0,0,NULL),(128,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477173212.jpg',NULL,'1614771732311.jpg','1614771732414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:42:12','2021-03-03 20:42:12','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771732',0,0,0,0,0,0,NULL),(129,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477175012.jpg',NULL,'1614771750311.jpg','1614771750414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:42:30','2021-03-03 20:42:30','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771750',0,0,0,0,0,0,NULL),(130,22,1,67,'강아지에게 좋은 성분만을 가득담은 \'사랑스러운 멍글멍글 강아지 비누\'','h',10,0,'사랑스러운 멍글멍글 강아지비누 (전신용,발전용 중 택 1)','2021-03-04','2021-03-13','2021-03-29','161477175512.jpg',NULL,'1614771755311.jpg','1614771755414.jpg','010-2221-6418','<전신용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지비누 #강아지목욕 #강아지샴푸추천\r\n\r\n<발전용 비누 키워드> - 제목 및 본문 내 2번이상 언급\r\n#강아지 산책후 발 #강아지발세정제 #강아지발닦기\r\n\r\n<공통키워드> - 본문내 3번 언급\r\n#사랑스러운멍글멍글 #견생샵 #유기견후원\r\n\r\n위의 키워드를 포함하여 사용후기를 포스팅해주시면됩니다,\r\n사용후기 포스팅시 멍글멍글 비누와 댕댕이가 함꼐나온사진을 \r\n반드시 1장 첨부해주셔야합니다','#강아지비누 #강아지목욕 #강아지샴푸추천 #강아지 산책후 발 #강아지발세정제 #강아지발닦기',66000,1,0,NULL,NULL,NULL,NULL,NULL,'2021-03-03 20:42:35','2021-03-03 20:42:35','* 해당 제품은 제품 제공후 먹튀를 방지하기위해 스토어 선결제 후 \r\n포스팅 확인하여 환급해드리는 방식입니다',0,'mc_1614771755',0,0,0,0,0,0,NULL),(134,1,2,53,'테스트 호텔입니다','v',2,5000,'숙박권','2021-10-18','2021-10-15','2021-11-08','16121618851.jpg',NULL,NULL,'16121618854maxresdefault.jpg','블록션 521-4512','리뷰미션입니다','#키워드',0,1,1,36,'오전 12시 이후 ~ 저녁 6시 전까지','03060','서울 종로구 윤보선길 10','201호','2021-10-17 20:20:26','2021-10-18 09:06:39','고고',3,'mc_1634469626',1,1,1,0,1,1100,'mc_1634470080640'),(135,1,3,53,'결제 관련 확인','v',7,5700,'test77','2021-10-18','2021-10-24','2021-11-08','16121360871.jpg','161213581625c6e9828e4337.jpg',NULL,NULL,'조지은 0105251','test77','#시원시원 #최신냉장고',55000,1,0,21,'test','46058','부산 기장군 기장읍 배산로8번길 2','201호','2021-10-17 20:36:30','2021-10-17 20:36:30','test',0,'mc_1634470590',0,0,0,6,0,0,NULL),(136,2,1,52,'123123','h',4,20000,'123','2022-04-19','2022-04-25','2022-05-10','16502626931externalFile(42).jpg','16502626932externalFile(58).jpg',NULL,NULL,'01000000000','01000000000','01000000000',0,1,1,NULL,NULL,NULL,NULL,NULL,'2022-04-18 15:18:13','2022-11-22 18:03:33','01000000000',828,'mc_1650262693',1,1,0,0,0,0,NULL),(143,2,1,52,'132','v',298,0,'123','2022-07-02','2022-07-08','2022-07-23','16566805341bmw_i7.jpg',NULL,NULL,NULL,'123','123','123',0,1,1,37,'123',NULL,'123','123','2022-07-01 22:02:14','2022-11-23 09:11:32','123',433,'mc_1656680534',1,1,0,0,0,0,NULL),(144,2,1,52,'123','v',1,0,'123','2022-07-02','2022-07-08','2022-07-23','16566809121bmw_i7.jpg',NULL,NULL,NULL,'123','123','123',1628000,1,0,37,'123',NULL,'123','123','2022-07-01 22:08:32','2022-07-01 22:08:32','123',0,'mc_1656680912',0,0,0,0,0,0,NULL),(146,2,1,52,'123','h',1,0,'123','2022-08-05','2022-08-11','2022-08-26','165957920911070.jpg',NULL,NULL,NULL,'123','123','123',2728000,1,0,NULL,NULL,NULL,NULL,NULL,'2022-08-04 11:13:29','2022-08-04 11:13:29','123',0,'mc_1659579209',0,0,0,0,0,0,NULL),(149,2,1,81,'아케소 목쿠션','h',5,0,'아케소 목쿠션','2022-11-23','2022-12-16','2023-01-01','16690988301.PNG','16690988302.PNG','166909883032.PNG',NULL,'01056312735','장점과 용도에 맞게 1800자 이상 작성 부탁드립니다.','★ 키워드 ★ 메인키워드(1개, 제목에 삽입) : 아케소, 거북목교정기 세부키워드(5개, 본문에 삽입) : 목보호대, 목깁스, 경추목베개, 맥켄지운동, 목쿠션',0,1,1,NULL,NULL,NULL,NULL,NULL,'2022-11-22 15:33:51','2022-11-23 12:10:52','[장점]\r\n\r\n0. 20년 경력 물리치료사, 카이로프랙터, 선수 재활트레이너가 만든 기능성 목쿠션\r\n\r\n1. 목이 앞으로 숙여지지 않도록 지지해줘서, 거북목 방지 및 목 디스크가 있는 분들도 목 통증 완화에 도움을 줌.\r\n\r\n2. 뒷부분에 ‘코어홀’ 이라는 구멍이 뚫려있어 환기가 잘 되며, 답답하지 않음.\r\n\r\n3. 착용한 상태에서 목을 뒤로 당겨주면서 목 근육 강화 운동(맥켄지 운동)이 가능함. 이 운동은 목 스트레칭이 되면서 목 관련 질환 예방 및 통증 완화에 도움을 줌\r\n\r\n4. 고밀도 메모리폼을 사용해서 꺼짐없이 반영구적으로 사용이 가능함.\r\n\r\n \r\n\r\n[용도]\r\n\r\n1. 이미 목이 굽어서 고민이신 분, 오랫동안 앉아있는 직장인, 집에서 TV나 핸드폰 시청할때, 밤 늦게까지 공부하는 수험생 등 이 회사에서, 집에서 착용하면 바른 자세를 유지하는데 도움을 주며, 목 관련 질환 예방 및 통증 완화에 도움을 주는 제품임.\r\n\r\n2. 장시간 운전 할 때, 또는 버스&기차 탑승 등 대중교통 이용 할때, 여행용 목베개로 사용 가능.',3,'mc_1669098830',1,0,0,0,0,0,NULL),(150,2,1,81,'아케소 허리쿠션','h',5,0,'아케소 허리쿠션','2022-11-23','2022-12-16','2023-01-01','166909898011.PNG','166909898022.PNG','166909898033.PNG','166909898144.PNG','01056312735','장점과 용도에 맞게 1800자 이상으로 작성 부탁드립니다.','메인키워드(1개, 제목에 삽입) : 아케소, 등받이쿠션 세부키워드(5개, 본문에 삽입) : 등쿠션, 허리쿠션, 의자등받이, 의자쿠션',0,1,1,NULL,NULL,NULL,NULL,NULL,'2022-11-22 15:36:21','2022-11-23 12:11:11','[장점]\r\n\r\n0. 20년 경력 물리치료사, 카이로프랙터, 선수 재활트레이너가 만든 사무실 허리쿠션\r\n\r\n1. 구부정한 어깨, 굽어진 등, 통증이 있는 허리에 좋은 기능성 허리쿠션임.\r\n\r\n2. 어깨 받침대와 척추 라인에 따라 척추 돌기가 들어갈 수 있도록 홈이 파져 있어 일반적인 쿠션보다 밀착감이 우수하며 척추 스트레스 감소에 탁월함.\r\n\r\n3. 앉기만 해도 올바른 허리 자세 유지할 수 있도록 돔 형태로 제작\r\n\r\n4. 사람의 척추 모양을 3D 입체 구현하여 제작, 의도하지 않아도 바른자세를 유지를 도움\r\n\r\n5. 허리쿠션 뒤쪽에 2개의 고정 스트랩이 있어서, 대부분의 의자에 단단하게 고정 가능함 (국내 최초 자석버클과 멜빵 스트랩을 함께 사용)\r\n\r\n6. 고밀도 메모리폼을 사용해서 꺼짐없이 반영구적으로 사용이 가능함.\r\n\r\n7. 네이버 구매평점 4.8점으로 사용 후기가 우수함\r\n\r\n8. 라운드숄더 때문에 어깨가 아프시거나, 허리디스크 때문에 허리가 아프신분들께서 허리쿠션 사용 후 증상이 호전되었다는 리뷰를 많이 남겨주심.\r\n\r\n \r\n\r\n[용도]\r\n\r\n1. 멜빵 스트랩으로 의자에 단단하게 고정되는 스타일로, 대부분의 사무용 의자에 착용 가능함.\r\n\r\n2. 식탁 의자 경우에도 등판이 있다면 사용할 수 있음.',1,'mc_1669098980',1,0,0,0,0,0,NULL);
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'맛집'),(2,'생활'),(3,'뷰티'),(4,'숙박'),(5,'디지털'),(6,'유아동'),(7,'식품'),(8,'패션'),(9,'문화'),(10,'도서'),(11,'기타'),(12,'앱 웹');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_plan`
--

DROP TABLE IF EXISTS `category_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_plan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `plan_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_plan_category_id_index` (`category_id`),
  KEY `category_plan_plan_id_index` (`plan_id`),
  CONSTRAINT `category_plan_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_plan_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=520 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_plan`
--

LOCK TABLES `category_plan` WRITE;
/*!40000 ALTER TABLE `category_plan` DISABLE KEYS */;
INSERT INTO `category_plan` VALUES (12,1,18,'2019-11-15 13:32:01','2019-11-15 13:32:01'),(13,2,18,'2019-11-15 13:32:01','2019-11-15 13:32:01'),(14,6,18,'2019-11-15 13:32:01','2019-11-15 13:32:01'),(15,7,18,'2019-11-15 13:32:01','2019-11-15 13:32:01'),(16,8,18,'2019-11-15 13:32:01','2019-11-15 13:32:01'),(17,1,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(18,2,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(19,3,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(20,4,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(21,5,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(22,6,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(23,7,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(24,8,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(25,9,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(26,10,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(27,11,20,'2019-11-17 15:34:16','2019-11-17 15:34:16'),(28,1,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(29,2,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(30,5,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(31,9,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(32,10,21,'2019-11-17 20:37:40','2019-11-17 20:37:40'),(33,1,24,'2019-11-18 03:36:16','2019-11-18 03:36:16'),(34,3,24,'2019-11-18 03:36:16','2019-11-18 03:36:16'),(35,8,24,'2019-11-18 03:36:16','2019-11-18 03:36:16'),(36,1,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(37,2,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(38,3,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(39,7,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(40,8,25,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(41,1,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(42,2,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(43,3,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(44,4,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(45,5,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(46,6,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(47,7,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(48,8,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(49,9,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(50,10,27,'2019-11-19 03:44:35','2019-11-19 03:44:35'),(51,1,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(52,2,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(53,3,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(54,4,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(55,5,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(56,6,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(57,7,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(58,8,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(59,9,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(60,10,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(61,11,28,'2019-11-19 11:44:05','2019-11-19 11:44:05'),(62,1,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(63,2,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(64,3,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(65,4,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(66,7,30,'2019-11-19 23:14:08','2019-11-19 23:14:08'),(72,1,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(73,2,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(74,3,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(75,4,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(76,5,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(77,6,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(78,7,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(79,8,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(80,9,37,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(81,1,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(82,2,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(83,3,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(84,4,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(85,5,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(86,6,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(87,7,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(88,8,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(89,9,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(90,10,38,'2019-11-20 11:45:28','2019-11-20 11:45:28'),(91,1,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(92,2,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(93,4,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(94,7,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(95,8,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(96,9,39,'2019-11-20 15:07:03','2019-11-20 15:07:03'),(97,1,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(98,2,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(99,4,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(100,5,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(101,6,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(102,7,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(103,9,40,'2019-11-21 02:27:27','2019-11-21 02:27:27'),(107,1,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(108,2,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(109,3,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(110,4,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(111,5,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(112,8,44,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(113,1,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(114,2,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(115,3,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(116,4,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(117,5,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(118,7,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(119,8,45,'2019-11-23 05:29:05','2019-11-23 05:29:05'),(120,1,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(121,2,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(122,3,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(123,5,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(124,7,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(125,8,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(126,9,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(127,10,46,'2019-11-23 11:11:32','2019-11-23 11:11:32'),(128,1,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(129,2,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(130,3,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(131,4,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(132,5,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(133,6,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(134,7,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(135,8,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(136,9,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(137,10,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(138,11,47,'2019-11-25 13:57:35','2019-11-25 13:57:35'),(139,1,48,'2019-11-25 19:20:17','2019-11-25 19:20:17'),(140,2,48,'2019-11-25 19:20:17','2019-11-25 19:20:17'),(141,3,48,'2019-11-25 19:20:17','2019-11-25 19:20:17'),(142,11,48,'2019-11-25 19:20:17','2019-11-25 19:20:17'),(143,1,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(144,2,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(145,3,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(146,4,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(147,6,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(148,7,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(149,8,49,'2019-11-25 23:49:04','2019-11-25 23:49:04'),(150,1,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(151,2,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(152,3,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(153,4,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(154,6,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(155,7,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(156,9,50,'2019-11-26 00:48:30','2019-11-26 00:48:30'),(157,1,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(158,2,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(159,3,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(160,4,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(161,5,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(162,6,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(163,7,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(164,8,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(165,9,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(166,10,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(167,11,51,'2019-11-26 02:03:01','2019-11-26 02:03:01'),(175,1,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(176,2,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(177,3,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(178,4,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(179,5,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(180,7,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(181,9,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(182,10,56,'2019-11-27 00:53:36','2019-11-27 00:53:36'),(183,1,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(184,2,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(185,3,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(186,4,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(187,5,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(188,7,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(189,8,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(190,9,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(191,10,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(192,11,58,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(193,1,59,'2019-11-28 23:46:11','2019-11-28 23:46:11'),(194,5,59,'2019-11-28 23:46:11','2019-11-28 23:46:11'),(195,10,59,'2019-11-28 23:46:11','2019-11-28 23:46:11'),(196,1,60,'2019-12-01 21:14:33','2019-12-01 21:14:33'),(197,3,60,'2019-12-01 21:14:33','2019-12-01 21:14:33'),(198,4,60,'2019-12-01 21:14:33','2019-12-01 21:14:33'),(199,1,61,'2019-12-02 01:14:23','2019-12-02 01:14:23'),(200,2,61,'2019-12-02 01:14:23','2019-12-02 01:14:23'),(201,4,61,'2019-12-02 01:14:23','2019-12-02 01:14:23'),(202,6,61,'2019-12-02 01:14:23','2019-12-02 01:14:23'),(203,9,61,'2019-12-02 01:14:23','2019-12-02 01:14:23'),(204,1,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(205,5,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(206,7,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(207,8,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(208,9,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(209,10,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(210,11,62,'2019-12-07 18:36:38','2019-12-07 18:36:38'),(211,1,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(212,2,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(213,3,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(214,5,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(215,7,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(216,8,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(217,9,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(218,11,63,'2019-12-10 19:30:29','2019-12-10 19:30:29'),(219,1,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(220,2,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(221,3,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(222,4,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(223,8,64,'2019-12-10 21:18:25','2019-12-10 21:18:25'),(224,1,66,'2019-12-13 16:42:45','2019-12-13 16:42:45'),(225,2,66,'2019-12-13 16:42:45','2019-12-13 16:42:45'),(226,4,66,'2019-12-13 16:42:45','2019-12-13 16:42:45'),(227,9,66,'2019-12-13 16:42:45','2019-12-13 16:42:45'),(228,1,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(229,2,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(230,4,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(231,7,67,'2019-12-16 00:51:00','2019-12-16 00:51:00'),(232,1,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(233,2,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(234,3,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(235,4,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(236,5,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(237,6,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(238,7,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(239,8,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(240,9,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(241,10,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(242,11,70,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(243,1,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(244,2,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(245,3,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(246,4,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(247,5,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(248,7,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(249,8,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(250,9,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(251,10,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(252,11,71,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(253,1,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(254,2,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(255,3,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(256,4,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(257,6,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(258,8,72,'2020-01-02 18:26:45','2020-01-02 18:26:45'),(259,1,73,'2020-01-06 21:38:59','2020-01-06 21:38:59'),(260,2,73,'2020-01-06 21:38:59','2020-01-06 21:38:59'),(261,3,73,'2020-01-06 21:38:59','2020-01-06 21:38:59'),(262,4,73,'2020-01-06 21:38:59','2020-01-06 21:38:59'),(263,5,73,'2020-01-06 21:38:59','2020-01-06 21:38:59'),(264,1,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(265,2,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(266,3,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(267,4,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(268,5,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(269,7,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(270,8,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(271,9,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(272,10,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(273,11,75,'2020-01-10 13:17:00','2020-01-10 13:17:00'),(274,1,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(275,2,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(276,3,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(277,4,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(278,5,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(279,6,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(280,7,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(281,8,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(282,9,76,'2020-01-13 19:33:42','2020-01-13 19:33:42'),(283,1,77,'2020-01-14 23:09:11','2020-01-14 23:09:11'),(284,2,77,'2020-01-14 23:09:11','2020-01-14 23:09:11'),(285,3,77,'2020-01-14 23:09:11','2020-01-14 23:09:11'),(286,6,77,'2020-01-14 23:09:11','2020-01-14 23:09:11'),(287,7,77,'2020-01-14 23:09:11','2020-01-14 23:09:11'),(288,2,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(289,3,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(290,7,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(291,8,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(292,10,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(293,11,78,'2020-01-16 09:21:13','2020-01-16 09:21:13'),(294,1,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(295,2,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(296,4,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(297,5,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(298,7,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(299,8,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(300,9,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(301,11,80,'2020-02-09 19:43:11','2020-02-09 19:43:11'),(307,1,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(308,2,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(309,3,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(310,5,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(311,8,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(312,11,83,'2020-03-22 03:51:17','2020-03-22 03:51:17'),(319,1,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(320,2,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(321,7,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(322,8,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(323,9,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(324,10,84,'2020-04-03 15:44:04','2020-04-03 15:44:04'),(365,1,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(366,2,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(367,9,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(368,10,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(369,12,87,'2020-05-26 20:44:33','2020-05-26 20:44:33'),(398,1,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(399,2,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(400,4,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(401,5,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(402,8,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(403,9,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(404,12,86,'2020-06-18 14:13:47','2020-06-18 14:13:47'),(414,1,89,'2020-07-24 17:04:36','2020-07-24 17:04:36'),(415,4,89,'2020-07-24 17:04:36','2020-07-24 17:04:36'),(416,5,89,'2020-07-24 17:04:36','2020-07-24 17:04:36'),(424,1,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(425,2,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(426,3,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(427,4,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(428,7,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(429,8,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(430,11,90,'2020-07-29 21:50:50','2020-07-29 21:50:50'),(458,1,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(459,2,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(460,3,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(461,4,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(462,5,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(463,6,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(464,7,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(465,8,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(466,9,91,'2020-08-09 20:54:24','2020-08-09 20:54:24'),(467,1,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(468,2,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(469,3,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(470,4,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(471,5,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(472,7,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(473,8,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(474,9,92,'2020-09-10 12:19:05','2020-09-10 12:19:05'),(475,1,96,'2020-12-29 18:01:22','2020-12-29 18:01:22'),(476,3,96,'2020-12-29 18:01:22','2020-12-29 18:01:22'),(477,8,96,'2020-12-29 18:01:22','2020-12-29 18:01:22'),(483,1,97,'2021-02-02 12:45:59','2021-02-02 12:45:59'),(484,2,97,'2021-02-02 12:45:59','2021-02-02 12:45:59'),(485,3,97,'2021-02-02 12:45:59','2021-02-02 12:45:59'),(486,5,97,'2021-02-02 12:45:59','2021-02-02 12:45:59'),(487,12,97,'2021-02-02 12:45:59','2021-02-02 12:45:59'),(488,1,98,'2021-02-02 16:31:19','2021-02-02 16:31:19'),(489,2,98,'2021-02-02 16:31:19','2021-02-02 16:31:19'),(490,3,98,'2021-02-02 16:31:19','2021-02-02 16:31:19'),(491,7,98,'2021-02-02 16:31:19','2021-02-02 16:31:19'),(492,1,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(493,2,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(494,3,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(495,7,99,'2021-02-02 16:39:56','2021-02-02 16:39:56'),(496,1,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(497,2,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(498,3,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(499,4,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(500,5,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(501,7,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(502,8,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(503,9,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(504,10,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(505,11,101,'2021-02-02 16:48:53','2021-02-02 16:48:53'),(509,1,85,'2021-02-09 13:48:52','2021-02-09 13:48:52'),(510,2,85,'2021-02-09 13:48:52','2021-02-09 13:48:52'),(511,9,85,'2021-02-09 13:48:52','2021-02-09 13:48:52'),(512,1,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(513,2,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(514,3,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(515,4,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(516,5,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(517,7,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(518,8,107,'2021-08-13 14:58:02','2021-08-13 14:58:02'),(519,12,107,'2021-08-13 14:58:02','2021-08-13 14:58:02');
/*!40000 ALTER TABLE `category_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_reviewers`
--

DROP TABLE IF EXISTS `channel_reviewers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel_reviewers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) unsigned DEFAULT NULL,
  `reviewer_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `channel_reviewers_channel_id_foreign` (`channel_id`),
  KEY `channel_reviewers_reviewer_id_foreign` (`reviewer_id`),
  CONSTRAINT `channel_reviewers_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `channel_reviewers_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel_reviewers`
--

LOCK TABLES `channel_reviewers` WRITE;
/*!40000 ALTER TABLE `channel_reviewers` DISABLE KEYS */;
INSERT INTO `channel_reviewers` VALUES (1,1,11,'bloxion'),(3,1,23,'rkdwjd1007'),(4,1,24,'zanne1218'),(5,1,37,'ps717942'),(6,1,39,'bbabba77'),(7,1,40,'wanna_be7777'),(8,1,42,'cpahaja'),(9,1,43,'dannymam'),(10,1,44,'joan2201'),(11,1,45,'princenoa'),(12,1,46,'dbsa8439'),(13,1,47,'goodnabi0'),(14,1,50,'truelove7712'),(15,1,51,'choi__bb'),(16,1,54,'coco5154'),(17,1,57,'nrg_zzwl6434'),(18,1,60,'soop_e'),(19,1,61,'mrp'),(20,1,66,'kissmint333'),(21,1,67,'rin_hun315'),(22,1,69,'genie_y_'),(23,1,70,'gkqls879'),(24,1,71,'yahmi07'),(25,1,72,'zxcv0922'),(26,1,73,'leehoney_g'),(27,1,74,'edwin9407'),(28,1,75,'jjwlgus78'),(29,1,76,'baejji4612'),(30,1,77,'sb0606'),(31,1,78,'sb0606'),(32,1,79,'wlswn502'),(33,1,80,'dbsel88'),(34,1,81,'oioio11'),(35,1,83,'lsszz210'),(36,1,84,'gytmd3412'),(37,1,85,'lovablj'),(38,1,87,'theboss005'),(39,1,91,'ssouil'),(40,1,92,'ctrlz88'),(41,1,93,'mimoa88'),(42,1,94,'taehomon'),(43,1,96,'nazi_day'),(44,1,97,'nazi_day'),(45,1,100,'sexy_bom'),(46,1,101,'dlahrwl'),(47,1,102,'ahnjiae2'),(48,1,104,'zzksylove'),(49,1,106,'fungji'),(50,1,107,'nuri527'),(51,1,108,'ㅣ'),(52,1,109,'choinuri01'),(53,1,110,'rjhzzz'),(54,1,114,'mous03'),(55,1,115,'remiyo79'),(56,1,116,'tpgml1004_'),(57,1,117,'cutesiwoo'),(58,1,118,'emflal02'),(59,1,120,'juupapa'),(60,1,121,'ce001121'),(61,1,125,'yoonhee_93'),(62,1,127,'namgyu08'),(63,1,129,'over_shoulder'),(64,5,42,'cpahaja'),(65,5,107,'nuri527'),(66,5,117,'cutesiwoo'),(67,5,118,'emflal02'),(68,2,17,'pungyo_mam'),(69,2,18,'sohee._.s2'),(70,2,19,'jjun2_mam'),(71,2,20,'hyejin3685'),(72,2,21,'haruh4'),(73,2,23,'min__dyong'),(74,2,24,'pr252nt'),(75,2,25,'geni_0316'),(76,2,27,'muk._.sarah'),(77,2,28,'poun_ding_0430'),(78,2,29,'new_seul'),(79,2,30,'_bongyeosa'),(80,2,31,'1.fine'),(81,2,34,'z.y.e.o.n'),(82,2,36,'sung_narae'),(83,2,37,'ps717942'),(84,2,38,'hiit1004'),(85,2,39,'honeydoong'),(86,2,42,'ssingatv'),(87,2,43,'dahyun.song'),(88,2,45,'joohyunha_noa'),(89,2,46,'reum_eat.again'),(90,2,47,'aurora_kim00'),(91,2,50,'mylove7712'),(92,2,51,'choi__bb'),(93,2,52,'BC ICBS'),(94,2,55,'kong.sta'),(95,2,56,'gauni____4'),(96,2,60,'Nohsoup_'),(97,2,61,'saie.log'),(98,2,63,'0g.__.h0'),(99,2,64,'pinkfox_5'),(100,2,65,'jomozzi'),(101,2,66,'gorgeous_om'),(102,2,67,'rin_hun315'),(103,2,69,'genie.yoon'),(104,2,70,'bean_tory'),(105,2,72,'kkongbabypapa'),(106,2,73,'leehoney_g'),(107,2,77,'soobok.kim'),(108,2,78,'soobok.kim'),(109,2,79,'songpearl0506'),(110,2,81,'rangyu.me'),(111,2,82,'mjpro0715'),(112,2,84,'kims.love'),(113,2,85,'luv_ruka'),(114,2,88,'KYUNG EUN'),(115,2,89,'KYUNG EUN'),(116,2,91,'borigoing'),(117,2,92,'yesdoitcat'),(118,2,93,'morrie_ksj'),(119,2,95,'leealim90'),(120,2,96,'nazi_day'),(121,2,97,'nazi_day'),(122,2,99,'98_taeng_128'),(123,2,100,'ab_s_90'),(125,2,104,'soon_d_'),(126,2,105,'ssunysta'),(127,2,106,'lune.sj'),(128,2,107,'onnuri0527'),(129,2,109,'cloud_0704'),(130,2,110,'byuzoo'),(131,2,112,'ub_lash'),(132,2,115,'chinsj'),(133,2,116,'heeinsta'),(134,2,117,'cutesiwoo'),(135,2,118,'mirine_02'),(136,2,121,'lovely_eun__c'),(137,2,127,'gyuseon87'),(138,2,129,'o_o.overshoulder'),(139,4,42,'UCGU6Ij7IvD7Dr5CfGkXOSsg'),(140,4,45,'UCW8rtF6agolWJWt6tSxj_sQ'),(141,4,107,'onnuri0527'),(142,4,129,'UCOjXmBghFRVM0Q8TZ-8aCLQ'),(143,3,42,'ssingatv'),(144,3,50,'truelove7712'),(145,3,79,'songpearl0506'),(146,3,95,'01079333866'),(147,3,107,'nuri527'),(148,3,121,'찬은'),(149,6,17,'34sea31'),(150,6,21,'34sea31'),(151,6,42,'_IMiWm'),(152,6,50,'truelove7712'),(153,6,79,'wlswn502'),(154,6,85,'luv_ruka'),(155,2,130,'sh5717'),(156,1,132,'history201'),(157,1,133,'adong'),(158,2,134,'valyoon_kr'),(159,2,135,'seo0_v'),(160,4,137,'UCpPPdP2aSm87a6vQmy-tfEA?view_as=subscriber'),(161,1,139,'kenshin209'),(162,4,139,'UCNAC0hL4ruA04W4OarjSjcQ?view_as=subscriber'),(163,2,142,'kpmj11'),(164,4,142,'UC9XKUivLQCVI2As3MRbpikw'),(165,1,144,'remixremix'),(166,1,145,'chosaehee'),(167,1,146,'waj129'),(168,2,146,'joyjoyjo__real'),(169,2,149,'lucky_beompd'),(170,4,149,'UC5I85er2asLDFv0iRvq-LMA'),(171,1,150,'madessong'),(172,2,150,'madessong'),(173,1,151,'dlthgus941221'),(174,2,151,'thgus941221'),(175,3,151,'thgus941221'),(176,1,152,'kimjisu037'),(177,1,153,'agadingo'),(178,2,153,'22in22'),(179,3,153,'agadingo'),(180,4,153,'UC2TPQFt2lhGgVPwuWFCKg8g?view_as=subscriberhttps%3A%2F%2Fwww.youtube.com%2Fchannel%2FUC2TPQFt2lhGgVPwuWFCKg8g%3Fview_as%3Dsubscriber'),(181,6,153,'agadingo'),(182,4,155,'홍콩백수'),(183,1,156,'sunsun900'),(184,2,156,'longbeaute_k'),(185,4,156,'UCbGv3Zh5uKS95IgFBHFIUfg'),(186,1,157,'jungin15'),(187,4,157,'UCVnjF3Uf9Qm8fgz-R4v-sYA'),(188,1,158,'ekejaqlsek'),(189,2,158,'sarnai_beauty'),(190,4,158,'UCWohPFGHNprYwPOwvKlUxyQ?view_as=subscriber'),(191,1,159,'http://blog.naver.com/ddaa104'),(192,4,159,'UC0iBZDnAoASyPj7HFccIJeA'),(193,1,160,'turtle0'),(194,5,160,'turtle0123'),(195,1,161,'www.lovinj.com'),(196,4,161,'https://www.youtube.com/channel/UCBrCIFTwliV-GX90CeCHqFQ?view_as=subscriber'),(197,1,162,'moonsasang'),(198,2,162,'mk4u0823'),(199,4,162,'UChXovfpr7qN9IDuVzU1505Q'),(200,1,163,'arsong89'),(201,2,163,'aram.song/'),(202,4,163,'UCvJfOMcZUGy30m_axrD78pg'),(204,1,166,'fndps14'),(205,1,168,'https://blog.naver.com/joy3906'),(206,2,169,'cheairy'),(207,4,169,'bolmi'),(208,2,170,'allaechan'),(209,2,171,'gpiratee'),(210,4,171,'https://www.youtube.com/channel/UC9LjtLeAmTQznLreaD4X4gg'),(211,2,173,'xhfhxhfh'),(212,1,174,'https://m.blog.naver.com/minji3757'),(213,6,174,'https://m.blog.naver.com/PostView.nhn?blogId=minji3757&logNo=221431425883&navType=tl'),(214,1,175,'djffkdid1222'),(215,2,175,'sysysysy1222'),(216,4,175,'UCTelSzFlc0TSZtJDnPbRKMQ'),(217,1,176,'sukjh97'),(218,2,176,'jae___heee'),(219,4,177,'stormkfilm'),(220,1,178,'jinlook'),(221,2,178,'jinlook'),(222,3,178,'jinlook'),(223,4,178,'soonjalook'),(224,6,178,'jinlook'),(225,1,179,'rlathdms96'),(226,1,180,'kimhan9430'),(227,2,180,'hanujangin_'),(228,4,180,'UCnfGznL0IYQRKkchWTkM2aA'),(229,1,183,'https://mjmj0085.blog.me/'),(230,2,183,'ming_0530'),(231,1,184,'style_lish89'),(232,2,184,'hi_sunny1228'),(233,2,185,'58beongapoca'),(234,2,186,'S.__.vly'),(235,2,187,'https://www.instagram.com/_ho_oo/'),(236,4,187,'https://www.youtube.com/channel/UCiDY62LQ4ZSzWjXI5mQooGQ?view_as=subscriber'),(237,1,188,'nimoforever'),(238,2,188,'themilk89'),(239,1,189,'peregrination_h'),(240,1,191,'sem_live'),(241,2,193,'yuriminng_lee'),(242,1,194,'gml61'),(243,2,194,'mini._.jeong'),(244,1,195,'crew_and'),(245,2,196,'miha2649'),(246,1,197,'https://blog.naver.com/pam6359'),(247,1,198,'sophkyo'),(248,2,198,'soph_kyo'),(249,3,198,'sophia880422'),(250,4,198,'kkaoli'),(251,1,199,'sig7955'),(252,2,199,'icaneatforyou'),(253,3,199,'icaneatforyou'),(254,4,199,'sikitv'),(255,1,200,'https://elfland1004.blog.me/'),(256,1,201,'socool8887'),(257,2,201,'i_am_bella2'),(258,3,201,'i_am_bella2'),(259,4,201,'UC4NwL_v52t93PRwPp06MEVA'),(260,1,202,'gustndi48'),(261,2,202,'gustndi48'),(262,2,203,'beanfxcd'),(263,2,204,'polias_zeromax/'),(264,3,204,'zeromaxXpolias/'),(265,1,205,'bluesearch'),(266,2,205,'KKoKKoDak2017'),(267,4,205,'UCxsbwXx3ivzEH_8l2xSR3iw?view_as=subscriber'),(268,1,206,'cosy_day'),(269,1,207,'six_young'),(270,2,207,'luv_yiuyiu'),(271,4,207,'UCaTzfVZ4d6Mbx4de0NoHmkQ?view_as=subscriber'),(272,4,208,'UCHMqG-C-Ob4I1-9T649uQJw?view_as=subscriber'),(273,1,210,'pjj412'),(274,2,210,'jinju_nabaki'),(275,4,210,'UCzBN2UpdTiN3KFNJbeDZdrg'),(276,1,211,'askges20'),(277,2,211,'_garam_ing'),(278,4,211,'UCoa1MArDnj0c2ZbsGUGenJw'),(279,1,212,'happymoon315'),(280,2,212,'romance_dal'),(281,4,212,'UCOTIn7TdAVE9YkfG5X5OnwA?view_as=subscriber'),(282,1,214,'hksports_kr'),(283,3,214,'han'),(284,4,214,'powermedusa'),(285,2,218,'moon_41489'),(286,1,219,'myjiyung33'),(287,2,219,'fitlife_ceo'),(288,2,132,'history2020'),(289,1,220,'friends_jjong'),(290,2,220,'friends_jjong'),(291,1,221,'wwwi002'),(292,4,221,'UCVRZzg7KWTf8NN3fqx7swhA?view_as=subscriber'),(293,1,222,'xmoix0'),(294,2,222,'xmoix0'),(295,1,225,'702story'),(296,2,225,'702story'),(297,3,225,'702story'),(298,4,225,'702story'),(299,5,225,'702story'),(300,6,225,'702story'),(301,1,226,'abcdef2651'),(303,1,229,'stopthe1'),(304,2,229,'stopthe1'),(305,3,229,'thomsontv'),(306,4,229,'UCjdtJTIpHyfSnt4_7hjptdg'),(307,2,230,'bbo.world'),(308,1,231,'tpsxj9'),(310,2,231,'ggamccc'),(311,1,4,'zhongguoxue8'),(312,1,232,'saeyan2477'),(313,2,232,'saeyan_kim'),(316,3,132,'history2020'),(317,2,4,'zhaorongwan'),(318,3,4,'zhaorongwan'),(319,4,4,'-'),(320,5,4,'-'),(321,6,4,'-'),(322,2,233,'ju._.vely__'),(323,1,235,'rkdus1541'),(324,2,235,'gaaa__yeon'),(325,2,236,'banybanybanybanycarrotcarrot'),(326,1,237,'https://blog.naver.com/friends_hill'),(327,1,238,'rgw417'),(328,2,238,'bori__jung'),(329,2,239,'ssunnoo_'),(330,2,240,'baek2098'),(331,1,241,'cateyepark'),(332,2,241,'Zal.s2'),(333,1,242,'alsgnl7@naver.com'),(334,2,242,'minhwi_te'),(335,2,243,'edge.11s'),(336,1,244,'pulum03'),(337,1,245,'jhyeonkim'),(338,1,246,'staybystay'),(339,2,246,'staybystayj'),(340,2,247,'daystar_erina'),(341,2,249,'https://instagram.com/g_river731?igshid=1m5gkwyxyrh03'),(342,1,250,'6bztm3fb3mn6'),(343,1,252,'smile0776'),(344,2,252,'cute0829'),(345,3,252,'smile0776'),(346,6,252,'smile0776'),(347,1,253,'stableyoung'),(348,1,255,'saeami__'),(349,2,255,'saeami__'),(350,1,256,'vzlzl94'),(351,2,256,'_vzl.zl'),(352,1,257,'hahayoon89'),(353,2,257,'___invely'),(354,1,258,'khyang37'),(355,2,258,'dan_miii_'),(356,4,258,'UC0zHk_Pk9dykSPUHI4LMT_A https://m.youtube.com/channel/UC0zHk_Pk9dykSPUHI4LMT_A'),(357,1,260,'anthdbfbs'),(358,2,260,'lovely_dungnsong'),(359,1,261,'ginajelee'),(360,1,262,'https://blog.naver.com/yudai04'),(361,2,262,'https://www.instagram.com/Yu_Da_Hee'),(362,3,262,'https://www.facebook.com/profile.php?id=100045148390939'),(363,4,262,'https://www.youtube.com/channel/UCtVIXGbDRRhEs5vTEh2WI3Q'),(365,1,264,'rlaslawl0414'),(366,2,264,'chocowoou_poodles'),(367,1,265,'ehs2gh'),(368,2,265,'jueong1725'),(369,1,266,'darkcgi'),(370,2,267,'mina_choi_93'),(371,1,268,'xo19xo'),(372,2,268,'rsrs._.kk'),(373,2,269,'ksyoung2000'),(374,1,271,'lymkje0331'),(375,2,271,'kje0603');
/*!40000 ALTER TABLE `channel_reviewers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channels`
--

LOCK TABLES `channels` WRITE;
/*!40000 ALTER TABLE `channels` DISABLE KEYS */;
INSERT INTO `channels` VALUES (1,'네이버블로그','https://blog.naver.com/'),(2,'인스타그램','https://www.instagram.com/'),(3,'페이스북','https://www.facebook.com/'),(4,'유튜브','https://www.youtube.com/channel/'),(5,'네이버포스트','https://post.naver.com/'),(6,'카카오스토리','https://story.kakao.com/');
/*!40000 ALTER TABLE `channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_id` bigint(20) unsigned DEFAULT NULL,
  `advertiser_id` bigint(20) unsigned DEFAULT NULL,
  `community_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_reviewer_id_foreign` (`reviewer_id`),
  KEY `comments_advertiser_id_foreign` (`advertiser_id`),
  KEY `comments_community_id_index` (`community_id`),
  CONSTRAINT `comments_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_community_id_foreign` FOREIGN KEY (`community_id`) REFERENCES `communities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,253,NULL,1,'저도 그래요.','2021-05-03 11:18:23','2021-05-03 11:18:23');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communities`
--

DROP TABLE IF EXISTS `communities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_id` bigint(20) unsigned DEFAULT NULL,
  `advertiser_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT '1',
  `view_count` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `communities_reviewer_id_foreign` (`reviewer_id`),
  KEY `communities_advertiser_id_foreign` (`advertiser_id`),
  CONSTRAINT `communities_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `communities_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communities`
--

LOCK TABLES `communities` WRITE;
/*!40000 ALTER TABLE `communities` DISABLE KEYS */;
INSERT INTO `communities` VALUES (1,133,NULL,'제가 처음 글을 쓰네요','반갑습니다! 리뷰에 대한 많은 정보를 나누고 싶어요!','2019-11-28 23:49:47','2022-11-23 03:33:43',1,916,NULL),(2,132,NULL,'test 글쓰기','테스트로 글을 씁니다!','2020-02-21 15:06:10','2020-02-21 15:24:22',1,3,'2020-02-21 15:24:22'),(3,NULL,2,'화이팅!','화이팅팅!','2020-03-05 15:27:15','2020-03-05 15:27:19',1,1,'2020-03-05 15:27:19'),(4,231,NULL,'곧 오픈한다고 하네요!','이런 상황에 체험단 얼른 이용하고 싶네요 ㅠㅠ','2020-05-28 11:44:37','2020-06-18 14:40:07',1,45,'2020-06-18 14:40:07'),(5,NULL,15,'ㅇㄴㅇㄴ','ㄹㄴㅇㄴㅇㅁㄹ','2020-06-22 16:42:26','2020-06-22 16:43:16',1,5,'2020-06-22 16:43:16');
/*!40000 ALTER TABLE `communities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` bigint(20) unsigned NOT NULL,
  `account_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reviewer_id` bigint(20) unsigned DEFAULT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `deposits_bank_id_foreign` (`bank_id`),
  KEY `deposits_reviewer_id_foreign` (`reviewer_id`),
  CONSTRAINT `deposits_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `deposits_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exposures`
--

DROP TABLE IF EXISTS `exposures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exposures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `instruction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_waiver` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exposures`
--

LOCK TABLES `exposures` WRITE;
/*!40000 ALTER TABLE `exposures` DISABLE KEYS */;
INSERT INTO `exposures` VALUES (1,'플래티넘',15000,12,'체험단 캠페인이 <strong>최상단에 노출</strong>되어 다른 캠페인보다 더욱 많이 노출됩니다.',0),(2,'프라임',10000,15,'체험단 캠페인이 <strong>상단에 노출</strong>되어 다른 캠페인보다 더욱 많이 노출됩니다.',0),(3,'그랜드',5000,20,'체험단 캠페인이 <strong>중단에 노출</strong>되어 다른 캠페인보다 더욱 많이 노출됩니다.',1);
/*!40000 ALTER TABLE `exposures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_banners`
--

DROP TABLE IF EXISTS `main_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `main_banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_banners`
--

LOCK TABLES `main_banners` WRITE;
/*!40000 ALTER TABLE `main_banners` DISABLE KEYS */;
INSERT INTO `main_banners` VALUES (12,'1640588874KakaoTalk_20211227_160339902.jpg','https://www.notion.so/9fa50ad8157b479dbe37a4c3211d53af'),(13,'1640591437KakaoTalk_20211227_163809575.jpg','https://www.notion.so/a637a4e5833e45238d00d624b067a71f'),(19,'1640588886KakaoTalk_20211227_160340263.jpg','https://www.notion.so/26997645e50642bd932910702914ffcd');
/*!40000 ALTER TABLE `main_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertiser_id` bigint(20) unsigned NOT NULL,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `from_ad` tinyint(1) NOT NULL,
  `new` tinyint(1) NOT NULL DEFAULT '1',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campaign_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_advertiser_id_foreign` (`advertiser_id`),
  KEY `messages_reviewer_id_foreign` (`reviewer_id`),
  KEY `messages_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `messages_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`),
  CONSTRAINT `messages_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`),
  CONSTRAINT `messages_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,132,1,0,'채팅을 입력합니다','2021-02-01 09:02:55','2021-02-01 15:23:05',83),(2,1,132,0,0,'입력이 잘 되는지 확인','2021-02-01 09:03:36','2021-02-01 15:26:35',83),(3,1,132,0,0,'채팅이 될까요?','2021-02-01 09:04:13','2021-02-01 15:26:35',83),(4,1,132,1,0,'채팅은 다행히 아주 잘 됩니다','2021-02-01 09:04:28','2021-02-01 15:23:05',83),(5,1,132,1,0,'채팅은 잘 되는데 왜??','2021-02-01 13:06:38','2021-02-01 15:23:05',83),(6,1,132,0,0,'한번더 입력할게요','2021-02-01 15:13:54','2021-02-01 15:26:35',83),(7,1,132,0,0,'더 길어지면','2021-02-01 15:21:04','2021-02-01 15:26:35',83),(8,1,132,0,0,'입력','2021-02-01 15:23:29','2021-02-01 15:26:35',83),(9,2,4,1,0,'안녕하세요','2021-02-05 11:02:01','2021-02-06 17:55:26',82),(10,2,4,1,0,'배송 잘 되었나요?','2021-02-05 11:02:04','2021-02-06 17:55:26',82),(11,2,4,0,0,'ㅇㅇ','2021-02-05 11:03:16','2022-01-18 16:35:40',82),(12,2,4,1,0,'ㅎㅇ','2021-02-05 11:03:39','2021-02-06 17:55:26',82),(13,2,4,0,0,'넵 ^^ 좋은제품 잘 받았습니다!','2021-02-06 17:55:42','2022-01-18 16:35:40',82);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `middle_banners`
--

DROP TABLE IF EXISTS `middle_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `middle_banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `middle_banners`
--

LOCK TABLES `middle_banners` WRITE;
/*!40000 ALTER TABLE `middle_banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `middle_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_09_18_052953_create_reviewers_table',1),(4,'2019_09_18_064716_create_advertisers_table',1),(5,'2019_09_18_085906_create_categories_table',1),(6,'2019_09_18_085934_create_brands_table',1),(7,'2019_09_25_010515_create_communities_table',1),(8,'2019_10_09_121429_add_point_to_reviewers_table',2),(9,'2019_10_09_122246_add_point_to_advertisers_table',2),(10,'2019_10_10_053643_create_channels_table',2),(11,'2019_10_10_053902_create_regions_table',2),(12,'2019_10_10_053940_create_areas_table',2),(13,'2019_10_10_054046_create_campaigns_table',2),(14,'2019_10_10_070325_drop_noti_view_to_brands_table',2),(15,'2019_10_11_013838_create_exposures_table',2),(16,'2019_10_11_014740_create_promotions_table',2),(17,'2019_10_11_015005_create_campaign_exposure_table',2),(18,'2019_10_11_015034_create_campaign_promotion_table',2),(19,'2019_10_28_170031_create_campaign_reviewers_table',2),(20,'2019_10_29_125355_add_etc_to_campaigns_table',2),(21,'2019_11_06_213959_create_plans_table',3),(22,'2019_11_07_110156_create_area_plan_table',3),(23,'2019_11_07_110253_create_category_plan_table',3),(24,'2019_11_13_191117_add_view_count_to_campaigns',4),(25,'2019_11_13_202210_add_arraynum_to_regions',4),(26,'2019_11_15_093816_create_admin_table',5),(27,'2019_11_17_155948_create_reviews_table',5),(28,'2019_11_17_160156_create_bookmarks_table',5),(29,'2019_11_17_160340_create_advertiser_plans_table',5),(30,'2019_11_17_160604_create_qcategories_table',5),(31,'2019_11_17_160605_create_onetoones_table',5),(32,'2019_11_17_160717_create_advertiser_faq_cates_table',5),(33,'2019_11_17_160833_create_advertiser_faqs_table',5),(34,'2019_11_17_160910_create_notices_table',5),(35,'2019_11_17_163318_create_reviewer_faq_cates_table',5),(36,'2019_11_17_163349_create_reviewer_faqs_table',5),(37,'2019_11_18_115007_create_points_table',5),(38,'2019_11_18_130410_create_banks_table',5),(39,'2019_11_18_130415_create_deposits_table',5),(40,'2019_11_26_214110_create_comments_table',5),(41,'2019_11_27_134458_create_channel_reviewers_table',5),(42,'2019_11_27_142535_drop_sns_to_reviewers_table',5),(43,'2019_12_18_142841_create_agencies_table',6),(44,'2020_01_15_101458_create_reviewer_suggestions_table',7),(45,'2020_02_04_113905_add_merchant_to_campaigns_table',7),(46,'2020_02_13_141052_add_code_to_banks_table',8),(47,'2020_02_13_165741_add_reviewer_id_to_deposits_table',8),(48,'2020_02_13_180932_add_complete_to_deposits_table',8),(49,'2020_02_14_115006_create_refunds_table',8),(50,'2020_02_28_165116_change_password_to_reviewers_table',9),(51,'2020_03_22_202948_change_detail_address_to_reviewers_table',10),(52,'2020_03_27_222429_create_modify_campaigns_table',10),(53,'2020_03_30_153720_add_confirm_to_modify_campaigns_table',10),(54,'2020_04_06_211014_add_certification_key_to_reviewers_table',11),(55,'2020_04_06_211226_add_certification_key_to_advertisers_table',11),(56,'2020_04_14_083211_create_main_banners_table',11),(57,'2020_04_14_083345_create_middle_banners_table',11),(58,'2020_04_14_083437_create_bottom_banners_table',11),(59,'2020_04_14_164559_add_image_to_notices_table',11),(60,'2020_04_18_140014_add_process_to_campaign_promotion',12),(61,'2020_04_19_161523_add_send_sms_to_campaigns_table',12),(62,'2020_04_22_144443_add_description_to_refunds_table',13),(63,'2020_06_11_114721_add_authority_to_admins_table',14),(64,'2020_06_30_152213_add_image_to_onetoones_table',15),(65,'2020_07_03_201553_change_view_count_to_communities_table',16),(66,'2020_07_31_224756_add_image2_to_onetoones_table',17),(67,'2020_11_13_131337_add_take_visit_check_to_campaign_reviewers_table',18),(68,'2020_12_14_061933_create_messages_table',18),(69,'2020_12_25_135047_create_penalties_table',18),(70,'2021_01_02_060242_drop_reviewer_id_campaign_id_add_campaign_reviewer_to_reviews_table',18),(71,'2021_01_16_053419_add_campaign_id_to_messages_table',18),(72,'2021_10_14_152629_add_fee_waiver_to_exposures_table',19),(73,'2021_10_14_152803_add_fee_waiver_to_promotions_table',19),(74,'2021_10_14_153310_add_fee_waiver_select_payment_to_campaigns_table',19),(75,'2021_10_17_150923_add_payment2_to_campaigns_table',19),(76,'2021_10_17_151832_add_merchant_uid2_to_campaigns_table',19);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modify_campaigns`
--

DROP TABLE IF EXISTS `modify_campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modify_campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `advertiser_id` bigint(20) unsigned NOT NULL,
  `channel_id` bigint(20) unsigned NOT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form` enum('h','v') COLLATE utf8mb4_unicode_ci NOT NULL,
  `recruit_number` smallint(5) unsigned NOT NULL,
  `offer_point` int(10) unsigned NOT NULL,
  `offer_goods` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_recruit` date NOT NULL,
  `end_recruit` date NOT NULL,
  `end_submit` date NOT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_id` bigint(20) unsigned DEFAULT NULL,
  `visit_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etc` text COLLATE utf8mb4_unicode_ci,
  `confirm` enum('w','a','r') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'w',
  PRIMARY KEY (`id`),
  KEY `modify_campaigns_brand_id_foreign` (`brand_id`),
  KEY `modify_campaigns_campaign_id_index` (`campaign_id`),
  KEY `modify_campaigns_advertiser_id_index` (`advertiser_id`),
  KEY `modify_campaigns_channel_id_index` (`channel_id`),
  KEY `modify_campaigns_form_index` (`form`),
  KEY `modify_campaigns_area_id_index` (`area_id`),
  CONSTRAINT `modify_campaigns_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modify_campaigns_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `modify_campaigns_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modify_campaigns_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `modify_campaigns_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modify_campaigns`
--

LOCK TABLES `modify_campaigns` WRITE;
/*!40000 ALTER TABLE `modify_campaigns` DISABLE KEYS */;
INSERT INTO `modify_campaigns` VALUES (25,87,1,2,53,'테스트 호텔입니다','v',2,5000,'숙박권','2021-01-29','2021-02-01','2021-02-05','16121618851.jpg',NULL,NULL,'16121618854maxresdefault.jpg','블록션 521-4512','리뷰미션입니다','#키워드',36,'오전 12시 이후 ~ 저녁 6시 전까지','03060','서울 종로구 윤보선길 10','201호','2021-02-01 15:51:13','2021-02-01 15:51:27','고고','a'),(26,136,2,1,52,'123123','h',4,20000,'123','2022-04-19','2022-04-25','2022-05-10','16502626931externalFile(42).jpg','16502626932externalFile(58).jpg',NULL,NULL,'01000000000','01000000000','01000000000',NULL,NULL,NULL,NULL,NULL,'2022-04-18 15:18:38','2022-04-18 15:18:38','01000000000','w');
/*!40000 ALTER TABLE `modify_campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES (1,'리뷰의 힘 사이트가 오픈되었습니다.','여러분의 많은 이용 부탁드립니다!\n감사합니다!',689,'2019-11-29 00:55:32','2022-11-08 19:01:13',NULL);
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `onetoones`
--

DROP TABLE IF EXISTS `onetoones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `onetoones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qcategory_id` bigint(20) unsigned NOT NULL,
  `reviewer_id` bigint(20) unsigned DEFAULT NULL,
  `advertiser_id` bigint(20) unsigned DEFAULT NULL,
  `answer_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `onetoones_reviewer_id_foreign` (`reviewer_id`),
  KEY `onetoones_advertiser_id_foreign` (`advertiser_id`),
  KEY `onetoones_qcategory_id_index` (`qcategory_id`),
  CONSTRAINT `onetoones_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `onetoones_qcategory_id_foreign` FOREIGN KEY (`qcategory_id`) REFERENCES `qcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `onetoones_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `onetoones`
--

LOCK TABLES `onetoones` WRITE;
/*!40000 ALTER TABLE `onetoones` DISABLE KEYS */;
INSERT INTO `onetoones` VALUES (1,'캠페인 신청은 했는데 선정이 되지 않아요','어떤 문제가 있는것일까요?\r\n리뷰전략에 문제가 있나요??',1,132,NULL,'리뷰전략의 철저한 작성이 필요합니다.','리뷰전략은 광고주가 리뷰어를 선정하는 중요한 기준입니다.','2019-11-29 08:17:45','2019-11-29 08:26:18',NULL,NULL,NULL),(3,'캠페인 신청 했는데요','신청해서 결제도 다했는데 다시 로그아웃 하고 들어오니까\r\n제가 올렸다는 캠페인이 하나도 안뜨네요\r\n검수중 캠페인에도 안뜨고 어떻게 된건지;',1,NULL,4,NULL,NULL,'2020-02-13 03:51:49','2020-02-13 03:51:49',NULL,NULL,NULL),(4,'d','d',1,NULL,2,NULL,NULL,'2020-03-04 09:08:59','2020-03-04 09:08:59',NULL,NULL,NULL),(5,'문의','문의문의',1,231,NULL,'문의의','문의의문의의','2020-05-28 11:47:53','2020-05-28 13:09:15',NULL,NULL,NULL),(6,'일대일 문의 파일첨부 테스트입니다','테스트',1,NULL,1,NULL,NULL,'2020-07-03 20:56:47','2020-07-03 20:56:47','1593777407.png',NULL,NULL),(7,'test문의 입니다','test',1,132,NULL,NULL,NULL,'2021-02-01 15:29:50','2021-02-01 15:29:50',NULL,NULL,NULL),(8,'ddd','dd',1,NULL,2,NULL,NULL,'2021-08-12 13:42:54','2021-08-12 13:42:54',NULL,NULL,NULL),(10,'회원 탈퇴','탈퇴 어떻게 하나요?',1,249,NULL,NULL,NULL,'2021-10-19 14:44:18','2021-10-19 14:44:18',NULL,NULL,NULL);
/*!40000 ALTER TABLE `onetoones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penalties`
--

DROP TABLE IF EXISTS `penalties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penalties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `fixed_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penalties_reviewer_id_foreign` (`reviewer_id`),
  CONSTRAINT `penalties_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penalties`
--

LOCK TABLES `penalties` WRITE;
/*!40000 ALTER TABLE `penalties` DISABLE KEYS */;
INSERT INTO `penalties` VALUES (1,132,'2021-07-03','2021-07-03 00:36:08','2021-07-03 00:36:08'),(2,132,'2021-07-03','2021-07-03 00:36:10','2021-07-03 00:36:10');
/*!40000 ALTER TABLE `penalties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reward` int(10) unsigned DEFAULT NULL,
  `review_plan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plans_reviewer_id_index` (`reviewer_id`),
  CONSTRAINT `plans_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (7,17,'육아 뷰티','157356497120191020_221359.jpg','언제든요',30000,'예쁜사진, 장점부각 후기 잘씁니다\r\n아이들도 사진잘찍구요\r\n뷰티 자신있습니다 그외에도 후기는 자신있어요','2019-11-12 22:22:51','2019-11-12 22:22:51'),(8,19,'주어진것에 맞게 늘 최선을다합니다',NULL,NULL,NULL,NULL,'2019-11-12 22:36:23','2019-11-12 22:36:23'),(11,20,'인플루언서라면','157356589920191008_101513_644.jpg',NULL,NULL,'경험과 노하우를 토대로\r\n꼼꼼하고 멋진후기로 보답할께요~','2019-11-12 22:38:20','2019-11-12 22:38:20'),(14,28,'사람들을 이끌다',NULL,'평일 14:00~19;00 주말 항상',10000,'만족스러운 리뷰 작성 가능합니다 다양한 경력으로 뷰티와 패션은 확실히 할 수 있습니다','2019-11-14 00:36:35','2019-11-14 00:36:35'),(15,30,'안녕하세요',NULL,'평일2시쯤',NULL,'가이드에 따라 정성껏 리뷰 작성하겠습니다 자신있습니다','2019-11-14 07:23:37','2019-11-14 07:23:37'),(18,37,'유아관련제품, 미용실,음식관련 원해요',NULL,NULL,10000,'실사용 후기를 남길게요 솔직하게 남길 수 있어요','2019-11-15 13:32:01','2019-11-15 13:32:01'),(19,38,'유아동 전문 해보고싶습니다',NULL,NULL,NULL,'대전사는 6살 키우는 33살 엄마입ㄴㅣ다\r\n유아동 뷰티 관심 많아서 가입했습니다','2019-11-15 15:43:39','2019-11-15 15:43:39'),(20,42,'일상과 점목하여 리뷰','1573972456190823017.PNG','토,일 24시간 또는 평일 오후 7시 이후',200000,'자체영상편집/영상효과/BGM/음향효과/자막 진행 유튜버','2019-11-17 15:34:16','2019-11-17 15:34:16'),(21,44,'네이버블로그 리뷰전문',NULL,NULL,NULL,'저는 원래 물고기를 키우는 포스팅을 주로 올렸었는데요\r\n최근 넷플릭스 추천이나 도서, 영화, 드라마, 웹툰 추천 포스팅을 올리면서 방문수가 일 700정도로 늘었고\r\n문화추천 외에도 전자담배, 전자기기, 애견 포스팅도 올리고 있습니다^^','2019-11-17 20:37:40','2019-11-17 20:37:40'),(22,45,'열심히합니다.','15739978521572574557360.png',NULL,NULL,'열심히하겠습니다.','2019-11-17 22:37:32','2019-11-17 22:37:32'),(24,49,'할수있다 시벌',NULL,NULL,NULL,'ㅋㅋㅋㅋㅋㅋㅋㅋ','2019-11-18 03:36:16','2019-11-18 03:36:16'),(25,60,'동영상 + 사진 + 적절한 해시태그',NULL,NULL,NULL,NULL,'2019-11-18 19:04:36','2019-11-18 19:04:36'),(26,61,'꼼꼼한 리뷰',NULL,NULL,NULL,NULL,'2019-11-18 20:07:25','2019-11-18 20:07:25'),(27,67,'5살 딸아이와 함께하는 진정성 리뷰~','1574102675IMG_20191023_223526_335.jpg','오전.9시~ 오후 5시 이전',30000,'노하우와 내츄럴을 겸비한 육아맘블로거^^\r\n2014년부터 다수의 체험단 경험과 노하우가 있어요!\r\n너무 광고같지 않은 자연스러운 리뷰 지향합니다~\r\n블로그 인터뷰기자로 활동중이어서 리뷰작성시 내용의 흐름이 자연스럽습니다!','2019-11-19 03:44:35','2019-11-19 03:44:35'),(28,70,'자연스러운 광고효과',NULL,'평일 열시~세시',NULL,'다년간의 리뷰경험으로 주제에 맞게 포스팅 할 수 있습니다 ^^','2019-11-19 11:44:05','2019-11-19 11:44:05'),(29,71,'리뷰전략',NULL,'평일 11:00~16:00',30000,NULL,'2019-11-19 14:32:31','2019-11-19 14:32:31'),(30,75,'신랄한 리뷰',NULL,'10:00~17::00',NULL,'신랄한리뷰. 정확하고 확실한 리뷰를 합니다','2019-11-19 23:14:08','2019-11-19 23:14:08'),(31,78,'다양한 리뷰가 가능하고, 상세한 기능을 요구하는 리뷰까지 가능합니다.','1574208148[]KakaoTalk_20191117_234918125.png','언제든 가능',30000,'현재 블로그를 운영하고 있으며, 제품리뷰, 육아 리뷰, 맛집, 장소, 직업적 요소 등등 수많은 주제를 가지고 블로그 포스팅을 활동하고 있으니, 언제나 편하게 문의주세요~','2019-11-20 09:02:28','2019-11-20 09:02:28'),(37,79,'초보블로거 육아맘이에요',NULL,'평일 12시~3시',NULL,NULL,'2019-11-20 10:42:21','2019-11-20 10:42:21'),(38,80,'내가게!내가만든 제품이라.생각하고 꼼꼼하게 리뷰작성 하겠습니다.','1574217927F221C3D3-43F1-410C-B205-AE80F89442FF.jpeg','항시가능',NULL,'직접 체험하고. 소신있게 리뷰작성 하겠습니다.\r\n내가게,내가 만든 제품, 요리라 생각하고 신중하고.성의있게 활동하겠습니다.','2019-11-20 11:45:28','2019-11-20 11:45:28'),(39,82,'으헣 무섭지','1574230023.png','평일 09:00~18:00',20000,'가장 평범한 직장인이지만 가장 경제적으로 여유로운 30대 초반 미혼남성의 시각으로 물품의 내적 가치를 표현함으로써 사람들의 공감을 얻는다','2019-11-20 15:07:03','2019-11-20 15:07:03'),(40,85,'리뷰의 힘',NULL,NULL,NULL,'솔직히 쓰겠습니다','2019-11-21 02:27:27','2019-11-21 02:27:27'),(41,89,'q221',NULL,'121212',NULL,'12','2019-11-22 19:01:42','2019-11-22 19:01:42'),(42,92,'꼼꼼하고 깔끔한 사진, 영상, 움짤을 사용해 리뷰합니다.',NULL,NULL,NULL,NULL,'2019-11-22 20:46:17','2019-11-22 20:46:17'),(44,96,'꾸준한 리뷰 작성가능합니다',NULL,'요일 상관없이 가능',NULL,NULL,'2019-11-23 05:22:04','2019-11-23 05:22:04'),(45,97,'꼼꼼하고 꾸준한 리뷰 작성 가능합니다',NULL,'항상가능',NULL,'인스타 팔로워 1천명 이상이며, 뷰티&제품리뷰 블로거를 운행 중이며, 누구보다 꼼꼼하게 제품 리뷰가 가능합니다! 다양한 사진컷과 꼼꼼한 포스팅으로 정성스럽게 작성 하겠습니다','2019-11-23 05:29:05','2019-11-23 05:29:05'),(46,99,'엄청난 말빨로 가져오는 홍보 효과!',NULL,'아무때나',NULL,'화려한 말빨로 홍보효과를 톡톡히 보실 수 있으실 겁니다!','2019-11-23 11:11:32','2019-11-23 11:11:32'),(47,107,'6년차 신문기자의 내공을 리뷰에 꽉꽉 담아드려요','1574657854untitled.png','평일 09:00~19:00',10000,'6년차 신문기자로 쌓아온 실력을 리뷰에서 보여드릴게요! ^^ 리뷰 프로젝트를 통해 알게된 좋은 서비스, 제품, 문화공연 등은 블로그나 인스타그램 등 SNS뿐 아니라 신문기사에도 올라갈 수도 있습니다. (실제 사례 링크 있습니다^^) 그외에 개인적으로 4살짜리 골든리트리버 키우고 있어 애견용품/서비스도 리뷰 가능합니다 ^^! 어떤 분야든 연락주시면 성심성의것, 제가 가진 실력과 지식과 능력치를 총집합해 리뷰에 담겠습니다 !!','2019-11-25 13:57:35','2019-11-25 13:57:35'),(48,109,'충분히 사용해보고 작성하는 리뷰',NULL,'언제나 가능',NULL,'직접 구입해서 사용하는 물건들도 리뷰 하기를 즐겨합니다. 무조건 여러 횟수에 걸쳐 사용해 정확한 리뷰를 합니다.','2019-11-25 19:20:17','2019-11-25 19:20:17'),(49,111,'맛집 제품 기타리뷰 전문입니다',NULL,'아무때나',100000,'요즘 유투브 체험단이 건당10이기본주던데\r\n타업체에서6개정도 했어요\r\n60정도버니까 욕심이나서 알아보던차\r\n리뷰의힘이 유튜브체험단전문이래서\r\n들어와봤어요 잘부탁드려요\r\nhttps://youtu.be/N5UqdbbUs6k','2019-11-25 23:49:04','2019-11-25 23:49:04'),(50,112,'정말 가이드에맞게 성심성의껏 인스타감성으로 리뷰남길자신 있습니다!','1574696910tkwls.jpg','평일 오후1시이후',5000,'파워 인플루언서는 아니지만 정말 정성다해 리뷰할 자신있습니다 !','2019-11-26 00:48:30','2019-11-26 00:48:30'),(51,113,'움짤 동영상 사진 다양하게 다양한 채널로',NULL,'평일 11:00-20:00',10000,'블로그를 두개운영중입니다. 각각 다른사진과 다른원고로 두군데  모두다 시간차를 두고 올려드립니다.\r\n인스타도 키우고있는데  인스타도올려드려요~\r\n블로그운영 15년 노하우로 꼼꼼하고 가이드에맞춰 그리고 기한을맞춰 올리겠습니다','2019-11-26 02:03:01','2019-11-26 02:03:01'),(52,114,'가장 정성스러운 포스팅.',NULL,NULL,NULL,NULL,'2019-11-26 17:16:26','2019-11-26 17:16:26'),(54,116,'상위노출블로거',NULL,NULL,NULL,NULL,'2019-11-26 17:21:33','2019-11-26 17:21:33'),(56,122,'영상, 블로그, 인스타 다 진행가능합니다.',NULL,NULL,200000,'유튜브 지이TV운영중입니다.','2019-11-27 00:53:36','2019-11-27 00:53:36'),(57,125,'마케팅 경력 6년, 기자단/체험단 운영중',NULL,'카카오톡 및 문자 및 메일 선호',15000,NULL,'2019-11-27 14:30:39','2019-11-27 14:30:39'),(58,130,'자신있습니다^^',NULL,NULL,NULL,NULL,'2019-11-28 22:38:03','2019-11-28 22:38:03'),(59,132,'철저한 리뷰를 약속합니다','1574952371about2.jpg','평일 10시~18시',10000,'너무 칭찬만 하는 리뷰가 아닌\r\n단점과 장점을 객관적으로 관찰해서 작성하겠습니다.','2019-11-28 23:46:11','2019-11-28 23:46:11'),(60,136,'유튜브 홍보',NULL,'평일  오후1시부터 저녁 9시까지',NULL,'다양한 홍보영상,광고영상,바이럴영상 제작경험 있습니다.\r\n\r\n기획,촬영,편집 모두 가능','2019-12-01 21:14:33','2019-12-01 21:14:33'),(61,137,'민준이네육아일기','15752168637.jpg','평일 11:00~15:00',300000,'아이 육아와 함께하는 온가족 유튜브 채널입니다.','2019-12-02 01:14:23','2019-12-02 01:14:23'),(62,149,'결국, 취향',NULL,NULL,NULL,'전략은 없습니다\r\n서로 원하는 리뷰,\r\n원하는 리워드,\r\n선을 맞추는게 중요','2019-12-07 18:36:38','2019-12-07 18:36:38'),(63,160,'꼼꼼 기자단',NULL,'아무때나',20000,'다양한 기능과 깔끔한 사진으로 리뷰하겠습니다.\r\n사용동영상 가능\r\n얼굴노출가능','2019-12-10 19:30:29','2019-12-10 19:30:29'),(64,161,'상품 리뷰 브이로그,',NULL,'평일 언제든 항상',50000,'저는 3년차 블로그를 운영하다\r\n최근 유튜브 맛집리뷰, 상품리뷰, 체육관운영하면서 브이로그까지 제작하고있습니다\r\n최선을다해 제작해드리겠습니다!','2019-12-10 21:18:25','2019-12-10 21:18:25'),(66,166,'핵심 리뷰와 정보를 쏙쏙 알려주는 블로거','1576222965KakaoTalk_20190528_113540233.jpg','평일/주말 09:00~18:00',NULL,'저는 업무때문에 블로그를 시작하다가\r\n비즈니스가 아닌\r\n 일상글을 공유하면서\r\n\r\n블로그에 재미를 가지게 됬습니다.\r\n\r\n어떤 서비스든 파악이 빠르기 때문에\r\n성의 없는 글이 아닌 핵심을 콕 잡아서 리뷰 진행하도록 하겠습니다 ^^','2019-12-13 16:42:45','2019-12-13 16:42:45'),(67,169,'먹방 그리고 브이로그',NULL,'평일 18:00 이후',0,'PPL위주로 진행하고 있어서 브이로그 자체를 보면 많은 지원을 받는 부분이 노출되지 않는 경우가 많습니다.\r\n하지만 이젠 아예 단독 영상으로도 제작해보고 다양한 영상 제작을 해 보고 싶습니다.\r\n먹방 외에도 이미지에 어울릴만한 다양한 제품리뷰나 영상 제작을 해 보려는 생각입니다:)','2019-12-16 00:51:00','2019-12-16 00:51:00'),(68,173,'인스타그램 sns로 홍보할수있어용','1576733038KakaoTalk_20191219_142001829_01.jpg',NULL,NULL,NULL,'2019-12-19 14:23:58','2019-12-19 14:23:58'),(69,176,'안녕하세요!',NULL,NULL,NULL,NULL,'2019-12-20 18:31:47','2019-12-20 18:31:47'),(70,178,'잘 만들겠습니다','1577038054KakaoTalk_Photo_2019-11-19-01-26-21.jpeg','24시간',NULL,NULL,'2019-12-23 03:07:34','2019-12-23 03:07:34'),(71,180,'직접 경험한 것만 리뷰하는 채널',NULL,'평일10:00~19:00',50000,NULL,'2019-12-26 07:21:55','2019-12-26 07:21:55'),(72,184,'한 번 맡은 리뷰는 끝까지 책임진다! \'사진, 영상, 움짤+재미있는 멘트로 끝까지 보게하는 흥미로운 포스팅\'','1577957204.jpg','평일 12:00~18:00',NULL,'블로그 운영한 지 4개월만에 투데이 1000명을 돌파시켰고, 이 후 쭉 성장세를 이어가고 있습니다\r\n상위노출, 최적화 블로그에 관련 된 강의를 듣고 참고하여 포스팅 작성에 적용시켰고, 한 번 맡은 일은 끝까지! 그리고 빠른 시일 내에 해내는 성격을 가지고 있어 성의 있는 리뷰 작성으로 업체 분들의 만족도를 높은 후기를 듣곤 합니다. 사람들의 니즈를 파악하여 상세한 정보력 있는 글+개그감 있는 멘트 들로 제가 작성한 글에 오랜 시간을 머물 수 있도록, 신뢰감 높은 리뷰를 작성해보겠습니다:-)','2020-01-02 18:26:45','2020-01-02 18:26:45'),(73,189,'젊은층의 감성을 공략하겠습니다',NULL,NULL,NULL,'젊은층들이 관심있어하는부분들을\r\n예쁜사진으로 풀어내어 공략하겠습니다 \r\n\r\n	https://blog.naver.com/peregrination_h 블로그 주소입니다 ','2020-01-06 21:38:59','2020-01-06 21:38:59'),(74,193,'리뷰전략',NULL,'평일 10~17시',NULL,NULL,'2020-01-08 16:44:17','2020-01-08 16:44:17'),(75,198,'블로그 포스트 1개로 하루 방문자 15만명 등극!!!!!!! 프로블로거',NULL,'평일 12~17',30000,'저는 일본어 스페인어 영어 모두 가능합니다 2015-18년까지 블로그 운영했던 경험도 있고 판매제안도 많이 받았습니다 :) \r\n글쓰는것과 책 읽는 것을 좋아하며, 리뷰를 작성할때도 제가 체험하고 경험한것 이외의 정보를 인터넷으로 검색해서 리뷰 한 페이지만으로도 다른 정보를 추가검색할 시간과 에너지를 들이지않도록 성심성의껏 작성합니다. \r\n믿고 리뷰어로 채택해 주신다면 :) 귀사에서 추천하고 홍보하는 물품들을 해외 전세계의 많은 사람들이 관심가질 수 있도록 리뷰하겠습니다 :) \r\n감사합니다 ~! ','2020-01-10 13:17:00','2020-01-10 13:17:00'),(76,200,'8여년 간의 홍보전문가 경력을 살려, 리뷰 진행하겠습니다.','1578911622sws1.jpg',NULL,NULL,'직장에서 홍보,마케팅 경력 13년차 직장인입니다. 다년간의 경험을 블로그 리뷰에 접목 시켜서 제품 홍보 진행하겠습니다. 감사합니다.','2020-01-13 19:33:42','2020-01-13 19:33:42'),(77,201,'꼼꼼하고 장점이 부각되게','157901095120191210_135237.jpg','10시-18시',100000,'인스타, 유튜브 리뷰 원합니다.\r\n꼼꼼하고 장점살려 영상으로 보여드리고 싶습니다.','2020-01-14 23:09:11','2020-01-14 23:09:11'),(78,202,'바른것만 리뷰한다!',NULL,NULL,NULL,'개인블로그는 다 지워져서 다시 시작하지만 일하면서 거래처들 블로그를 대신 작성해주고 해서 정말 블로그하나는 자신있습니다 ! ! 이미지만들기 상세페이지 등 다 가능합니다 ! !','2020-01-16 09:21:13','2020-01-16 09:21:13'),(79,206,'맛집 블로거',NULL,NULL,NULL,NULL,'2020-01-20 22:13:13','2020-01-20 22:13:13'),(80,177,'영상제작자의 고퀄리티 리뷰 영상입니다.',NULL,NULL,100000,'영상 제작자의 고퀄리티 영상을 제작해드립니다.','2020-02-09 19:43:11','2020-02-09 19:43:11'),(83,229,'맛집, 리뷰, 먹방, 식품, 전자제품 등 다양한 컨텐츠 진행합니다','1584816677.jpg','평일 10:00 ~ 18:00',300000,'안녕하세요 유튜브 크리에이터 김톰슨 입니다\r\n저의 간단한 소개를 하자면 2010년부터 아프리카TV를 시작으로 인터넷방송을 시작하였습니다.\r\n베스트 비제이 활동기간 : 2010년 9월 16일 ~ 2018년 9월 27일\r\n\r\n현재는 베스트비제이 자진 반납 후 유튜브를 위주로 활동하고 있습니다.\r\n저의 주 컨텐츠는 먹방, 요리, 맛집탐방, 게임, IT, 리뷰 입니다.\r\n구독자는 2020년 3월 22일 기준으로 6,030명이며 매일 성장하고 있습니다.\r\n\r\n저의 장점은 방문형 컨텐츠와 체험형 컨텐츠 진행 경험이 풍부하며, 광고주와의 커뮤니케이션에도 적극적입니다. 방송 진행 스타일은 건전한 방송을 추구합니다. 또한 다양한 컨텐츠 진행에 대한 경험이 풍부합니다.\r\n\r\n영상 제작기간은 촬영시작 후 14일 전후이며 업로드 유지기간은 6개월을 기본으로 하고 있지만 특별한 이슈가 없으면 삭제하지 않습니다. (삭제 원하시면 최대한 빨리 삭제해드립니다)\r\n\r\n감사합니다. ^^','2020-03-22 03:51:17','2020-03-22 03:51:17'),(84,230,'인스타 사진홍보 체험단 가능','1585896059KakaoTalk_20200403_153317253.jpg','13:00~17:00',50000,'맛집 및 카페 먹거리등 그동안 수없이 다녔습니다. 다양한 조건의 리뷰작성 모두 가능합니다. 사진이면 사진 글이면 글 체험이면 체험 모두 가능합니다.','2020-04-03 15:40:59','2020-04-03 15:44:04'),(85,4,'7년차 블로거의 리뷰','15888352800001.jpg','10:00-15:00',20000,'안녕하세요 조축삼입니다.\r\n부산 맛집, 제품 리뷰를 주로 하고 있습니다.\r\n체험단은 1000회 정도 진행한 경력이 있어서, 어떤 리뷰든 정확하게 할 수 있습니다.\r\n반말 리뷰로 실 사용후기 느낌의 리뷰를 작성하겠습니다.\r\n많은 제안 바랍니다!','2020-05-07 16:08:00','2020-05-14 14:38:30'),(86,231,'무엇이든 경험하는 까만아이','1590038955water.PNG','평일 11:00 ~ 21:00',5000,'무엇이든 경험해보는걸 좋아합니다!\r\n무엇이든 시켜주시면 언제든지 가능합니다.\r\n맛집 생활 숙박 디지털 패션 문화 앱 웹 어떤 분야들 관심이 많으니\r\n정성껏 글로 보답해드리겠습니다.','2020-05-21 14:29:15','2020-06-18 14:13:31'),(87,232,'광고같지 않은 자연스러운 후기로 거부감Down!','159049341320200521_125110_656.jpg','상시가능',15000,'소니a6400,아이폰xs로 촬영하여 감성적인 느낌나게 보정해서 포스팅할게요. 인스타업로드도 원하신다면 가능합니다. 퀄리티높은 후기 약속드려요','2020-05-26 20:43:33','2020-05-26 20:44:01'),(88,234,'블로그로 잘 홍보드리겠습니다',NULL,'평일 정오 이후',NULL,'https://blog.naver.com/sodasuchoco/222033713451에 포스팅예정입니다.','2020-07-21 15:40:46','2020-07-21 15:40:46'),(89,237,'맛집,뷰티,숙박,디지털,숙박등을 리뷰합니다!',NULL,'11:00~17:00',NULL,'최대한 지역을 위한 블로그 활동을 하고 있으며. 좋지 않은데 좋다거나 맛이 없는데 맛있다고 리뷰하지 않는 최대한 솔직한 관점에서 리뷰를 합니다.','2020-07-24 17:04:36','2020-07-24 17:04:36'),(90,238,'애견동반여행지, 카페, 간식, 사료 등 솔직리뷰가능','159602680465605CF9-02D7-44CC-A776-DAF7437AC28D.jpeg','언제든지 가능.부재시 문자요청',NULL,'애견동반 여행지, 카페, 숙소 등등 다녀온 후 소소하게 포스팅하며 블로그 운영중입니다. \r\n사료, 간식, 애견용품 등  체험단 이벤트를 통해 여러 후기 남겨 봤어요. \r\n많은사진, 솔직리뷰 자신있어용','2020-07-29 21:46:44','2020-07-29 21:50:50'),(91,240,'유아동부터 성인여자,남자까지 체험단가능합니다!',NULL,'평일 10시~오후4시',2000,'가정을 이루고 있는 한아이의 엄마로서 유아동부터 어른컨텐츠까지 다양하게 가능해요!\r\n뷰티쪽으로 너무 관심이 많은 엄마라 뷰티쪽은 너무 환영이구요,\r\n꼼꼼한 리뷰와 짧은 영상도 같이 올릴수있어요^^\r\n필요한 가이드라인 주시면 가이드라인에 맞추어 올립니다!\r\n주부라서 바로바로 가자마자 올리지는 못하지만 약속날짜는 꼭 지켜서 올려요!','2020-08-09 20:52:47','2020-08-09 20:54:24'),(92,243,'좋은건 많이 공유하고 싶습니다. (뷰티&맛집&생활용품&숙박&체험 등)',NULL,'9:00~20:00',NULL,'직접 경험을 통해 좋은 건 많은 사람들과 나누고 싶습니다. 진솔하고 마음이 와닿는 리뷰를 하겠습니다.','2020-09-10 12:19:05','2020-09-10 12:19:05'),(93,245,'대박의 비결은 여기에 있지요',NULL,'평일 09:00~ 18:00',10000,'누구에게나 친근하게 어필한다는 것은 마음 속에 진실을 말할 때 가능합니다. \r\n리뷰의 첫 출발점은 정확한 내용을 바르게 어필하며, 다음 소비 패턴을 만들어낼 수 있다는 것이지요.\r\n그런 시점에서 힘이 되는 리뷰이자, 조용한 혁명같은 역할을 하는 리뷰어이고 싶습니다.','2020-11-03 21:44:06','2020-11-03 21:44:06'),(94,245,'대박의 비결은 여기에 있지요',NULL,'평일 09:00~ 18:00',10000,'누구에게나 친근하게 어필한다는 것은 마음 속에 진실을 말할 때 가능합니다. \r\n리뷰의 첫 출발점은 정확한 내용을 바르게 어필하며, 다음 소비 패턴을 만들어낼 수 있다는 것이지요.\r\n그런 시점에서 힘이 되는 리뷰이자, 조용한 혁명같은 역할을 하는 리뷰어이고 싶습니다.','2020-11-03 21:44:06','2020-11-03 21:44:06'),(95,249,'나만의 후기로 신선하고 좋은 리뷰!','160854500501CBD8E1-4FEB-4A55-871A-07D9730D1722.jpeg','상관없음',NULL,'상품에대한 자세한 설명 그리고 나만의 후기로 상품에대한 좋은 후기로 인스타 리뷰가능 합니다 협찬 후기 경험 있음 !','2020-12-21 19:03:25','2020-12-21 19:03:25'),(96,250,'빵찌니의 솔직한 리뷰',NULL,'00~00',15000,'안녕하세요 빵찌니입니다.\r\n맛집이나 일상 포스팅 위주로 활동하구 있고요 \r\n갈수록 노출도 잘 되고 있고 방문자도 조금씩 늘어나고 있습니다 부산 맛집이나 뷰티나 패션 쪽도 다양하게 체험하고 리뷰하고싶습니다!!','2020-12-29 18:01:22','2020-12-29 18:01:22'),(97,253,'항상 젊음을 유지하는 리뷰어','1612237272noimage1.jpg','10:00~17:00',1000,'저는 25년동안 소프터웨어 개발자로 일하고 있습니다.\r\nIT관련 리뷰어로 활동하고자 합니다.\r\n여러분의 관심어린 지원을 바랍니다.','2021-02-02 12:41:12','2021-02-02 12:41:12'),(98,255,'감각있는 사진과 노출로직에 맞는 원고로 광고주님에게 도움이 되는 블로거입니다.',NULL,'평일 10~17시',5000,'네이버 로직을 파악하는 실행사에 근무하고 있습니다.\r\n키워드 로직파악은 물론 사진까지 로직에 맞추어 노출될 수 있도록 작성 약속드립니다.','2021-02-02 16:31:19','2021-02-02 16:31:19'),(99,257,'가이드에 맞게 꼼꼼하게 리뷰 포스팅하겠습니다.','1612251596KakaoTalk_20210202_163804230_05.jpg','평일 11시30분 ~ 1시 / 주말은 언제든 상관없음',5000,'사진과 영상 등 다양하게 컨텐츠를 활용하여 리뷰를 쓰고있습니다. \r\n\r\n7살된 치와와 댕댕이와 함께하여 애견용품의 경우 저희집 댕댕이를 모델로 이쁘게 촬영도 가능합니다. 맛집블로그의 경우 제가 직접 먹방 영상을 찍어 움짤 등을 활용하여 포스팅 진행합니다.','2021-02-02 16:35:32','2021-02-02 16:39:56'),(100,258,'실제품의 직접 테스트로  신뢰감있는 리뷰작성',NULL,'상관없음',NULL,'실사용을 통한 실리뷰로 작성하여 신뢰감있는 리뷰작성 여태 일한 노하우를 담아 진실성있게 작성하겠습니다','2021-02-02 16:38:38','2021-02-02 16:38:38'),(101,256,'소비자의 마음을 꿰뚫는 전 작가 출신 마케터',NULL,'항상',NULL,'안녕하세요,\r\n저는 강아지 4마리를 키우고 있는 견주입니다.\r\n저는 글쓰는 걸 좋아하는 전 작가 출신입니다.\r\n저는 광고마케팅학과를 나와 누구보다 소비자의 마음을 꿰뚫어볼 수 있는 마케터입니다.','2021-02-02 16:48:53','2021-02-02 16:48:53'),(102,260,'꼼꼼하고 사실과같은 리뷰',NULL,'10:00-17:30',NULL,'꼼꼼한 리뷰를 적고있습니다.\r\n정보전달과 함께 제가 사용하거나 사실에 근거한 내용을 정확하게 전달하며\r\n기타 요청사항이 있다면 최대한 반영하여 작성합니다.\r\n대충 써내려가는 리뷰로 개수를 늘리기보다는 하나를 써도 제대로 쓰려고하니 시간이 조금 걸릴 수 있는 단점이\r\n있을 수 있으나 가장중요한것은 내용전달이라고 생각합니다.','2021-02-02 17:15:13','2021-02-02 17:15:13'),(103,261,'블로그 리뷰 성실하게 꼼꼼히',NULL,NULL,NULL,'각종 서비스 제품 맛집 애견관련 용품 리뷰합니다. 성실한 리뷰합니다.\r\n40대초반 기혼여성\r\n강아지 두마리 키우고 있습니다','2021-02-02 18:48:32','2021-02-02 18:48:32'),(105,264,'꼼꼼한 리뷰 작성하겠습니다!',NULL,'월화 전부, 수-일 7시 이후',NULL,'꼼꼼하고 상위노출이 잘 되고 있습니다!\r\n반려동물 카테고리가 힘이 좋습니다!\r\n\r\n기간, 가이드 맞춰서 작성하겠습니다!','2021-02-17 08:59:32','2021-02-17 08:59:32'),(106,265,'꼼꼼한 리뷰약속드리는 블로거입니다',NULL,NULL,NULL,'일방문자 3000명이상 블로거입니다 지연없이 꼼꼼하게 리뷰약속드립니다 원하시는데로 맞춰드리니 뽑아주십사!!!!!','2021-02-17 22:52:59','2021-02-17 22:52:59'),(107,270,'가장 현실적이고 공감가는 리뷰만 작성합니다!',NULL,'항상가능',NULL,'설명만 하는 리뷰 말고 다른사람들의 시선을 끌 수 있는 리뷰로 작성해드립니다  시대에 흐름에 잘 따라가는 웹디자이너입니다\r\n그만큼 사람들을 잘 이끌 수 있습니다!','2021-08-13 14:58:02','2021-08-13 14:58:02');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `campaign_id` bigint(20) unsigned DEFAULT NULL,
  `kinds` enum('d','w') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `points_reviewer_id_index` (`reviewer_id`),
  KEY `points_kinds_index` (`kinds`),
  CONSTRAINT `points_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` VALUES (1,231,19,'d',0,'2020-06-01 11:49:53','2020-06-01 11:49:53'),(2,231,21,'d',0,'2020-06-03 14:21:22','2020-06-03 14:21:22'),(3,132,8,'d',5000,'2020-06-03 23:28:32','2020-06-03 23:28:32'),(4,132,8,'d',5000,'2020-06-03 23:47:50','2020-06-03 23:47:50'),(5,132,8,'d',5000,'2020-06-03 23:49:00','2020-06-03 23:49:00'),(6,132,8,'d',5000,'2020-06-03 23:51:44','2020-06-03 23:51:44'),(7,132,8,'d',5000,'2020-06-03 23:54:07','2020-06-03 23:54:07'),(8,231,23,'d',0,'2020-06-18 14:42:31','2020-06-18 14:42:31'),(9,231,26,'d',1,'2020-06-18 14:42:37','2020-06-18 14:42:37'),(10,231,30,'d',0,'2020-06-18 14:47:38','2020-06-18 14:47:38'),(11,231,36,'d',5000,'2020-07-13 12:30:25','2020-07-13 12:30:25'),(12,132,83,'d',700,'2021-02-01 12:24:22','2021-02-01 12:24:22'),(13,4,82,'d',0,'2021-02-15 11:07:20','2021-02-15 11:07:20'),(14,132,134,'d',5000,'2021-10-17 20:31:17','2021-10-17 20:31:17');
/*!40000 ALTER TABLE `points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promotions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `instruction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_waiver` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'홍보배너게재',50000,4,'사이트 최상단에 홍보 배너를 게재합니다.<br>(담당 디자이너가 배너 제작에 대한 내용을 연락드립니다.)',5),(2,'푸시 알림',10000,NULL,'추천되는 인플루언서 회원 100명에게 푸시 알림을 보내드립니다.',0);
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qcategories`
--

DROP TABLE IF EXISTS `qcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcategories`
--

LOCK TABLES `qcategories` WRITE;
/*!40000 ALTER TABLE `qcategories` DISABLE KEYS */;
INSERT INTO `qcategories` VALUES (1,'캠페인 신청');
/*!40000 ALTER TABLE `qcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refunds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertiser_id` bigint(20) unsigned NOT NULL,
  `campaign_id` bigint(20) unsigned DEFAULT NULL,
  `point` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kinds` enum('i','o') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'i',
  PRIMARY KEY (`id`),
  KEY `refunds_advertiser_id_foreign` (`advertiser_id`),
  KEY `refunds_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `refunds_advertiser_id_foreign` FOREIGN KEY (`advertiser_id`) REFERENCES `advertisers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `refunds_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refunds`
--

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
INSERT INTO `refunds` VALUES (16,15,35,210000,'2020-06-26 14:08:35','2020-06-26 14:08:35','dqwe... 캠페인 결제 사용','o'),(43,1,NULL,6000,'2020-12-15 16:05:46','2020-12-15 16:05:46','hh... 캠페인 취소 환급','i'),(44,1,NULL,6000,'2020-12-15 16:05:48','2020-12-15 16:05:48','test1... 캠페인 취소 환급','i'),(47,2,82,25000,'2021-01-27 15:22:28','2021-01-27 15:22:28','냉장/실온 이유식 체험단 모집... 캠페인 결제 사용','o'),(49,1,NULL,0,'2021-01-27 17:33:58','2021-01-27 17:33:58','지오지엘 에어 캠핑용 ... 캠페인 취소 환급','i'),(53,1,83,5000,'2021-02-01 08:30:16','2021-02-01 08:30:16','test... 캠페인 결제 사용','o'),(56,1,NULL,30000,'2021-02-01 13:25:47','2021-02-01 13:25:47','일이삼사요 도서... 캠페인 취소 환급','i'),(58,1,NULL,20000,'2021-02-01 15:43:08','2021-02-01 15:43:08','테스트 호텔... 캠페인 취소 환급','i'),(59,1,87,20000,'2021-02-01 15:44:45','2021-02-01 15:44:45','테스트 호텔... 캠페인 결제 사용','o'),(62,2,NULL,5000,'2021-02-02 16:36:47','2021-02-02 16:36:47','3123... 캠페인 취소 환급','i'),(63,21,91,0,'2021-02-02 16:48:15','2021-02-02 16:48:15','양산 서창스터디카페... 캠페인 결제 사용','o'),(66,2,NULL,300000,'2021-07-20 16:39:15','2021-07-20 16:39:15','123123123... 캠페인 취소 환급','i'),(70,1,134,0,'2021-10-17 20:20:26','2021-10-17 20:20:26','테스트 호텔입니다... 캠페인 결제 사용','o'),(71,1,134,9000,'2021-10-17 20:29:14','2021-10-17 20:29:14','테스트 호텔입니다... 캠페인 결제 사용','o'),(72,1,135,0,'2021-10-17 20:36:30','2021-10-17 20:36:30','결제 관련 확인... 캠페인 결제 사용','o'),(74,2,NULL,0,'2021-10-18 13:32:12','2021-10-18 13:32:12','루시스 크리스탈 탈모샴푸 배송체험단... 캠페인 취소 환급','i'),(75,2,NULL,0,'2021-10-18 13:32:14','2021-10-18 13:32:14','루시스 크리스탈 탈모샴푸 배송체험단... 캠페인 취소 환급','i'),(76,2,NULL,0,'2021-10-18 13:32:15','2021-10-18 13:32:15','루시스 크리스탈 탈모샴푸 배송체험단... 캠페인 취소 환급','i'),(77,2,136,0,'2022-04-18 15:18:13','2022-04-18 15:18:13','123123... 캠페인 결제 사용','o'),(83,2,NULL,0,'2022-06-15 18:01:55','2022-06-15 18:01:55','123123... 캠페인 취소 환급','i'),(84,2,NULL,50000,'2022-06-15 18:01:56','2022-06-15 18:01:56','123123... 캠페인 취소 환급','i'),(85,2,NULL,5000,'2022-06-15 18:01:57','2022-06-15 18:01:57','123123123... 캠페인 취소 환급','i'),(86,2,NULL,0,'2022-06-15 18:01:58','2022-06-15 18:01:58','1... 캠페인 취소 환급','i'),(87,2,NULL,0,'2022-06-15 18:01:59','2022-06-15 18:01:59','1... 캠페인 취소 환급','i'),(89,2,143,0,'2022-07-01 22:02:14','2022-07-01 22:02:14','132... 캠페인 결제 사용','o'),(90,2,144,0,'2022-07-01 22:08:32','2022-07-01 22:08:32','123... 캠페인 결제 사용','o'),(92,2,146,0,'2022-08-04 11:13:29','2022-08-04 11:13:29','123... 캠페인 결제 사용','o'),(93,2,NULL,900000,'2022-10-24 10:48:51','2022-10-24 10:48:51','123... 캠페인 취소 환급','i'),(96,2,NULL,0,'2022-11-22 15:30:55','2022-11-22 15:30:55','123... 캠페인 취소 환급','i'),(97,2,NULL,0,'2022-11-22 15:30:57','2022-11-22 15:30:57','ㅁㄴㅇㄹ... 캠페인 취소 환급','i'),(98,2,149,15000,'2022-11-22 15:33:51','2022-11-22 15:33:51','아케소 목쿠션... 캠페인 결제 사용','o'),(99,2,150,15000,'2022-11-22 15:36:21','2022-11-22 15:36:21','아케소 허리쿠션... 캠페인 결제 사용','o');
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arraynum` bigint(20) unsigned NOT NULL DEFAULT '20',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'서울',200),(2,'경기',190),(3,'인천',180),(4,'대전',160),(5,'충남',100),(6,'대구',140),(7,'경북',20),(8,'부산',170),(9,'경남',20),(10,'광주',130),(11,'전남',80),(12,'강원',20),(13,'제주',110),(14,'충북',90),(15,'전북',70),(16,'울산',120),(17,'세종',150);
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewer_faq_cates`
--

DROP TABLE IF EXISTS `reviewer_faq_cates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviewer_faq_cates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewer_faq_cates`
--

LOCK TABLES `reviewer_faq_cates` WRITE;
/*!40000 ALTER TABLE `reviewer_faq_cates` DISABLE KEYS */;
INSERT INTO `reviewer_faq_cates` VALUES (10,'캠페인 신청'),(11,'캠페인 선정'),(12,'캠페인 참여'),(13,'캠페인 마감'),(14,'리뷰 등록');
/*!40000 ALTER TABLE `reviewer_faq_cates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewer_faqs`
--

DROP TABLE IF EXISTS `reviewer_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviewer_faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewer_faq_cate_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviewer_faqs_reviewer_faq_cate_id_index` (`reviewer_faq_cate_id`),
  CONSTRAINT `reviewer_faqs_reviewer_faq_cate_id_foreign` FOREIGN KEY (`reviewer_faq_cate_id`) REFERENCES `reviewer_faq_cates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewer_faqs`
--

LOCK TABLES `reviewer_faqs` WRITE;
/*!40000 ALTER TABLE `reviewer_faqs` DISABLE KEYS */;
INSERT INTO `reviewer_faqs` VALUES (4,'신청한 캠페인 취소는 어떻게 하나요?','선정 전\n리뷰어로 선정 되기 전 캠페인 상세 페이지에서 직접 취소가 가능합니다.\n[선정 취소하기] 버튼을 클릭하면 취소가 진행이 됩니다.\n\n선정 후\n리뷰어 선정이 된 다음인 상황에는 고객센터 > 1:1문의 > 캠페인 선택 후 취소 신청 접수를 해주시면 됩니다.\n단! 리뷰어 선정 후 단순 변심으로 취소를 할 경우 불이익이 있습니다.',10,'2020-03-09 16:08:01','2020-06-16 12:47:43'),(5,'캠페인 선정은 어떻게 확인할 수 있나요?','리뷰어로 선정되면 SMS 문자 / 이메일 등으로 선정 사실을 알려 드립니다.\n사이트에서 알 수 있는 방법은\n마이페이지 > 나의 캠페인에서 선정된 캠페인 확인이 가능합니다.',10,'2020-03-09 16:08:55','2020-06-16 12:48:30'),(6,'캠페인 선정 기준은 무엇인가요?','광고주가 리뷰어가 작성한 리뷰전략과 SNS 콘텐츠 퀄리티를 확인하고 선정합니다.',11,'2020-03-09 16:13:24','2020-06-16 12:57:31'),(7,'리뷰어의 조건은 무엇인가요?','본인이 운영하는 남녀노소 전 세계 누구나 가능합니다.\n내 SNS를 등록하고 리뷰전략을 작성해 캠페인에 신청해보세요!',10,'2020-05-29 13:21:01','2020-06-16 13:13:23'),(8,'캠페인 선정 잘 되는 방법은?','첫번째 마이페이지-나의 리뷰전략 관리-리뷰전략 100% 작성 - 완료\n두번째 MY SNS 입력 후 2번 확인 후 등록한다.\n세번째 나만의 특별함을 부각시킬 수 있는 SNS활동을 열심히 한다.\n네번째 나와 맞는 캠페인을 신청하면 선정될 확률이 UP!',11,'2020-05-29 15:17:50','2020-06-08 14:23:05'),(9,'신청한 제공내역을 내역을 변경할 수 있나요?','선정 전\n캠페인 신청 후 선정이 되기 전에 제공내역 변경을 원하시면 캠페인 페이지에서 신청 취소 후, 다시 재신청을 해주시면 됩니다.\n\n선정 후\n제공내역은 캠페인 페이지 상단부분에서 확인이 가능하며, 캠페인 선정 후에 개인사정 및 변심으로 인한 제공내역 변경은 어렵습니다.\n그렇다보니 그전에 캠페인 신청 전 꼼꼼하게 확인을 부탁드립니다.',10,'2020-06-04 16:39:28','2020-06-08 14:23:09'),(10,'캠페인 신청시 휴대폰 카메라도 가능한가요?','가능은 합니다!\n다만 기본적으로 카메라( DSLR / 미러리스등)을 사용해주시는걸 권장합니다.\n인스타그램의 경우 핸드폰 촬영이 가능하나,\n블로그 / 페이스북등의 캠페인을 진행시 업체별 주의사항에\n\'카메라 필수\' 라는 내용이 있는지 없는지 참고하셔서 신청을 해주시면 됩니다.',10,'2020-06-05 16:31:01','2020-06-08 14:23:13'),(11,'[방문형]  선정 당일 방문해도 되나요?','선정이 된 당일 방문은 불가능합니다.\n최소 하루 전 사전 예약이 필수이며, 캠페인 내용에 당일 방문 / 3일 전 예약 등의\n예외적으로 가이드에 적혀있을때가 있으니 확인을 해보고 진행해주시면 됩니다.\n\n선정 후 가이드에 맞게 광고주와 조율 후 방문을 해주시면 됩니다.',12,'2020-06-05 17:05:15','2020-06-08 14:23:19'),(12,'[방문형] 캠페인 담당자와 연락을 안받아요.','캠페인마다 담당자의 번호로 문자를 남기거나\n고객센터 > 1:1 문의하기를 이용하셔서 문의를 남겨주시면 신속하게 처리가 가능합니다.',12,'2020-06-05 17:07:48','2020-06-08 14:23:26'),(13,'[방문형] 선정된 업체 측에서 체험을 못하게 되었어요.','업체측에서의 체험이 불가능한 경우 따로 불이익은 없습니다.\n고객센터 > 1:1 문의하기를 이용해서 해당업체 관련 내용을 작성 후\n업체측에서의 체험 불가능한 부분의 내용을 남겨주시면 신속하게 처리를 도와드리겠습니다.',12,'2020-06-05 17:11:49','2020-06-08 14:23:30'),(14,'[재택형] 배송 기간을 몇일 정도 걸리나요?','업체별로 다를 수 있습니다.\n대부분 선정 후 평일 기준 2 ~ 3일 정도 소요됩니다.\n주말이나 공휴일이 포함이 될 경우 3 ~ 6일 정도 소요 됩니다.',12,'2020-06-05 17:23:24','2020-06-08 14:23:33'),(15,'[재택형] 선정이 되었는데 제품을 못받았습니다.','평균 배송기간이 지났음에도 오지 않을 경우\n고객센터 > 1:1 문의하기를 통해서 상세한 내용을 적어주시면 됩니다.',12,'2020-06-05 17:25:11','2020-06-08 14:23:37'),(16,'[재택형] 배송 받은 제품이 문제가 있어요.','제품의 상태가 불량 / 파손 / 오발송 등의 문제가 있을 경우\n고객센터 > 1:1 문의하기를 통해서 상세한 애용을 적어주시면 됩니다.',12,'2020-06-05 17:26:13','2020-06-08 14:23:40'),(17,'[재택형] 제품을 받을 주소를 변경 하고 싶습니다.','리뷰어 로그인 > 마이페이지 > 회원정보수정에서 변경하실 수 있습니다.\n이미 체험단에 선정이 된 경우 선정 후에 주소 변경은 불가능합니다.\n제품은체험단 신청시에 작성된 주소로 발송됩니다.\n이 점 참고하셔서 캠페인 신청 전 꼭 한번 회원정보를 체크해보시기 바랍니다.',12,'2020-06-05 17:36:36','2021-10-20 14:02:57'),(19,'마감된 캠페인 어떻게 확인하나요?','마이페이지 > 나의 캠페인 > 종료된 캠페인에서 확인을 하실 수 있습니다.',13,'2020-06-05 17:46:03','2021-10-20 14:00:58'),(20,'등록한 리뷰는 언제까지 유지해야 하나요?','리뷰의힘에서 진행한 모든 캠페인 관련 리뷰는 이용왁관에 따라서\n선정 후 리뷰 등록 후부터 6개월간 필수적으로 유지를 해주셔야 합니다.\n이 부분을 어길시 사이트 이용에 불이익이 발생할 수 있습니다.',14,'2020-06-05 17:50:08','2020-06-08 14:24:00'),(21,'공정위문구( 대가성문구/스폰서 배너/공정위문구)를 무조건 해야하나요?','공정거래위원회 지침에 따라서, 리뷰 작성시 스폰서 배너 및 대가성 안내하는 문구를 필수적으로 표기 되어야 합니다.\n리뷰 내용 안에 대가성문구, 스폰서 배너, 공정위문구를 부착하지 않고 작성했을 경우 /\n리뷰어가 임의로 배너 및 문구를 변조 및 삭제했을 경우 /\n관련된 법규를 저촉되어 리뷰의힘, 광고주, 리뷰어 모든 인원이 법적인 제재가 가해질 수 있다는 부분\n인지하셔서 꼭 공정위문구를 부착해 주셔야 합니다.',14,'2020-06-05 18:02:38','2020-06-08 14:24:04'),(22,'캠페인 기간 안에 리뷰등록이 어려울거 같아요.','리뷰등록은 기간 안에 해주셔야 합니다.\n혹여나 부득이한 상황으로 인해서 기간 내 리뷰등록이 어려울때 고객센터 > 1:1 문의 > 캠페인명과 사유를 작성해주세요.\n만일 아무런 이유도 없이 리뷰등록을 지연하거나 미등록 시 패널티는 물론 제품(서비스) 비용을 변상해야하는 일이 발생될 수 있습니다.',14,'2020-06-08 14:13:10','2021-10-20 14:00:12'),(23,'캠페인 가이드라인을 꼭 지켜야 하나요?','캠페인 가이드라인을 지키지 않을 시에는 광고주의 수정, 삭제 요청이 있을 수 있습니다.',14,'2020-06-08 14:18:53','2021-10-20 13:59:38');
/*!40000 ALTER TABLE `reviewer_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewer_suggestions`
--

DROP TABLE IF EXISTS `reviewer_suggestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviewer_suggestions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `reviewer_id` bigint(20) unsigned NOT NULL,
  `accept` enum('null','yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviewer_suggestions_campaign_id_index` (`campaign_id`),
  KEY `reviewer_suggestions_reviewer_id_index` (`reviewer_id`),
  CONSTRAINT `reviewer_suggestions_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reviewer_suggestions_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewer_suggestions`
--

LOCK TABLES `reviewer_suggestions` WRITE;
/*!40000 ALTER TABLE `reviewer_suggestions` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviewer_suggestions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviewers`
--

DROP TABLE IF EXISTS `reviewers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviewers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_num` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `zipcode` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL,
  `receive_agreement` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `point` int(10) unsigned NOT NULL DEFAULT '0',
  `certification_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviewers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviewers`
--

LOCK TABLES `reviewers` WRITE;
/*!40000 ALTER TABLE `reviewers` DISABLE KEYS */;
INSERT INTO `reviewers` VALUES (4,'zhongguoxue8@naver.com','조용완','$2y$10$GxsEHO3Z4.Pm1Fc1pM2JJ.uaxK4Z7159nJC1TYu1Nnwf15gFYsYaO','용느','01077412735','1992-09-07','49506','부산 사하구 다대낙조1길 12','102동 502호','m',1,NULL,'0D91rckxSLAZiMJz08215LNf2lhNIT8uGxHF09JIlsVeznv8hX7VvAO4OToa','2019-11-04 17:32:01','2022-10-24 11:32:02',0,NULL),(11,'bloxion1@naver.com','조용완','$2y$10$voUVoxfPZefaP3iwfjZv1eIx.D8hSSw6ITyybawD75CRHLPEFauR2','낄낄','01077412735','1992-09-07','49506','부산 사하구 다대낙조1길 12','102동 502호','m',1,NULL,NULL,'2019-11-11 17:07:19','2021-02-03 13:59:07',0,NULL),(17,'34sea@naver.com','제승희','$2y$10$avqvJ9ExmZHUzxAj0mn1r.MPY1W7fEebhrKGAMWQYvNV5HOnDJSsW','풍요맘','01025780799','1979-04-15','46228','부산 금정구 두실로37번길 49-5','1층','f',1,NULL,NULL,'2019-11-12 22:20:12','2019-11-12 22:20:12',0,NULL),(18,'ssh4752@naver.com','신소희','$2y$10$vf4QvLj45DuJz3MG1yzl4OSyrm.eRUQz9/rbDrjAlj.UogKDCIjgu','shsh','01029594752','1994-09-26','13928','경기도 안양시 동안구 동편로110','307','f',1,NULL,NULL,'2019-11-12 22:24:26','2019-11-12 22:24:26',0,NULL),(19,'youngmam79@naver.com','정현엿','$2y$10$IBh0pW5IMhPh4aa.0JaZauSqV3FijqQqP2KR9z9EMTOoQQgVbhDwq','쭌뭉','01086911924','1979-08-19','62223','광주 광산구 장덕로6번길 35','102동1602호','f',1,NULL,NULL,'2019-11-12 22:33:38','2019-11-12 22:33:38',0,NULL),(20,'seo160616@naver.com','임혜진','$2y$10$VQ6MqKReBUKC7rNAg9H4n./.7jJJBq3TrfpYSvaEhKK3Zum54QF9.','찰떡언니','01074682929','1985-11-04','21397','인천 부평구 장제로 98','스위트홈2동604호','f',1,NULL,NULL,'2019-11-12 22:35:58','2019-11-12 22:35:58',0,NULL),(21,'34sea@hanmail.net','제승희','$2y$10$U1bpyXKIOnH7sEhdQIqvP.nC2M7BUwoUI97rBBcKl303ltbpmWU9S','하루먹방','01025780799','1979-04-15','46228','부산 금정구 두실로37번길 49-5','1층','f',1,NULL,NULL,'2019-11-12 23:04:33','2019-11-12 23:04:33',0,NULL),(22,'gayoung4951@naver.com','서가영','$2y$10$qvL/yNKzpzp2c2ipoTPPy.GlsheI9cvsoPWi.OYaQB4A1ard3W/t6','Young','01036844952','2019-12-02','50966','김해센텀Q시티','107동803호','f',1,NULL,NULL,'2019-11-12 23:33:31','2019-11-12 23:33:31',0,NULL),(23,'cherrycoke94@naver.com','강민정','$2y$10$7/MmbtSOVqlzHjaV5v8z0u7zXyxQgMfXzsKY68FVzr5nSVyo8fJrS','민둉','01092989131','1994-10-07','03455','서울특별시 은평구 불광천길 494','603호','f',0,NULL,NULL,'2019-11-13 19:51:51','2019-11-13 19:51:51',0,NULL),(24,'zanne1218@gmail.com','정세희','$2y$10$PmMf5yaUzDYJ6FLDbvKvku6qj0XV8jwDIH980RsNf6RFr9KP7JbjK','프레','01030238845','1999-01-02','01841','서울특별시 노원구 공릉동 동일로192나길 14(공릉동,리더밸리)','303호','f',0,NULL,NULL,'2019-11-13 21:12:50','2019-11-13 21:12:50',0,NULL),(25,'jsc7993@naver.com','정진희','$2y$10$BbKCVZ5PGRXU/NFJsxGVvOQ75CcZb/BrwcOrZmwDuExCWibEI.o9u','geni_0316','01066647993','2002-03-16','51498','경상남도 창원시 성산구 동산로 115','대동아파트 112동 1604호','f',1,NULL,NULL,'2019-11-13 23:15:36','2019-11-13 23:15:36',0,NULL),(26,'cherrycoke1007@gmail.com','강민정','$2y$10$nA6YyOtHHbTvOrup21aVPOysVIkFuIbPXK/5kIssGvmbuDWAK6tli','민둉','01099999999','1994-10-07','03455','서울 은평구 불광천길 494','603호','f',0,NULL,NULL,'2019-11-13 23:39:19','2019-11-13 23:39:19',0,NULL),(27,'osh3074@naver.com','오세화','$2y$10$TlK5l0V.DAJMRjHxX1NCaOz0R539TxD.huASywBix.7tH4/nUhtz.','세화','01088183076','1997-08-22','18477','경기도 화성시 동탄대로시범길 20','1424동 701호','f',0,NULL,NULL,'2019-11-14 00:33:06','2019-11-14 00:33:06',0,NULL),(28,'seoyoun001@naver.com','김서연','$2y$10$RQ2AXLX7139kaBQ3Jfri1uamSbLaZO2YL88XOUKHVgN6SNlsPITTG','서돼지','01041458110','2001-04-30','16689','경기도 수원시 영통구 태장로 35번길 64','극동푸른별아파트 101동805호','f',1,NULL,NULL,'2019-11-14 00:34:18','2019-11-14 00:34:18',0,NULL),(29,'new__ss@naver.com','허유슬','$2y$10$RNp5MzY3sAV.chsUkC7hPuYb8H9NCiJRZff3P05e93BjolVWkKfWu','유슬','01056052373','1997-04-10','51768','경남 창원시 마산합포구 월영서 9길 27','이층 첫번째집','f',1,NULL,NULL,'2019-11-14 00:44:31','2019-11-14 00:44:31',0,NULL),(30,'dkmami@naver.com','봉숙진','$2y$10$/hv6py/VwooEvXFawKKrN.OFHiYhq2ExjJzOBrfDbXTIFkh/2pwqK','봉여사','01086474970','1974-06-20','22372','인천 중구 운남서로 7','영종자이 109동 2001호','f',0,NULL,NULL,'2019-11-14 07:22:23','2019-11-14 07:22:23',0,NULL),(31,'1iamfine@naver.com','박하나','$2y$10$3piTZwlHJTHx5DALR.pKremDMHj6q.MJWDBtiTp7WdrFIAvpKUTYG','히나','01044104504','1986-02-17','03998','서울 마포구 성미산로10길 36-13','601','f',1,NULL,NULL,'2019-11-14 10:18:07','2019-11-14 10:18:07',0,NULL),(34,'3130064@naver.com','김정연','$2y$10$gkIPLu5DoJQsHO2.KmrjDull6jo9nuTPUMDBHiQ1ofUfwtrZsMwR2','정욤','01029600064','1995-11-19','14902','경기도 시흥시 대야동 332-12 극동아파트','2차 104동 402호','f',0,NULL,NULL,'2019-11-14 20:54:00','2019-11-14 20:54:00',0,NULL),(36,'stevefly@naver.com','성나락','$2y$10$tXgQp7xMX8WJBLY8nqIKAeyZXN/zrVF4XXXndVIKdRSWMEo6hGV1O','ann','01055569157','1986-11-09','00000','부산시 남구 대연동','93-3 대연푸르지오 105-803','f',1,NULL,NULL,'2019-11-15 12:12:12','2019-11-15 12:12:12',0,NULL),(37,'ps717942@naver.com','고수경','$2y$10$FCYw9dUjrV26tAeqK6RNceifz2LePagExWEYj18M6EVblwp5lMYBO','슈슈','01052934805','1985-09-22','16339','경기 수원시 장안구 장안로 211','동신아파트 211동 1102호','f',0,NULL,NULL,'2019-11-15 13:30:26','2019-11-15 13:30:26',0,NULL),(38,'feelgyo48@naver.com','박현숙','$2y$10$hX09PKqrfSStcCQwfMX3Q.FmBrATOhURVSUgbWDTHKX1X6PvHPEly','하은맘','01077121987','2020-04-07','34510','대전 동구 가양동 165-11','영재빌301호','f',1,NULL,NULL,'2019-11-15 15:42:05','2019-11-15 15:42:05',0,NULL),(39,'bbabba77@naver.com','장윤형','$2y$10$ha6Kd9m.6hxv5LMUnNmlz.7K4CAlcWh4RMbooIurudbR7qm/ME97q','하니둥둥','01032547542','1977-01-05','07563','서울시 강서구 공항대로 59가길 5-7','3층','f',0,NULL,NULL,'2019-11-15 17:38:10','2019-11-15 17:38:10',0,NULL),(40,'wanna_be7777@naver.com','이원화','$2y$10$P1xg.7c1d3uiTBLNSBmba.0z2fryXiRwv2oHapUOUgVwoD9/SJevG','웬디','01067346799','1993-06-02','13963','경기 안양시 만안구 안양로532번길 12','107동 905호','f',0,NULL,NULL,'2019-11-17 00:00:44','2019-11-17 00:00:44',0,NULL),(41,'tmdwn1535@naver.com','서승주','$2y$10$StF4KxOaCuuf.Ja5v/IMMO6B0D7.64ryDTKcg6riouHWuZJbMM9/K','쓰룽','01056890094','1994-02-13','57969','전남 순천시 장선배기길 63','201-802','f',1,NULL,NULL,'2019-11-17 04:45:45','2019-11-17 04:45:45',0,NULL),(42,'cpahaja@naver.com','송준','$2y$10$TThTYY4VsaqOl0icA1I5v.XYeobulwSSs/jcyu/WAWTu9zXTd.0Ji','SSingaTV씽씽맘','01027988161','1981-03-03','07646','서울 강서구 강서로52길 80','아데나펠리스 202호','m',1,NULL,NULL,'2019-11-17 15:30:54','2019-11-17 15:30:54',0,NULL),(43,'dannymam@naver.com','송다현','$2y$10$iDRUfo6CByFjE0EBA0GrYO475VNDxB1njKi.y1FES9csRQqVtEG12','littlestar','01034387963','1988-07-03','05623','서울 송파구 석촌호수로 268','2201호','f',1,NULL,NULL,'2019-11-17 19:11:25','2019-11-17 19:11:25',0,NULL),(44,'joan2201@naver.com','안윤정','$2y$10$x6DFmAJy3y0HqYvPDAcs2ejyNZC7NYTQC.W6mTRqSi7eF4W63v0uO','윤스팟','01083724002','1998-07-27','05033','서울 광진구 구의동 229-25','101-101','m',0,NULL,NULL,'2019-11-17 20:34:28','2019-11-17 20:34:28',0,NULL),(45,'princenoa@naver.com','김현주','$2y$10$vSKsoI8RTacePdVsFyfuuuHC2Bm.NIJi3UkBT0cXhf4U2ja.PZ1de','주현하','01032732701','1995-02-07','08852','서울 관악구 신림동 611-154','청마 305호','f',1,NULL,NULL,'2019-11-17 22:36:10','2019-11-17 22:36:10',0,NULL),(46,'dbsa8439@naver.com','윤아름','$2y$10$TXjc3rbbVa1MckC/am.7neYV6uPIJMYaXZo8odMR8g.F6sRslsrpy','름또먹','01045658439','1991-06-03','44773','울산 남구 두왕로190번길 35-20','307호','f',0,NULL,NULL,'2019-11-17 23:57:28','2019-11-17 23:57:28',0,NULL),(47,'goodnabi0@naver.com','김태은','$2y$10$MLmlOwg7lQT9AckMAO1oI.nnKtM/zwlR0IyWqjtAAi1kgjNzX/PCK','착둥이','01083571127','1988-01-16','32009','충남 서산시 오산8길 16-6','검은지붕주택','f',1,NULL,NULL,'2019-11-18 01:30:39','2019-11-18 01:30:39',0,NULL),(48,'a-doong@naver.com','조세핀','$2y$10$lqF5DHueL7wFFl7TQhC3ZuCjZuV1R3dV2ILCcl.xNzOVYmFNL/1JO','아둥이','01077887010','1991-11-13','48118','부산 해운대구 마린시티1로 127','1401호','f',0,NULL,NULL,'2019-11-18 03:33:19','2019-11-18 03:33:19',0,NULL),(49,'dsfadsf@dkkj.com','가루','$2y$10$DyRrUV5yfNClHVLYQ8rpIeUANEH8N1mEHkmU4VAhqRgbjIVXQKxG6','가룩','01077778889','1111-11-11','46067','부산 기장군 기장읍 대라리 1000','1111','m',1,NULL,NULL,'2019-11-18 03:35:45','2019-11-18 03:35:45',0,NULL),(50,'truelove7712@naver.com','김애숙','$2y$10$XpOxSURgHXX3bjQaL/kRl.bJvp2fzXvLuE88H.zR.AVfcY/18QZzq','방울토마토','01098217712','1977-12-19','15215','경기 안산시 단원구 선부동 1099-13','지층02호','f',1,NULL,NULL,'2019-11-18 04:26:31','2019-11-18 04:26:31',0,NULL),(51,'choi__bb@naver.com','최보배','$2y$10$/PFfJSBUAoiPa6n9R1AhRuB2TDsoJATFthleEhuwABoppBym40XvG','쵭','01057757825','1988-02-20','21519','인천 남동구 서판로54번길 67','마동 401호','f',1,NULL,NULL,'2019-11-18 10:56:34','2019-11-18 10:56:34',0,NULL),(52,'doolsai@gmail.com','양승일','$2y$10$55OJzXxqBSjvyN/p8faJn.g/ClwvRoGpnqn79fFeuZfsn5zJOqlmC','gonggam','01037876873','1968-11-25','13558','경기 성남시 분당구 느티로 22','백궁동양파라곤 B-1224','m',0,NULL,NULL,'2019-11-18 12:02:59','2019-11-18 12:02:59',0,NULL),(53,'e0841231@naver.com','윤가희','$2y$10$d6Is8pj8IRk8XStrL7BRLun3TLgn5dtwhokauviogXmBTPq5yhYRi','메꽃','01056587845','1989-12-13','22133','인천 미추홀구 주안동 124-1','LH행복주택101동1010호','f',1,NULL,NULL,'2019-11-18 12:05:10','2019-11-18 12:05:10',0,NULL),(54,'sukinga@nate.com','이영박','$2y$10$YrwuSH.IoO/OGWtFLbxWwuXGV6C.66KTFvZIP5fj3Flu6XZRK1lSO','박영이','01022511522','1993-03-26','03062','서울 종로구 율곡로1길 40-12','일성빌딩 1층','m',0,NULL,NULL,'2019-11-18 13:12:01','2019-11-18 13:12:01',0,NULL),(55,'yoyoqp@naver.com','정연화','$2y$10$s4s06snt1GZV5ZONrm0UoesLKofIInWoEhx6FVZY6TXv0NqpAGvDe','콩순이','01058049204','1988-10-20','48112','부산 해운대구 좌동 1331','101동 1105호','f',0,NULL,NULL,'2019-11-18 13:59:18','2019-11-18 13:59:18',0,NULL),(56,'wuwrkxj@naver.com','오하령','$2y$10$mEBu9Y9m7waV3.LMaE/BZeUC32iCeA6T1eelrULL75UGf7TawEB7S','가유니공주님','01067276675','1989-11-01','28630','충북 청주시 서원구 두꺼비로60번길 26-5','301호','f',1,NULL,NULL,'2019-11-18 14:45:57','2019-11-18 14:45:57',0,NULL),(57,'nrg_zzwl6434@naver.com','최혜지','$2y$10$R9J.YzqrWMpd/ZRGN4Cx8uoGlHEBslcNMR07ytpLzztOVy.HZ672S','욤다닥','01043553134','1992-03-22','44255','울산 북구 명촌로 94','103동 909호','f',0,NULL,NULL,'2019-11-18 15:05:46','2019-11-18 15:05:46',0,NULL),(58,'temily@temily.co.kr','성빈','$2y$10$9fIis7m2/KExMOkke0SfeulVKOnIUuSDCv6deNUxCk5PKbISdxK/y','테밀리','01076510427','1990-04-27','08215','서울 구로구 경인로55길 31','라동 408호','m',0,NULL,NULL,'2019-11-18 16:35:37','2019-11-18 16:35:37',0,NULL),(59,'namhuira98@gmail.com','남희라','$2y$10$KfaLBHVRoyLNiZR81zpp7.2LqCel7bCQrjbsi09IgvcW6h1q47HEG','feelsu','01099393425','1998-08-27','04144','서울 마포구 마포대로 127','풍림브이아이피텔 414호','f',0,NULL,NULL,'2019-11-18 17:39:07','2019-11-18 17:39:07',0,NULL),(60,'nohsubin1223@naver.com','노수빈','$2y$10$z85WtOwJIDcmom2FdJY9teNU8B9gQS5GzZJABfzgYHR/GncLKM9Da','노숲','01097291223','1988-01-02','11901','경기 구리시 갈매순환로204번길 26-14','1층','f',1,NULL,NULL,'2019-11-18 19:03:39','2019-11-18 19:03:39',0,NULL),(61,'mrp@naver.com','박미란','$2y$10$nGL85b2M7sLiHGrS3kG6RO0shzsOg/1F8/sis3GQmKXUrWnMMnybK','사이에','01094374037','1989-05-03','34188','대전 유성구 도안대로 560','105-21-','f',1,NULL,NULL,'2019-11-18 20:06:52','2019-11-18 20:06:52',0,NULL),(62,'ranpark@kakao.com','박미란','$2y$10$RUw17a1E472Q4KL6r7DiAezQ6rUib2Dr8H5LnpNghnz0E63DqJS7e','사이에','01094374037','1989-05-03','34188','대전 유성구 도안대로 560','105-210','f',1,NULL,NULL,'2019-11-18 20:10:08','2019-11-18 20:10:08',0,NULL),(63,'ckh5293@naver.com','최가현','$2y$10$U5ojtA/loE7pyqf1Y.JZ2.BiXdegDFfqpUZQqgMCCBrnEZieS0EUC','잉냐','01093945292','2002-01-25','53023','경남 통영시 용남면 적촌 2길 59','.','f',0,NULL,NULL,'2019-11-18 20:27:41','2019-11-18 20:27:41',0,NULL),(64,'aria52@naver.com','이광옥','$2y$10$YL0B300r3HgGZzhcmRwZV.xbhAPs8IAM7vttQH6rDBL03Cei3bmn6','핑크여우','01044555252','1980-11-11','38595','경북 경산시 백자로20길 9','302/1001','f',0,NULL,NULL,'2019-11-18 21:43:37','2019-11-18 21:43:37',0,NULL),(65,'918__@naver.com','조승연','$2y$10$Y2kWX0W/083E33MZMjVFMe4BUc7vmv.RJWKzReg1uPJaWn/kALQ1G','조모찌','01097979018','1997-09-18','34646','동백동 610-9','302호','f',0,NULL,NULL,'2019-11-19 02:38:43','2019-11-19 02:38:43',0,NULL),(66,'kissmint333@naver.com','이다솜','$2y$10$6P5hVBl6DpqLj6OUgT0p1.jGzpboyL7U.fdhJeZEDP41qCWcgNiru','솜로그','01045264543','1989-08-07','39276','경북 구미시 백산로 153','102-1701','f',0,NULL,NULL,'2019-11-19 02:41:17','2019-11-19 02:41:17',0,NULL),(67,'rin_hun315@naver.com','전혜린','$2y$10$QzloOCcJun30B.KZ9L7.5eAulgoiXOLWFXZNU/mfyIeQG4iBgu8lm','평화맘린짱','01088689785','1981-02-22','04998','서울 광진구 능동로27가길 14','101호','f',1,NULL,NULL,'2019-11-19 03:39:29','2019-11-19 03:39:29',0,NULL),(68,'wmfmdl@naver.com','박혜란','$2y$10$/P9/oDEnNWwoNIaWElbqjOqKQq/tspt/R/IpI.yLYKLyOGeBSqe1u','라니고라니','01051666166','1989-12-16','49246','부산 서구 토성동5가 39-7','3','f',0,NULL,NULL,'2019-11-19 03:42:28','2019-11-19 03:42:28',0,NULL),(69,'genie_y_@naver.com','윤진희','$2y$10$zeMztCDwRsqmX.mJYwz8oOcAV4lK4dQXhoUcdRo8JwAJNz47Z4wem','윤지니','01024940070','1985-07-20','44256','울산시 북구 명촌로 91','평창리비에르 2차 221동 903호','f',1,NULL,NULL,'2019-11-19 06:54:52','2019-11-19 06:54:52',0,NULL),(70,'gkqls879@naver.com','황하빈','$2y$10$Sa5vZWd5R/L/2jD7Tx58deSWSKttU4ZetlUCixIk8g133lz.t7NM2','빈토리','01048258799','2019-11-06','42615','대구 달서구 선원남로 99','311동504호','f',1,NULL,NULL,'2019-11-19 11:43:12','2019-11-19 11:43:12',0,NULL),(71,'yahmi07@naver.com','김민희','$2y$10$j5wgyiuRei/2FYN/H7LdVu01UPq/Z6x5sJ4ELbhQexJeU3tx3uSbW','꾸꾸맘','01041472817','1984-02-20','18507','경기 화성시 동탄대로4가길 26','3334동 502호','f',0,NULL,NULL,'2019-11-19 14:27:03','2019-11-19 14:27:03',0,NULL),(72,'pjb0730@gmail.com','박주병','$2y$10$yMviDwzQy3bJtd8nALvtwehLY2dQjVPWm/W7MpKJH9ct5LvNVfvq6','콩딱파파','01067003099','1989-07-30','14480','경기 부천시 평천로849번길 69','101동 203호','m',1,NULL,NULL,'2019-11-19 19:06:08','2019-11-19 19:06:08',0,NULL),(73,'leehoney_g@naver.com','이보영','$2y$10$XnsCBSDxTicJ4zc5n4pzJO6msPhE8/dX/FSP3Des1OkL/UEa.lj.W','이꿀지','01063551029','1988-10-29','05016','서울 광진구 아차산로27길 42-3','303호','f',1,NULL,NULL,'2019-11-19 21:20:38','2019-11-19 21:20:38',0,NULL),(74,'edwin9407@naver.com','정한솔','$2y$10$LkBEsGtNifqA35IYLuLfXOv9B.8zdE19zxkf.92PE3ugwG0uwk2b.','정스타그램','01037023077','1994-07-18','37591','경북 포항시 북구 양덕로 60','양덕풍림아이원 104동 402호','f',0,NULL,NULL,'2019-11-19 22:10:36','2019-11-19 22:10:36',0,NULL),(75,'jjwlgus78@naver.com','이지현','$2y$10$nrzLR.q2FbImDkuif6c6TOtghRK0MY1mUnLVfoFrRFLGWCnwjhtfG','이지똥','01090436705','1979-02-02','07965','서울 양천구 목동중앙서로7다길 45','에스타워 101호','f',1,NULL,NULL,'2019-11-19 23:11:11','2019-11-19 23:11:11',0,NULL),(76,'baejji4612@naver.com','이소영','$2y$10$TOchhmFx/abJb/RkdIFyGOus73zUifExPHHgxiDIPlp.uQu6MdRHa','송정새댁','01072404612','1990-07-23','44236','울산 북구 박상진3로 73','104동 607호','f',1,NULL,NULL,'2019-11-20 07:55:50','2019-11-20 07:55:50',0,NULL),(77,'sb0606@naver.com','김수복','$2y$10$JfdtlP5swPO.PGti49rjNeVB7V0RjKxJsmbVTgSndUgRquwyPtRD2','몽상쟁이','01091591308','1980-04-24','51590','경남 창원시 진해구 냉천로 257','415동 402호','m',1,NULL,NULL,'2019-11-20 08:42:22','2019-11-20 08:42:22',0,NULL),(78,'soobok800514@gmail.com','김수복','$2y$10$uNiOgm0wIfLIV8DYvLqa.uLTY2eBa1K4bB95Fp6wqXLD7zjZxtw.O','몽상쟁이','01091591308','1980-04-24','51590','경남 창원시 진해구 냉천로 257','415동 402호','m',1,NULL,NULL,'2019-11-20 08:46:51','2019-11-20 08:46:51',0,NULL),(79,'wlswn502@naver.com','송진주','$2y$10$VgAHpGk8RyChAyey7q29Me7lpC5tUgPq6iMdE8f8KCbHRSg5EweLG','서윤이맘','01034725145','1991-05-06','47707','부산 동래구 금강로61번길 84','303호','f',1,NULL,NULL,'2019-11-20 10:40:48','2019-11-20 10:40:48',0,NULL),(80,'dbsel88@naver.com','조윤지','$2y$10$fAQvkkQdVe9EJvURnlYZ0u79B1DAM0CHu6vkKdxlJVvGgLMSDcWKW','장군이언니','01036327983','1988-01-05','08239','서울 구로구 고척동 347','다미안3차102동203호','f',1,NULL,NULL,'2019-11-20 11:41:26','2019-11-20 11:41:26',0,NULL),(81,'oioio11@naver.com','서효숙','$2y$10$0od5VG2SziY/pjozJDgI2ejsnhWICvXbkZiMDV8tCtaDHZgxxpCUK','랑유','01059679719','1987-04-30','21508','인천 남동구 백범로 404','1409호','f',0,NULL,NULL,'2019-11-20 12:29:38','2019-11-20 12:29:38',0,NULL),(82,'omjcrow@naver.com','오명재','$2y$10$YhBbKHB2KN/5jZuJp4ECs.kM4Y3sYq4saERyYQD0uPkFMiaV2.hM6','으헣','01095550203','1988-07-15','44698','울산 남구 삼산중로 144','3층','m',0,NULL,NULL,'2019-11-20 15:04:39','2019-11-20 15:04:39',0,NULL),(83,'lsszz210@naver.com','이상선','$2y$10$eHt7fVD3qXoLTs6EysATiOAIqTtmj9h7ABj11KqZECk5ZDwd1coxK','소울보이스','01033706538','1987-07-06','14235','경기 광명시 오리로876번길 30','1차동 705호','m',1,NULL,NULL,'2019-11-20 20:44:28','2019-11-20 20:44:28',0,NULL),(84,'gytmd3412@naver.com','오효승','$2y$10$0uvMdGG8qd3HVFeIKkwyguKBldbgWngkqsVwqzi24D.Pe66K.RWC2','정래와재후와정후','01050005694','1984-01-15','31175','충남 천안시 서북구 충무로 124-24','108동1503호','f',1,NULL,NULL,'2019-11-20 21:07:15','2019-11-20 21:07:15',0,NULL),(85,'lovablj@naver.com','이진아','$2y$10$jr9Wrhmj4ohxwaUcR8H0R.Qs2hULDpN.dksDAT9p5p78B7d59TgYK','루카','01092899789','1984-10-23','08830','서울 관악구 청룡10길 45','102-502','f',1,NULL,NULL,'2019-11-21 02:24:36','2019-11-21 02:24:36',0,NULL),(86,'jjoolevel@gmail.com','이은주','$2y$10$oOFVt1R/tgd.n6pTfQYjgOWXfezzywtZhKJWY0UyWfdfJWD9XY2b6','올때메롱','01055505125','1986-06-28','15337','경기 안산시 단원구 당곡3로 3','701동 1305호','f',0,NULL,NULL,'2019-11-22 01:34:46','2019-11-22 01:34:46',0,NULL),(87,'theboss005@naver.com','남찬우','$2y$10$QmkcEpbS1cu7FwV41CHuB.FdPVOmX0cVB4FsL7Dg6QCMKA2QQEDAy','동네형들','01055272500','1995-05-12','21048','인천 계양구 계양대로205번길 8-1','202호','m',1,NULL,NULL,'2019-11-22 11:14:54','2019-11-22 11:14:54',0,NULL),(88,'kke0703@gmail.com','강군','$2y$10$ar89gp4RpJVudj4Me0iSdelzaUzZmHhm5X1xg4zTb3Hu6G2HtaivC','강군','01098337003','1985-07-03','13524','경기 성남시 분당구 대왕판교로606번길 45','115-102','m',0,NULL,NULL,'2019-11-22 18:59:16','2019-11-22 18:59:16',0,NULL),(89,'kke3323@gmail.com','강군','$2y$10$I9Mn0DbtvU/mReu2Aylw5ei.u/xcOvGTY.e2ivn7tgm/zW7b59ByS','강군','01036976569','1985-07-03','13524','경기 성남시 분당구 대왕판교로606번길 45','115-102','m',0,NULL,NULL,'2019-11-22 19:00:44','2019-11-22 19:00:44',0,NULL),(90,'burik10@naver.com','강동훈','$2y$10$Qt7XUBoJT5JfSZI1xx/Asu1/hpE.EDLU0NSuVp4yAAWaPeroAIzrG','세류','01042820918','1996-02-01','52822','경남 진주시 가좌동 1442-6','401호','m',0,NULL,NULL,'2019-11-22 19:28:52','2019-11-22 19:28:52',0,NULL),(91,'ssouil@naver.com','김지수','$2y$10$Xm3ZRig5cmj.5.Tq1XAXnuA14R8HufOB1S494q3FVrGTvIWVo5oOq','보리','01051656689','1986-10-11','27871','충북 진천군 덕산읍 연미로 128','601-802','f',1,NULL,NULL,'2019-11-22 19:49:41','2019-11-22 19:49:41',0,NULL),(92,'ctrlz88@naver.com','박형규','$2y$10$WiOUWoTk1T3hAg5Vc7vcjOyNBj/5Vwyhy2un3kY9RyAU81tCYkMJS','루킷','01080308930','1988-12-26','08323','서울 구로구 구일로8길 92','3동 1208호','m',0,NULL,NULL,'2019-11-22 20:42:32','2019-11-22 20:42:32',0,NULL),(93,'mimoa88@naver.com','강성재','$2y$10$I70AlQoZKVg/jzU2yc791OqEYYmLIvCHPhzBca2ZG5AXjpUl2EqGq','모리','01085032994','1994-07-07','54083','전북 군산시 팔마로 138','1층 미모아','m',0,NULL,NULL,'2019-11-23 00:29:26','2019-11-23 00:29:26',0,NULL),(94,'taehomon@naver.com','이태호','$2y$10$eP8krQZay31xsfjQP1.id.6lwB8hPtSVdQC3WUjBZv5YdCpYn4bWu','꼼태','01041759190','1997-06-01','14621','경기도 부천시 석천로 16번길 66','디아망','m',1,NULL,NULL,'2019-11-23 01:14:53','2019-11-23 01:14:53',0,NULL),(95,'3848346@naver.com','이아림','$2y$10$lXg.a0fls3WEwtK/cJns1uRgGh8vyJBcdsuXVPU5lwxOg2QJ.W4MW','이아','01079333866','1990-04-12','21045','인천 계양구 계산로74번길7','경신로얄빌라 a-b02호','f',1,NULL,NULL,'2019-11-23 01:23:20','2019-11-23 01:23:20',0,NULL),(96,'nazi_day@naver.com','김혜빈','$2y$10$8qlYfosEGObkOrsayNsJee4sidfhCF978DjDdKC4r8XWVtSOBLotK','나지','01036056776','1995-05-26','03938','서울 마포구 모래내로 5','817호','f',1,NULL,NULL,'2019-11-23 05:20:26','2019-11-23 05:20:26',0,NULL),(97,'sally3006@nate.com','김혜빈','$2y$10$eEj1oIS0HOdHsvcoKt.5NOlEmSWl1xE0fhEndCEh4ljE/xjhBayRW','나지','01036056776','1995-05-26','03938','서울 마포구 모래내로 5','817호','f',1,NULL,NULL,'2019-11-23 05:26:06','2019-11-23 05:26:06',0,NULL),(98,'dmsco386@naver.com','조은채','$2y$10$jIq3mLF/G5t5UVJp2d9koO2KS16WsFIXeef3amijhEYgfKxC4pA5y','분홍복숭아','01020704178','1998-02-27','27478','하단2길 35','리오빌102호','f',1,NULL,NULL,'2019-11-23 10:12:56','2019-11-23 10:12:56',0,NULL),(99,'xodud8642@naver.com','김태영','$2y$10$07e8DxM6qJu/usCkcyzikuBOZHNkZl3dOa/5HrVdX4kTjRyIeQTOe','탱요미','01057891926','1998-12-08','34860','대전 중구 선화동423-21','띠아모빌 401호','f',0,NULL,NULL,'2019-11-23 11:09:45','2019-11-23 11:09:45',0,NULL),(100,'sexy_bom@naver.com','심보미','$2y$10$abP.igBIdfmT.RcY1U2w3.lmQC5Q89x1.2m69tJ1pgKNN.pfo5Lj6','쫄봄','01058111712','1990-10-02','07519','서울 강서구 방화대로48길 40','211동 1306호','f',0,NULL,NULL,'2019-11-23 12:09:44','2019-11-23 12:09:44',0,NULL),(101,'dlahrwl@naver.com','이목지','$2y$10$1N9GRxwtwyKBzUv7azHZjes.e5yYP.TtIzSYr9Pr.DeFShtkQxVs.','체대생모찌','01079282802','1995-10-02','17821','경기 평택시 고덕면 서동대로 2651','202동 905호','f',0,NULL,NULL,'2019-11-24 00:53:16','2019-11-24 00:53:16',0,NULL),(102,'ahnjiae2@naver.com','안지애','$2y$10$tDBiRGuO0brOEVQOQ.dqguoQ/v8SLhKAfeF2xgOM/gWNNXEke/0rC','JIAE','01091810302','1991-05-06','03750','서울 서대문구 북아현로14길 48','202호','f',0,NULL,NULL,'2019-11-24 07:05:32','2019-11-24 07:05:32',0,NULL),(104,'zzksylove@naver.com','권순영','$2y$10$0xrbVk2P1p6QxkmVgtJiquxLCre7HHgXRZeOPymJbn8yY3d1xCTyC','순디','01030201402','1989-05-19','16295','경기 수원시 장안구 경수대로976번길 22','108동 2003호','f',0,NULL,NULL,'2019-11-24 21:05:30','2019-11-24 21:05:30',0,NULL),(105,'sundiln@naver.com','김선희','$2y$10$LGf9IqXE/swYnzf4Xd.slu09eMB5KyalnDXKb2TbFWHqgT4A8U25G','써니스타','01067735533','1993-10-19','41413','대구 북구 동변동 690-10','복실하이츠 202','f',1,NULL,NULL,'2019-11-24 22:50:17','2019-11-24 22:50:17',0,NULL),(106,'fungji@naver.com','문성지','$2y$10$4wHm49QjPkyuncSJQIbuj.VVFW/lE/yaIshIJKnDMYgDd8otFq482','fungji','01026597993','1984-06-22','51582','경남 창원시 진해구 진해대로 727','102동 501호','f',0,NULL,NULL,'2019-11-25 06:54:52','2019-11-25 06:54:52',0,NULL),(107,'nuri527@hanmail.net','문누리','$2y$10$vnqqdkXrpJRTg2FbyCYzfOK0Grvo0xln.H4Ekbrpdy.ONYpFiAuHW','아보카도올리브','01025273563','1990-05-27','02077','서울 중랑구 봉화산로48길 62','102동 2304호','f',0,NULL,NULL,'2019-11-25 13:49:26','2019-11-25 13:49:26',0,NULL),(108,'lisianthus1231@naver.com','김지언','$2y$10$pdPcQCiV9eZ.JmUSOW7V4OJFaSVEVdaEOyWLUBnQAkbrQoy.5vztO','jinnnnni','01096010939','1989-12-31','50656','경남 양산시 물금읍 물금로 57','505-2102','f',1,NULL,NULL,'2019-11-25 14:52:36','2019-11-25 14:52:36',0,NULL),(109,'choinuri01@naver.com','최누리','$2y$10$Vd93OroLG87P0gzD8p9iU.T3pPBYKiqoKDxd3DV9yd2tBzRQC4K1O','눌구름','01054733013','1995-01-03','55343','전북 완주군 삼례읍 충혼길 50','102/1303','f',0,NULL,NULL,'2019-11-25 19:18:15','2019-11-25 19:18:15',0,NULL),(110,'rjhzzz@naver.com','류주혜','$2y$10$tv9K2clS9igLdQBeo18P6e7NODaE5eqECVtNkIG8C49qG9jXq/0m2','애몽','01036541636','1984-02-11','10104','경기 김포시 감정로 64','111동 1505호','f',0,NULL,NULL,'2019-11-25 20:22:12','2019-11-25 20:22:12',0,NULL),(111,'heartb2151@naver.com','김윤정','$2y$10$p0BrPHL9oKSk8ldYgfmI8OrCKuY1X/m0sArI/MDvXljdrZs86zSPW','쪙이에요','01025471278','1984-08-30','01647','서울 노원구 덕릉로 780','104동703호','f',1,NULL,NULL,'2019-11-25 23:46:47','2019-11-25 23:46:47',0,NULL),(112,'tlawlgp423@gmail.com','심지혜','$2y$10$6AaOJRtVT7i9BJqr3W2oN./9/eIKw3qV.mQN7ujKyAU9Nh5lTFELy','유비맘','01099722295','1992-12-02','21344','인천 부평구 길주로 623','롯데마트3층 네일잇','f',1,NULL,NULL,'2019-11-26 00:45:03','2019-11-26 00:45:03',0,NULL),(113,'pantaaa@naver.com','차영인','$2y$10$xFSEy1tQDDGY5kMqoXcqFeajQHZREcC3VDFEkD/QXOhgEUigrGOry','초코쉐이크','01028947120','1987-12-16','02593','서울 동대문구 황물로 60','용진빌딩310호','f',1,NULL,NULL,'2019-11-26 02:00:05','2019-11-26 02:00:05',0,NULL),(114,'mous03@naver.com','이태호','$2y$10$A3STCbzxe4.ybHoMuayWNOI/4gCsYvPwMlXE0pj4xDAm8TBJ5pe8q','김작가','01041759190','1997-06-01','14621','경기 부천시 석천로16번길 66','202호','m',0,NULL,NULL,'2019-11-26 17:16:13','2019-11-26 17:16:13',0,NULL),(115,'remiyo79@naver.com','진선종','$2y$10$AOC0K8CMZqq9bxZ.Jki99uNOBCE3fxL1qLVnU5x1KU0XeO8kECTHK','꽃구름','01092337115','1979-08-01','21335','인천 부평구 갈월서로 46','5-602','f',1,NULL,NULL,'2019-11-26 17:18:34','2019-11-26 17:18:34',0,NULL),(116,'tpgml1004_@naver.com','김세희','$2y$10$oHf8Iepmtxc5NoJyppo.3eBG5pDhtX3Z7eYgsGN3TpkrtB5tWl.7C','희','01064811175','1995-03-01','03420','서울 은평구 갈현로4길 5-23','동우리체 502호','f',1,NULL,NULL,'2019-11-26 17:20:48','2019-11-26 17:20:48',0,NULL),(117,'cutesiwoo@naver.com','박주영','$2y$10$fmx4nTdg19eFac0QNVvImOFzUwxOZPnKk9dArPsi6omWh.0xyDC26','명랑남매','01066881212','1984-04-09','44220','울산 북구 신천로 26','신천효성헤링턴플레이스 103동 2105호','f',0,NULL,NULL,'2019-11-26 17:21:06','2019-11-26 17:21:06',0,NULL),(118,'emflal02@naver.com','신혜경','$2y$10$aB64TsO0f9nZbln29/SiyOGW7fkGA2y7R.vUdduNSN3fmoPg9DeaS','폴레폴레','00178494492','1984-02-07','46244','부산 금정구 구서온천천로 59','1202','f',0,NULL,NULL,'2019-11-26 17:22:20','2019-11-26 17:22:20',0,NULL),(119,'leesunz@naver.com','이선형','$2y$10$fyt4h2I/S3QPFc8BZmNQuuarEYQLLjRgjUztJEpfUymY.FUI/vr1m','오호컴퍼니','01050195118','1980-11-23','08297','서울 구로구 공원로 26','306호','m',1,NULL,NULL,'2019-11-26 17:52:50','2019-11-26 17:52:50',0,NULL),(120,'juupapa@naver.com','박정민','$2y$10$1hxo4mVFXpqu0qpwOAyexe3GN1t517o3UeFGdk/USKedKxYXYkgpy','화쟁이','01032918202','1968-02-28','11500','경기 양주시 어둔동 368','산에산','m',1,NULL,NULL,'2019-11-26 20:22:46','2019-11-26 20:22:46',0,NULL),(121,'ce001121@naver.com','변찬은','$2y$10$FzP7STEiQ3dlEo1qDJDr6OX1YAMh0OFy3v.pVbYhN79YA3v8qTqW6','아리따은','01028588768','2000-11-21','39213','경상북도 구미시 야은로37 구미대학교','여자생활관','f',1,NULL,NULL,'2019-11-26 22:18:34','2019-11-26 22:18:34',0,NULL),(122,'fabulatio@naver.com','허지이','$2y$10$BmfVkc5E/zH2Z4Q08StBVuWnXV4k4TlAnz8Ep1BxpkFkJSZBxEmqe','지이TV','01063949181','1990-08-14','15589','경기 안산시 상록구 후곡로 14-1','203호','f',1,NULL,NULL,'2019-11-27 00:52:13','2019-11-27 00:52:13',0,NULL),(123,'ruwk143com@naver.com','123','$2y$10$ubWvupdSGwKzRS1Lmx06b.zbBz1OGGPPLcmUKyKmh2J8ySLiaCtuq','123','01122244235','1998-09-07','12345','123','123','f',1,NULL,NULL,'2019-11-27 06:12:33','2022-01-11 10:22:07',0,NULL),(124,'tnrl1207@naver.com','최혜숙','$2y$10$rm4XFA0Vd2qzTsNk7qLyMeVvBQdVczgjvhzaZThdkhEqw7AK6wTfO','치킨투어237','01027202650','1985-12-07','12930','경기 하남시 조정대로 150','423호','f',0,NULL,NULL,'2019-11-27 13:19:27','2019-11-27 13:19:27',0,NULL),(125,'yoonhee_93@naver.com','장윤희','$2y$10$tXoC6XKZO.xw857L5J5lg.evj81b3mJhaTF90kU4jynrTGwENdwtu','장보스','01054706558','1993-06-26','01382','서울 도봉구 방학로 193','12동 202호','f',1,NULL,NULL,'2019-11-27 14:29:12','2019-11-27 14:29:12',0,NULL),(127,'namgyu08@naver.com','남규선','$2y$10$IWauTFkkhYvoMybhOtzDyO04pSYVHdlPWyMwxelz4nbjIw2bKXFB2','썬블리','01064825998','1987-02-17','38488','경북 경산시 진량읍 일연로 528','체시스','f',0,NULL,NULL,'2019-11-27 15:18:10','2019-11-27 15:18:10',0,NULL),(128,'kjy3207@naver.com','김종열','$2y$10$A5nDcw.re4gO.6HaC.d50ObRtkxdWrt/2dEKgpyf2X4p5dN4QBy/K','케렌시아','01028694624','1984-02-25','12248','경기 남양주시 다산중앙로81번길 25','3510-1503호','m',1,NULL,NULL,'2019-11-27 17:03:13','2019-11-27 17:03:13',0,NULL),(129,'j1naz@naver.com','박진아','$2y$10$qdcxxfMumYIuEjV.Pq5R6uTgGNzI9Pe6ooZdluhTwuwd08MDZpW3C','어깨너머','01032749030','1987-10-08','35380','대전 서구 구봉산북로280번길 27','하얀빌 202호','f',1,NULL,NULL,'2019-11-28 11:51:22','2019-11-28 11:51:22',0,NULL),(130,'ggomangheaya@naver.com','신승혜','$2y$10$bcRh5g3wKaYSuX7zS8956ulpjVgTzHn9fNtWLTBgsrc8wQF2AqYKW','망치코코','01067070005','1990-12-06','50597','경남 양산시 물금읍 범어리 716-3','스마트원룸404호','f',1,NULL,NULL,'2019-11-28 22:37:26','2019-11-28 22:37:26',0,NULL),(131,'actorwow@naver.com','강두형','$2y$10$mPiCLcpRZyA.kKvH1MP.nuMCNcdiwHVlncj5ScXZqesVtHqWCvIw.','바쁜남자','01079203030','1979-09-27','47900','부산 동래구 온천천로 451-1','1층','m',0,NULL,NULL,'2019-11-28 23:25:40','2019-11-28 23:25:40',0,NULL),(132,'history201@naver.com','조지은','$2y$10$iY1ULD1AMLfAjcGVrAis/.0GdO.MaY71hcrCjTM46/v4cwyds6F.2','조조','01093490223','1985-11-01','50657','경남 양산시 물금읍 버들2길 31','201호','f',1,NULL,'rqZssQtXeuw90FPEetSt1LuX9zNKWNu6pakI8gaCbzY7LqbePSrlpUoxgarl','2019-11-28 23:42:42','2021-10-17 20:31:17',30700,NULL),(133,'adong@gmail.com','임호윤','$2y$10$bdk8ZDIHRQogPbuX7b7rt.i6VwPyDOqVqfNX1wCSz5fchOBF7SXQm','임자','01028858620','1976-08-30','48292','부산 수영구 감포로 5','2층','m',1,NULL,NULL,'2019-11-28 23:48:58','2019-11-28 23:48:58',0,NULL),(134,'welcomesnj@gmail.com','박진헌','$2y$10$9hi4vKe9Z1OYNMN6pJI.OehLsQdjt5N3t9YDsYFhDF3LfIgTqvWX2','에스앤제이','01071593407','1990-12-07','06326','서울 강남구 선릉로 8','219동 102호','m',1,NULL,NULL,'2019-11-29 11:00:59','2019-11-29 11:00:59',0,NULL),(135,'qotjdud@daum.net','배서영','$2y$10$.hpYTqqwA8V2zt0xb7MH/umr.9oMGwmav5yyA7PQadskNpTeWxs9i','서영','01091414556','2002-05-23','31748','충남 당진시 신평면 거산3거리길 74-11','코아루 103-101','f',1,NULL,NULL,'2019-12-01 20:16:25','2019-12-01 20:16:25',0,NULL),(136,'wlgnsdl123412@naver.com','이지훈','$2y$10$PYteogQA944lp26IgDesTucLuBprJ7TOwy5uBWrYznaScw7ELOGFi','지훈이','01046789364','1993-06-04','41456','대구 북구 태전로7길 3-5','대우빌리지 101호','m',0,NULL,NULL,'2019-12-01 21:12:02','2019-12-01 21:12:02',0,NULL),(137,'omone@naver.com','장동원','$2y$10$MKltCBYlclwGns1M0FboAe5B8NXP4V/ZVWZIyliSu0VIFB6FHoEry','장감독','01054209534','1984-05-07','44942','울산 울주군 언양읍 서문1길 4','알프스빌라 4동 301호','m',0,NULL,NULL,'2019-12-02 01:12:49','2019-12-02 01:12:49',0,NULL),(138,'rodls1@naver.com','rodls','$2y$10$nNJR65rk1siit5QYkRKZp.E2JT11VfORBfpRkyCSstaM12NUHB8.S','rodls','01011111111','1111-11-11','06122','서울 강남구 논현로111길 3','1','m',1,NULL,NULL,'2019-12-02 09:55:17','2019-12-02 09:55:17',0,NULL),(139,'kenshin209@naver.com','맹두환','$2y$10$2QqoJ1MkSGhKH2by8.a0Tufrrv6z3jyn0EFzbsgchWn/cDSUOy8m2','콩콩TV','01081575258','1983-04-08','58677','전남 목포시 남악1로52번길 83','105동 1502호','m',0,NULL,NULL,'2019-12-02 17:58:23','2019-12-02 17:58:23',0,NULL),(140,'wlsni76@gmail.com','김미진','$2y$10$PdQcKyjFCIMBbq/xywEGjuh.h3adOm4UvcEcXg3gvQFrxkNhcPYLS','하야니','01039949531','1986-10-07','32439','충남 예산군 예산읍 대학로54번길 19','1층','f',0,NULL,NULL,'2019-12-02 21:59:32','2019-12-02 21:59:32',0,NULL),(141,'jyr7156@naver.com','정유리','$2y$10$Gfps2QYjGbajms/S1R4XMu9WpzJ3m3UAAlvPJ0uWszHKUCl94wi02','봉구네주얼리','01096182638','1994-06-07','05841','서울 송파구 문정동 620','A동','f',1,NULL,NULL,'2019-12-03 08:36:55','2019-12-03 08:36:55',0,NULL),(142,'pmj9475@naver.com','박미정','$2y$10$J23vyCTXPKTFav/iI65xm.fIY/xVZ8jsbHhhFRuTnYB56LiaBAmLS','바겨사','01033459475','1975-05-25','11709','경기 의정부시 평화로272번길 11-1','호원아이빌리지 E동 402호','f',0,NULL,NULL,'2019-12-03 13:25:52','2019-12-03 13:25:52',0,NULL),(143,'dudgy94@naver.com','최영효','$2y$10$x/2KVotMWKowbACKldGKEeUDROzAMo2I97QmgfOURAOsM6tjJAsXq','앵굴','01049686292','2019-12-03','03988','서울 마포구 연남로 39','2층','m',1,NULL,NULL,'2019-12-03 15:57:52','2019-12-03 15:57:52',0,NULL),(144,'remixremix@naver.com','김정민','$2y$10$iD.pJ9UDic6WtUSQQ7Flju3r1f2//dYF0.TdkPSGyrGld/1kUnOPS','아이스망고','01087526655','1995-06-25','13015','경기 하남시 위례광장로 285','6209-402','f',0,NULL,NULL,'2019-12-04 00:37:01','2019-12-04 00:37:01',0,NULL),(145,'chosaehee@naver.com','조새희','$2y$10$jXhlQEgcvXXVlYUzOxncM.WDJRp7ImDSpgAMifKHnMVPAhWOOEp4K','서르니','01067571523','1989-05-28','22810','인천 서구 가좌동 7','가좌한신휴플러스 104동 702호','f',0,NULL,NULL,'2019-12-04 00:58:35','2019-12-04 00:58:35',0,NULL),(146,'waj129@naver.com','이주희','$2y$10$S0os3Px742L/iPOn6nsuF.yJ.kImrhxECK8mxlzvqbKGU.mmyGNIu','리얼조이','01057218701','1993-02-20','03682','서울 서대문구 북가좌동 295-18','엘리시아 202호','f',1,NULL,NULL,'2019-12-05 10:54:03','2019-12-05 10:54:03',0,NULL),(147,'amatriciana88@gmail.com','강병효','$2y$10$mQLUA3.ISVKErxWSkaILK.7q/9X7Sxup7Ij2q9f4QPUhSntOj3dMG','Amatriciana','01049985898','1988-03-13','03733','서울시 서대문구 독립문 공원길','17 극동아파트 115동 1109호','m',0,NULL,NULL,'2019-12-05 11:09:02','2019-12-05 11:09:02',0,NULL),(148,'ksteeve@naver.com','농업회사법인 유한회사 삼성농원','$2y$10$69b3HDw2J1fJHsR/8lDSR.2jgChSEsV3eFNp/BlzjL/Y9jUq85.AO','삼성농원','01056603283','2018-01-01','54538','전북 익산시 익산대로 460','창업보육센터(67) 405호','m',0,NULL,NULL,'2019-12-06 11:08:04','2019-12-06 11:08:04',0,NULL),(149,'parkbeompd@daum.net','박범찬','$2y$10$PizawGEJUI.8txpPZBo2o.BGnZDTxqGc6CehsQvGRcmRfCLg9r/Mu','ParkPD','01074487714','1986-08-20','07788','서울 강서구 마곡동 757','두산더랜드파크 A동 1205호','m',0,NULL,NULL,'2019-12-07 18:29:20','2019-12-07 18:29:20',0,NULL),(150,'madessong@gmail.com','송은경','$2y$10$wkgWWltiGq7Ab.lLDON8keBE6tt6pHo0tu2di4J8m.Qn9FiHWMpve','떼루떼루','01072368475','1978-02-23','07704','서울 강서구 강서로45다길 30-17','1001호','f',1,NULL,NULL,'2019-12-08 01:06:30','2019-12-08 01:06:30',0,NULL),(151,'dlthgus941221@naver.com','이소현','$2y$10$usCXpS6e9on3V2Hh/JQd2uRmNj1MutJ22DgCGtZ1m5Y1BsrrdtRwm','햄찌냥','01023948097','1994-12-21','21913','인천 연수구 연수동 490-2','B05호','f',1,NULL,NULL,'2019-12-08 01:40:12','2019-12-08 01:40:12',0,NULL),(152,'kimjisu037@naver.com','김지수','$2y$10$jhKn2du2EZHRZR6.oZ.H5O1VGIGY6RuSovczMNsLSKxELMjzcqKVe','슐랭','01076732263','2000-01-10','05028','서울 광진구 아차산로39길 14','206호','f',1,NULL,NULL,'2019-12-08 04:00:42','2019-12-08 04:00:42',0,NULL),(153,'agadingo@naver.com','장유주','$2y$10$nO.6il3TY9S0do8A0z4b2uhBySyBqHBxoHdugGbxp7yoqkzYM6YlK','유주니아','01037273246','1993-07-14','02790','서울 성북구 화랑로 214','111동 202호','f',1,NULL,NULL,'2019-12-09 02:57:40','2019-12-09 02:57:40',0,NULL),(154,'kangda0407@naver.com','강다희','$2y$10$xF8xFhKjCevriFY5wlazke/2SbVasJcClKTEqszsoXZ0aP9zKiAEe','DAVELY','01090968242','2000-04-07','14125','경기 안양시 동안구 경수대로 462','203동 402호','f',1,NULL,NULL,'2019-12-09 12:57:33','2019-12-09 12:57:33',0,NULL),(155,'rrrsurrr@gmail.com','정수연','$2y$10$kzW7./vDQ28I3tUMmahxy.tyIQnqsfRRdWkyYyqB6RiUfibcd1wua','rriiing','01052325324','1985-10-23','10239','경기 고양시 일산서구 일현로 140','103동 305호','f',1,NULL,NULL,'2019-12-09 19:10:51','2019-12-09 19:10:51',0,NULL),(156,'sunsun900@naver.com','김경선','$2y$10$Xn5tu6N8.ky/PzaroYjCo.HLoSHIRt6oGbAgp4TKzg5g3HNXBZn6O','너의친구써니','01092565663','1990-07-05','41579','대구 북구 중앙대로 556-7','1층','f',0,NULL,NULL,'2019-12-09 21:57:09','2019-12-09 21:57:09',0,NULL),(157,'jungin15@naver.com','승정인','$2y$10$DYRJ6haYwT/W0lnlBfnFeOFSiTnuB6vdMCzN.mVcTpRtX3S5AOS3i','로이','01072001795','1987-09-09','01687','서울 노원구 동일로221길 22','마들 대림아파트 5동 1410호','m',0,NULL,NULL,'2019-12-09 23:49:09','2019-12-09 23:49:09',0,NULL),(158,'ekejaqlsek@naver.com','한소영','$2y$10$9TAAL8ForconJvkcPoDN6e/HwkB2gC59AuGOhVUStjR90PtXMVW5i','사르나이','01097270531','1988-05-31','15296','경기 안산시 상록구 화랑로 495','4동1204호','f',0,NULL,NULL,'2019-12-10 16:28:01','2019-12-10 16:28:01',0,NULL),(159,'ddaa104@naver.com','육선화','$2y$10$eU2uMEgrmfpqcyVvb7P29u4RiHMR95xLwXMt6MOGRhrFA1ajvG5my','둘이합쳐팔푼이','01095682205','1987-04-11','01805','서울 노원구 화랑로 564','109동 403호','f',0,NULL,NULL,'2019-12-10 18:25:38','2019-12-10 18:25:38',0,NULL),(160,'turtle0@naver.com','박종성','$2y$10$iYui1rpCFNbZxdGpBqZB4eL/asbi0KpiNy5rHu9vhVEoJvf4OYJ.i','거뷰기','01099428202','1982-02-01','07528','서울 강서구 양천로55길 55','110동 1805호','m',1,NULL,NULL,'2019-12-10 19:29:41','2019-12-10 19:29:41',0,NULL),(161,'lovinj91@naver.com','강민정','$2y$10$ImsVrC6TwmddDil.aCcJJu9R/INQXw9DsmjSqutdGwx1OXDsKCFBu','러비니','01063011365','1991-07-10','51377','경남 창원시 의창구 팔용로 425','3층 체육관','f',0,NULL,NULL,'2019-12-10 21:16:51','2019-12-10 21:16:51',0,NULL),(162,'moonsasang@naver.com','안미경','$2y$10$GxTwrgaVGK3Pz86/qbpMuOhs4oPcSA9Gh90xt.PvOf31DWCv5Qmwm','발칙한밍','01098500823','1988-10-23','17047','경기 용인시 처인구 용문로 58','에르하임 503호','f',0,NULL,NULL,'2019-12-11 01:29:31','2019-12-11 01:29:31',0,NULL),(163,'arsong89@naver.com','송','$2y$10$JB/Dmdi5cww79LCGx3A9Ou1FgvEAl8P7bog7qR8sA1kFOzsCqVNXe','우아한유유','01050652908','1989-11-29','26484','강원 원주시 남원로 526','103-603','f',0,NULL,NULL,'2019-12-12 12:09:19','2019-12-12 12:09:19',0,NULL),(165,'ksdtnsekf@naver.com','권순달','$2y$10$Ul/MUyPZIskykOwtUcJss.Qzegz.k7tCTMjiHUiGR5.bObxX77Rwq','쑹쑹','01097571019','1989-10-19','04143','서울 마포구 마포대로 143','19층','m',0,NULL,NULL,'2019-12-13 14:26:00','2019-12-13 14:26:00',0,NULL),(166,'fndps14@naver.com','장혜정','$2y$10$PRfZ3TmQ8MICX3FvGdsdMefqRXHBUiwUNNYBayTCIcoYmKF.OGe12','루샤샤','01077580833','1994-08-03','21571','인천 남동구 구월동 201-40','1층 102호','f',0,NULL,NULL,'2019-12-13 16:37:59','2019-12-13 16:37:59',0,NULL),(167,'chcchoi@naver.com','최현창','$2y$10$sNVrorIROlHkFlNHuM871e2Akvh59ZGVyboLsrPIfhPep7VIDrFf2','Donkorea','01033546044','2019-07-13','06167','서울 강남구 삼성로96길 13','2층','m',1,NULL,NULL,'2019-12-13 18:43:15','2019-12-13 18:43:15',0,NULL),(168,'joy3906@naver.com','선우성룡','$2y$10$xxLL5nHJOZk6PogoxYdSFe8rI5zWou/DeV/HwqNHmMp4SMPT473Oa','애런','01068583906','1991-10-02','10415','경기 고양시 일산동구 강송로 153','309-1301','m',0,NULL,NULL,'2019-12-13 20:15:10','2019-12-13 20:15:10',0,NULL),(169,'lalalalaok@naver.com','홍보림','$2y$10$jdiv8wsfzqDZ0gKDVryxWuMsi9BtGxFFcfkmc/9xkJdQu6K5Kkwli','볼미','01026934862','1991-03-27','48242','부산 수영구 망미번영로38번길 50','204호','f',0,NULL,NULL,'2019-12-16 00:47:58','2019-12-16 00:47:58',0,NULL),(170,'focks753@naver.com','박래찬','$2y$10$aAFkeYl6mz26hXEQpywvleEONH6xJBDy4FnmaECP7j9c04ytWiZjq','allaechan','01068772599','1999-05-06','11709','경기의정부시평화로272번길18','예다음빌라b동601호','m',1,NULL,NULL,'2019-12-16 07:25:31','2019-12-16 07:25:31',0,NULL),(171,'kk651100@hanmail.net','권순성','$2y$10$A3zFt68b9utyYHnpTCPFhuchsr/mz0L/i92Je0FA3dxyAClGjBRW.','곰보선장','01083788317','1991-07-30','14333','경기 광명시 영당로21번길 16','102호','m',0,NULL,NULL,'2019-12-16 16:39:10','2019-12-16 16:39:10',0,NULL),(172,'tyami@naver.com','양태양','$2y$10$QJAZJ.CtJpT9/XrwPJsls.A6QRikh3ZQpczNVHT0vpY50mA8lA4Pe','tyami','01054840639','1993-01-20','44921','울산 울주군 범서읍 모두박길 1-20','203호','m',1,NULL,NULL,'2019-12-16 16:48:26','2019-12-16 16:48:26',0,NULL),(173,'wkdhrtkfkd@naver.com','박은지','$2y$10$yR2svLeQT3XSH0.zluqweeqUKYgX.LX8i6HOIrWJLi/6PKg46l4ZO','갈규','01050303997','1987-09-07','49429','부산 사하구 하신중앙로 265','324동607호','f',1,NULL,NULL,'2019-12-19 14:15:30','2019-12-19 14:15:30',0,NULL),(174,'minji3757@naver.com','김민지','$2y$10$/BP0brXujhaBbLJpY6fZd.Z3DojtuRkviAUoosH28C8pCO4N70ybe','민지당','01042027678','2000-02-14','51671','경남 창원시 진해구 경화동 958-7','단층주택','f',1,NULL,NULL,'2019-12-19 16:26:15','2019-12-19 16:26:15',0,NULL),(175,'djffkdid1222@naver.com','조서영','$2y$10$wtHXVXGzkB5zEL0rffAaz.4E5V9hLeuX0KYHwliCW7ct7yTSCyt5a','라둥둥','01056840254','1991-12-22','21546','인천 남동구 석산로207번길 16','a동 401호','f',1,NULL,NULL,'2019-12-19 23:54:49','2019-12-19 23:54:49',0,NULL),(176,'sukjh97@naver.com','석재희','$2y$10$YPaBNpNR1XqiXHc8Bw8lqOe0Yjp7zWJ2uiLBAUMcD5ThU11T8vevC','0611','01024195868','1997-06-11','08786','서울시 관악구 봉천동 882-7','풍원힐타운비 202호','f',1,NULL,NULL,'2019-12-20 18:30:53','2019-12-20 18:30:53',0,NULL),(177,'no2csk@naver.com','최석광','$2y$10$vJCgx5eMMmJ2ZKdCe1nsLutk95H6PuKzMY2vcjjAACxRRsKKeLwdK','스톰케이필름','01099061294','1981-08-22','10909','경기 파주시 하우고개길 161-28','103-303','m',0,NULL,NULL,'2019-12-22 02:04:31','2019-12-22 02:04:31',0,NULL),(178,'jinalook@naver.com','김진아','$2y$10$SHKuy4qu4cE.arzNwleoZe28lCxt62d96Mcr/lNg2dqtmgJ1FMeyC','포레','01041962785','1981-05-06','05065','서울 광진구 아차산로 262','A동 2607호','f',1,NULL,NULL,'2019-12-23 03:06:44','2019-12-23 03:06:44',0,NULL),(179,'rlathdms96@naver.com','김소은','$2y$10$pjektVO7qYzt0ZO/SrvGpuTfvGZahwJUJSrNj.pKn8aqwds3ZbIOC','소니의소니','01042443196','1996-02-16','08831','서울 관악구 봉천동 1575-5','203호','f',1,NULL,NULL,'2019-12-23 15:18:30','2019-12-23 15:18:30',0,NULL),(180,'kimhan9430@naver.com','김한성','$2y$10$9u4udW4LKVtXQ0Uyiz5iOu5kiXwF.cLtzIUIp8KYXEDbXv9WJ5ap6','곰탕삼촌','01042420030','1988-09-30','42947','대구 달성군 화원읍 비슬로 2545','108동 1302호','m',1,NULL,NULL,'2019-12-26 07:15:08','2019-12-26 07:15:08',0,NULL),(181,'newfrecy@naver.com','박상원','$2y$10$hhL2x9LS.kcTzpYL27ii7uxpDI9edO2.YaG7H9h6XYyvFEN97jxXq','박상원','01025076968','1989-02-21','61676','광주 남구 용대로 136','4층','m',1,NULL,NULL,'2019-12-26 14:28:50','2019-12-26 14:28:50',0,NULL),(182,'jiwoo2027@naver.com','김지우','$2y$10$bFszUo1Pe3ta.IK5TqSvqumAq5Oo/aO1z6KdiLOllsp2mFZyP9V9q','우우우지','01072933037','2000-01-01','06303','서울 강남구 개포로17길 3-4','302','f',0,NULL,NULL,'2019-12-30 20:22:52','2019-12-30 20:22:52',0,NULL),(183,'mjmj0085@naver.com','서민지','$2y$10$VcrGaeLHDEHiokn7.PNOZ.jiEFkfqxNVkMNUa2R1PQAeZs/Kglica','2호','01023499992','1990-05-30','30128','세종특별자치시 나성북1로 12','406호','f',0,NULL,NULL,'2019-12-31 21:04:35','2019-12-31 21:04:35',0,NULL),(184,'style_lish89@naver.com','신선영','$2y$10$4aGh0ZiE5JcK0Mfrodqf1OGyDwqNaPYf8lORxWu09hRryDpmW6/ce','써니쌤','01083741383','1989-12-28','12105','경기 남양주시 별내동 966-3','302호','f',0,NULL,NULL,'2020-01-02 18:20:27','2020-01-02 18:20:27',0,NULL),(185,'cjw30400@naver.com','천진웅','$2y$10$049P1Y1Nqp2zq.Avymo/u.rRl0ybpaNQj0qZLBHJ23MazV55GmGkK','워터물','01020130638','1984-03-22','61071','광주 북구 양산동 853','58번가포차','m',1,NULL,NULL,'2020-01-03 03:38:06','2020-01-03 03:38:06',0,NULL),(186,'970219sohongg@naver.com','김소홍','$2y$10$t/BMpu6TRDVVw7AzTDpMT.cYtsKAL1vsPFIr6cKmyZa4tvg17pXya','앙쏘','01055219251','1997-02-19','15374','경기도 안산시 단원구 원곡동 767-5','303로','f',1,NULL,NULL,'2020-01-03 13:45:50','2020-01-03 13:45:50',0,NULL),(187,'hoojun928@naver.com','정호준','$2y$10$k9jxXVAeF3AbqyviP8A0keUmiRHRoYAIJf6ipxKGMeY.okQMQBHbW','정호두','01064899589','2000-09-28','47344','부산 부산진구 신암로145번길 41','3층','m',1,NULL,NULL,'2020-01-04 20:18:49','2020-01-04 20:18:49',0,NULL),(188,'nimoforever@naver.com','김미숙','$2y$10$7B6H8TOHuzhRQevERLdb/OpK6othTaSwhFA/rsOL3HD8q.KMdHPia','알로하니모','01065155690','1989-03-22','02558','서울시립대로75 102동 1405호','102동 1405호','f',1,NULL,NULL,'2020-01-05 01:15:57','2020-01-05 01:15:57',0,NULL),(189,'wls0875@nate.com','윤혜진','$2y$10$w6Vn9YvGquU2v/l9zfS/A.HiCuUHGdZfQeyQhnZtHy/Q0P0O5gWDW','Une','01026489664','1997-10-08','41210','대구 동구 동대구로99길 20','1층','f',0,NULL,NULL,'2020-01-06 21:37:02','2020-01-06 21:37:02',0,NULL),(190,'dayongss1@gmail.com','권다영','$2y$10$2LnzwhhGlyUmorQAQ11lbe2m4y6uvQy/RoM2Mvkw/g9VYkCVwSMxu','천구','01055072399','2020-01-07','06908','서울 동작구 노량진로26길 57','51-27','f',1,NULL,NULL,'2020-01-07 23:51:48','2020-01-07 23:51:48',0,NULL),(191,'sem_love@naver.com','임세미','$2y$10$JOsaMAA0EM0yNJ7BxTAGNe6P7npjvCH.Owhf6p.rytdc9eHhO1vy6','세미슐랭','01040171171','1992-07-31','47598','부산 연제구 월드컵대로73번길 55','3층','f',1,NULL,NULL,'2020-01-08 01:45:04','2020-01-08 01:45:04',0,NULL),(192,'unddr100@naver.com','이유정','$2y$10$dympuQKSIW7MK3mTBIG8MuixIcv3g4SntFeiSIQoaBDJuPnW3fQ7y','히스플레르','01047793119','1992-11-14','22736','인천 서구 청라라임로 85','b동 102호','f',1,NULL,NULL,'2020-01-08 09:41:05','2020-01-08 09:41:05',0,NULL),(193,'dldbfla77@naver.com','이유림','$2y$10$OMo.LyIPHETdFioK/qB29.nAMV2Qg0Mx7zG4q0uucBr5cUeafj5j6','리스타','01088288603','1992-05-20','01341','서울 도봉구 도봉로147길 36-3','2층','f',1,NULL,NULL,'2020-01-08 16:43:38','2020-01-08 16:43:38',0,NULL),(194,'gml61@naver.com','김민정','$2y$10$6l52onfEDZcsrocf8H3B.eIAfqqsGpZrhCwbcCvUQMWukSZoHuY1W','미니댕','01034205419','1991-10-03','02584','서울 동대문구 용두동 112-85','301호','f',0,NULL,NULL,'2020-01-08 22:28:38','2020-01-08 22:28:38',0,NULL),(195,'crew_and@naver.com','김민지','$2y$10$ns1H3thdK5AcPaBqEIZDJ.GZ1j3Fs6MOR/ShsBtmB5focThyuHPKe','명수언니','01020634861','1993-01-12','05302','서울 강동구 명일로27길 60','정도205','f',0,NULL,NULL,'2020-01-09 13:40:30','2020-01-09 13:40:30',0,NULL),(196,'wisd3379@naver.com','박미하','$2y$10$y3IrCOEijlTypHOpc4K9GOpowZc71HCIQfVK3oZbN0CyOwFIsmCl2','차차셋','01045645754','1979-12-05','03123','서울 종로구 율곡로22가길 28','5층','f',1,NULL,NULL,'2020-01-10 01:54:36','2020-01-10 01:54:36',0,NULL),(197,'pam6359@naver.com','정세환','$2y$10$pTb8W0nUymfPBqTAJVR2IO99uIA63SZ.EShAaTpQQNJwtKqbQ46rC','인올리','01099026359','1994-08-27','22815','인천 서구 원적로 82','진주아파트 3동 1318호','m',1,NULL,NULL,'2020-01-10 09:29:27','2020-01-10 09:29:27',0,NULL),(198,'kosophie42@naver.com','김혜준','$2y$10$yoKakHDs6EXBgGGImPs5AeH7kwnf4e65gPZFE4dfyKy.CvvTqmbBK','Priya','01039131304','1988-04-22','16663','경기 수원시 권선구 동수원로177번길 90','902-804','f',1,NULL,NULL,'2020-01-10 13:10:40','2020-01-10 13:10:40',0,NULL),(199,'sig7955@naver.com','김경식','$2y$10$TPjRUwH1qnUu2FkyKpjfkOm7MpMHV.FlV8BQaOXuZ.QZup2VvuOYm','싴이','01043307955','1994-03-31','01191','서울 강북구 솔샘로 159','104동 303호','m',0,NULL,NULL,'2020-01-13 00:39:22','2020-01-13 00:39:22',0,NULL),(200,'elfland1004@naver.com','송원선','$2y$10$29OFBq91x/Y6mv6ZgVGukuodWpN1at1wTwJEGEJFS4x8nYDKgsl8u','환하게','01037526561','1982-02-20','06089','서울 강남구 학동로64길 7','한솔아파트 101동 407호','f',0,NULL,NULL,'2020-01-13 19:29:10','2020-01-13 19:29:10',0,NULL),(201,'socool8887@naver.com','이경진','$2y$10$QkatX5AIiXehQnHlEPSHaewGtFdiHOxxBmtcu9FUz64IkLCLYjkoS','아이엠벨라','01090218887','1977-08-16','06555','서울 서초구 동광로11길 80','401호','f',1,NULL,NULL,'2020-01-14 23:04:53','2020-01-14 23:04:53',0,NULL),(202,'gustndi48@naver.com','양하린','$2y$10$30biNQB87hbO/b/xyCCC6./W65mMK2VOsViliyU3UUrKPvc014hsC','Rin','01064973697','1987-08-01','08020','서울 양천구 오목로 188','라비앙오피스텔 203호','f',0,NULL,NULL,'2020-01-16 09:18:38','2020-01-16 09:18:38',0,NULL),(203,'habin5183@naver.com','류하빈','$2y$10$uCO369rcprOMVgOaLfOYUehNrBlqx2uwWH6k8LTsIhQD9.TAqLNjS','하빙','01026853830','2003-11-16','62003','광주광역시 서구 운천로69','금호명지아파트 102동 307호','m',0,NULL,NULL,'2020-01-17 06:34:12','2020-01-17 06:34:12',0,NULL),(204,'y211069@naver.com','고경남','$2y$10$kReHZIQtjIUBQrnSR.moKu2W.vKtrL5.mxJE9lqjQUsCSYyyV80Tu','제로맥스','01041770324','1985-05-07','21571','인천 남동구 성말로53번길 83','1층','m',1,NULL,NULL,'2020-01-18 16:22:51','2020-01-18 16:22:51',0,NULL),(205,'kubonhyuk@naver.com','구본혁','$2y$10$aFz.y9vOmb/CztZhMHxb1.3tlG45o.7PU7yvWXkePyOkxzyAQlDeS','꼬꼬닭','01082313095','1983-08-16','35354','대전 서구 도안동 1121','대운빌라202호','m',1,NULL,NULL,'2020-01-20 15:33:20','2020-01-20 15:33:20',0,NULL),(206,'cosy_day@naver.com','구민지','$2y$10$BQ/jaeH5dUJy5Or7UrEOA.0Wz0DsXISbuCwACiKF4HZJ2FEzx7qpC','복치','01035232535','1993-04-25','07666','서울 강서구 등촌로51길 111','나동 301호','f',0,NULL,NULL,'2020-01-20 22:12:21','2020-01-20 22:12:21',0,NULL),(207,'six_young@naver.com','이유경','$2y$10$HrM.bvhaxoQ1KAyzgGVlreu8dpAmOLs.IuR/5nV68uASL9IpAxSS2','힙칠','01083888784','1988-10-25','05267','서울 강동구 고덕로 210','603동 303호','f',0,NULL,NULL,'2020-01-21 22:33:48','2020-01-21 22:33:48',0,NULL),(208,'di05713@naver.com','김대섭','$2y$10$hnS0v/3/80YHzA8YJNfufedSgujViplJzrHOFQkCzNKSfE9AwCp9G','저세상리뷰','01099540360','1989-08-30','13998','경기 안양시 만안구 안양동 707-88','201호','m',0,NULL,NULL,'2020-01-22 22:00:59','2020-01-22 22:00:59',0,NULL),(209,'tahyun486@naver.com','차성호','$2y$10$pawTJXaoMtj6aoXh1nd6VuHtpacKTJqoSK307ivfInTAHRbhTwGsu','퍼즐','01085745425','1998-09-03','13480','경기 성남시 분당구 대왕판교로 477','ㅣ','m',0,NULL,NULL,'2020-01-23 12:40:25','2020-01-23 12:40:25',0,NULL),(210,'pjj412@naver.com','박진주','$2y$10$efH/gUzHq3CWNbgzjxE2X.1yvwYA2x3wA7vrPfTHoLoU.95Rf6m52','나박이','01041775309','1988-02-26','10906','경기 파주시 와석순환로 15','813동 904호','f',1,NULL,NULL,'2020-01-26 19:36:56','2020-01-26 19:36:56',0,NULL),(211,'askges20@naver.com','정예원','$2y$10$ItdbhWeHhyC4Ry429OjwSuGub.spkCuI2WLGEShN2dCjAEFQitw1y','가람','01040477905','1999-10-06','13602','경기 성남시 분당구 내정로 24','602동 1404호','f',0,NULL,NULL,'2020-01-29 02:12:06','2020-01-29 02:12:06',0,NULL),(212,'happymoon315@naver.com','조달맞이','$2y$10$YTAwEzZJTWImMANdT11JMOTjemJsQBUN7u1JU6xOpFp1BN8.dxTcu','달토깽이','01023453229','1988-03-15','53071','경남 통영시 선금산2길 28','가동 601호','f',0,NULL,NULL,'2020-01-31 08:50:33','2020-01-31 08:50:33',0,NULL),(213,'jjh980302@naver.com','장지현','$2y$10$/Zwfk36Nzqrr2IAY/64rHOAcrVyEA/XZwYWVOhWQDve9peJ9uHfoW','지현','01034761151','2000-12-30','38067','경북 경주시 석장동 755-1','올리브하우스 106호','f',0,NULL,NULL,'2020-01-31 16:57:02','2020-01-31 16:57:02',0,NULL),(214,'hksports_kr@naver.com','강민수','$2y$10$66tjFkMOIk5w8mZB.BbPt.iWxVVV8sLnz3NNjiZEiChAqy.AHKYNa','한강스포츠','01044195780','1986-09-03','22729','인천 서구 승학로 213','지하','m',0,NULL,NULL,'2020-01-31 20:00:03','2020-01-31 20:00:03',0,NULL),(215,'romantica_mi@naver.com','최유미','$2y$10$2dCAaj1fPIUwP2UaBdl8duUkASo/e/LkdkR/7q9Gtts6SIpybidi.','안녕미미','01056503787','1985-08-07','02004','서울 중랑구 동일로169길 41','101-401','f',1,NULL,NULL,'2020-02-01 03:06:57','2020-02-01 03:06:57',0,NULL),(216,'greetastar@naver.com','김태영','$2y$10$n22Z94gk/PIdS5iNI.ArHOMECpwwar38Op.h3m24xNtr0ZuxiYR1e','오엥','01025195252','1994-11-08','14735','경기 부천시 심곡로34번길 58-18','B01호','m',1,NULL,NULL,'2020-02-03 16:05:04','2020-02-03 16:05:04',0,NULL),(218,'sindarekj@naver.com','신다래','$2y$10$5BHfOo9QCo24dBYu1ZMnLuxL8ozdmmzq/rZXd817GTeMKECgzxDQm','달달','01086241662','1989-04-14','21641','인천 남동구 은봉로166번길 27','210동708호','f',1,NULL,NULL,'2020-02-05 11:57:03','2020-02-05 11:57:03',0,NULL),(219,'myjiyung33@naver.com','권태혁','$2y$10$zNtB1P7g2.jA80zubtJs3.GFFzBmQE83Fy0KHb8I4z2sbo.zSPR9S','핏라이프','01033667196','1992-11-26','31078','충남 천안시 서북구 성성8로 2-44','바루나타워 6층','m',0,NULL,NULL,'2020-02-12 10:07:37','2020-02-12 10:07:37',0,NULL),(220,'friends_jjong@naver.com','또바기','$2y$10$UlDoKaaA2XWZpbxhL9owmusFwXSJQEwSiot/mep9vZ83ateO0HmOm','라쵸','01093359774','1988-06-20','50639','경남 양산시 동면 금오5길 5-1','1층 또바기텔레콤','m',1,NULL,NULL,'2020-02-20 20:07:09','2020-02-20 20:07:09',0,NULL),(221,'wwwi002@naver.com','최은아','$2y$10$b4oOJPagDTITM1Cg7JMf3OWQKOF1/JEPuQlFFLTrJNMx0HnNq28De','시녀의생활','01051150609','1989-06-09','54057','전북 군산시 임피면 남산로 41','.','f',1,NULL,NULL,'2020-02-21 19:14:39','2020-02-21 19:14:39',0,NULL),(222,'xmoix0@naver.com','이지연','$2y$10$SS.pPI/pSDjUSVRBdEVFkuONMj5UHCDfBMB7hWv1FDYcxF0sQ5uB6','xmoix0','01094573544','2001-11-24','12061','경기 남양주시 진접읍 해밀예당1로 272','신안인스빌23단지 2311동 202호','f',1,NULL,NULL,'2020-02-24 08:01:46','2020-02-24 08:01:46',0,NULL),(225,'702story@naver.com','유종숙','$2y$10$s2uMQ./iNy9XyTD8rH/WrObOi8rWR1dBQAtNEvqenfi1cstq7atHG','칠공이스토리','01024753586','1988-07-07','07372','서울 영등포구 도영로7길 15','105-807','f',0,NULL,NULL,'2020-03-02 04:12:02','2020-03-02 04:12:02',0,NULL),(226,'ssh2651@naver.com','송승희','$2y$10$5aXcvMZxcOVJ8m3Rgi/18uHabSb4k9NpykAToj2kQe7mos7tVXQAm','쏭뚜기','01021082652','1993-11-11','05555','서울 송파구 잠실로 62','트리지움 312동 2704호','f',1,NULL,NULL,'2020-03-04 11:22:05','2020-03-04 11:22:05',0,NULL),(229,'stopthe1@naver.com','홍종오','$2y$10$QV4H4GFnn1RFMKuTJHg7OeXwhVfyOhMzZhCK3oYwnJZ5TZAcLFvJ.','김톰슨','01097480514','1979-05-14','01004','서울 강북구 삼양로169길 7','402호 (우이동, 동아그린빌라)','m',1,NULL,NULL,'2020-03-22 03:45:38','2020-03-22 03:45:38',0,NULL),(230,'cyberbora@nate.com','임보라','$2y$10$6q.Znl0p67dOi3sxVj4mHeSJ/JX1sV1KNQqSrzqEgyEyOuY0O6a9S','뽀라뽀라','01024696669','1983-12-20','15442','경기 안산시 단원구 화정천서로 161','그린빌11단지 1103동 204호','f',0,NULL,NULL,'2020-04-03 15:09:00','2020-04-03 15:09:00',0,NULL),(231,'tpsxj9@naver.com','김성근','$2y$10$WsEMHpwGe6ZhWJhgK/pOuuP1qxpBXUz0/Nu9VKV4AGQoptDpNIlOK','김깜시','01041239432','1992-08-30','49347','부산 사하구 까치고개로20번길 20','302호','m',1,NULL,'TqjCM6zjWUxtxv8178VW5mueOVuOgvlIz5tkUFFllkX9MVjYyxqS7RE1LZbu','2020-05-07 17:35:30','2020-07-13 12:30:25',5001,'Ewu7gb76ZjrM4riyjNgbk4enrkMvTtx37kDNL0WRBiF02Ro3zUuW0fu6jS2gIu9Aiga/64S50Avc0k+jYc2vAA=='),(232,'saeyan2477@naver.com','김소혜',NULL,'새얀','01020690073','1994-02-20','04171','서울 마포구 도화동 224-24','1','f',1,NULL,'hNweYApKIa5Duuu7tAlNzgv8fiLS6fMjgMPGMFddDkKWxYU5gnYaPd5c7TRP','2020-05-26 17:00:06','2020-05-26 17:00:06',0,NULL),(233,'gohj8408@naver.com','고효주','$2y$10$kZL58Q3lUcMp0nzY478TmO6obwpoGXA5w8Lss06Z49YuNE40thDPi','상콤이8','01085078408','1998-08-06','41461','대구 북구 태암로2길 3','다온빌201호','f',1,NULL,NULL,'2020-07-10 01:09:54','2020-07-10 01:09:54',0,'5BskO0f8WnNG+HjXEI1Bt8N6BZmPtxV9LHq19SS7cfn8LnmNqe/p16j3nhyv4r33mTf+nqPhCaPJskU/czb24Q=='),(234,'tmxhdjvka_@naver.com','김이솔','$2y$10$sAoNr6DEfoVoDRWhkJ/40uXdDJAF5w5V.LZQAjU56ZFdEXamDc42C','뚀리','01054462284','1993-10-14','01913','서울 노원구 마들로 31','123-706','f',0,NULL,NULL,'2020-07-21 15:38:26','2020-07-21 15:38:26',0,'MGML1DCuQGDvmc4jzUsB0sDxGnCaZnV6/TZXCTjp5TPq9fW9OTeJHmUpPq/lMjy2qyUJry2UlO69RZML2Q7H/g=='),(235,'rkdus1541@naver.com','김가연',NULL,'간둥','01053250957','1992-05-21','21389','인천 부평구 부평문화로 54','3층 더마에필','f',0,NULL,NULL,'2020-07-22 12:25:02','2020-07-22 12:25:02',0,NULL),(236,'keb0714@naver.com','김은빈','$2y$10$1O.DyqqVtG52Z8pXmXlFJeRoNKUKAD2RPgMaLkfyLC8PNzIPVUNNe','바니','01027051709','2000-07-14','49225','부산 서구 대영로45번길 63','201호','f',1,NULL,NULL,'2020-07-22 19:45:55','2020-07-22 19:45:55',0,'aRBWJcQtotcJu9T8z0iNyMDCdw6MgpsX3YSECevWK+BbOY6KWoYy2aLaetAoI9CnDay0sBq/LsQYbEKm/FmMqw=='),(237,'friends_hill@naver.com','강두환','$2y$10$KIicSt9dzApwtiVB7M6iLeE3DRE6y9UU2BJnI6gHhV8RB9lojpEmO','friends_hill','01028355494','1980-09-29','10073','경기 김포시 운양동 1339-1','한신더휴테라스','m',1,NULL,NULL,'2020-07-24 17:00:57','2020-07-24 17:00:57',0,'V5CB+7v+/eE4o7yJLEBApAzVjaAuXIwXNfXe7o/FEXPO6BqwrVF7yeGMDHLfojsPnufNqMMBYhlgTGA/jDCsoQ=='),(238,'rgw417@naver.com','김희정','$2y$10$NDJzhq3UQKavLv7hCwjMPuhYL6Lm0GajHcKdcXPF2bFn0q0bABE4G','볼희','01096692190','1990-04-17','01037','서울 강북구',NULL,'f',0,NULL,NULL,'2020-07-29 21:38:27','2020-07-29 21:47:44',0,'ncUKVfcKI7KYSiSOkXpf9swZCfI3GyMH/pvJ8JTt+y3PdBw+2plkPT8vvDfHB38LTBAn234wKPQ0baX8MQY/xg=='),(239,'swlee4872@naver.com','이선우','$2y$10$PfIoJk8jztifrlz8MWa.zugVfAk8Bl4yLZi7bSl9xioIhdbDDkIu6','ssunnoo_','01040594872','2000-04-22','03719','서울 서대문구 연희로 28길35-28','성원상떼빌팰리스아파트202동704호','f',1,NULL,NULL,'2020-08-05 10:07:51','2020-08-05 10:07:51',0,'HOTSGqpwPqo/Eeo5tyBThcgCd00d9MkuzwFWWVuDRC9rD3cGP+zi1AzITEOtgpR9fViuBvTAQ3txJp8xrKiFxw=='),(240,'baek2098@naver.com','백길현','$2y$10$jbsBnCo9hrbJROBpIsNokeNBqeVunJ2H86O9pBLKqMFN0/cjrS3H.','쭈니맘','01036062098','1988-08-16','34658','대전 동구 계족로140번길 33','105-1704','f',0,NULL,NULL,'2020-08-09 20:47:59','2020-08-09 20:47:59',0,'5No0IfAU+rd4RyF1spFPGvZkKNpKFOm98EtPNLnchtFG0bHkV4G08rmxgjnJhU5RgvF/LrB9W9V/hyESQIoBWw=='),(241,'cateyepark@naver.com','박소영',NULL,'잘잘언니','01025982253','1988-11-21','16480','경기 수원시 팔달구 경수대로443번길 14-17','205호','f',1,NULL,NULL,'2020-08-17 18:36:35','2020-08-17 18:36:35',0,NULL),(242,'alsgnl7@naver.com','김민휘',NULL,'minhwikim','01082422460','2002-02-07','41584','대구 북구 침산남로 160 침산롯데캐슬오페라','101-502','f',1,NULL,NULL,'2020-08-24 14:01:51','2020-08-24 14:01:51',0,NULL),(243,'prettydia3@naver.com','정다운','$2y$10$hlUR7MI.MCa/tjjo1JePLuJj2x4RtvPo5612ul7WLozye2q1gk2ii','edge','01065648568','1992-03-15','14205','경기 광명시 광복로9번길 23','101호','f',0,NULL,NULL,'2020-09-10 12:13:09','2020-09-10 12:13:09',0,'mumCzUkaOMSFNOmXozMgXbwH6oRDwWxQQuhQrriBU53ninrsRrgfGVsJvj3UzQkc/omowKOVv03B1O93Ujt/Dg=='),(244,'pulum03@naver.com','박근오','$2y$10$1fkFrGOtwPfhENaplunw9epbgQ9CREGxLI8xgTnsiH.pWqAo.SknC','pulum03','01057794316','1991-01-28','05001','서울 광진구 동일로40길 34','102동 301호','m',1,NULL,NULL,'2020-09-17 17:36:48','2020-12-10 16:35:05',0,'jmaBOIoshg7ZF+t6RowY86lpGUEhOixYK4mgRtymGom8AaGj8pmkgqEkpUEmziYp5vj2SddIlCA5+4xaPGTzwA=='),(245,'jhyeonkim@hanmail.net','김정현','$2y$10$alGdnohNwTfC2HUA3T1N.ODjqpmz1AEuysIsokbM1T.lnkp0XYRlu','크리스틴','01037945778','1971-07-03','06575','서울 서초구 서래로5길 101','302호','f',1,NULL,NULL,'2020-11-03 21:38:21','2020-11-03 21:38:21',0,'0yhknW8KMy3Ynyh3MbuOSQceQOwJMA9yeLbFz/hHIQJ5RbckmDP6UsDFeyt6jUiMf/c7hmmIa/h+odbDQVqgAQ=='),(246,'staybystay@naver.com','신정은','$2y$10$6UOaus1oe7EYIC5IbkdaoO8gi3q5iJ0UN2/aP71SB58z.Zr3EuZHa','staybystay','01062550971','1991-01-30','05398','서울 강동구 성내로6길 42-9','산성빌리지 B동 402호','f',1,NULL,NULL,'2020-12-08 15:57:05','2020-12-08 15:57:05',0,'vVCS4fsz/SqK6PLOqo91ggXdygNVUJNQp8cFrlLmksq33z9CDjSVI59k8A9w1H9GmHFTlILrhROS2hNodRxdeA=='),(247,'yyerin02@naver.com','송예린','$2y$10$/fPRSJs./1FEIsahmTTJHeRg5d7/NA3t6IUI7mUhMqEjr5r9gMBQ.','erina','01021644873','2002-08-19','21667','인천 남동구 논고개로68번길 34','406동1301호','f',0,NULL,NULL,'2020-12-20 12:07:48','2020-12-20 12:07:48',0,'XdO/S20fO+wqQdHw4hAikcU0wBF62fOIcF1iu+kZJBRMJPC4JdtjrAWjvVtUaKplxfLYtTc3ICBxnYqpgYkh5Q=='),(248,'kuno.lee@dslab.global','이건오','$2y$10$jQt.1iS2f1LmKRoxWxWgNerOeMkYNJrXs080Akpfst9XhDtmoKfSC','dst','01079127192','1997-02-05','10450','104 - 903, 33 Gangsong-ro','kuno.lee@dslab.global','m',0,NULL,NULL,'2020-12-21 11:18:17','2020-12-21 11:18:17',0,'1+Qb4rGwnlSqQOLBr++ozvzOFlCXGHdVw6aPHw6/BL3pvfjONV/xs/ONhXAG4GhX6mN78bHXt3JM/xydbxrplw=='),(249,'rkfka032726@naver.com','권가람','$2y$10$b/xPEkD8d1W1GA5jblrG7e.ImEh/PAYjqVn41X6nV3BCfH2YP2sqm','맵싹주먹','01068720731','2001-07-31','48017','부산 해운대구 아랫반송로21번길 12-31','101','f',1,NULL,NULL,'2020-12-21 18:58:13','2020-12-21 18:58:13',0,'0x57eUw5Mx0e5g52BfKqiI4S2CVgm353mjRkgBR/XY/S4cRLY6RdBmfXnxFWQRWroH2haMRHAOfyd/xA3eWTtw=='),(250,'6bztm3fb3mn6@naver.com','김은진','$2y$10$ROjQgkuvKP0YzekIL6NTg.mliqPwB/pnrjonrlcqSpO890QOWe0uy','빵찌니','01049639432','1998-05-26','48500','부산 남구 용소로46번길 7','5층','m',1,NULL,NULL,'2020-12-29 17:57:38','2021-01-12 16:21:01',0,'G9pb3k0rAqGu89ZoWoUjJ0FnHl3iUhK9qTeN5bF1sMNj1RyWA0QU77or2Es4bZ5TBFzdeSgigOFKY1y/Nm6LuA=='),(251,'jo2735@hanmail.net','가가가 용완',NULL,'123123123','01012345656','1233-12-31','06112','서울 강남구 논현로123길 4-1','123','m',1,NULL,'KKzxy1y77WMrk5dTd8xvTObixVXDXvWjLpPOMzaFbT1lITE9rieOejgcw0UL','2021-01-14 18:52:45','2021-01-14 18:52:45',0,NULL),(252,'smile0776@naver.com','이윤주','$2y$10$wSmWyeQpPJ7YHgTILE4lZeZt6xxbqG20P9UbYWvi4tfbYATFrGCBK','팬더언니','01062664499','2014-09-08','38668','경북 경산시 펜타힐즈2로 20','101동 2903호','f',1,NULL,NULL,'2021-01-20 16:53:31','2021-01-20 16:53:31',0,'e7dHn2C9iImqP4A6OM+SPaMFwIzGYCXEN8quv7DYAFK97mnyFplkKJTFO6/ccyexOacbTUlHAu74KOYkbRaLUw=='),(253,'stablecho@gmail.com','정초영','$2y$10$r6VBaLulMuMyDOI4pBOdtORurvb9qAd7QQRCvfAf63lpjPi./anOy','스테이블영','01023297862','1971-11-19','46265','부산 금정구 중앙대로1742번길 33','A동 201호','m',0,NULL,NULL,'2021-01-29 17:13:09','2021-02-02 12:36:16',0,NULL),(255,'saeami__@naver.com','박새암','$2y$10$lc7InasC1LdxnRjrQGDqlu/1bLa20wX.krzVXXA4eD2yZxDoEPkue','ami','01094236502','1994-05-23','35357','대전 서구 도안동 1282','301호','f',0,NULL,NULL,'2021-02-02 16:28:58','2021-02-02 16:28:58',0,'qXwUHj+estyRLfNS0St5C6EYt6rVtJ4pRBubCwN3e9GG3AKnTQlog1niEQs/ozAvCZ6CI1tk6O5HzPlsd5E3Jw=='),(256,'newstar1021@naver.com','샛별',NULL,'VzlZl','01027522730','1994-10-21','35322','대전 서구 도마로 59','309호','f',0,NULL,'ZCGrL0gbGdNVbTcg2IY3opfddrQsqErssh89maAYLSEg1t9mrz2dtw8ewEiw','2021-02-02 16:31:46','2021-02-02 16:31:46',0,NULL),(257,'hahayoon89@naver.com','김인혜','$2y$10$XY1NIrU2u6WitRCJmn4mtOZUo9bhaqfr8V4w7skt/7jeAZeCN6.Au','하윤89','01072564816','1989-06-23','08261','서울 구로구 부일로1길 31-20','102호','f',1,NULL,NULL,'2021-02-02 16:32:17','2021-02-02 16:32:17',0,'gSClQPWmoucUnVLvqztXG1aYBuaf2zHS4XcterfWBIXobEk3dAtZC0DrVNABUbBSQ/rz6dkxcGYrnj4EnvMp1g=='),(258,'khyang37@naver.com','김향','$2y$10$sMVzh56DS1r.UybaK2U7GuWdDj27vzJte1JUZ2wSUF3dFofn8RN3G','코코맘','01096001915','1991-02-20','44773','울산 남구 두왕로190번길 77','102/709','f',0,NULL,NULL,'2021-02-02 16:34:15','2021-02-02 16:34:15',0,'JTCfZC1TrxZEpUjvMi9W4Zt45KYIFAsHJ+0gszHek7Mcp09ZCMptApOrmAHLjyY9FavB1AGdg/9IdNQhM0USYw=='),(259,'kiki10041@naver.com','김가영','$2y$10$n/Pw9QmUXmLYwo/3PrkcJO/nsEFMd41NboWjofror7Y9GxmOGkfw2','영이','01032050040','1984-08-26','50974','경남 김해시 금관대로599번길 11','1011동602호','f',1,NULL,NULL,'2021-02-02 16:39:47','2021-02-02 16:39:47',0,'vKP/w55V+VU+0Vn6vXRlibF+aTmTJlqrL5rMwGB7kEeZyK+6XdAxX4/mLTtZtlNG55ANJqoewBeL1w7XkULWHg=='),(260,'mysty1ej@nate.com','J',NULL,'일상채우는 여자','01094052165','1988-01-23','05041','서울 광진구 구의동 241-82','세종아트빌202호','f',0,NULL,NULL,'2021-02-02 17:10:12','2021-02-02 17:10:12',0,NULL),(261,'ginajelee@naver.com','이지은','$2y$10$iXYXU4gDqDN/RAy1D.Afo.7AYEjfQvsjDaqVHQk8a9AjQ0b2UW2aW','지나젤리','01072081770','1978-09-12','04368','서울 용산구 원효로 216','113동 2204호','f',0,NULL,NULL,'2021-02-02 18:45:01','2021-02-02 18:45:01',0,'yvMf0N1+ufGH6OFSiciicwi3TYu7lhD0gbphJNdRvqAIe52AaQMgMAUUSNTWmi0TeFsHMXjveOcnvGY3UIbPog=='),(262,'revan-ym@naver.com','유다희',NULL,'다희','01020330783','2004-07-26','37899','경북 포항시 남구 정몽주로847번길 19-8','청림동 자람빌라 가동 401호','f',1,NULL,'LQRMFfbDAPkoToVMYTd3gqdGY33RVTmgdXwLdPMkQhyKt8gXKIlJMiy9EfZ8','2021-02-03 20:47:24','2021-02-03 20:47:24',0,NULL),(264,'rlaslawl0414@naver.com','김민지',NULL,'초코우유','01030147111','1995-04-14','13525','경기 성남시 분당구 대왕판교로606번길 58','102-502','f',0,NULL,NULL,'2021-02-17 08:56:46','2021-02-17 08:56:46',0,NULL),(265,'ehs2gh@naver.com','조수정',NULL,'삐에로','01080723774','1991-03-08','39330','경북 구미시 사곡동 483','비체영덕 203호','f',1,NULL,NULL,'2021-02-17 22:51:29','2021-02-17 22:51:29',0,NULL),(266,'yookin@naver.com','유만호','$2y$10$MGVirDR0f7XClUWkGs70feeqpkZyzx5qIfKXkDvMh3X.m9ZyRZSQe','야미호','01047173125','1984-01-26','17081','경기 용인시 기흥구 보라동 585-1','2층','m',1,NULL,NULL,'2021-02-20 00:08:47','2021-02-20 00:08:47',0,'qWHo6bqukDThM/iSEQway8u1gJ8aIgUGxQ7AyBxFqGLk5I20quV7doqxbA9CyDwQ6+R2rPmIUJvhDBpiSiWtVA=='),(267,'osmina0125@gmail.com','최민아','$2y$10$yUYEX0QgW.RTd5z7lz69bug1tQMF/OOD8YxsmD9FAIKCuVmZ6D8fq','Minachoi','01095566876','1993-01-25','16854','경기 용인시 수지구 성복1로 157','101-2002','f',1,NULL,NULL,'2021-03-29 14:29:49','2021-03-29 14:29:49',0,'Cku0z791Qjl8hlTzh6UAwYgbfE1FeMkWpI7Hrjy3/tVitsbwxxyWgaGj3G9nBCJz1dCKWf/5BMx1eB0AzzMPPA=='),(268,'xo19xo@naver.com','김보람','$2y$10$xlvxgJPo/F14oLF/VMLHieiBS6ksej3DLt2H6B7fHCSCIFewgSKt.','보름달','01099340796','1990-11-19','18611','경기 화성시 향남읍 상신하길로274번길 21','707동 2601호','f',1,NULL,NULL,'2021-04-23 23:19:01','2021-04-23 23:19:01',0,'UjT1/LazaMFSlWTgBVB0OCXAgvdjE5iCeOr1cE7sFvPjmXQQcbtqcgakA9Z/uXTVj7HbX/KKNVCM4/km2WHOhA=='),(269,'khnhaha88@naver.com','국시영','$2y$10$jik16vHaMZZ0pTFJZ2f4f.j82Y7G6x99H1uLYAgNffhdGy5ERxOP6','앱뿌니','01058123456','1988-09-12','10875','경기 파주시 청석로 300','대원효성 924동402','f',1,NULL,NULL,'2021-06-22 18:05:15','2021-06-22 18:05:15',0,'N4hmq32d6GfEqGLmmgMuEPtItTVTVVuZTHZvy7FvK36ICL54Xtki4h1uMj2RXa0+fDDh3KMTqYy+ji24iSUtvA=='),(270,'sinhee1028@naver.com','김신희','$2y$10$G4Yv7JwSKgFjbDemkbraku9KfnUvpLFFlfBG4ItWNjBF9xbeyHCAS','동동이','01092202814','1999-10-28','48496','부산 남구 수영로 248','메트로타워 610호','f',1,NULL,NULL,'2021-08-13 14:52:50','2021-08-13 14:52:50',0,'gk0fYeQgQYXz0S0KHZ784FGXjiNPj7GEN/g39dWf8Hw4AIp0rh4KYZNJh0xRWjXQqTtzuI0wMYBeYZAnoGdniw=='),(271,'imp0421@hanmail.net','김지은','$2y$10$Z6MaSObAQG9rqZzIQqojLeHrOPQr5DkeHHS9JAMNngkPsme6klNHy','작은악마','01050566798','1980-06-10','51261','경남 창원시 마산합포구 자산솔밭로 41','105호','f',1,NULL,NULL,'2022-01-11 18:47:00','2022-01-11 18:47:00',0,'tb3iijnF4Kt5Tscn39SbFImXsqz51Q6Fl3EhX6cd+paHlA5YrUki9ClFUKdwlDyUBWByB6jy6w1fFuDctomm2Q==');
/*!40000 ALTER TABLE `reviewers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `after` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `satisfaction` tinyint(3) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campaign_reviewer_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_campaign_reviewer_id_foreign` (`campaign_reviewer_id`),
  CONSTRAINT `reviews_campaign_reviewer_id_foreign` FOREIGN KEY (`campaign_reviewer_id`) REFERENCES `campaign_reviewers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (12,'http://naver.com','너무  독같죠?  test 참여후기 입니다 test 참여후기 입니다 test 참여후기 입니다 test 참여후기 입니다 test 참여후기 입니다 test 참여후기 입니다 test 참여후기 입니다 test 참여후기 입니다',90,'2021-02-01 12:24:22','2021-02-01 13:02:51',36),(13,'http://1','1',100,'2021-02-15 11:07:20','2022-01-18 16:35:35',34),(14,'http://naver.com','재미있었습니다!',NULL,'2021-10-17 20:31:17','2021-10-17 20:31:17',39);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-23  4:00:24

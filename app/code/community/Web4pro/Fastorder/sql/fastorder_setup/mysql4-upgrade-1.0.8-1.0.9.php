<?php
/**
 * WEB4PRO - Creating profitable online stores
 *
 *
 * @author    WEB4PRO <support@web4pro.net>
 * @category  WEB4PRO
 * @package   Web4pro_Fastorder
 * @copyright Copyright (c) 2015 WEB4PRO (http://www.web4pro.net)
 * @license   http://www.web4pro.net/license.txt
 */

/** @var  $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS  `{$installer->getTable('web4pro_fastorder/country')}`;
    CREATE TABLE `{$installer->getTable('web4pro_fastorder/country')}` (
       `entity_id` int(10) unsigned NOT NULL auto_increment,
       `phone_code` varchar(9) NOT NULL default '',
       `country_code` varchar(9) NOT NULL default '',
       `order` tinyint(4) default '0',
       PRIMARY KEY  (`entity_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('376', 'AD', 1);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('971', 'AE', 2);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('93', 'AF', 3);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('355', 'AL', 4);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('374', 'AM', 5);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('599', 'AN', 6);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('244', 'AO', 7);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('54', 'AR', 8);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('43', 'AT', 9);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('61', 'AU', 10);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('297', 'AW', 11);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('994', 'AZ', 12);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('387', 'BA', 13);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('880', 'BD', 14);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('32', 'BE', 15);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('226', 'BF', 16);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('359', 'BG', 17);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('973', 'BH', 18);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('257', 'BI', 19);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('229', 'BJ', 20);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('673', 'BN', 21);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('591', 'BO', 22);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('55', 'BR', 23);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('975', 'BT', 24);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('267', 'BW', 25);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('375', 'BY', 26);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('501', 'BZ', 27);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('236', 'CF', 28);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('41', 'CH', 29);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('682', 'CK', 30);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('56', 'CL', 31);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('237', 'CM', 32);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('86', 'CN', 33);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('57', 'CO', 34);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('506', 'CR', 35);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('53', 'CU', 36);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('238', 'CV', 37);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('357', 'CY', 38);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('420', 'CZ', 39);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('49', 'DE', 40);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('253', 'DJ', 41);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('45', 'DK', 42);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('213', 'DZ', 43);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('593', 'EC', 44);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('372', 'EE', 45);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('20', 'EG', 46);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('291', 'ER', 47);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('34', 'ES', 48);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('251', 'ET', 49);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('358', 'FI', 50);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('679', 'FJ', 51);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('691', 'FM', 52);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('298', 'FO', 53);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('33', 'FR', 54);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('241', 'GA', 55);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('44', 'GB', 56);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('995', 'GE', 57);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('594', 'GF', 58);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('233', 'GH', 59);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('350', 'GI', 60);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('299', 'GL', 61);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('220', 'GM', 62);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('224', 'GN', 63);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('590', 'GP', 64);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('240', 'GQ', 65);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('30', 'GR', 66);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('502', 'GT', 67);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('245', 'GW', 68);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('592', 'GY', 69);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('504', 'HN', 70);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('385', 'HR', 71);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('509', 'HT', 72);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('36', 'HU', 73);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('62', 'ID', 74);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('353', 'IE', 75);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('972', 'IL', 76);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('91', 'IN', 77);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('964', 'IQ', 78);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('98', 'IR', 79);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('354', 'IS', 80);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('39', 'IT', 81);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('962', 'JO', 82);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('81', 'JP', 83);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('254', 'KE', 84);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('996', 'KG', 85);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('855', 'KH', 86);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('686', 'KI', 87);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('269', 'KM', 88);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('850', 'KP', 89);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('82', 'KR', 90);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('965', 'KW', 91);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('856', 'LA', 92);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('961', 'LB', 93);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('423', 'LI', 94);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('94', 'LK', 95);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('231', 'LR', 96);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('266', 'LS', 97);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('370', 'LT', 98);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('352', 'LU', 99);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('371', 'LV', 100);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('218', 'LY', 101);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('212', 'MA', 102);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('377', 'MC', 103);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('373', 'MD', 104);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('382', 'ME', 105);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('261', 'MG', 106);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('692', 'MH', 107);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('389', 'MK', 108);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('223', 'ML', 109);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('976', 'MN', 110);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('596', 'MQ', 111);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('222', 'MR', 112);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('356', 'MT', 113);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('230', 'MU', 114);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('960', 'MV', 115);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('265', 'MW', 116);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('52', 'MX', 117);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('60', 'MY', 118);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('258', 'MZ', 119);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('264', 'NA', 120);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('687', 'NC', 121);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('227', 'NE', 122);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('234', 'NG', 123);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('505', 'NI', 124);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('31', 'NL', 125);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('47', 'NO', 126);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('977', 'NP', 127);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('674', 'NR', 128);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('64', 'NZ', 129);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('968', 'OM', 130);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('507', 'PA', 131);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('51', 'PE', 132);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('689', 'PF', 133);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('675', 'PG', 134);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('63', 'PH', 135);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('92', 'PK', 136);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('48', 'PL', 137);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('508', 'PM', 138);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('351', 'PT', 139);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('680', 'PW', 140);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('595', 'PY', 141);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('974', 'QA', 142);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('40', 'RO', 143);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('381', 'RS', 144);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('250', 'RW', 145);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('966', 'SA', 146);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('677', 'SB', 147);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('248', 'SC', 148);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('249', 'SD', 149);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('46', 'SE', 150);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('65', 'SG', 151);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('290', 'SH', 152);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('386', 'SI', 153);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('421', 'SK', 154);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('232', 'SL', 155);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('378', 'SM', 156);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('221', 'SN', 157);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('252', 'SO', 158);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('597', 'SR', 159);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('503', 'SV', 160);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('963', 'SY', 161);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('268', 'SZ', 162);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('235', 'TD', 163);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('228', 'TG', 164);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('66', 'TH', 165);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('992', 'TJ', 166);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('690', 'TK', 167);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('993', 'TM', 168);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('216', 'TN', 169);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('90', 'TR', 170);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('688', 'TV', 171);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('886', 'TW', 172);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('255', 'TZ', 173);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('380', 'UA', 174);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('256', 'UG', 175);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('598', 'UY', 176);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('998', 'UZ', 177);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('379', 'VA', 178);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('58', 'VE', 179);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('1', 'VI', 180);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('84', 'VN', 181);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('678', 'VU', 182);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('681', 'WF', 183);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('685', 'WS', 184);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('967', 'YE', 185);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('27', 'ZA', 186);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('260', 'ZM', 187);
    INSERT INTO `{$installer->getTable('web4pro_fastorder/country')}` (`phone_code`, `country_code`, `order`) VALUES ('263', 'ZW', 188);
");

$installer->endSetup();


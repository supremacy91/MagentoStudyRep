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
	ALTER TABLE {$this->getTable('web4pro_fastorder/country')}
	      ADD COLUMN `status` int(11) unsigned DEFAULT '0' NOT NULL AFTER `order`;
");

$installer->endSetup();


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
$fastOrderTable = $installer->getTable('web4pro_fastorder/country');

$db = $installer->getConnection();
$db->beginTransaction();

try {
	$collection = Mage::getResourceModel('web4pro_fastorder/country_collection');

	foreach($collection as $item)
	{
		$phoneCode = $item->getPhoneCode();
		$formattedPhoneCode = "+{$phoneCode}";

		$bind  = array('phone_code' => $formattedPhoneCode);
		$where = array('entity_id = ?' => $item->getEntityId());
		$db->update($fastOrderTable, $bind, $where);
	}

	$db->commit();
} catch (Exception $e) {
	$db->rollback();
	throw $e;
}

$installer->endSetup();


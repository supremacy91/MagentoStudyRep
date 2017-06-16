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
$fastOrderTable = $installer->getTable('web4pro_fastorder/order');

$db = $installer->getConnection();
$db->beginTransaction();

try {
	$collection = Mage::getResourceModel('web4pro_fastorder/order_collection');

	foreach($collection as $order)
	{
		$phoneCode = Mage::helper('web4pro_fastorder')->getPhoneCodeByCountry($order->getCountry());
		$fullPhoneNumber = "+{$phoneCode}{$order->getPhone()}";

		$bind  = array('phone' => $fullPhoneNumber);
		$where = array('entity_id = ?' => $order->getEntityId());
		$db->update($fastOrderTable, $bind, $where);
	}

	$db->commit();
} catch (Exception $e) {
	$db->rollback();
	throw $e;
}

$installer->endSetup();


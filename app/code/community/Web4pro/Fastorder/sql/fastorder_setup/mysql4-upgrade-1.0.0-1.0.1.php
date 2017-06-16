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

$installer = $this;

$installer->startSetup();

$installer->run("delete `{$installer->getTable('web4pro_fastorder/order')}`.*  FROM `{$installer->getTable('web4pro_fastorder/order')}`
left join `{$installer->getTable('sales_flat_order')}`  on `{$installer->getTable('sales_flat_order')}`.entity_id = `{$installer->getTable('web4pro_fastorder/order')}`.magento_order_id
where `{$installer->getTable('sales_flat_order')}`.entity_id IS NULL");
$installer->run("ALTER TABLE `{$installer->getTable('web4pro_fastorder/order')}`
ADD FOREIGN KEY `fast_orders_to_full_orders` (`magento_order_id` ) REFERENCES `{$installer->getTable('sales_flat_order')}` (`entity_id` ) ON DELETE CASCADE ");

$installer->endSetup();

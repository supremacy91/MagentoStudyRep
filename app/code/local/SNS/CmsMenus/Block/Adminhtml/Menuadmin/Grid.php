<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml cms blocks grid
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SNS_CmsMenus_Block_Adminhtml_Menuadmin_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('menuGrid');
        $this->setDefaultSort('menu_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('cmsMenu/menu')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('menu_id', array(
            'header'    => $this->__('menu ID'),
            'align'     => 'left',
            'index'     => 'menu_id',
        ));

        $this->addColumn('name', array(
            'header'    => $this->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('date_created', array(
            'header'    => $this->__('Date of creation'),
            'align'     => 'left',
            'index'     => 'date_created'
        ));

        $this->addColumn('date_update', array(
            'header'    => $this->__('Date of update'),
            'align'     => 'left',
            'index'     => 'date_update'
        ));


        $this->addColumn('status', array(
            'header'    => $this->__('Status'),
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                0 => $this->__('Disabled'),
                1 => $this->__('Enabled')
            ),
        ));

        $this->addColumn('link', array(
            'header'    => $this->__('Link is here'),
            'align'     => 'left',
            'index'     => 'link'
        ));

        $this->addColumn('action',
            array(
                'header'    => $this->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => $this->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit',

                        ),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,

            ));

        return parent::_prepareColumns();
    }


    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}

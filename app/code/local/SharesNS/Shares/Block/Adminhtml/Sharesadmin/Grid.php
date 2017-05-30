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
class SharesNS_Shares_Block_Adminhtml_Sharesadmin_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        //Mage::log("AAAAAAAAAAAAAAA");
        parent::__construct();
        $this->setId('sharesGrid');
        $this->setDefaultSort('shares_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('shares/shares')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return $this;
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();
    //    Mage::log("AAAAAAAAAAAAAAA");
        $this->addColumn('shares_id', array(
            'header'    => $this->__('share ID'),
            'align'     => 'left',
            'index'     => 'shares_id',
        ));

        $this->addColumn('name', array(
            'header'    => $this->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('description', array(
            'header'    => $this->__('Description'),
            'align'     => 'left',
            'index'     => 'description'
        ));

        $this->addColumn('picture', array(
            'header'    => $this->__('Picture'),
            'align'     => 'left',
            'index'     => 'picture',
            'width'     => '70',
            'renderer' => 'SharesNS_Shares_Block_Adminhtml_Sharesadmin_Renderer'

        ));




        return parent::_prepareColumns();
    }

  /*  public function render(Varien_Object $row){
        $mediaurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $value = $row->getData($this->getColumn()->getIndex());
        return '<p style="text-align:center;padding-top:10px;"><img src="'.$mediaurl.DS.$value.'"  style="width:100px;height:200px;text-align:center;"/></p>';
    }*/

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('shares_id');
        $this->getMassactionBlock()->setIdFieldName('shares_id');
        $this->getMassactionBlock()
            ->addItem('delete',
                array(
                    'label' => Mage::helper('shares')->__('Delete'),
                    'url' => $this->getUrl('*/*/massDelete'),
                    'confirm' => Mage::helper('shares')->__('Are you sure?')
                )
            );
//            ->addItem('status',
//                array(
//                    'label' => Mage::helper('siteblocks')->__('Update status'),
//                    'url' => $this->getUrl('*/*/massStatus'),
//                    'additional' =>
//                        array('block_status'=>
//                            array(
//                                'name' => 'block_status',
//                                'type' => 'select',
//                                'class' => 'required-entry',
//                                'label' => Mage::helper('siteblocks')->__('Status'),
//                                'values' => Mage::getModel('siteblocks/source_status')->toOptionArray()
//                            )
//                        )
//                )
//            );

        return $this;
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

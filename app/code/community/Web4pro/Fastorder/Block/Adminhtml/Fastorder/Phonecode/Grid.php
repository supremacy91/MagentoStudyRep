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

class Web4pro_Fastorder_Block_Adminhtml_Fastorder_Phonecode_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setId('fast_order_phonecode_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('web4pro_fastorder/country')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('web4pro_fastorder')->__('Id'),
            'align' => 'right',
            'width' => '10',
            'type' => 'number',
            'index' => 'entity_id',
        ));

        $this->addColumn('phone_code', array(
            'header' => Mage::helper('web4pro_fastorder')->__('Phone Code'),
            'index' => 'phone_code',
            'type' => 'text',
        ));

        $this->addColumn('country_code', array(
            'header' => Mage::helper('web4pro_fastorder')->__('Country'),
            'index' => 'country_code',
            'type' => 'options',
            'options' => self::getCountriesCode(),
        ));

        $this->addColumn('order', array(
            'header'    => Mage::helper('web4pro_fastorder')->__('Position'),
            'width'     => '1',
            'type'      => 'number',
            'index'     => 'order',
            'sortable'  => false
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('web4pro_fastorder')->__('Status'),
            'width'     => '150',
            'align'     => 'left',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('web4pro_fastorder')->__('Disabled'),
                1 => Mage::helper('web4pro_fastorder')->__('Enabled')
            ),
            'frame_callback' => array($this, 'decorateStatus')
        ));

        return parent::_prepareColumns();
    }

    /**
     * Decorate status column values
     *
     * @param string $value
     * @param Web4pro_Fastorder_Model_Country $row
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @param bool $isExport
     *
     * @return string
     */
    public function decorateStatus($value, $row, $column, $isExport)
    {
        $class = '';
        switch ($row->getStatus()) {
            case 0:
                $class = 'grid-severity-critical';
                break;
            case 1:
                $class = 'grid-severity-notice';
                break;
        }
        return '<span class="'.$class.'"><span>'.$value.'</span></span>';
    }

    static public function getCountriesCode()
    {
        $countryCollection = Mage::getResourceModel('directory/country_collection')->loadData()->toOptionArray(false);
        $countyCodeList = array();

        foreach($countryCollection as $countryCode)
        {
            $countyCodeList[$countryCode['value']] = $countryCode['label'];
        }

        return $countyCodeList;
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('entity_ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        if(Mage::getSingleton('admin/session')->isAllowed('web4pro_attachments/fastorder_settings/phonecode/change')){
            $this->getMassactionBlock()->addItem('remove_phone_code', array(
                'label' => Mage::helper('web4pro_fastorder')->__('Delete'),
                'url' => $this->getUrl('*/fastorder_phonecode/massRemove'),
                'confirm' => Mage::helper('web4pro_fastorder')->__('Are you sure?')
            ));
            $this->getMassactionBlock()->addItem('enable_phone_code', array(
                'label' => Mage::helper('web4pro_fastorder')->__('Enable'),
                'url' => $this->getUrl('*/fastorder_phonecode/massEnable')
            ));
            $this->getMassactionBlock()->addItem('disable_phone_code', array(
                'label' => Mage::helper('web4pro_fastorder')->__('Disable'),
                'url' => $this->getUrl('*/fastorder_phonecode/massDisable')
            ));
        }
        return $this;
    }

    public function getRowUrl($row)
    {
        if(Mage::getSingleton('admin/session')->isAllowed('web4pro_attachments/fastorder_settings/phonecode/view')){
            return $this->getUrl('*/*/edit', array('id' => $row->getId()));
        }
        return false;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}
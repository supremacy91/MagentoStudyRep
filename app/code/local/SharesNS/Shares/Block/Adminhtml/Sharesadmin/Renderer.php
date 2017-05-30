<?php
class SharesNS_Shares_Block_Adminhtml_Sharesadmin_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    protected function _getValue(Varien_Object $row)
    {
       // Mage::log("FFFFFFFFFFFFF1");
        $val = $row->getData($this->getColumn()->getIndex());
       // var_dump($row->getData());
        $val = str_replace("no_selection", "", $val);
        $url = Mage::getBaseUrl('media') . 'shares/' . $val;
        $out = "<img src=". $url ." width='60px'/>";
        return $out;
    }
}
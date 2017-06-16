<?php

class SNS_CmsMenus_Model_Resource_Menu extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('cmsMenu/menu', 'menu_id');
    }

    protected function _afterLoad($object){
        if (!empty($object->getId())) {
            $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('cmsMenu/relation'),'ref_cms_page')
                ->where('ref_cms_menu=?',$object->getId());

            $object->setData('rcm', $this->_getReadAdapter()->fetchCol($select));
        }
        return parent::_afterLoad($object);
    }

    protected function _afterSave($object){
        if (!empty($object->getId())) {

            $resource = Mage::getSingleton('core/resource');
            $writeConnection = $resource->getConnection('core_write');
            $table = $resource->getTableName('cmsMenu/relation');

            $writeConnection->delete(
                $table,
                "ref_cms_menu = " . $object->getId()
            );
            $rcmArray = $object->getData('rcm');
           // var_dump($rcmArray); die();
            if(!empty($rcmArray)) {
                $rcmArray = explode('&', $rcmArray);
                foreach ($rcmArray as $rcm) {

                    $this->_getWriteAdapter()->insert($this->getTable('cmsMenu/relation'),
                        array('ref_cms_menu' => $object->getId(), 'ref_cms_page' => $rcm));
                }
            }

        }
    }
}
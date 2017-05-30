<?php
class SharesNS_Shares_Model_Resource_Shares extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('shares/shares', 'shares_id');
    }

    protected function _afterLoad($object){
        if (!empty($object->getId())) {
            $select = $this->_getReadAdapter()->select()
                ->from($this->getTable('shares/relation'),'ref_block')
                ->where('ref_shares=?',$object->getId());

            $object->setData('relationData', $this->_getReadAdapter()->fetchCol($select));
        }
        return parent::_afterLoad($object);
    }

    protected function _afterSave($object){
        if (!empty($object->getId())) {

            $resource = Mage::getSingleton('core/resource');
            $writeConnection = $resource->getConnection('core_write');
            $table = $resource->getTableName('shares/relation');

            $writeConnection->delete(
                $table,
                "ref_shares = " . $object->getId()
            );
            $rcmArray = $object->getData('relationData');

            if(!empty($rcmArray)) {
                $rcmArray = explode('&', $rcmArray);
                foreach ($rcmArray as $rcm) {

                    $this->_getWriteAdapter()->insert($this->getTable('shares/relation'),
                        array('ref_shares' => $object->getId(), 'ref_block' => $rcm));
                }
            }

        }
    }

}
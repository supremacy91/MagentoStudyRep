<?php
class SharesNS_Shares_Model_Shares extends Mage_Core_Model_Abstract
{

    protected $imagePath = 'shares';

    protected function _construct()
    {
        parent::_construct();
        $this->_init('shares/shares');
    }

    protected function _beforeSave()
    {
        //Mage::log("log" . "ModelShares _beforeSave");
        if ($this->getData('picture/delete')) {
            $this->unsImage();
        }
      //  Mage::log("FILES: " . $_FILES);
        try {
            $uploader = new Varien_File_Uploader('picture');
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
            $uploader->setAllowRenameFiles(true);
           // die($uploader);
            $this->setImage($uploader);
        } catch (Exception $e) {
            Mage::logException($e);
            // it means that we do not have files for uploading
        }

        return parent::_beforeSave();
    }

    public function getImagePath()
    {
        //Mage::log("log" . "ModelShares getImagePath" . Mage::getBaseDir('media') . DS . $this->imagePath . DS);
        return Mage::getBaseDir('media') . DS . $this->imagePath . DS;
    }

    public function setImage($image)
    {
        //Mage::log("log" . "ModelShares setImage");
        if ($image instanceof Varien_File_Uploader) {

            $image->save($this->getImagePath());
            $image = $image->getUploadedFileName();
        }
        $this->setData('picture', $image);
        return $this;
    }

    public function getImage()
    {
       // Mage::log("log" . "ModelShares getImage");
        if ($image = $this->getData('picture')) {

            return Mage::getBaseUrl('media') . $this->imagePath . DS . $image;
        } else {
            return '';
        }
    }

    protected function prepareImageForDelete()
    {
        //Mage::log("log" . "ModelShares prepareImageForDelete");
        $image = $this->getData('picture');
        return str_replace(Mage::getBaseUrl('media'), Mage::getBaseDir('media') . DS, $image['value']);
    }

    public function unsImage()
    {
        //Mage::log("log" . "ModelShares unsImage");
        $image = $this->getData('picture');
        if (is_array($image)) {
            $image = $this->prepareImageForDelete();
        } else {
            $image = $this->getImagePath() . $image;
        }

        if (file_exists($image)) {
            unlink($image);
        }
        $this->setData('picture', '');
        return $this;
    }

    /*public function getImageUrl()
    {
        $helper = Mage::helper('shares');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }*/

}
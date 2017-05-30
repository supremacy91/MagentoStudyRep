<?php
/**
 * Created by PhpStorm.
 * User: maks
 * Date: 16.05.17
 * Time: 18:13
 */
class SharesNS_Shares_Adminhtml_ShareController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        //die(var_dump($this->getRequest()->getPost()));
        $id = $this->getRequest()->getParam('id');
       //die($id);
        $model = Mage::getModel('shares/shares')->load($id);

        Mage::register('shares_share', $model);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        // check if data sent
      //  die(var_dump($this->getRequest()->getPost()));
        if ($data = $this->getRequest()->getPost()) {
            $data = $this->_filterPostData($data);
            //  die(var_dump($data));
            //init model and set data
            $model = Mage::getModel('shares/shares');
            //die(var_dump($data));
            if ($id = $this->getRequest()->getParam('shares_id')) {
                $model->load($id);
               // die(var_dump("id: " . $id));
            }
            if(!$data['shares_id']){
                unset($data['shares_id']);
            }
            $model->setData($data);

            //validating
            if (!$this->_validatePostData($data)) {
                $this->_redirect('*/*/edit', array('shares_id' => $model->getId(), '_current' => true));
                return;
            }

            // try to save it
            try {
               // die(var_dump($data));
                $model->save();

                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    $this->__('The page has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('page_id' => $model->getId(), '_current'=>true));
                    return;
                }
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Mage_Core_Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addException($e,
                    $this->__('An error occurred while saving the page.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('page_id' => $this->getRequest()->getParam('page_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    protected function _filterPostData($data)
    {
        $data = $this->_filterDates($data, array('custom_theme_from', 'custom_theme_to'));
        return $data;
    }

    protected function _validatePostData($data)
    {
        $errorNo = true;
        if (!empty($data['layout_update_xml']) || !empty($data['custom_layout_update_xml'])) {
            /** @var $validatorCustomLayout Mage_Adminhtml_Model_LayoutUpdate_Validator */
            $validatorCustomLayout = Mage::getModel('adminhtml/layoutUpdate_validator');
            if (!empty($data['layout_update_xml']) && !$validatorCustomLayout->isValid($data['layout_update_xml'])) {
                $errorNo = false;
            }
            if (!empty($data['custom_layout_update_xml'])
                && !$validatorCustomLayout->isValid($data['custom_layout_update_xml'])) {
                $errorNo = false;
            }
            foreach ($validatorCustomLayout->getMessages() as $message) {
                $this->_getSession()->addError($message);
            }
        }
        return $errorNo;
    }


    public function deleteAction()
    {

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('shares/shares')->load($id);

        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $table = $resource->getTableName('shares/shares');

        $writeConnection->delete(
            $table,
            "shares_id = " . $model->getId()
        );
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $blocks = $this->getRequest()->getParams();
        try {
            $blocks= Mage::getModel('shares/shares')
                ->getCollection()
                ->addFieldToFilter('shares_id',array('in'=>$blocks['massaction']));
            foreach($blocks as $block) {
                $block->delete();
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Blocks were deleted!');

        return $this->_redirect('*/*/');

    }

    public function blocksGridAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('cmsMenu/menu')->load($id);

        Mage::register('shares_share', $model);
        $this->loadLayout();
        $this->renderLayout();
    }

    
        public function linkAction()
        {
            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('shares/shares')->load($id);

            Mage::register('shares_share', $model);
            $this->loadLayout();
            $this->renderLayout();
        }
}

<?php

class SNS_CmsMenus_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
       // $this->getResponse()->setOutput();
    }

    public function newAction()
    {
        $this->_forward('edit');

    }

    public function editAction()
    {

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('cmsMenu/menu')->load($id);

        Mage::register('cmsMenu_menu', $model);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAndContinueEditAction() {
        $data = $this->getRequest()->getPost();
        $data = $this->_filterPostData($data);

        $model = Mage::getModel('cmsMenu/menu');

        if(!$data['menu_id']){
            unset($data['menu_id']);
        }
        $model->setData($data);

        try {

            $model->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(
                $this->__('The page has been saved.'));

            Mage::getSingleton('adminhtml/session')->setFormData(false);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('menu_id' => $model->getId(), '_current'=>true));
                return;
            }
            // go to grid

            if (empty($this->getRequest()->getParam('menu_id'))) {

                $this->_redirect('*/*/edit', array('id' => $model->getId()));

            } else {
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('menu_id')));
            }

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
        $this->_redirect('*/*/edit', array('menu_id' => $this->getRequest()->getParam('menu_id')));
        return;

        $this->_redirect('*/*/edit/id/' . $this->getRequest()->getParam('id'));
    }

    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            $data = $this->_filterPostData($data);
            //init model and set data
            $model = Mage::getModel('cmsMenu/menu');
            //die(var_dump($data));
            if ($id = $this->getRequest()->getParam('menu_id')) {
                $model->load($id);
            }
            if(!$data['menu_id']){
                unset($data['menu_id']);
            }
            $model->setData($data);

            //validating
            if (!$this->_validatePostData($data)) {
                $this->_redirect('*/*/edit', array('menu_id' => $model->getId(), '_current' => true));
                return;
            }

            // try to save it
            try {

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

    public function pagesGridAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('cmsMenu/menu')->load($id);

        Mage::register('cmsMenu_menu', $model);
        $this->loadLayout();

        $this->renderLayout();

    }

    public function deleteAction()
    {

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('cmsMenu/menu')->load($id);

        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $table = $resource->getTableName('cmsMenu/menu');

        $writeConnection->delete(
            $table,
            "menu_id = " . $model->getId()
        );
        $this->_redirect('*/*/');
    }


    public function linkAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('cmsMenu/menu')->load($id);

        Mage::register('cmsMenu_menu', $model);
        $this->loadLayout();
        $this->renderLayout();
    }
    protected function _filterPostData($data)
    {
        $data = $this->_filterDates($data, array('custom_theme_from', 'custom_theme_to'));
        return $data;
    }

    /**
     * Validate post data
     *
     * @param array $data
     * @return bool     Return FALSE if someone item is invalid
     */
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
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/menuext');
    }

}

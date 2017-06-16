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

class Web4pro_Fastorder_Adminhtml_Fastorder_PhonecodeController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('web4pro_attachments/fastorder_settings')
            ->_addBreadcrumb(
                Mage::helper('web4pro_fastorder')->__('WEB4PRO'),
                Mage::helper('web4pro_fastorder')->__('Fast Order'),
                Mage::helper('web4pro_fastorder')->__('Country Calling Codes')
            );
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Web4pro'))->_title($this->__('Fast Order'))->_title($this->__('Country Calling Codes'));
        $this->_initAction();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $entityId = $this->getRequest()->getParam('id');

        if ($entityId) {
            $countryModel = Mage::getModel('web4pro_fastorder/country');
            $countryModel->load($entityId);
            if (!$countryModel->getEntityId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('web4pro_fastorder')->__('This country calling code no longer exists.'));
                $this->_redirect('*/*/*');
                return;
            }
            Mage::register('fastorder_phonecode_data', $countryModel);
            $this->_title('Edit country calling code');
        }
        else
        {
            $this->_title('Create new country calling code');
        }

        $this->_initAction();
        $this->renderLayout();
    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        $entityId = $this->getRequest()->getParam('id');
        $postData = $this->getRequest()->getPost();

        if ($postData) {
            $model = Mage::getModel('web4pro_fastorder/country');
            try {
                $model->addData($postData)->setId($entityId)->save();
                $this->_getSession()->addSuccess($this->__('Country Calling Code #%d was saved', $model->getId()));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                Mage::logException($e);
            }

            if ($this->getRequest()->getParam('back') && $model->getId()) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
        } else {
            $this->_getSession()->addError($this->__('There was no data to save'));
        }

        if ($redirectBack) {
            $this->_redirect('*/*/edit', array(
                'id' => $entityId,
            ));
        } else {
            $this->_redirect('*/*/index');
        }
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id'))
        {
            try
            {
                $model = Mage::getModel('web4pro_fastorder/country')->load($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('web4pro_fastorder')->__('Country Calling Code has been deleted.')
                );
                $this->_redirect('*/*/');
                return;

            }
            catch (Mage_Core_Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
                return;
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
                return;
            }
        }
    }

    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('entity_ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel('web4pro_fastorder/country');
                $model->setId($id)->delete();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('web4pro_fastorder')->__('Country calling code(s) was successfully removed')
            );
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function massEnableAction()
    {
        try {
            $ids = $this->getRequest()->getPost('entity_ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel('web4pro_fastorder/country');
                $model->setId($id)->setStatus(1)->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('web4pro_fastorder')->__('Country calling code(s) was successfully enabled')
            );
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function massDisableAction()
    {
        try {
            $ids = $this->getRequest()->getPost('entity_ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel('web4pro_fastorder/country');
                $model->setId($id)->setStatus(0)->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('web4pro_fastorder')->__('Country calling code(s) was successfully disabled')
            );
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Acl check for admin
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        $action = strtolower($this->getRequest()->getActionName());
        switch ($action) {
            case 'index':
                $aclResource = 'web4pro_attachments/fastorder_settings/phonecode/grid';
                break;
            case 'edit':
                $aclResource = 'web4pro_attachments/fastorder_settings/phonecode/view';
                break;
            case 'delete':
            case 'save':
            case 'new':
                $aclResource = 'web4pro_attachments/fastorder_settings/phonecode/change';
                break;
            default:
                $aclResource = 'admin';
                break;

        }
        return Mage::getSingleton('admin/session')->isAllowed($aclResource);
    }
}
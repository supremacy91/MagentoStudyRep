<?php
class SharesNS_Shares_Block_Adminhtml_Sharesadmin_Edit_Tab_Share
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setShowGlobalIcon(true);
    }


  protected function _prepareForm()
    {
        $isElementDisabled = false;

        $form = new Varien_Data_Form();


        $model = Mage::registry('shares_share');

        $layoutFieldset = $form->addFieldset('layout_fieldset', array(
            'legend' => Mage::helper('cms')->__('Shares Edit'),
            'class'  => 'fieldset-wide',
            'disabled'  => $isElementDisabled
        ));

        $layoutFieldset->addField('shares_id', 'hidden', array(
            'name'      => 'shares_id',

        ));

        $layoutFieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => $this->__('Name'),
           // 'style'     => 'height:24em;',
            'disabled'  => $isElementDisabled
        ));


        $layoutFieldset->addField('description', 'text', array(
            'name'      => 'description',
            'label'     => $this->__('Description'),
            // 'style'     => 'height:24em;',
            'disabled'  => $isElementDisabled
        ));

        $layoutFieldset->addField('picture', 'image', array(
            'name'      => 'picture',
            'label'     => $this->__('Image'),
            // 'style'     => 'height:24em;',
            'disabled'  => $isElementDisabled,
            'renderer' => 'SharesNS_Shares_Block_Adminhtml_Sharesadmin_Renderer'
        ));

       // Mage::log($model);
        //$formData = array_merge($model->getData(), array('image' => $model->getImageUrl()));
        $data = $model->getData();
        //Mage::log("Data: " . var_dump($data));
        $data['picture'] = $model->getImage();
        $form->setValues($data);

       // $form->setValues($model->getData());
  //  die()
        $this->setForm($form);
      //  Mage::log($form);
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Shares');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Design');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }


}
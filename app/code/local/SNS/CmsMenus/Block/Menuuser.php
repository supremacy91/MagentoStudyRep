<?php


class SNS_CmsMenus_Block_Menuuser extends Mage_Core_Block_Template
{

    public function getCollection()
    {
        $page = Mage::registry("current_page")->getPageId();
        $collection = Mage::getModel('cmsMenu/menu')->getCollection();
        $collection->join(
            array( 'relation' => 'cmsMenu/relation'),
            'menu_id = ref_cms_menu and ref_cms_page = ' . $page

        );

        return $collection;
    }

    public function getLink($menu)
    {
        return $this->getUrl('', array('_direct' => $menu->getLink()));
    }


}

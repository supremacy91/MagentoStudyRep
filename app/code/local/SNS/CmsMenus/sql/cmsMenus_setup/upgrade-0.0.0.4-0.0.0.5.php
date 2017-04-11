<?php
$installer = $this;


$installer->startSetup();

$installer->run("

/*ALTER TABLE {$this->getTable('cmsMenu/relation')}
      DROP FOREIGN KEY FK_RELATION_MENU;
ALTER TABLE {$this->getTable('cmsMenu/relation')}
      DROP FOREIGN KEY FK_RELATION_PAGE;
ALTER TABLE {$this->getTable('cmsMenu/relation')}
      ADD CONSTRAINT FK_RELATION_MENU FOREIGN KEY(ref_cms_menu) REFERENCES 
      {$this->getTable('cmsMenu/menu')}(menu_id) ON DELETE CASCADE; 
ALTER TABLE {$this->getTable('cmsMenu/relation')}
      ADD CONSTRAINT FK_RELATION_PAGE FOREIGN KEY(ref_cms_page) REFERENCES 
      {$this->getTable('cms/page')}(page_id) ON DELETE CASCADE;*/
");
<?php
$installer = $this;


$installer->startSetup();

$installer->run("
/*ALTER TABLE {$this->getTable('cmsMenu/menu')}
      ADD CONSTRAINT PK_MENU PRIMARY KEY(menu_id);*/
/*ALTER TABLE {$this->getTable('cmsMenu/relation')}
      ADD CONSTRAINT FK_RELATION_MENU FOREIGN KEY(ref_cms_menu) REFERENCES 
      {$this->getTable('cmsMenu/menu')}(menu_id);*/
/*ALTER TABLE {$this->getTable('cmsMenu/relation')}
      ADD CONSTRAINT FK_RELATION_PAGE FOREIGN KEY(ref_cms_page) REFERENCES 
      {$this->getTable('cms/page')}(page_id);*/
");
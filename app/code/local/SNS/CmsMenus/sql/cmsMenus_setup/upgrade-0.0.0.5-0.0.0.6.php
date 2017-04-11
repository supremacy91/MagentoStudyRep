<?php
$installer = $this;


$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('cmsMenu/relation')}
      ADD CONSTRAINT FK_RELATION_PAGE FOREIGN KEY(ref_cms_page) REFERENCES 
      {$this->getTable('cms/page')}(page_id) ON DELETE CASCADE;
");
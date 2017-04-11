    <?php
$installer = $this;


$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('cms_menu')}
      MODIFY date_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE {$this->getTable('cms_menu')}
      MODIFY date_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;

");
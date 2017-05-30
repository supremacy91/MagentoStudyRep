<?php
$installer = $this;

$installer->startSetup();
//ALTER DATABASE 'shares' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

//ALTER TABLE {$this->getTable('shares/shares')} DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
$installer->run("



CREATE TABLE {$this->getTable('shares/relation')} (
  relation_id int NOT NULL PRIMARY KEY,
  ref_shares int,
  ref_block int
 
);

");
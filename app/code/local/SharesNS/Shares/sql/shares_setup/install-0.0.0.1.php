<?php

$installer = $this;

$installer->startSetup();

$installer->run("

CREATE TABLE {$this->getTable('shares/shares')} (
  shares_id int NOT NULL PRIMARY KEY,
  name varchar(255) NOT NULL,
  description varchar(255),
  picture varchar(255)
);

//ALTER DATABASE {$this->getTable('shares/shares')} DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

");


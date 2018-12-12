<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('stockist')};
CREATE TABLE {$this->getTable('stockist')} (
  `stockist_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `telephone` bigint(32) NOT NULL default '0',
  `fax` bigint(32) default '0',
  `company` varchar(255) NOT NULL default '',
  `abn` bigint(11) NOT NULL default '0',
  `address_first` varchar(255) NOT NULL default '',
  `address_second` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `state` varchar(255) NOT NULL default '',
  `country` varchar(255) NOT NULL default '',
  `postcode` int(11) NOT NULL default '0',
  `comment` text NOT NULL,
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`stockist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 
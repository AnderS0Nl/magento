<?php

$installer = $this;
$tableNews = $installer->getTable('tsgtrial/table_news');

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($tableNews)
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'identity' => true,
    'nullable' => false,
    'primary'  => true,
    'auto_increment' => true,
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false,
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ))
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable' => false,
    ));

$installer->getConnection()->createTable($table);

$installer->endSetup();


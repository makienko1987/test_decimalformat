<?php
/**
 * @author      Andrey Makienko <makyshplat@gmail.com>
 */
/** @var $this Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();

$tableOrderTotalWithDecimalFactor = $installer->getTable('test_decimalfactor/factor');
// Dropping table
$installer->getConnection()->dropTable($tableOrderTotalWithDecimalFactor);
// create table if not exist
if (!$installer->tableExists($tableOrderTotalWithDecimalFactor)) {
    $table = $installer->getConnection()->newTable($tableOrderTotalWithDecimalFactor)
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ), 'increment id')
        ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'nullable' => false,
            'identity' => false,
            'unsigned' => true,
            'primary' => true,
        ), 'Order ID')
        ->addColumn('total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
            'unsigned' => true,
            'nullable' => false,
        ), 'Total')
        // add index to order_id column for fast execution from query
        ->addIndex(
            $installer->getIdxName($tableOrderTotalWithDecimalFactor, ['order_id']),
            ['order_id']
        )
        //link to order table
        ->addForeignKey(
            $installer->getFkName('test_decimalfactor/factor', 'order_id', 'sales/order', 'entity_id'),
            'order_id', $installer->getTable('sales/order'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
        )
        ->setComment('Order Total Table With Decimal Factor');
    $this->getConnection()->createTable($table);
}

$installer->endSetup();
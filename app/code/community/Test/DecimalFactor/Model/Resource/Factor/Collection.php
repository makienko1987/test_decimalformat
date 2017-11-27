<?php
/**
 * @author      Andrey Makienko <makyshplat@gmail.com>
 */

/**
 * Class Test_DecimalFactor_Model_Resource_Factor_Collection
 */
class Test_DecimalFactor_Model_Resource_Factor_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('test_decimalfactor/factor');
    }

    /**
     * @return array
     */
    public function getAllItems()
    {
        $select = $this->getSelect()->from([$this->getMainTable()],[
            'entity_id',
            'total',
            'order_id'
        ]);
        $select->group('main_table.order_id');

        $connection = $this->getResource()->getReadConnection();
        $itemsData = $connection->fetchAll($select);

        return $itemsData;
    }

    /**
     * @return array
     */
    public function getAllOrderIds()
    {
        $select = $this->getSelect()->from([$this->getMainTable()]);

        $select->reset(Zend_Db_Select::COLUMNS);
        $select->columns('main_table.order_id');
        $select->group('main_table.order_id');
        $connection = $this->getResource()->getReadConnection();

        $itemsData = $connection->fetchCol($select);

        return $itemsData;
    }
}
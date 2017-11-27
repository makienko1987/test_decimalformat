<?php
/**
 * @author      Andrey Makienko <makyshplat@gmail.com>
 */
/**
 * Class Test_DecimalFactor_Model_Cron
 */
class Test_DecimalFactor_Model_Cron
{
    CONST SELECT_BATCH = 100;

    protected $_curStartPoint = 0;

    /** cron job method
     *
     *  use partial select data for insert
     */
    public function upgradeExistOrders()
    {
        // run if config flag is enabled
        if($this->getResourceModel()->getHelper()->getConfigHelper()->isCronJobAvailable()) {
            $ordersSelect = $this->getResourceModel()->getOldValidOrdersSelect();
            // use approach of partial execution from select
            while ($rowCount = $ordersSelect->limit(self::SELECT_BATCH, $this->_curStartPoint)->query()->rowCount()) {
                $this->getResourceModel()->prepareDataToInsert($ordersSelect);
                $this->_curStartPoint += self::SELECT_BATCH;
            }
        }
    }

    /**
     * @return Test_DecimalFactor_Model_Resource_Factor
     */
    protected function getResourceModel()
    {
        return Mage::getResourceModel('test_decimalfactor/factor');
    }
}
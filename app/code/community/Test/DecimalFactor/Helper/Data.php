<?php
/**
 * @author      Andrey Makienko <makyshplat@gmail.com>
 */

/**
 * Class Test_DecimalFactor_Helper_Data
 */
class Test_DecimalFactor_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @param $orderTotal
     * @param $decimalFactor
     * @return mixed
     */
    public function transformValueByFactor($orderTotal,$decimalFactor)
    {
        $result = !empty($decimalFactor)
            ? ($orderTotal*$decimalFactor)
            : $orderTotal;
        //todo default store round has precision 2
        return Mage::app()->getStore()->roundPrice($result);
    }

    /**
     * @param $invoice
     */
    public function addDataToTable($invoice)
    {
        $decimalFactor = $this->getConfigHelper()->getDecimalFactor($invoice->getStoreId());
        $orderTotalPaid = $invoice->getOrder()->getTotalPaid();
        // get transform value
        $transformTotalValue = $this->transformValueByFactor($orderTotalPaid,$decimalFactor);
        // save data to table
        $this->getFactorModel()
            ->addObjectData($invoice->getOrder()->getId(),$transformTotalValue)
            ->save();
    }

    /**
     * @return Test_DecimalFactor_Helper_Config
     */
    public function getConfigHelper()
    {
        return Mage::helper('test_decimalfactor/config');
    }

    /**
     * @return false|Test_DecimalFactor_Model_Factor
     */
    protected function getFactorModel()
    {
        return Mage::getModel('test_decimalfactor/factor');
    }
}
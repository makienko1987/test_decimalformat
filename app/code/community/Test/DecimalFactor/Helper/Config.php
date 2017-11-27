<?php
/**
 * @author      Andrey Makienko <makyshplat@gmail.com>
 */

/**
 * Class Test_DecimalFactor_Helper_Config
 */
class Test_DecimalFactor_Helper_Config extends Mage_Core_Helper_Abstract
{
    CONST SETTINGS_DECIMAL_FACTOR_STATUS_PATH = 'test_decimalfactor/test_group/is_active';
    CONST SETTINGS_DECIMAL_FACTOR_VALUE_PATH = 'test_decimalfactor/test_group/decimal_factor';
    CONST SETTINGS_CRON_JOB_STATUS_PATH = 'test_decimalfactor/test_group/upgrade_old_orders';

    /**
     * @param mixed $store
     * @return mixed
     */
    public function getDecimalFactor($store = null)
    {
        if(!$store) {
            $store = Mage::app()->getStore();
        }

        return Mage::getStoreConfig(self::SETTINGS_DECIMAL_FACTOR_VALUE_PATH, $store);
    }

    /**
     * @param mixed $store
     * @return mixed
     */
    public function isEnabled($store = null)
    {
        if(!$store) {
            $store = Mage::app()->getStore();
        }

        return Mage::getStoreConfig(self::SETTINGS_DECIMAL_FACTOR_STATUS_PATH, $store);
    }

    /**
     * @param mixed $store
     * @return mixed
     */
    public function isCronJobAvailable($store = null)
    {
        if(!$store) {
            $store = Mage::app()->getStore();
        }

        return Mage::getStoreConfig(self::SETTINGS_CRON_JOB_STATUS_PATH, $store);
    }
}
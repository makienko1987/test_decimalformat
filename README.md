# Introduction
This module represents an approach to observe field "paid_total" (`sales_flat_order`) and change this value by decimal factor which can be set in admin settings part.
# Features
 - Ability to change decimal factor
 - Ability to get actual data from old orders by cron
 - All changes are stored in a separate table which allows to expand/change this table without any changes in core tables
 
# How to Install 

### Compatibility
#### Supported Magento Versions

 - Community: 1.8.1.0; 1.9.0.1; 1.9.1.1; 1.9.2.x; 1.9.3.x
 
#### Requirements

 - PHP Version: > 5.3
 - Magento Community Edition 1.x
 
#### Installation

   - Install this extension using [modman](https://github.com/colinmollenhour/modman).
    Once you have modman installed, run `modman init` if you have not done this yet.
    Next just enter the following command in the root of the Magento installation (`/var/www/magento`):
   
   ```
   modman clone git://github.com/makienko1987/test_decimalfactor.git
   ```
   
# Configuration

Configuration can be done using the Administrator section of your Magento store. 
Once Logged in, you will find the configuration settings under  **Settings > Configuration > Test Extension Modules > Decimal Factor**
![Alt text](https://raw.githubusercontent.com/makienko1987/test_decimalfactor/master/docs/SettingsMenu.png "Menu settings")
![Alt text](https://raw.githubusercontent.com/makienko1987/test_decimalfactor/master/docs/MainSettings.png "Main settings")

**NOTE:** As default this extension uses settings from `config.xml` 
![Alt text](https://raw.githubusercontent.com/makienko1987/test_decimalfactor/master/docs/DefaultSettings.png "Default settings")

# Additional Info

This extension uses cron job to get data from old orders
![Alt text](https://raw.githubusercontent.com/makienko1987/test_decimalfactor/master/docs/CronConfigSettings.png "Cron settings")

Cron extracts data in parts (as default CRON_BATCH = 100)

This extension has additional methods to get data from any place of your Magento

`$orderId` you order entity_id
```
Mage::getModel('test_decimalfactor/factor')->getItemByOrderId($orderId);
```
Get All Items (all rows):
```
Mage::getModel('test_decimalfactor/factor')
->getCollection()
->getAllItems();
```
Get All Items (only order_id row):
```
Mage::getModel('test_decimalfactor/factor')
->getCollection()
->getAllOrderIds();
```

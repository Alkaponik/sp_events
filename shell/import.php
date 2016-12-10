<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */
require_once 'abstract.php';

class SP_Shell_Import extends Mage_Shell_Abstract
{
    protected $_file = null;

    public function __construct()
    {
        parent::__construct();

        // Time limit to infinity
        set_time_limit(0);

        // Get command line argument named "argname"
        // Accepts multiple values (comma separated)
        if($this->getArg('file')) {
            $this->_file = trim($this->getArg('file'));
        }
    }

    // Shell script point of entry
    public function run()
    {
        if (($handle = fopen($this->_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                list($name, $sku, $price) = $data;

                $this->createProduct($name, $sku, $price);
            }
            fclose($handle);
        }
    }

    protected function createProduct($name, $sku, $price)
    {
        $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);

        $product
//    ->setStoreId(1) //you can set data in store scope
            ->setWebsiteIds(array(1)) //website ID the product is assigned to, as an array
            ->setAttributeSetId(9) //ID of a attribute set named 'default'
            ->setTypeId(Mage_Catalog_Model_Product_Type::TYPE_SIMPLE) //product type
            ->setCreatedAt(strtotime('now')) //product creation time
//    ->setUpdatedAt(strtotime('now')) //product update time

            ->setSku($sku) //SKU
            ->setName($name) //product name
            ->setWeight(4.0000)
            ->setStatus(1) //product status (1 - enabled, 2 - disabled)
            ->setTaxClassId(4) //tax class (0 - none, 1 - default, 2 - taxable, 4 - shipping)
            ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH) //catalog and search visibility
            ->setManufacturer(28) //manufacturer id
            ->setColor(24)
            //->setNewsFromDate('06/26/2014') //product set as new from
            //->setNewsToDate('06/30/2014') //product set as new to
            //->setCountryOfManufacture('AF') //country of manufacture (2-letter country code)

            ->setPrice($price) //price in form 11.22
            //->setCost(22.33) //price in form 11.22
            //->setSpecialPrice(00.44) //special price in form 11.22
            //->setSpecialFromDate('06/1/2014') //special price from (MM-DD-YYYY)
            //->setSpecialToDate('06/30/2014') //special price to (MM-DD-YYYY)
            //->setMsrpEnabled(1) //enable MAP
            //->setMsrpDisplayActualPriceType(1) //display actual price (1 - on gesture, 2 - in cart, 3 - before order confirmation, 4 - use config)
            //->setMsrp(99.99) //Manufacturer's Suggested Retail Price

            //->setMetaTitle('test meta title 2')
            //->setMetaKeyword('test meta keyword 2')
            //->setMetaDescription('test meta description 2')

            //->setDescription('This is a long description')
            //->setShortDescription('This is a short description')

            //->setMediaGallery (array('images'=>array (), 'values'=>array ())) //media gallery initialization
            //->addImageToMediaGallery('media/catalog/product/1/0/10243-1.png', array('image','thumbnail','small_image'), false, false) //assigning image, thumb and small image to media gallery

            ->setStockData(array(
                    'use_config_manage_stock' => 0, //'Use config settings' checkbox
                    'manage_stock'=>1, //manage stock
                    'min_sale_qty'=>1, //Minimum Qty Allowed in Shopping Cart
                    'max_sale_qty'=>2, //Maximum Qty Allowed in Shopping Cart
                    'is_in_stock' => 1, //Stock Availability
                    'qty' => 999 //qty
                )
            )

            ->setCategoryIds(array(3, 10)); //assign product to categories
        try {
            $product->save();
        } catch (Exception $e) {
            Mage::logException($e);
            sprintf("Product with sku %s isn't import", $sku);
        }

    }

    // Usage instructions
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f import.php -- [options]
 
  --argname <argvalue>       Argument description
 
  help                   This help
 
USAGE;
    }
}
// Instantiate
$shell = new SP_Shell_Import();

// Initiate script
$shell->run();
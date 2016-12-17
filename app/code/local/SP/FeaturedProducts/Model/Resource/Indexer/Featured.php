<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

class SP_FeaturedProducts_Model_Resource_Indexer_Featured
    extends Mage_CatalogIndex_Model_Resource_Abstract
{
    protected function _construct()
    {
        $this->_setResource('sp_featuredproducts');
    }

    protected function _reindexEntity($productId = null)
    {
        $select = $this->_getReadAdapter()->select();

        $attribute = Mage::getSingleton('eav/config')
                            ->getAttribute('catalog_product', 'is_featured');

        $select->from($attribute->getBackendTable(), 'entity_id')
               ->where('value = ?', 1)
               ->where('attribute_id = ?', $attribute->getId());

        if (null !== $productId) {
            $productId = is_array($productId) ? $productId : [$productId];

            $select->where('entity_id IN(?)', $productId);

            $this->_getWriteAdapter()->delete(
                $this->getTable('sp_featuredproducts/featured'),
                [
                    'product_id IN(?)', $productId
                ]
            );
        } else {
            $this->_getWriteAdapter()
                 ->truncateTable(
                     $this->getTable('sp_featuredproducts/featured')
                 );
        }

        $sqlStatement = $select->insertIgnoreFromSelect(
            $this->getTable('sp_featuredproducts/featured'),
            [
                'product_id'
            ]
        );

        $this->_getWriteAdapter()->query($sqlStatement);
    }

    public function reindexAll()
    {
        $this->_reindexEntity();
    }

    /**
     * @param $event
     */
    public function catalogProductSave($event)
    {
        $this->_reindexEntity($event->getData('product_id'));
    }

    public function catalogProductMassAction($event)
    {
        $this->_reindexEntity($event->getData('product_ids'));
    }
}

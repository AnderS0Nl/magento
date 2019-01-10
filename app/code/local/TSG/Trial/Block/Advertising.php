<?php

class Tsg_Trial_Block_Advertising extends Mage_Core_Block_Template
{
    const SKU = 'advertising';

    public function isAdvertising()
    {
        $currentProduct = Mage::registry('current_product');
        $sku = $currentProduct->getSku();
        return $sku === self::SKU;
    }
}

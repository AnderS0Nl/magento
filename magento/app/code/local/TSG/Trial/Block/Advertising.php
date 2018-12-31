<?php
class TSG_Trial_Block_Advertising extends Mage_Core_Block_Template
{
    public function isAdvertising()
    {
        $currentProduct = Mage::registry('current_product');
        $sku = $currentProduct->getSku();
        if ($sku == 'advertising') {
            return true;
        } else {
            return false;
        }
    }
}
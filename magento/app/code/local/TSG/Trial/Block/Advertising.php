<?php
class TSG_Trial_Block_Advertising extends Mage_Core_Block_Template
{
    public function isAdvertising()
    {
        $current_product = Mage::registry('current_product');
        $sku = $current_product->getSku();
        if ($sku == 'advertising') {
            return true;
        } else {
            return false;
        }
    }
}
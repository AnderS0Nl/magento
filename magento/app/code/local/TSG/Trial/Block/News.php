<?php

class TSG_Trial_Block_News extends Mage_Core_Block_Template
{
    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('tsgtrial/news')->getCollection();
        $newsCollection->setOrder('title', 'DESC');
        return $newsCollection;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
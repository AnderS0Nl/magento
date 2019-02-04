<?php

class Tsg_Trial_Block_News extends Mage_Core_Block_Template
{
    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('tsg_trial/news')->getCollection();
        return $newsCollection;
    }
}
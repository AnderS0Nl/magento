<?php

class TSG_Trial_Model_News extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('tsgtrial/news');
    }
}

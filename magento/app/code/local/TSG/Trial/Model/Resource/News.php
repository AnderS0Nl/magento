<?php

class TSG_Trial_Model_Resource_News extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('tsgtrial/table_news', 'id');
    }
}
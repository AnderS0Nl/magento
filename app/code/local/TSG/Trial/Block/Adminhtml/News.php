<?php

class Tsg_Trial_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('tsg_trial');
        $this->_blockGroup = 'tsg_trial';
        $this->_controller = 'adminhtml_news';

        $this->_headerText = $helper->__('News Management');
    }
}
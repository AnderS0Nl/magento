<?php

class TSG_Trial_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('tsgtrial');

        $contentBlock = $this->getLayout()->createBlock('tsgtrial/adminhtml_news');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('news', null);

        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('tsgtrial/news')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d news have been deleted', sizeof($news)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select news'));
        }
        $this->_redirect('*/*');
    }
}



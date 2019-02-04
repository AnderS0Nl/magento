<?php
class Tsg_Trial_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function advertisingAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newsListAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newsViewAction()
    {
        $newsId = Mage::app()->getRequest()->getParam('id', 8);
        $news = Mage::getModel('tsg_trial/news')->load($newsId);

        if ($news->getId() > 0) {
            $this->loadLayout();
            $this->getLayout()->getBlock('tsg_trial_newsView')->assign(array(
                "newsItem" => $news,
            ));
            $this->renderLayout();
        } else {
            $this->_forward('noRoute');
        }
    }
}
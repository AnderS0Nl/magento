<?php

class Tsg_Trial_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('tsg_trial');
        $this->_addContent($this->getLayout()->createBlock('tsg_trial/adminhtml_news'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_news', Mage::getModel('tsg_trial/news')->load($id));

        $this->loadLayout()->_setActiveMenu('tsg_trial');
        $this->_addContent($this->getLayout()->createBlock('tsg_trial/adminhtml_news_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
                if (isset($_FILES['image_upload']['name']) && $_FILES['image_upload']['name'] != '') {
                    try
                    {
                        $path = Mage::getBaseDir('media') . '/tsg_trial/' ;
                        $fname = $_FILES['image_upload']['name'];
                        $newObject = new Varien_File_Uploader('image_upload');
                        $correctFileName = $newObject::getCorrectFileName($fname);
                        $fullName = $path.$correctFileName;
                        $uploader = new Varien_File_Uploader('image_upload');
                        $uploader->setAllowedExtensions(array('jpg', 'png'));
                        $uploader->setAllowCreateFolders(true);
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $uploader->save($path, $fname);
                    }
                    catch (Exception $e)
                    {
                        $fileType = "Invalid file format";
                    }
                }
            if ($fileType == "Invalid file format") {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('foundation')->__($fname." Invalid file format"));
                $this->_redirect('*/*/');
                return;
            }
            try {
                $model = Mage::getModel('tsg_trial/news');
                $data['image'] = $fullName;
                $model->setData($data)->setId($this->getRequest()->getParam('id'));

                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('tsg_trial/news')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('news', null);

        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('tsg_trial/news')->setId($id)->delete();
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
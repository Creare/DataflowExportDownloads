<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * package    Creare_Exportdownloads
 * copyright  Copyright (c) 2013 Adam Moss (Creare Communications Ltd) http://www.creare.co.uk
 * license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Creare_Exportdownloads_Adminhtml_ExportdownloadsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
			$this->_title($this->__('Creare Dataflow Exports'));
			$this->loadLayout();
			
			$content = $this->getLayout()
        		->createBlock('exportdownloads/adminhtml_exportdownloads');
        	$this->_addContent($content);
			
        	$this->_setActiveMenu('system/convert');
        	$this->renderLayout();
    }
	
	public function downloadAction()
    {
		if (Mage::app()->getRequest()->getParam('file'))
		{
			$file = Mage::app()->getRequest()->getParam('file');
			
			header('Content-disposition: attachment; filename='.$file);
			header('Content-type: text/csv');
			header('Content-type: application/ms-excel');
			readfile(Mage::getBaseDir('export') . DS . $file);
			exit;
			
		} else {
		
			Mage::getSingleton('core/session')->addError(Mage::helper('exportdownloads')->__('Unable to find download file'));
			$this->_redirect('*/*/');
			
		}
    }
}
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

class Creare_Exportdownloads_Block_Adminhtml_Exportdownloads extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'exportdownloads';
        $this->_controller = 'adminhtml_exportdownloads';
        $this->_headerText = Mage::helper('exportdownloads')->__('Creare Dataflow Exports'); 
        parent::__construct();   
		$this->removeButton('add');
    }
}
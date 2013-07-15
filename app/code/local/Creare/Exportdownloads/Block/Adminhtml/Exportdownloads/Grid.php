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

class Creare_Exportdownloads_Block_Adminhtml_Exportdownloads_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('exportdownloads_grid');
        $this->setDefaultSort('file_created');
        $this->setDefaultDir('desc');
		$this->setSaveParametersInSession(true);
    }
     
    protected function _prepareCollection()
    {
        $collection = new Creare_Exportdownloads_Model_Csv_Collection();
		$this->setCollection($collection);
		
        return parent::_prepareCollection();
    }
     
    protected function _prepareColumns()
    {
        $this->addColumn('file', array(
            'header'    => Mage::helper('exportdownloads')->__('File Name'),
            'index'     => 'file',
			'filter'	=> false
        ));
			
		$this->addColumn('file_created', array(
            'header'    => Mage::helper('exportdownloads')->__('Created Date'),
            'index'     => 'file_created',
			'type'      => 'datetime'
        ));
			
        return parent::_prepareColumns();
    }
         
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/download', array('file'=> $row->getFile()));
    }

}
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

class Creare_Exportdownloads_Model_Csv_Collection extends Varien_Data_Collection_Filesystem
{
	
    protected $_baseDir;
	
    public function __construct()
    {
        parent::__construct();

        $this->_baseDir = Mage::getBaseDir('export');

        // check for valid base dir
        $ioProxy = new Varien_Io_File();
        $ioProxy->mkdir($this->_baseDir);
        if (!is_file($this->_baseDir . DS . '.htaccess')) {
            $ioProxy->open(array('path' => $this->_baseDir));
            $ioProxy->write('.htaccess', 'deny from all', 0644);
        }

        $this
            ->setOrder('file_created', self::SORT_ORDER_DESC)
            ->addTargetDir($this->_baseDir)
            ->setCollectRecursively(false);
    }
	
    protected function _generateRow($filename)
    {
        $row = parent::_generateRow($filename);
        foreach (Mage::getSingleton('exportdownloads/csv')->load($row['basename'], $this->_baseDir)
            ->getData() as $key => $value) {
            $row[$key] = $value;
        }
        return $row;
    }
	
	 protected function _collectRecursive($dir)
    {
        $collectedResult = array();
		
        if (!is_array($dir)) {
            $dir = array($dir);
        }
		
        foreach ($dir as $folder) {
            if ($nodes = glob($folder . DIRECTORY_SEPARATOR . '*')) {
                foreach ($nodes as $node) {
                    $collectedResult[] = $node;
                }
            }
        }
		
        if (empty($collectedResult)) {
            return;
        }

        foreach ($collectedResult as $item) {
			if (substr($item, -3, 3) == "csv")
			{
				$this->_collectedFiles[] = $item;
			}
        }
    }
}
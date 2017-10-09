<?php


namespace Magestore\Retailerkittools\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'vendor_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Magestore\Retailerkittools\Model\Vendor',
            'Magestore\Retailerkittools\Model\ResourceModel\Vendor'
        );
    }
}

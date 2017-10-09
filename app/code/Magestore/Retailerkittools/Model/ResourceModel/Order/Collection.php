<?php


namespace Magestore\Retailerkittools\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Magestore\Retailerkittools\Model\Order',
            'Magestore\Retailerkittools\Model\ResourceModel\Order'
        );
    }
}

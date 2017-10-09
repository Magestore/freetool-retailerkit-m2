<?php


namespace Magestore\Retailerkittools\Model\ResourceModel\Invoice;

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
            'Magestore\Retailerkittools\Model\Invoice',
            'Magestore\Retailerkittools\Model\ResourceModel\Invoice'
        );
    }
}

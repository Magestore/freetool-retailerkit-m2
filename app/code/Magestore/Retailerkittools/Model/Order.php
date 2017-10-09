<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\Data\OrderInterface;

class Order extends \Magento\Framework\Model\AbstractModel implements OrderInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\Retailerkittools\Model\ResourceModel\Order');
    }

    /**
     * Get order_id
     * @return string
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $orderId
     * @return \Magestore\Retailerkittools\Api\Data\OrderInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get order_data
     * @return string
     */
    public function getOrderData()
    {
        return $this->getData(self::ORDER_DATA);
    }

    /**
     * Set order_data
     * @param string $order_data
     * @return \Magestore\Retailerkittools\Api\Data\OrderInterface
     */
    public function setOrderData($order_data)
    {
        return $this->setData(self::ORDER_DATA, $order_data);
    }
}

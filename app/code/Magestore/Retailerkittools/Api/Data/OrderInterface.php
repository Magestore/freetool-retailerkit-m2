<?php


namespace Magestore\Retailerkittools\Api\Data;

interface OrderInterface
{

    const ORDER_ID = 'order_id';
    const ORDER_DATA = 'order_data';


    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $order_id
     * @return \Magestore\Retailerkittools\Api\Data\OrderInterface
     */
    public function setOrderId($orderId);

    /**
     * Get order_data
     * @return string|null
     */
    public function getOrderData();

    /**
     * Set order_data
     * @param string $order_data
     * @return \Magestore\Retailerkittools\Api\Data\OrderInterface
     */
    public function setOrderData($order_data);
}

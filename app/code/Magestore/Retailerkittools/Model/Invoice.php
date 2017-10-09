<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\Data\InvoiceInterface;

class Invoice extends \Magento\Framework\Model\AbstractModel implements InvoiceInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\Retailerkittools\Model\ResourceModel\Invoice');
    }

    /**
     * Get invoice_id
     * @return string
     */
    public function getInvoiceId()
    {
        return $this->getData(self::INVOICE_ID);
    }

    /**
     * Set invoice_id
     * @param string $invoiceId
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface
     */
    public function setInvoiceId($invoiceId)
    {
        return $this->setData(self::INVOICE_ID, $invoiceId);
    }

    /**
     * Get invoice_data
     * @return string
     */
    public function getInvoiceData()
    {
        return $this->getData(self::INVOICE_DATA);
    }

    /**
     * Set invoice_data
     * @param string $invoice_data
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface
     */
    public function setInvoiceData($invoice_data)
    {
        return $this->setData(self::INVOICE_DATA, $invoice_data);
    }
}

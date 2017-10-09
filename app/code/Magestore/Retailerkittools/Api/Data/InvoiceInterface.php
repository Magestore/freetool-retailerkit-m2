<?php


namespace Magestore\Retailerkittools\Api\Data;

interface InvoiceInterface
{

    const INVOICE_ID = 'invoice_id';
    const INVOICE_DATA = 'invoice_data';


    /**
     * Get invoice_id
     * @return string|null
     */
    public function getInvoiceId();

    /**
     * Set invoice_id
     * @param string $invoice_id
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface
     */
    public function setInvoiceId($invoiceId);

    /**
     * Get invoice_data
     * @return string|null
     */
    public function getInvoiceData();

    /**
     * Set invoice_data
     * @param string $invoice_data
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface
     */
    public function setInvoiceData($invoice_data);
}

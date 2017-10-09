<?php


namespace Magestore\Retailerkittools\Block\Adminhtml;

class Dashboard extends \Magento\Backend\Block\Template
{
    protected $_urlBuilder;

    protected $retailerkittoolHelper;
    
	public function __construct(
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Magestore\Retailerkittools\Helper\Data $retailerkittoolHelper,
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        $this->_retailerkittoolHelper = $retailerkittoolHelper;
        $this->_urlBuilder = $backendUrl;
        parent::__construct($context, $data);
    }

    public function getAdminUrl(){
    	return $this->_urlBuilder;
    }

}

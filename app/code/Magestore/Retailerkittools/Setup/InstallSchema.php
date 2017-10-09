<?php


namespace Magestore\Retailerkittools\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_magestore_retailerkittools_vendor = $setup->getConnection()->newTable($setup->getTable('magestore_retailerkittools_vendor'));

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_name'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_email'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_phone',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_phone'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_address',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_address'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_city',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_city'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_country',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_country'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_zipcode',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_zipcode'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_state',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_state'
        );
        

        
        $table_magestore_retailerkittools_vendor->addColumn(
            'vendor_state_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'vendor_state_id'
        );
        

        $table_magestore_retailerkittools_invoice = $setup->getConnection()->newTable($setup->getTable('magestore_retailerkittools_invoice'));

        
        $table_magestore_retailerkittools_invoice->addColumn(
            'invoice_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_magestore_retailerkittools_invoice->addColumn(
            'invoice_data',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'invoice_data'
        );
        

        $table_magestore_retailerkittools_order = $setup->getConnection()->newTable($setup->getTable('magestore_retailerkittools_order'));

        
        $table_magestore_retailerkittools_order->addColumn(
            'order_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_magestore_retailerkittools_order->addColumn(
            'order_data',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'order_data'
        );
        

        $table_magestore_retailerkittools_label = $setup->getConnection()->newTable($setup->getTable('magestore_retailerkittools_label'));

        
        $table_magestore_retailerkittools_label->addColumn(
            'label_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_magestore_retailerkittools_label->addColumn(
            'label_data',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'label_data'
        );
        

        $setup->getConnection()->createTable($table_magestore_retailerkittools_label);

        $setup->getConnection()->createTable($table_magestore_retailerkittools_order);

        $setup->getConnection()->createTable($table_magestore_retailerkittools_invoice);

        $setup->getConnection()->createTable($table_magestore_retailerkittools_vendor);

        $setup->endSetup();
    }
}

<?php
namespace AHT\ProductTags\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '2.0.3', '<')) {
			$installer->getConnection()->addColumn(
				$installer->getTable('aht_producttags_tags'),
				'product_name',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'nullable' => false,
                    'length' => 255,
					'comment' => 'Product_Name'
				]
			);
		}
		$installer->endSetup();
	}
}
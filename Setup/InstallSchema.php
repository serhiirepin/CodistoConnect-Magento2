<?php

/**
 * Codisto LINQ Sync Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @package   Codisto_Connect
 * @copyright 2016-2017 On Technology Pty. Ltd. (http://codisto.com/)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      https://codisto.com/connect/
 */

namespace Codisto\Connect\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $context; // unused param

        $setup->startSetup();

        $connection = $setup->getConnection();

        try {
            $connection->addColumn(
                $setup->getTable('sales_order'), // @codingStandardsIgnoreLine MEQP2.SQL.CoreTablesModification.CoreTablesModification
                'codisto_orderid',
                'varchar(10)'
            );
        } catch (\Exception $e) {
            $e;
            // ignore if column is already present
        }

        try {
            $connection->addColumn(
                $setup->getTable('sales_order'), // @codingStandardsIgnoreLine MEQP2.SQL.CoreTablesModification.CoreTablesModification
                'codisto_merchantid',
                'varchar(10)'
            );
        } catch (\Exception $e) {
            $e;
            // ignore if column is already present
        }

        $setup->endSetup();
    }
}

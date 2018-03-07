<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\StockApi\Communication\Plugin\Api;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use FondOfSpryker\Zed\StockApi\StockApiConfig;

/**
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory getFactory()
 */
class StockApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @param int $id
     *
     * @return void
     */
    public function get($id)
    {
        throw new RuntimeException('Add action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idStock
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($idStock, ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFacade()->updateStock($idStock, $apiDataTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return void
     */
    public function add(ApiDataTransfer $apiDataTransfer)
    {
        throw new RuntimeException('Add action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param int $idStock
     *
     * @return void
     */
    public function remove($idStock)
    {
        throw new RuntimeException('Remove action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return void
     */
    public function find(ApiRequestTransfer $apiRequestTransfer)
    {
        throw new RuntimeException('Find action not implemented on core level', ApiConfig::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getResourceName()
    {
        return StockApiConfig::RESOURCE_STOCK;
    }
}

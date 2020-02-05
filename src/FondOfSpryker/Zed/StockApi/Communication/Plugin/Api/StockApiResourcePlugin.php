<?php

namespace FondOfSpryker\Zed\StockApi\Communication\Plugin\Api;

use FondOfSpryker\Zed\StockApi\StockApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Dependency\Plugin\ApiResourcePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\StockApi\StockApiConfig getConfig()
 */
class StockApiResourcePlugin extends AbstractPlugin implements ApiResourcePluginInterface
{
    /**
     * @param int $id
     *
     * @throws \RuntimeException
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
     * @throws \RuntimeException
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
     * @throws \RuntimeException
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
     * @throws \RuntimeException
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

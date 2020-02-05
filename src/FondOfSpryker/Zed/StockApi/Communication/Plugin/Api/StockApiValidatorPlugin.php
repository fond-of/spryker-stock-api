<?php

namespace FondOfSpryker\Zed\StockApi\Communication\Plugin\Api;

use FondOfSpryker\Zed\StockApi\StockApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Dependency\Plugin\ApiValidatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory getFactory()
 * @method \FondOfSpryker\Zed\StockApi\StockApiConfig getConfig()
 */
class StockApiValidatorPlugin extends AbstractPlugin implements ApiValidatorPluginInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getResourceName()
    {
        return StockApiConfig::RESOURCE_STOCK;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiValidationErrorTransfer[]
     */
    public function validate(ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFacade()->validate($apiDataTransfer);
    }
}

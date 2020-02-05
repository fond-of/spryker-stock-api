<?php

namespace FondOfSpryker\Zed\StockApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory getFactory()
 */
class StockApiFacade extends AbstractFacade implements StockApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idStock
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateStock($idStock, ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFactory()
            ->createStockApi()
            ->update($idStock, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer)
    {
        return $this->getFactory()
            ->createStockApiValidator()
            ->validate($apiDataTransfer);
    }
}

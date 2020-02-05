<?php

namespace FondOfSpryker\Zed\StockApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;

/**
 * @method \FondOfSpryker\Zed\StockApi\Business\StockApiBusinessFactory getFactory()
 */
interface StockApiFacadeInterface
{
    /**
     * Specification:
     *
     * @api
     *
     * @param int $idStock
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateStock($idStock, ApiDataTransfer $apiDataTransfer);

    /**
     * Specification:
     * - Validates the given API data and returns an array of errors if necessary.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer);
}

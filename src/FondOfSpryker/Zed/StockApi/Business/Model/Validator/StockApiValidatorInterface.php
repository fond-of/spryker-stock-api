<?php

namespace FondOfSpryker\Zed\StockApi\Business\Model\Validator;

use Generated\Shared\Transfer\ApiDataTransfer;

interface StockApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\ApiValidationException
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer);
}

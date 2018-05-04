<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\StockApi\Business\Model;

use FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface;
use FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface;
use FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;

class StockApi implements StockApiInterface
{
    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface
     */
    protected $entityMapper;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface
     */
    protected $stockFacade;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface
     */
    protected $productFacade;

    /**
     * @var \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    protected $availabilityQueryContainer;

    /**
     * @param \FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface $entityMapper
     * @param \FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface $stockFacade
     * @param \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductInterface $productFacade
     * @param \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface $availabilityQueryContainer
     */
    public function __construct(
        StockApiToApiInterface $apiQueryContainer,
        EntityMapperInterface $entityMapper,
        TransferMapperInterface $transferMapper,
        StockApiToAvailabilityInterface $stockFacade,
        StockApiToProductInterface $productFacade,
        AvailabilityQueryContainerInterface $availabilityQueryContainer
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->entityMapper = $entityMapper;
        $this->transferMapper = $transferMapper;
        $this->stockFacade = $stockFacade;
        $this->productFacade = $productFacade;
        $this->availabilityQueryContainer = $availabilityQueryContainer;
    }

    /**
     * @param int $sku
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update($sku, ApiDataTransfer $apiDataTransfer)
    {
        $idProductConcrete = $this->productFacade->findProductConcreteIdBySku($sku);

        if ($idProductConcrete === null) {
            throw new EntityNotFoundException(sprintf('Concrete product not found for sku %s', $sku));
        }

        $stockProductTransferList = $this->stockFacade->getStockProductsByIdProduct($idProductConcrete);

        if (count($stockProductTransferList) === 0) {
            throw new EntityNotFoundException(sprintf('There is no product stock for sku %s', $sku));
        }

        $stockProductTransfer = $this->createStockProductTransfer($stockProductTransferList, $apiDataTransfer);

        if ($stockProductTransfer === null) {
            throw new EntityNotFoundException(sprintf('There is no product stock for sku %s and given warehouse', $sku));
        }

        $stockProductTransfer = $this->stockFacade->updateStockProduct($stockProductTransfer);

        return $this->apiQueryContainer->createApiItem($stockProductTransfer, $sku);
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer[] $stockProductTransferList
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    protected function createStockProductTransfer(array $stockProductTransferList, ApiDataTransfer $apiDataTransfer)
    {
        $data = (array)$apiDataTransfer->getData();
        $preparedStockProductTransfer = null;


        foreach ($stockProductTransferList as $stockProductTransfer) {
            if ($stockProductTransfer->getStockType() !== $data['stock_type']) {
                continue;
            }

            $stockProductTransfer->setIsNeverOutOfStock($data['is_never_out_of_stock']);
            $stockProductTransfer->setQuantity($data['quantity']);

            return $stockProductTransfer;
        }

        return null;
    }

}

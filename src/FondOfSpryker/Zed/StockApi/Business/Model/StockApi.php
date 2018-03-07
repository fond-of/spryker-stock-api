<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\StockApi\Business\Model;

use FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface;
use FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface;
use FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface;

use Generated\Shared\Transfer\ApiDataTransfer;

use Generated\Shared\Transfer\StockProductTransfer;
use Orm\Zed\Availability\Persistence\SpyAvailability;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface;

class StockApi implements StockApiInterface
{
    /**
     * @var StockApiToApiInterface
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
     * @var \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     */
    protected $availabilityQueryContainer;


    /**
     * @param StockApiToApiInterface $apiQueryContainer
     * @param \FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface $entityMapper
     * @param \FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface $stockFacade
     * @param \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface $availabilityQueryContainer
     */
    public function __construct(
        StockApiToApiInterface $apiQueryContainer,
        EntityMapperInterface $entityMapper,
        TransferMapperInterface $transferMapper,
        StockApiToAvailabilityInterface $stockFacade,
        AvailabilityQueryContainerInterface $availabilityQueryContainer
    )
    {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->entityMapper = $entityMapper;
        $this->transferMapper = $transferMapper;
        $this->stockFacade = $stockFacade;
        $this->availabilityQueryContainer = $availabilityQueryContainer;
    }

    /**
     * @param int $sku
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     *
     * @throws EntityNotFoundException
     */
    public function update($sku, ApiDataTransfer $apiDataTransfer)
    {
        $availability = $this->availabilityQueryContainer->querySpyAvailabilityBySku($sku)->findOneOrCreate();

        if (!$availability) {
            throw new EntityNotFoundException(sprintf('Availability not found for sku %s', $sku));
        }

        $stockProductTransfer = $this->createStockProductTransfer($sku, $apiDataTransfer, $availability);

        $this->stockFacade->updateStockProduct($stockProductTransfer);

        return $this->apiQueryContainer->createApiItem($stockProductTransfer, $sku);
    }

    /**
     * @param string $sku
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     * @param \Orm\Zed\Availability\Persistence\SpyAvailability $availability
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    private function createStockProductTransfer(string $sku, ApiDataTransfer $apiDataTransfer, SpyAvailability $availability): StockProductTransfer
    {
        $data = (array)$apiDataTransfer->getData();

        $stockProductTransfer = new StockProductTransfer();
        $stockProductTransfer->fromArray($data, true);
        $stockProductTransfer->setSku($sku);
        $stockProductTransfer->setIdStockProduct($availability->getIdAvailability());

        return $stockProductTransfer;
    }

}

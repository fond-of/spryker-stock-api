<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\StockApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapper;
use FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapper;
use FondOfSpryker\Zed\StockApi\Business\Model\StockApi;
use FondOfSpryker\Zed\StockApi\Business\Model\Validator\StockApiValidator;
use FondOfSpryker\Zed\StockApi\StockApiDependencyProvider;

/**
 * @method \FondOfSpryker\Zed\StockApi\StockApiConfig getConfig()
 */
class StockApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\StockApi\Business\Model\StockApiInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createStockApi()
    {
        return new StockApi(
            $this->getApiQueryContainer(),
            $this->createEntityMapper(),
            $this->createTransferMapper(),
            $this->getStockFacade(),
            $this->getProductFacade(),
            $this->getQueryContainer()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\StockApi\Business\Mapper\EntityMapperInterface
     */
    public function createEntityMapper()
    {
        return new EntityMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\StockApi\Business\Mapper\TransferMapperInterface
     */
    public function createTransferMapper()
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfSpryker\Zed\StockApi\Business\Model\Validator\StockApiValidatorInterface
     */
    public function createStockApiValidator()
    {
        return new StockApiValidator();
    }

    /**
     * @return \FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getApiQueryContainer()
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getStockFacade()
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::FACADE_STOCK);
    }

    /**
     * @return \Spryker\Zed\Availability\Persistence\AvailabilityQueryContainerInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getQueryContainer()
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::QUERY_CONTAINER);
    }

    /**
     * @return \FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getProductFacade()
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::FACADE_PRODUCT);
    }
}

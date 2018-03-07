<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\StockApi;

use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityBridge;
use FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class StockApiDependencyProvider extends AbstractBundleDependencyProvider
{
    const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';

    const QUERY_CONTAINER = 'QUERY_CONTAINER';

    const FACADE_STOCK = 'FACADE_STOCK';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->provideApiQueryContainer($container);
        $container = $this->provideQueryContainer($container);
        $container = $this->provideStockFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideApiQueryContainer(Container $container)
    {
        $container[static::QUERY_CONTAINER_API] = function (Container $container) {
            return new StockApiToApiBridge($container->getLocator()->api()->queryContainer());
        };

        return $container;
    }

    /**s
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideStockFacade(Container $container)
    {
        $container[static::FACADE_STOCK] = function (Container $container) {
            return new StockApiToAvailabilityBridge($container->getLocator()->stock()->facade());
        };
        return $container;
    }

    /**s
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideQueryContainer(Container $container)
    {
        $container[static::QUERY_CONTAINER] = function (Container $container) {
            return $container->getLocator()->availability()->queryContainer();
        };
        return $container;
    }
}

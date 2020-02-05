<?php

namespace FondOfSpryker\Zed\StockApi;

use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToAvailabilityBridge;
use FondOfSpryker\Zed\StockApi\Dependency\Facade\StockApiToProductBridge;
use FondOfSpryker\Zed\StockApi\Dependency\QueryContainer\StockApiToApiBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class StockApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_API = 'QUERY_CONTAINER_API';

    public const QUERY_CONTAINER = 'QUERY_CONTAINER';

    public const FACADE_STOCK = 'FACADE_STOCK';

    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

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
        $container = $this->provideProductFacade($container);

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

    /**
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

    /**
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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function provideProductFacade(Container $container)
    {
        $container[static::FACADE_PRODUCT] = function (Container $container) {
            return new StockApiToProductBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }
}

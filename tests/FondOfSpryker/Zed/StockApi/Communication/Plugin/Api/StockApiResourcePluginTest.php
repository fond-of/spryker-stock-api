<?php

namespace FondOfSpryker\Zed\StockApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use RuntimeException;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class StockApiResourcePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer |\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiRequestTransfer;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Communication\Plugin\Api\StockApiResourcePlugin
     */
    protected $stockApiResourcePlugin;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\StockApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $stockApiFacadeMock;

    /**
     * @return void
     */
    public function _before()
    {
        $this->apiDataTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiDataTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiItemTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransfer = $this->getMockBuilder('\Generated\Shared\Transfer\ApiRequestTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiFacadeMock = $this->getMockBuilder(AbstractFacade::class)
            ->disableOriginalConstructor()
            ->setMethods(['updateStock'])
            ->getMockForAbstractClass();

        $this->stockApiResourcePlugin = new StockApiResourcePlugin();
    }

    /**
     * @return void
     */
    public function testGet()
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->get(1);
    }

    /**
     * @return void
     */
    public function testAdd()
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->add($this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testRemove()
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->remove(1);
    }

    /**
     * @return void
     */
    public function testFind()
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->find($this->apiRequestTransfer);
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $this->stockApiFacadeMock->expects($this->atLeastOnce())
            ->method('updateStock')
            ->willReturn($this->apiItemTransferMock);

        $this->stockApiResourcePlugin->setFacade($this->stockApiFacadeMock);

        $update = $this->stockApiResourcePlugin->update(1, $this->apiDataTransferMock);

        $this->assertInstanceOf('\Generated\Shared\Transfer\ApiItemTransfer', $update);
    }

    /**
     * @return void
     */
    public function testGetResourceName()
    {
        $resource = $this->stockApiResourcePlugin->getResourceName();

        $this->assertEquals('stocks', $resource);
    }
}

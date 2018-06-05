<?php

namespace FondOfSpryker\Zed\StockApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class StockApiValidatorPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfSpryker\Zed\StockApi\Communication\Plugin\Api\StockApiValidatorPlugin
     */
    protected $stockApiValidatorPlugin;

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

        $this->apiValidateErrorTransferMock = $this->getMockBuilder('\Generated\Shared\Transfer\ApiValidationErrorTransfer')
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiFacadeMock = $this->getMockBuilder(AbstractFacade::class)
            ->disableOriginalConstructor()
            ->setMethods(['validate'])
            ->getMockForAbstractClass();

        $this->stockApiValidatorPlugin = new StockApiValidatorPlugin();
    }

    /**
     * @return void
     */
    public function testValidate()
    {
        $this->stockApiFacadeMock->expects($this->atLeastOnce())
            ->method('validate')
            ->willReturn($this->apiValidateErrorTransferMock);

        $this->stockApiValidatorPlugin->setFacade($this->stockApiFacadeMock);

        $errorTransfer = $this->stockApiValidatorPlugin->validate($this->apiDataTransferMock);

        $this->assertInstanceOf('\Generated\Shared\Transfer\ApiValidationErrorTransfer', $errorTransfer);
    }

    /**
     * @return void
     */
    public function testGetResourceName()
    {
        $resource = $this->stockApiValidatorPlugin->getResourceName();

        $this->assertEquals('stocks', $resource);
    }
}

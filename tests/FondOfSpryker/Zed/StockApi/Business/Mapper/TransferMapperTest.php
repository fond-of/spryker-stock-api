<?php

namespace FondOfSpryker\Zed\StockApi\Business\Mapper;

use Codeception\Test\Unit;

class TransferMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\StockApi\Business\Mapper
     */
    protected $transferMapper;

    /**
     * @var array
     */
    protected $dataToTransfer;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->transferMapper = new TransferMapper();
        $this->dataToTransfer = [
            "0" => [
                "stock_type" => "Warehouse 1",
                "quantity" => 10,
                "is_never_out_of_stock" => false,
            ],
        ];
    }

    /**
     * @return void
     */
    public function testToTransfer()
    {
        $availability = $this->transferMapper->toTransfer($this->dataToTransfer);

        $this->assertInstanceOf('\Generated\Shared\Transfer\StockProductTransfer', $availability);
    }

    /**
     * @return void
     */
    public function testToTransferCollection()
    {
        $availability = $this->transferMapper->toTransferCollection($this->dataToTransfer);

        $this->assertInternalType('array', $availability);
    }
}

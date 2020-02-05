<?php

namespace Generated\Shared\Transfer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class StockProductTransfer extends AbstractTransfer
{
    public const SKU = 'sku';

    public const STOCK_TYPE = 'stockType';

    public const FK_STOCK = 'fkStock';

    public const QUANTITY = 'quantity';

    public const IS_NEVER_OUT_OF_STOCK = 'isNeverOutOfStock';

    public const ID_STOCK_PRODUCT = 'idStockProduct';

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var string
     */
    protected $stockType;

    /**
     * @var int
     */
    protected $fkStock;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $isNeverOutOfStock;

    /**
     * @var int
     */
    protected $idStockProduct;

    /**
     * @var array
     */
    protected $transferPropertyNameMap = [
        'sku' => 'sku',
        'Sku' => 'sku',
        'stock_type' => 'stockType',
        'stockType' => 'stockType',
        'StockType' => 'stockType',
        'fk_stock' => 'fkStock',
        'fkStock' => 'fkStock',
        'FkStock' => 'fkStock',
        'quantity' => 'quantity',
        'Quantity' => 'quantity',
        'is_never_out_of_stock' => 'isNeverOutOfStock',
        'isNeverOutOfStock' => 'isNeverOutOfStock',
        'IsNeverOutOfStock' => 'isNeverOutOfStock',
        'id_stock_product' => 'idStockProduct',
        'idStockProduct' => 'idStockProduct',
        'IdStockProduct' => 'idStockProduct',
    ];

    /**
     * @var array
     */
    protected $transferMetadata = [
        self::SKU => [
            'type' => 'string',
            'name_underscore' => 'sku',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::STOCK_TYPE => [
            'type' => 'string',
            'name_underscore' => 'stock_type',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::FK_STOCK => [
            'type' => 'int',
            'name_underscore' => 'fk_stock',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::QUANTITY => [
            'type' => 'int',
            'name_underscore' => 'quantity',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::IS_NEVER_OUT_OF_STOCK => [
            'type' => 'string',
            'name_underscore' => 'is_never_out_of_stock',
            'is_collection' => false,
            'is_transfer' => false,
        ],
        self::ID_STOCK_PRODUCT => [
            'type' => 'int',
            'name_underscore' => 'id_stock_product',
            'is_collection' => false,
            'is_transfer' => false,
        ],
    ];

    /**
     * @module Stock
     *
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        $this->modifiedProperties[self::SKU] = true;

        return $this;
    }

    /**
     * @module Stock
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @module Stock
     *
     * @return $this
     */
    public function requireSku()
    {
        $this->assertPropertyIsSet(self::SKU);

        return $this;
    }

    /**
     * @module Stock
     *
     * @param string $stockType
     *
     * @return $this
     */
    public function setStockType($stockType)
    {
        $this->stockType = $stockType;
        $this->modifiedProperties[self::STOCK_TYPE] = true;

        return $this;
    }

    /**
     * @module Stock
     *
     * @return string
     */
    public function getStockType()
    {
        return $this->stockType;
    }

    /**
     * @module Stock
     *
     * @return $this
     */
    public function requireStockType()
    {
        $this->assertPropertyIsSet(self::STOCK_TYPE);

        return $this;
    }

    /**
     * @module Stock
     *
     * @param int $fkStock
     *
     * @return $this
     */
    public function setFkStock($fkStock)
    {
        $this->fkStock = $fkStock;
        $this->modifiedProperties[self::FK_STOCK] = true;

        return $this;
    }

    /**
     * @module Stock
     *
     * @return int
     */
    public function getFkStock()
    {
        return $this->fkStock;
    }

    /**
     * @module Stock
     *
     * @return $this
     */
    public function requireFkStock()
    {
        $this->assertPropertyIsSet(self::FK_STOCK);

        return $this;
    }

    /**
     * @module Stock
     *
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->modifiedProperties[self::QUANTITY] = true;

        return $this;
    }

    /**
     * @module Stock
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @module Stock
     *
     * @return $this
     */
    public function requireQuantity()
    {
        $this->assertPropertyIsSet(self::QUANTITY);

        return $this;
    }

    /**
     * @module Stock
     *
     * @param string $isNeverOutOfStock
     *
     * @return $this
     */
    public function setIsNeverOutOfStock($isNeverOutOfStock)
    {
        $this->isNeverOutOfStock = $isNeverOutOfStock;
        $this->modifiedProperties[self::IS_NEVER_OUT_OF_STOCK] = true;

        return $this;
    }

    /**
     * @module Stock
     *
     * @return string
     */
    public function getIsNeverOutOfStock()
    {
        return $this->isNeverOutOfStock;
    }

    /**
     * @module Stock
     *
     * @return $this
     */
    public function requireIsNeverOutOfStock()
    {
        $this->assertPropertyIsSet(self::IS_NEVER_OUT_OF_STOCK);

        return $this;
    }

    /**
     * @module Stock
     *
     * @param int $idStockProduct
     *
     * @return $this
     */
    public function setIdStockProduct($idStockProduct)
    {
        $this->idStockProduct = $idStockProduct;
        $this->modifiedProperties[self::ID_STOCK_PRODUCT] = true;

        return $this;
    }

    /**
     * @module Stock
     *
     * @return int
     */
    public function getIdStockProduct()
    {
        return $this->idStockProduct;
    }

    /**
     * @module Stock
     *
     * @return $this
     */
    public function requireIdStockProduct()
    {
        $this->assertPropertyIsSet(self::ID_STOCK_PRODUCT);

        return $this;
    }
}

<?php

namespace App\Services\Sales;

use App\Models\SaleItems;
use App\Repositories\Products\Contracts\ProductRepositoryContract;
use App\Services\Sales\Contracts\SaleServiceContract;
use App\Repositories\Sales\Contracts\SaleRepositoryContract;
use App\Repositories\SaleItems\Contracts\SaleItemsRepositoryContract;
use Exception;

class SaleService implements SaleServiceContract
{
    /**
     * @var SaleRepositoryContract $saleRepository
     */
    private $saleRepository;

    /**
     * @param SaleRepositoryContract $saleRepository
     */
    private $productRepository;

    /**
    * @param SaleItemsRepositoryContract $saleItemRepository
    */
    private $saleItemRepository;

    /**
     * @param ProductRepositoryContract $productRepository
     * @param SaleRepositoryContract $saleRepository
     * @param SaleItemsRepositoryContract $saleItemRepository
     */
    public function __construct(
        ProductRepositoryContract $productRepository,
        SaleRepositoryContract $saleRepository,
        SaleItemsRepositoryContract $saleItemRepository)
    {
        $this->saleRepository = $saleRepository;
        $this->productRepository = $productRepository;
        $this->saleItemRepository = $saleItemRepository;
    }

    /**     * @return array
     */
    public function get(): array
    {
        $getSales = $this->saleRepository->getSales(['saleItem', 'saleItem.product'])->toArray();

        return $getSales;
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params): array
    {
        $amount = $this->sumProductAmount($params['products']);

        $sale = $this->saleRepository->store(['amount' => $amount])->toArray();

        $this->saleItems($params['products'], $sale['sale_id']);

        return $sale;
    }

    /**
     * @param string $saleId
     * @return array
     */
    public function getById(string $saleId): array
    {
        $getSale = $this->saleRepository->getByAttribute('sale_id', $saleId, ['saleItem', 'saleItem.product'])->toArray();

        return $getSale;
    }

    /**
     * @param string $saleId
     * @return boolean|null
     */
    public function cancelSale(string $saleId): ?bool
    {
        $sale = $this->getById($saleId);

        if (empty($sale))
            return false;

        $update = $this->saleRepository->updateById(['status' => 'cancelled'], ['sale_id' => $saleId]);

        if (! $update) {
            return false;
        }

        return true;
    }

    public function addProduct(string $saleId, array $params): array
    {
        $sale = $this->getById($saleId);

        if (empty($sale))
            return [];

       $this->saleItems($params['products'], $saleId);

        return $this->getById($saleId);
    }

    /**
     * @param array $params
     * @return integer
     */
    private function sumProductAmount(array $params): int
    {
        $amount = 0;

        foreach ($params as $key => $val) {
            $amount += $this->productRepository->getById($val['product_id'])['price'];
        }

        return $amount;
    }

    /**
     * @param array $params
     * @param string $saleId
     * @return void
     */
    private function saleItems(array $params, string $saleId): void
    {
        foreach ($params as $key => $val) {
            $this->saleItemRepository->store([
                'product_id' => $val['product_id'],
                'sale_id' => $saleId
            ]);
        }
    }
}

<?php namespace Easyshop\ModelRepositories;

use Brand;

class BrandRepository extends AbstractRepository
{
    /**
     * Find brand by ID
     * @return Entity
     */
    public function getBrandById($id)
    {
        return Brand::find($id);
    }

    /**
     * Fetches all brands
     * @return Entity
     */
    public function getAllBrands()
    {
        return Brand::all();
    }
     
}


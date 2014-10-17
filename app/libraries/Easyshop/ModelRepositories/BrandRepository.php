<?php namespace Easyshop\ModelRepositories;

use Brand;

class BrandRepository extends AbstractRepository
{
    /**
     * Get all Admin Images
     * @return AdminImages[]
     */
    public function getBrandById($id)
    {
        return Brand::find($id);
    }

    public function getAllBrands()
    {
        return Brand::all();
    }
     
}


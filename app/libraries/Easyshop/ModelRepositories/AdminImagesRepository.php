<?php namespace Easyshop\ModelRepositories;

use AdminImages;

class AdminImagesRepository extends AbstractRepository
{
    /**
     * Get all Admin Images
     *
     * @return AdminImages[]
     */
    public function getAllAdminImages()
    {
        return AdminImages::orderBy("created_at","desc")->get();
    }
     
}


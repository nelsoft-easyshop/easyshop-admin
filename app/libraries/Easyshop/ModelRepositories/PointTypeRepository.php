<?php 

namespace Easyshop\ModelRepositories;

use PointType;

class PointTypeRepoitory extends AbstractRepository
{    
    /**
     * Returns the point type by ID
     *
     * @param integer $typeId
     * @return PointType
     */
    public function getPointTypeById($typeId)
    {
        return PointType::find($typeId);
    }

    
}


<?php

namespace App\Services;

use App\Models\DocumentVersion;

/**
 * Class DocumentVersionService
 * @package App\Services
 */
class DocumentVersionService extends BaseService
{

    /**
     * Initialize DocumentService object
     *
     * @param DocumentVersionService 
     */
    public function __construct(DocumentVersion $documentVersion)
    {
        $this->model = $documentVersion;
       
    }

}
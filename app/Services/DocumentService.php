<?php

namespace App\Services;

use App\Models\Document;
use App\Models\DocumentVersion;
use Illuminate\Support\Str;

/**
 * Class DocumentService
 * @package App\Services
 */
class DocumentService extends BaseService
{
    /**
     * @var DocumentVersionService
     */
    protected DocumentVersion $documentVersion;

    /**
     * Initialize DocumentService object
     *
     * @param DocumentService 
     */
    public function __construct(Document $document, DocumentVersion $documentVersion)
    {
        $this->model = $document;
        $this->documentVersion = $documentVersion;
    }

    public function store($request)
    {
        //1st document Create
        $payload =  array_merge(
            $request->all(),
            ['current_version' => "var_" . Str::random(10)]
        );
        $document = $this->create($payload);

        //2nd document Version create
        $payload = array_merge(
            $payload,
            ['document_id' => $document->id, 'version' => $document->current_version]
        );
        $this->documentVersion->create($payload);

        return  $document;
    } 
    
    public function edit($request, $document)
    {
        //1st update document
        $payload =  array_merge(
            $request->all(),
            ['current_version' => "var_" . Str::random(10)]
        );
        $this->update($payload, $document);

        //2nd create new document version
        $payload = array_merge(
            $payload,
            ['document_id' => $document->id, 'version' => $payload['current_version']]
        );
       
        $this->documentVersion->create($payload);

        return  $document;
    }
}

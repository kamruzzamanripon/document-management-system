<?php

namespace App\Services;

use App\Models\Document;
use App\Models\DocumentVersion;
use Illuminate\Support\Str;

/**
 * Class DocumentService
 * @package App\Services
 */
class DocumentService extends BaseService {
    
    /**
     * @var DocumentVersionService
     */
    protected DocumentVersion $documentVersion;

    /**
     * Initialize DocumentService object
     *
     * @param Document $document
     * @param DocumentVersion $documentVersion
     */
    public function __construct( Document $document, DocumentVersion $documentVersion ) {
        $this->model = $document;
        $this->documentVersion = $documentVersion;
    }

    /**
     * Retrieve all active documents with their versions.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allActiveDocument() {
        return Document::where( 'status', 0 )->with( 'versions' )->orderBy( 'created_at', 'desc' )->paginate( 10 );
    }

    /**
     * Store a new document and its initial version.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Document
     */
    public function store( $request ) {
        //1st document Create
        $payload = array_merge(
            $request->all(),
            ['current_version' => "var_" . Str::random( 10 )]
        );
        $document = $this->create( $payload );

        //2nd document Version create
        $payload = array_merge(
            $payload,
            ['document_id' => $document->id, 'version' => $document->current_version]
        );
        $this->documentVersion->create( $payload );

        return $document;
    }

    /**
     * Update an existing document and create a new version.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \App\Models\Document
     */
    public function edit( $request, $document ) {
        //1st update document
        $payload = array_merge(
            $request->all(),
            ['current_version' => "var_" . Str::random( 10 )]
        );
        $this->update( $payload, $document );

        //2nd create new document version
        $payload = array_merge(
            $payload,
            ['document_id' => $document->id, 'version' => $payload['current_version']]
        );

        $this->documentVersion->create( $payload );

        return $document;
    }
}

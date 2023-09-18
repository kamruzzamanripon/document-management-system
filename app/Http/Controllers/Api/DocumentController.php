<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller {
    /**
     * @var ClientService
     */
    protected DocumentService $documentService;

    /**
     * DocumentController constructor.
     * @param DocumentService $documentService
     */
    public function __construct( DocumentService $documentService ) {
        $this->documentService = $documentService;

    }

    /**
     * Display a list of all active documents.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $data = $this->documentService->allActiveDocument();

        $transformedData = DocumentResource::collection( $data )
            ->response()
            ->getData();

        return $this->successResponse(
            $transformedData,
            "All Active Document",
            200
        );
    }

    /**
     * Store a newly created document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request ) {
        $this->documentService->store( $request );

        return $this->successResponse(
            null,
            "document Create Successfully",
            201
        );
    }

    /**
     * Update an existing document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( Request $request, Document $document ) {
        $this->documentService->edit( $request, $document );

        return $this->successResponse(
            null,
            "document Update Successfully",
            202
        );
    }

    /**
     * Retrieve a single document by its ID.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function singleDocument( Document $document ) {
        $transformedData = new DocumentResource( $document );

        return $this->successResponse(
            $transformedData,
            "Single Document",
            200
        );

    }
}

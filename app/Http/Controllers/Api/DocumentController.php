<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * @var ClientService
     */
    protected DocumentService $documentService;

    /**
     * DocumentController constructor.
     * @param DocumentService $documentService
     */
    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function store(Request $request)
    {
        $this->documentService->store($request);

        return $this->successResponse(
            null,
            "document Create Successfully",
            202
        );
    }

    public function update(Request $request, Document $document)
    {
        //dd($request->all());
        $this->documentService->edit($request, $document);

        return $this->successResponse(
            null,
            "document Update Successfully",
            202
        );
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
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


    public function index(){
       $data =  $this->documentService->allActiveDocument();

       $transformedData = DocumentResource::collection($data)
            ->response()
            ->getData();

       return $this->successResponse(
        $transformedData,
        "All Active Document",
        200
        );
    }

    public function store(Request $request)
    {
        $this->documentService->store($request);

        return $this->successResponse(
            null,
            "document Create Successfully",
            201
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

    public function singleDocument(Document $document)
    {
        $transformedData = new DocumentResource($document);

        return $this->successResponse(
            $transformedData,
            "Single Document",
            200
            );
        
    }
}

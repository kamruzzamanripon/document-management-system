<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\DocumentVersion;
use App\Models\DocumentDiff;
use Illuminate\Console\Command;
use Carbon\Carbon;
use SebastianBergmann\Diff\Differ;

class CreateDocumentDiffs extends Command
{
    protected $signature = 'create:document-diffs';
    protected $description = 'Create document diffs and store them in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all active documents
        $documents = Document::where('status', 0)->get();

        foreach ($documents as $document) {
            // Get the latest document version
            $latestVersion = DocumentVersion::where('document_id', $document->id)
                ->whereDate('created_at', Carbon::today())
                ->orderByDesc('created_at')
                ->first();

            if ($latestVersion) {
                // Get the previous version of the document
                $previousVersion = DocumentVersion::where('document_id', $document->id)
                    ->where('created_at', '<', $latestVersion->created_at)
                    ->orderByDesc('created_at')
                    ->first();

                if ($previousVersion) {
                    // Compare body_content and tags_content of the two versions
                    if ($latestVersion->body_content !== $previousVersion->body_content ||
                        $latestVersion->tags_content !== $previousVersion->tags_content) {

                        // Create a new document diff and store it in the database
                        $diff = $this->createDocumentDiff($latestVersion, $previousVersion);
                        DocumentDiff::create($diff);
                    }
                }
            }
        }

        $this->info('Document diffs created and stored.');
    }

    protected function createDocumentDiff($latestVersion, $previousVersion)
    {
        // Implement your own diff creation logic here
        $diffBodyContent = $this->generateDiff($previousVersion->body_content, $latestVersion->body_content);
        $diffTagsContent = $this->generateDiff($previousVersion->tags_content, $latestVersion->tags_content);

        return [
            'document_id' => $latestVersion->document_id,
            'document_version_id' => $latestVersion->id,
            'diff_body_content' => $diffBodyContent,
            'diff_tags_content' => $diffTagsContent,
        ];
    }

    protected function generateDiff($oldContent, $newContent)
    {
        $differ = new Differ();
        $diff = $differ->diff($oldContent, $newContent);
    
        return $diff;
    }
}
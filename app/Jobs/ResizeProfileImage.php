<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image; // ✅ Import this
use Illuminate\Support\Facades\Log;

class ResizeProfileImage implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $imagePath;

    /**
     * Create a new job instance.
     */
    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $imageFullPath = public_path($this->imagePath);

            if (!file_exists($imageFullPath)) {
                Log::error("Image not found: " . $imageFullPath);
                return;
            }

            Image::make($imageFullPath)
                ->resize(300, 300)
                ->save();

            Log::info('✅ Profile image resized successfully: ' . $this->imagePath);

        } catch (\Exception $e) {
            Log::error('❌ ResizeProfileImage failed: ' . $e->getMessage());
            throw $e; // so it appears as failed in queue
        }
    }
}

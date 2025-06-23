<?php

namespace App\Console\Commands;

use App\Models\Nft;
use Cloudinary\Cloudinary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MigrateToCloudinary extends Command
{
    protected $signature = 'nft:migrate-to-cloudinary';
    protected $description = 'Migrate NFT images to Cloudinary';

    public function handle()
    {
        $cloudinary = new Cloudinary(); // Initialize Cloudinary
        $uploadApi = $cloudinary->uploadApi();

        $successful = 0;
        $failed = 0;

        $nfts = Nft::whereNotNull('ntf_image')->get();

        foreach ($nfts as $nft) {
            $localPath = public_path('user/uploads/nfts/' . $nft->ntf_image);

            if (File::exists($localPath)) {
                try {
                    $uploadResult = $uploadApi->upload(
                        $localPath,
                        [
                            'folder' => 'nft-assets',
                            'public_id' => 'nft-' . $nft->id . '-' . pathinfo($nft->ntf_image, PATHINFO_FILENAME),
                            'transformation' => [
                                'quality' => 'auto:best',
                                'fetch_format' => 'auto'
                            ]
                        ]
                    );

                    $nft->update([
                        'ntf_image' => $uploadResult['secure_url'] ?? null,
                        'cloudinary_public_id' => $uploadResult['public_id'] ?? null
                    ]);

                    $this->info("✅ Migrated NFT #{$nft->id}: {$nft->ntf_name}");
                    $successful++;
                } catch (\Exception $e) {
                    $this->error("❌ Failed NFT #{$nft->id}: " . $e->getMessage());
                    $failed++;
                }
            } else {
                $this->error("⚠️ Missing file for NFT #{$nft->id}: {$nft->ntf_image}");
                $failed++;
            }
        }

        $this->info('✅ NFT migration completed!');
        $this->line("➡ Successful: {$successful}");
        $this->line("➡ Failed: {$failed}");
    }
}

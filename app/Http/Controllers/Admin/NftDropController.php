<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\NftDrop;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class NftDropController extends Controller
{
    /**
     * Display a listing of the NFT Drops.
     */
    public function index()
    {
        $buy_nft = NftDrop::with('user:id,name,email')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.nft_drops.index', compact('buy_nft'));
    }

    /**
     * Show the form for creating a new NFT Drop.
     */
    public function create()
    {
        $users = User::where('user_type', 0)->get();
        return view('admin.nft_drops.create', compact('users'));
    }

    /**
     * Store a newly created NFT Drop in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048',
            'eth_value' => 'required|numeric',
            'change' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer',
            'is_positive' => 'required|boolean',
        ]);

        $uploadResult = $this->uploadToCloudinary($request->file('image_url'), 'nft_drops');

        NftDrop::create([
            'name' => $request->name,
            'image_url' => $uploadResult['secure_url'],
            'cloudinary_public_id' => $uploadResult['public_id'],
            'eth_value' => $request->eth_value,
            'change' => $request->change,
            'user_id' => $request->user_id,
            'duration' => $request->duration,
            'is_positive' => $request->is_positive,
        ]);

        return redirect()->route('admin.nft-drops.index')->with('success', 'NFT Drop created successfully.');
    }

    /**
     * Show the form for editing the specified NFT Drop.
     */
    public function edit($id)
    {
        $nftDrop = NftDrop::findOrFail($id);
        $users = User::where('user_type', 0)->get();
        return view('admin.nft_drops.edit', compact('nftDrop', 'users'));
    }

    /**
     * Update the specified NFT Drop in storage.
     */
    public function update(Request $request, $id)
    {
        $nftDrop = NftDrop::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048',
            'eth_value' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'duration' => 'required|integer',
            'is_positive' => 'required|boolean',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'eth_value' => $validated['eth_value'],
            'change' => $validated['change'],
            'user_id' => $validated['user_id'],
            'duration' => $validated['duration'],
            'is_positive' => $validated['is_positive'],
        ];

        if ($request->hasFile('image_url')) {
            $this->deleteFromCloudinary($nftDrop->cloudinary_public_id);
            $uploadResult = $this->uploadToCloudinary($request->file('image_url'), 'nft_drops');
            $updateData['image_url'] = $uploadResult['secure_url'];
            $updateData['cloudinary_public_id'] = $uploadResult['public_id'];
        }

        $nftDrop->update($updateData);

        return redirect()->route('admin.nft-drops.index')->with('success', 'NFT Drop updated successfully.');
    }

    /**
     * Remove the specified NFT Drop from storage.
     */
    public function destroy($id)
    {
        $nftDrop = NftDrop::findOrFail($id);

        // Delete image from Cloudinary
        if ($nftDrop->cloudinary_public_id) {
            $this->deleteFromCloudinary($nftDrop->cloudinary_public_id);
        }

        $nftDrop->delete();

        return redirect()->route('admin.nft-drops.index')
            ->with('success', 'NFT Drop deleted successfully');
    }

    /**
     * Search users for AJAX requests.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get(['id', 'name', 'email']);

        return response()->json($users);
    }

    // Helper method for Cloudinary uploads
    protected function uploadToCloudinary($file, $folder)
    {
        try {
            $cloudinary = new Cloudinary();
            $uploadApi = $cloudinary->uploadApi();

            return $uploadApi->upload($file->getRealPath(), [
                'folder' => $folder,
                'transformation' => [
                    'width' => 800,
                    'height' => 800,
                    'crop' => 'limit',
                    'quality' => 'auto:best',
                    'format' => 'webp'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());
            throw new \Exception('Image upload failed. Please try again.');
        }
    }

    // Helper method for Cloudinary deletion
    protected function deleteFromCloudinary($publicId)
    {
        if (!$publicId) return;

        try {
            $cloudinary = new Cloudinary();
            $uploadApi = $cloudinary->uploadApi();
            $uploadApi->destroy($publicId);
        } catch (\Exception $e) {
            Log::error('Cloudinary deletion failed: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\NftDrop;

use App\Models\Nft;

class HomePageController extends Controller
{

    public function homepage()
    {
        $data['phone'] = DB::table('admins')->first();
        $data['nfts'] = Nft::where('status', 1)->latest()->take(6)->get();
        return view('home.homepage', $data);
    }

    public function about()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.about', $data);
    }

    public function contact()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.contact', $data);
    }

    public function drop()
    {
        $data['phone'] = DB::table('admins')->first();

        // Fetch all NFT Drops, you can add pagination if needed
        $data['nftDrops'] = NftDrop::orderBy('created_at', 'desc')->get();


        return view('home.drop', $data);
    }

    public function what()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.what_is_nft', $data);
    }

    public function whatIsCryptocurrency()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('what-is-cryptocurrency', $data);
    }

    public function whatIsCryptoWallet()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.what-is-crypto-wallet', $data);
    }

    public function drops()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.what-are-nft-drops', $data);
    }

    public function whatIsBlockchain()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.what-is-blockchain', $data);
    }
    public function nftGasFees()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.nft-gas-fees', $data);
    }

    public function whatIsWeb3()
    {
        $data['phone'] = DB::table('admins')->first();
        return view('home.what-is-web3', $data);
    }

    public function explore(Request $request)
    {
        $data['phone'] = DB::table('admins')->first();

        $query = Nft::where('status', 1);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ntf_name', 'like', "%{$search}%")
                    ->orWhere('ntf_description', 'like', "%{$search}%")
                    ->orWhere('ntf_owner', 'like', "%{$search}%");
            });
        }

        // Category filter (keyword-based since no category column)
        if ($request->filled('category')) {
            $category = $request->input('category');
            $categoryKeywords = [
                'art' => ['art', 'painting', 'drawing', 'illustration', 'abstract', 'canvas'],
                'gaming' => ['game', 'gaming', 'player', 'level', 'quest', 'rpg'],
                'memberships' => ['membership', 'member', 'access', 'pass', 'exclusive', 'vip'],
                'pfps' => ['pfp', 'profile', 'avatar', 'portrait', 'character'],
                'photography' => ['photo', 'photography', 'camera', 'landscape', 'portrait'],
                'music' => ['music', 'song', 'beat', 'audio', 'sound', 'melody'],
                'sports' => ['sport', 'athlete', 'football', 'basketball', 'soccer', 'fitness'],
                'virtual-worlds' => ['virtual', 'metaverse', 'world', '3d', 'vr', 'land'],
            ];

            $keywords = $categoryKeywords[$category] ?? [];
            if (!empty($keywords)) {
                $query->where(function ($q) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $q->orWhere('ntf_name', 'like', "%{$keyword}%")
                            ->orWhere('ntf_description', 'like', "%{$keyword}%");
                    }
                });
            }

            $data['activeCategory'] = $category;
        }

        // Sort
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('nft_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('nft_price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $data['nfts'] = $query->paginate(12)->withQueryString();
        $data['totalNfts'] = Nft::where('status', 1)->count();

        return view('home.explore', $data);
    }
}

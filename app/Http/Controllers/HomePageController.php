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
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        $data['nfts'] = Nft::where('status', 1)->latest()->take(9)->get();
        return view('home.homepage', $data);
    }

    public function about()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.about',$data);
    }

    public function contact()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.contact',$data);
    }

    public function drop()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        
            // Fetch all NFT Drops, you can add pagination if needed
        $data['nftDrops'] = NftDrop::orderBy('created_at', 'desc')->get();
        
        
        return view('home.drop',$data);
    }

    public function what()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.what_is_nft',$data);
    }

    public function whatIsCryptocurrency()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('what-is-cryptocurrency',$data);
    }

    public function whatIsCryptoWallet()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.what-is-crypto-wallet',$data);
    }

    public function drops()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.what-are-nft-drops',$data);
    }

    public function whatIsBlockchain()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.what-is-blockchain',$data);
    }
    public function nftGasFees()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.nft-gas-fees',$data);
    }

    public function whatIsWeb3()
    {
        $data['phone'] = DB::table('users')->where('id', '33')->first();
        return view('home.what-is-web3',$data);
    }
}

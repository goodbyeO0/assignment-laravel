<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Web3Controller extends Controller
{
    public function connect()
    {
        return view('web3.connect');
    }

    public function saveWalletAddress(Request $request)
    {
        $request->validate([
            'wallet_address' => 'required|string|size:42' // Ethereum addresses are 42 characters (including '0x')
        ]);

        $user = Auth::user();
        $user->wallet_address = $request->wallet_address;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet connected successfully',
            'wallet_address' => $user->wallet_address
        ]);
    }

    public function disconnect()
    {
        $user = Auth::user();
        $user->wallet_address = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Wallet disconnected successfully'
        ]);
    }
}
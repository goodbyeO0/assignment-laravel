@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Connect Wallet</div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <button id="connectWallet" class="btn btn-primary">
                            <i class="fas fa-wallet mr-2"></i> Connect MetaMask
                        </button>
                        <button id="disconnectWallet" class="btn btn-danger d-none">
                            <i class="fas fa-unlink mr-2"></i> Disconnect Wallet
                        </button>
                    </div>

                    <div id="walletInfo" class="d-none">
                        <div class="alert alert-success">
                            <strong>Connected Wallet Address:</strong>
                            <p id="walletAddress" class="mb-0 mt-2 font-monospace"></p>
                            <a id="addressEtherscan" href="#" target="_blank" class="btn btn-sm btn-info mt-2">
                                <i class="fas fa-external-link-alt"></i> View on Etherscan
                            </a>
                        </div>

                        <!-- Transaction Form -->
                        <div class="card mt-4">
                            <div class="card-header">Send ETH</div>
                            <div class="card-body">
                                <form id="sendEthForm">
                                    <div class="mb-3">
                                        <label for="recipientAddress" class="form-label">Recipient Address</label>
                                        <input type="text" class="form-control" id="recipientAddress" 
                                               value="0x12e442b53CA7A10D5038635bfCe8AA56498A47ED">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ethAmount" class="form-label">Amount (ETH)</label>
                                        <input type="number" class="form-control" id="ethAmount" step="0.0001" min="0">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send ETH</button>
                                </form>
                            </div>
                        </div>

                        <!-- Transaction History -->
                        <div class="card mt-4">
                            <div class="card-header">Recent Transactions</div>
                            <div class="card-body">
                                <div id="transactionsList">
                                    <!-- Transactions will be added here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="errorMessage" class="alert alert-danger d-none">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const connectBtn = document.getElementById('connectWallet');
    const disconnectBtn = document.getElementById('disconnectWallet');
    const walletInfo = document.getElementById('walletInfo');
    const walletAddressElement = document.getElementById('walletAddress');
    const errorMessage = document.getElementById('errorMessage');
    const addressEtherscan = document.getElementById('addressEtherscan');
    const sendEthForm = document.getElementById('sendEthForm');
    const transactionsList = document.getElementById('transactionsList');

    // Sepolia network configuration
    const SEPOLIA_CHAIN_ID = '0xaa36a7'; // 11155111 in hex
    const SEPOLIA_RPC_URL = 'https://sepolia.infura.io/v3/your-infura-id';
    const ETHERSCAN_BASE_URL = 'https://sepolia.etherscan.io';

    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.classList.remove('d-none');
        setTimeout(() => {
            errorMessage.classList.add('d-none');
        }, 5000);
    }

    async function switchToSepolia() {
        try {
            await window.ethereum.request({
                method: 'wallet_switchEthereumChain',
                params: [{ chainId: SEPOLIA_CHAIN_ID }],
            });
        } catch (switchError) {
            // This error code indicates that the chain has not been added to MetaMask
            if (switchError.code === 4902) {
                try {
                    await window.ethereum.request({
                        method: 'wallet_addEthereumChain',
                        params: [{
                            chainId: SEPOLIA_CHAIN_ID,
                            chainName: 'Sepolia Test Network',
                            nativeCurrency: {
                                name: 'Sepolia ETH',
                                symbol: 'ETH',
                                decimals: 18
                            },
                            rpcUrls: [SEPOLIA_RPC_URL],
                            blockExplorerUrls: [ETHERSCAN_BASE_URL]
                        }]
                    });
                } catch (addError) {
                    showError('Failed to add Sepolia network');
                }
            }
        }
    }

    async function connectWallet() {
        if (typeof window.ethereum !== 'undefined') {
            try {
                console.log('Requesting account access...');
                await switchToSepolia();
                const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
                const account = accounts[0];
                console.log('Account connected:', account);
                
                // Save wallet address to backend
                const response = await fetch('/web3/save-wallet', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ wallet_address: account })
                });

                const data = await response.json();
                
                if (data.success) {
                    connectBtn.classList.add('d-none');
                    disconnectBtn.classList.remove('d-none');
                    walletInfo.classList.remove('d-none');
                    walletAddressElement.textContent = account;
                    addressEtherscan.href = `${ETHERSCAN_BASE_URL}/address/${account}`;
                } else {
                    showError(data.message || 'Failed to save wallet address');
                }
            } catch (error) {
                console.error('Error connecting wallet:', error);
                showError(error.message || 'Failed to connect wallet');
            }
        } else {
            showError('MetaMask is not installed. Please install MetaMask and try again.');
        }
    }

    async function sendTransaction(recipientAddress, amount) {
        try {
            const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
            const account = accounts[0];
            
            // Convert ETH amount to Wei (1 ETH = 10^18 Wei)
            const amountWei = `0x${(amount * 1e18).toString(16)}`;
            
            const transactionParameters = {
                from: account,
                to: recipientAddress,
                value: amountWei,
                gas: '0x5208', // 21000 gas (standard transaction)
            };

            const txHash = await window.ethereum.request({
                method: 'eth_sendTransaction',
                params: [transactionParameters],
            });

            // Add transaction to the list
            const txElement = document.createElement('div');
            txElement.className = 'alert alert-info mt-2';
            txElement.innerHTML = `
                Transaction sent! <br>
                <a href="${ETHERSCAN_BASE_URL}/tx/${txHash}" target="_blank" class="btn btn-sm btn-info mt-2">
                    <i class="fas fa-external-link-alt"></i> View on Etherscan
                </a>
            `;
            transactionsList.prepend(txElement);

            return txHash;
        } catch (error) {
            throw error;
        }
    }

    async function disconnectWallet() {
        try {
            const response = await fetch('/web3/disconnect', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();
            
            if (data.success) {
                connectBtn.classList.remove('d-none');
                disconnectBtn.classList.add('d-none');
                walletInfo.classList.add('d-none');
                walletAddressElement.textContent = '';
                transactionsList.innerHTML = '';
            } else {
                showError(data.message || 'Failed to disconnect wallet');
            }
        } catch (error) {
            console.error('Error disconnecting wallet:', error);
            showError(error.message || 'Failed to disconnect wallet');
        }
    }

    connectBtn.addEventListener('click', connectWallet);
    disconnectBtn.addEventListener('click', disconnectWallet);

    sendEthForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const recipientAddress = document.getElementById('recipientAddress').value;
        const amount = parseFloat(document.getElementById('ethAmount').value);

        if (!recipientAddress || !amount) {
            showError('Please fill in both recipient address and amount');
            return;
        }

        try {
            await sendTransaction(recipientAddress, amount);
        } catch (error) {
            showError(error.message || 'Transaction failed');
        }
    });

    // Check if wallet is already connected
    if (typeof window.ethereum !== 'undefined') {
        window.ethereum.request({ method: 'eth_accounts' })
            .then(accounts => {
                if (accounts.length > 0) {
                    connectBtn.classList.add('d-none');
                    disconnectBtn.classList.remove('d-none');
                    walletInfo.classList.remove('d-none');
                    walletAddressElement.textContent = accounts[0];
                    addressEtherscan.href = `${ETHERSCAN_BASE_URL}/address/${accounts[0]}`;
                }
            })
            .catch(error => {
                console.error('Error checking wallet connection:', error);
            });

        // Listen for account changes
        window.ethereum.on('accountsChanged', function (accounts) {
            if (accounts.length > 0) {
                walletAddressElement.textContent = accounts[0];
                addressEtherscan.href = `${ETHERSCAN_BASE_URL}/address/${accounts[0]}`;
            } else {
                disconnectWallet();
            }
        });

        // Listen for chain changes
        window.ethereum.on('chainChanged', function (chainId) {
            if (chainId !== SEPOLIA_CHAIN_ID) {
                showError('Please switch to Sepolia Test Network');
                disconnectWallet();
            }
        });
    }
});
</script>
@endpush
@endsection
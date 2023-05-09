<div class="container">
    <div class="card">
        <div class="card-header" style="text-align:center;">
            Wallet
        </div>
        <div class="card-body">
            <h5 class="card-title"><button type="button" class="btn btn-success sm" id="conexion_wallet"
                    onclick="conectarMetamask()">Conectar Metamask</button></h5>
            
            <p class="card-text" id="cuenta"></p>
            <p class="card-text" id="balance"></p>

        </div>
    </div>
</div>
<script>
function conectarMetamask() {
    let account;
    ethereum.request({
        method: 'eth_requestAccounts'
    }).then(accounts => {
        account = accounts[0];
        console.log(account);
        let p = document.getElementById('cuenta');
        p.innerHTML = "Cuenta: " + account;
        getBalance(account);
    });
}

function getBalance(account) {

    ethereum.request({
        method: 'eth_getBalance',
        params: [account, 'latest']
    }).then(result => {

        let wei = parseInt(result, 16);
        let balance = wei / (10 ** 18);

        let p2 = document.getElementById('balance');

        p2.innerHTML = "Saldo: " + balance + " ETH";

    });

}

function transferETH(from, to, value) {
    let wei = "0x" + (parseInt(value) * (10 ** 18)).toString(16);
    let transactionParam = {
        to: to,
        from: from,
        value: wei
    };

    ethereum.request({
        method: 'eth_sendTransaction',
        params: [transactionParam]
    }).then(txhash => {
        console.log(txhash);
    });
}



function checkTransactionconfirmation(txhash) {

    let checkTransactionLoop = () => {
        return ethereum.request({
            method: 'eth_getTransactionReceipt',
            params: [txhash]
        }).then(r => {
            if (r != null) return 'confirmed';
            else return checkTransactionLoop();
        });
    };

    return checkTransactionLoop();
}

function cambioCuenta(nuevacuenta) {
    conectarMetamask();

}
window.ethereum.on("accountsChanged", cambioCuenta);
</script>
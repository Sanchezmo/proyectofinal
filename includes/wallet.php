<div class="container mt-3">
    <div class="card">
        <div class="card-header" style="text-align:center;">
            Hazte Premium
        </div>
        <div class="card-body mt-2">
            <h5 class="card-title"><button type="button" class="btn btn-info sm" id="conexion_wallet"
                    onclick="conectarMetamask()">Conectar con Metamask</button></h5>


            <form action="mysuscription.php" method="post" name="enviar">
                <input type="hidden" name="cuenta" id="cuenta" value="">
                <input type="hidden" name="balance" id="balance" value="">

            </form>
            <form action="mysuscription.php" method="post" name="enviarpremium">
                <input type="hidden" name="premium" id="premium" value="">
            </form>
            <?php if(!empty($_POST['cuenta'])){ echo $_POST['cuenta']; echo "<p> saldo: ".$_POST['balance']."</p>";}?>


        </div>
        <div class="card-footer"><button type="button" class="btn btn-success sm" id="conexion_wallet"
                onclick="pagar()">Pagar Premium</button></div>
    </div>
</div>
<script>
//window.ethereum.networkVersion == 10 para controlar los pagos sean en la mainnet.
function pagar() {
    ethereum.request({
        method: 'eth_requestAccounts'
    }).then(accounts => {
        account = accounts[0];
        transferETH(account, "0x937fbAD70a9Eeb01d645399031fCA95182308800", 0.01);
    });
}

function conectarMetamask() {
    let account;
    ethereum.request({
        method: 'eth_requestAccounts'
    }).then(accounts => {
        account = accounts[0];
        console.log(account);
        let p = document.getElementById('cuenta');
        p.value = "Cuenta: " + account;
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
        p2.value = balance;
        document.enviar.submit();
    });
}

function transferETH(from, to, value) {
    let wei = "0x" + (parseFloat(value) * (10 ** 18)).toString(16);
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
        checkTransactionconfirmation(txhash)
            .then(r => alert(r))
            .then(() => {
                let pre = document.getElementById('premium');
                pre.value = "SI";
                document.enviarpremium.submit();
            })


    });
}
//window.ethereum.networkVersion == 10 para que sea la mainnet.

function checkTransactionconfirmation(txhash) {

    let checkTransactionLoop = () => {
        return ethereum.request({
            method: 'eth_getTransactionReceipt',
            params: [txhash]
        }).then(r => {
            if (r != null) return 'Pago Confirmado, vuelve a loguear para aplicar los cambios';
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
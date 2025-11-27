<!DOCTYPE html>
<html>
<head>
    <title>Scan QR Barang</title>
</head>
<body>
    <div style="width: 100%; max-width: 500px; margin: auto;">
        <h2 style="text-align: center;">Scan QR Code</h2>
        <div id="reader"></div>
        <p style="text-align: center;">Arahkan kamera ke label barang</p>
    </div>

    <script src="/js/html5-qrcode.min.js"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // decodedText = UUID dari QR Code
            console.log(`Scan Result: ${decodedText}`);
            
            // Matikan kamera setelah berhasil scan
            html5QrcodeScanner.clear();

            // REDIRECT KE ROUTER
            // Arahkan ke controller detail dengan membawa ID
            window.location.href = "/barang/detail?id=" + decodedText;
        }

        function onScanFailure(error) {
            // Biarkan kosong, ini looping saat kamera mencari QR
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", 
            { fps: 10, qrbox: {width: 250, height: 250} }, 
            false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>
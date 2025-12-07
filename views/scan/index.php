<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<style>
    /* Custom Animation untuk Garis Scanner */
    @keyframes scan-moving {
        0% { top: 0%; opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        50% { top: 100%; opacity: 0; }
        60% { opacity: 1;}
        100% { top: 0%; opacity: 0; }
    }
    .animate-scan {
        animation: scan-moving 2.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }
</style>

<div class="min-h-[80vh] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-md w-full space-y-6 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
        
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Scan QR Code</h2>
            <p class="text-sm text-gray-500">Arahkan kamera ke barcode barang</p>
        </div>

        <div id="camera-select-container" class="hidden">
            <label for="camera-selection" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kamera</label>
            <select id="camera-selection" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md border bg-white">
            </select>
        </div>

        <div class="relative overflow-hidden rounded-xl bg-black shadow-inner aspect-square">
            <div id="reader" class="w-full h-full object-cover"></div>
            
            <div class="absolute inset-0 border-2 border-indigo-500 opacity-50 pointer-events-none"></div>
            
            <div class="absolute left-0 right-0 h-0.5 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.8)] z-10 animate-scan"></div>
        </div>

        <p id="status-msg" class="text-center text-xs text-gray-400">Memuat kamera...</p>

        <div class="text-center">
            <a href="/admin/dashboard" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                Batal / Kembali
            </a>
        </div>
    </div>
</div>

<script src="/js/html5-qrcode.min.js"></script>

<script>
    const html5QrCode = new Html5Qrcode("reader");
    const cameraSelect = document.getElementById('camera-selection');
    const statusMsg = document.getElementById('status-msg');
    let currentCameraId = null;

    // 1. Fungsi Utama: Menangani Sukses Scan
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        
        if (navigator.vibrate) navigator.vibrate(200);

        html5QrCode.stop().then(() => {
            window.location.href = "/admin/barang/detail?id=" + decodedText;
        }).catch(err => {
            window.location.href = "/admin/barang/detail?id=" + decodedText;
        });
    }

    // 2. Fungsi Start Scanning
    function startScanning(cameraId) {
        statusMsg.innerText = "Scanning...";
        
        if (html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                startCameraInstance(cameraId);
            }).catch(err => console.log("Stop failed", err));
        } else {
            startCameraInstance(cameraId);
        }
    }

    function startCameraInstance(cameraId) {
        html5QrCode.start(
            cameraId, 
            {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                aspectRatio: 1.0
            },
            onScanSuccess,
            (errorMessage) => { }
        ).catch(err => {
            console.error("Gagal memulai kamera", err);
            statusMsg.innerText = "Gagal akses kamera. Pastikan izin diberikan.";
            statusMsg.classList.add('text-red-500');
        });
    }

    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            document.getElementById('camera-select-container').classList.remove('hidden');
            
            cameraSelect.innerHTML = "";
            let backCameraId = null;

            devices.forEach(device => {
                const option = document.createElement("option");
                option.value = device.id;
                option.text = device.label || `Kamera ${device.id}`;
                cameraSelect.appendChild(option);

                if (device.label.toLowerCase().includes('back') || device.label.toLowerCase().includes('belakang')) {
                    backCameraId = device.id;
                }
            });

            currentCameraId = backCameraId ? backCameraId : devices[0].id;
            cameraSelect.value = currentCameraId;
            startScanning(currentCameraId);

        } else {
            statusMsg.innerText = "Kamera tidak ditemukan.";
        }
    }).catch(err => {
        console.error("Error getting cameras", err);
        statusMsg.innerText = "Izin kamera ditolak atau tidak support.";
    });

    cameraSelect.addEventListener('change', (event) => {
        currentCameraId = event.target.value;
        startScanning(currentCameraId);
    });
</script>

<?php $this->endSection(); ?>
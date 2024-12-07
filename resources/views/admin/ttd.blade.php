<style>
    #signature-container {
        border: 2px solid #000;
        width: 100%; /* Ambil lebar penuh */
        max-width: 600px; /* Batas maksimum untuk lebar */
        aspect-ratio: 2 / 1; /* Rasio aspek untuk menjaga proporsi */
        margin: auto; /* Pusatkan di tengah */
        position: relative;
    }
    #signature-pad {
        border: 2px solid #000;
        width: 400px;
        height: 200px;
        cursor: crosshair;
    }


    button {
        margin-top: 10px;
    }
</style>
<div class="signature-container">
    <canvas id="signature-pad"></canvas>
</div>
<div>
    <a class="btn btn-sm btn-danger" onclick="clearPad()">Bersihkan Tanda Tangan</a>
    <a class="btn btn-sm btn-primary" onclick="saveSignature()">Simpan Tanda Tangan</a>
</div>

@if (Route::is('editasset'))
    <br>
    <input id='ttd' type="file" name="signature" class="form-control" value="{{ $asset->signature }}">
    <img src="{{ asset('storage/signature_asset/'.$asset->signature) }}" width="200px" alt="" srcset="">
    <br>
@endif
@if (Route::is('tambahasset'))
    <br>
    <input id="ttd" type="file" name="signature" class="form-control">
    <small>jika sudah disimpan upload kesini</small>
@endif

<script>
    const canvas = document.getElementById("signature-pad");
    const ctx = canvas.getContext("2d");
    let isDrawing = false;

    // Atur ukuran kanvas
    canvas.width = 400;
    canvas.height = 200;

    // Menangani event mouse
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseout", stopDrawing);

    // Menangani event sentuhan (touch)
    canvas.addEventListener("touchstart", startDrawingTouch);
    canvas.addEventListener("touchmove", drawTouch);
    canvas.addEventListener("touchend", stopDrawing);

    function startDrawing(event) {
        isDrawing = true;
        ctx.beginPath();
        ctx.moveTo(event.offsetX, event.offsetY);
    }

    function draw(event) {
        if (!isDrawing) return;
        ctx.lineTo(event.offsetX, event.offsetY);
        ctx.stroke();
    }

    function startDrawingTouch(event) {
        isDrawing = true;
        ctx.beginPath();

        // Ambil koordinat sentuhan pertama
        const rect = canvas.getBoundingClientRect();
        const touch = event.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;

        ctx.moveTo(x, y);
    }

    function drawTouch(event) {
        if (!isDrawing) return;

        // Ambil koordinat sentuhan saat ini
        const rect = canvas.getBoundingClientRect();
        const touch = event.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;

        ctx.lineTo(x, y);
        ctx.stroke();
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function clearPad() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
        const dataURL = canvas.toDataURL("image/png");

        // Konversi ke Blob
        canvas.toBlob((blob) => {
            const file = new File([blob], "signature.png", { type: "image/png" });

            // Gunakan DataTransfer untuk input file
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Set file ke input file
            const fileInput = document.getElementById('ttd');
            fileInput.files = dataTransfer.files;

            console.log("File berhasil diatur:", fileInput.files[0]);
        });
    }
</script>

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
        width: 100%; /* Lebar penuh */
        height: 100%; /* Tinggi penuh */
        display: block; /* Menghapus ruang kosong default canvas */
    }

    .buttons {
        margin-top: 10px;
        text-align: center;
    }

    .buttons a {
        margin: 5px;
    }
</style>

<div id="signature-container">
    <canvas id="signature-pad"></canvas>
</div>
<div class="buttons">
    <a class="btn btn-sm btn-danger" onclick="clearPad()">Bersihkan Tanda Tangan</a>
    <a class="btn btn-sm btn-primary" onclick="saveSignature()">Simpan Tanda Tangan</a>
</div>

<script>
    const canvas = document.getElementById("signature-pad");
    const container = document.getElementById("signature-container");
    const ctx = canvas.getContext("2d");
    let isDrawing = false;

    // Fungsi untuk menyesuaikan ukuran kanvas
    function resizeCanvas() {
        const rect = container.getBoundingClientRect();
        const tempCanvas = document.createElement("canvas");

        // Salin gambar saat ini sebelum mengubah ukuran
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        tempCanvas.getContext("2d").drawImage(canvas, 0, 0);

        // Atur ulang ukuran kanvas
        canvas.width = rect.width;
        canvas.height = rect.height;

        // Salin kembali gambar ke kanvas yang telah disesuaikan
        ctx.drawImage(tempCanvas, 0, 0, tempCanvas.width, tempCanvas.height, 0, 0, canvas.width, canvas.height);
    }

    // Panggil resize saat halaman dimuat dan saat jendela diubah ukurannya
    window.addEventListener("load", resizeCanvas);
    window.addEventListener("resize", resizeCanvas);

    // Event menggambar menggunakan mouse
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseout", stopDrawing);

    // Event menggambar menggunakan sentuhan (touch)
    canvas.addEventListener("touchstart", startDrawingTouch, { passive: false });
    canvas.addEventListener("touchmove", drawTouch, { passive: false });
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
        event.preventDefault(); // Mencegah scroll layar
        isDrawing = true;
        ctx.beginPath();
        const rect = canvas.getBoundingClientRect();
        const touch = event.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;
        ctx.moveTo(x, y);
    }

    function drawTouch(event) {
        event.preventDefault(); // Mencegah scroll layar
        if (!isDrawing) return;
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
        console.log("Tanda tangan disimpan:", dataURL);
        alert("Tanda tangan berhasil disimpan.");
    }
</script>

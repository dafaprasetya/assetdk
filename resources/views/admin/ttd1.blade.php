<style>
    #signature-container {
        border: 2px solid #000;
        width: 100%; /* Ambil lebar penuh */
        max-width: 600px; /* Batas maksimum untuk lebar */
        aspect-ratio: 2 / 1; /* Rasio aspek untuk menjaga proporsi */
        margin: auto; /* Pusatkan di tengah */
        position: relative;
    }

    #canvas1 {
        width: 100%; /* Lebar penuh */
        height: 100%; /* Tinggi penuh */
        display: block; /* Menghapus ruang kosong default canvas */
    }
    #canvas2 {
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

<script>
    // Fungsi untuk menggambar di canvas
    const canvas = document.getElementById("canvas1");
    const canvas2 = document.getElementById("canvas2");
    const container = document.getElementById("signature-container");
    const ctx = canvas.getContext("2d");
    const ctx2 = canvas2.getContext("2d");
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
    function resizeCanvas2() {
        const rect = container.getBoundingClientRect();
        const tempCanvas = document.createElement("canvas");

        // Salin gambar saat ini sebelum mengubah ukuran
        tempCanvas.width = canvas2.width;
        tempCanvas.height = canvas2.height;
        tempCanvas.getContext("2d").drawImage(canvas2, 0, 0);

        // Atur ulang ukuran kanvas
        canvas2.width = rect.width;
        canvas2.height = rect.height;

        // Salin kembali gambar ke kanvas yang telah disesuaikan
        ctx2.drawImage(tempCanvas, 0, 0, tempCanvas.width, tempCanvas.height, 0, 0, canvas2.width, canvas2.height);
    }

    // Panggil resize saat halaman dimuat dan saat jendela diubah ukurannya
    window.addEventListener("load", resizeCanvas);
    window.addEventListener("resize", resizeCanvas);
    window.addEventListener("load", resizeCanvas2);
    window.addEventListener("resize", resizeCanvas2);

    // Event menggambar menggunakan mouse
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseout", stopDrawing);
    // Event menggambar menggunakan mouse
    canvas2.addEventListener("mousedown", startDrawing2);
    canvas2.addEventListener("mousemove", draw2);
    canvas2.addEventListener("mouseup", stopDrawing);
    canvas2.addEventListener("mouseout", stopDrawing);

    // Event menggambar menggunakan sentuhan (touch)
    canvas.addEventListener("touchstart", startDrawingTouch, { passive: false });
    canvas.addEventListener("touchmove", drawTouch, { passive: false });
    canvas.addEventListener("touchend", stopDrawing);
    // Event menggambar menggunakan sentuhan (touch)
    canvas2.addEventListener("touchstart", startDrawingTouch2, { passive: false });
    canvas2.addEventListener("touchmove", drawTouch2, { passive: false });
    canvas2.addEventListener("touchend", stopDrawing);

    function startDrawing(event) {
        isDrawing = true;
        ctx.beginPath();
        ctx.moveTo(event.offsetX, event.offsetY);
    }
    function startDrawing2(event) {
        isDrawing = true;
        ctx2.beginPath();
        ctx2.moveTo(event.offsetX, event.offsetY);
    }

    function draw(event) {
        if (!isDrawing) return;
        ctx.lineTo(event.offsetX, event.offsetY);
        ctx.stroke();
    }
    function draw2(event) {
        if (!isDrawing) return;
        ctx2.lineTo(event.offsetX, event.offsetY);
        ctx2.stroke();
    }

    function startDrawingTouch2(event) {
        event.preventDefault(); // Mencegah scroll layar
        isDrawing = true;
        ctx2.beginPath();
        const rect = canvas2.getBoundingClientRect();
        const touch = event.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;
        ctx2.moveTo(x, y);
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
    function drawTouch2(event) {
        event.preventDefault(); // Mencegah scroll layar
        if (!isDrawing) return;
        const rect = canvas2.getBoundingClientRect();
        const touch = event.touches[0];
        const x = touch.clientX - rect.left;
        const y = touch.clientY - rect.top;
        ctx2.lineTo(x, y);
        ctx2.stroke();
    }

    function stopDrawing() {
        isDrawing = false;
    }

function initCanvas(canvasId) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext("2d");
    let isDrawing = false;

    canvas.addEventListener("mousedown", (e) => {
        isDrawing = true;
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener("mousemove", (e) => {
        if (isDrawing) {
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        }
    });

    canvas.addEventListener("mouseup", () => {
        isDrawing = false;
    });

    canvas.addEventListener("mouseout", () => {
        isDrawing = false;
    });
}

// Fungsi untuk menghapus canvas
function clearCanvas(canvasId) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

// Fungsi untuk menyimpan tanda tangan dan menampilkan preview
function saveSignature(canvasId, previewId, inputtd) {
    const canvas = document.getElementById(canvasId);
    const dataURL = canvas.toDataURL("image/png");

    // Tampilkan gambar sebagai pratinjau
    const preview = document.getElementById(previewId);
    const loadd = document.getElementById(inputtd);
    preview.src = dataURL;
    canvas.toBlob((blob) => {
        // Buat file virtual dari Blob
        const file = new File([blob], "signature.png", { type: "image/png" });

        // Gunakan DataTransfer untuk mensimulasikan unggahan
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        // Set file ke input file
        const fileInput = document.getElementById('ttd_penerima');
        loadd.files = dataTransfer.files;

        console.log("File berhasil diatur:", fileInput.files[0]);
    });
}

// Inisialisasi kedua canvas
initCanvas("canvas1");
initCanvas("canvas2");

</script>
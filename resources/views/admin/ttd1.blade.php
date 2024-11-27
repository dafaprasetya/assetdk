<script>
    // Fungsi untuk menggambar di canvas
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
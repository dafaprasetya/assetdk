<style>
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
<canvas id="signature-pad"></canvas>
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

    canvas.width = 400;
    canvas.height = 200;

    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseout", stopDrawing);

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

    function stopDrawing() {
        isDrawing = false;
    }

    function clearPad() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
        const dataURL = canvas.toDataURL("image/png");
        const link = document.createElement("a");
        link.href = dataURL;
        // link.download = "tandatangan.png";
        canvas.toBlob((blob) => {
            // Buat file virtual dari Blob
            const file = new File([blob], "signature.png", { type: "image/png" });

            // Gunakan DataTransfer untuk mensimulasikan unggahan
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Set file ke input file
            const loadd = document.getElementById('ttd');
            loadd.files = dataTransfer.files;

            console.log("File berhasil diatur:", fileInput.files[0]);
        });
        link.click();
    }
</script>
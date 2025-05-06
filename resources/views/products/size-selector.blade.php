<div class="size-selector">
    <!-- Label untuk Ukuran -->
    <label for="size">Ukuran:</label>
    <span id="selected-size" class="selected-size">Small</span>

    <!-- Tombol Pilihan Ukuran -->
    <div class="size-options">
        <button type="button" class="size-option" data-size="S" onclick="selectSize(this)">S</button>
        <button type="button" class="size-option" data-size="M" onclick="selectSize(this)">M</button>
        <button type="button" class="size-option" data-size="L" onclick="selectSize(this)">L</button>
        <button type="button" class="size-option" data-size="XL" onclick="selectSize(this)">XL</button>
    </div>

    <!-- Input Hidden untuk Menyimpan Ukuran yang Dipilih -->
    <input type="hidden" name="size" id="size-input" value="S">
</div>

<style>
    /* Gaya untuk Komponen Pilihan Ukuran */
    .size-selector {
        font-family: 'Poppins', Arial, sans-serif;
        margin-top: 15px;
    }

    .size-selector label {
        font-size: 1rem;
        font-weight: bold;
        margin-right: 5px;
    }

    .size-selector .selected-size {
        font-size: 1rem;
        font-weight: normal;
        color: #555;
    }

    .size-options {
        display: flex;
        gap: 10px;
        margin-top: 8px;
    }

    /* Gaya Tombol Ukuran */
    .size-option {
        border: 1px solid #ccc;
        background-color: #fff;
        color: #333;
        font-size: 1rem;
        font-weight: bold;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .size-option:hover {
        border-color: #007bff;
        color: #007bff;
    }

    .size-option.active {
        background-color: #333;
        color: #fff;
        border-color: #000;
    }
</style>

<script>
    function selectSize(button) {
        // Hapus kelas 'active' dari semua tombol
        const allOptions = document.querySelectorAll('.size-option');
        allOptions.forEach(option => option.classList.remove('active'));

        // Tambahkan kelas 'active' ke tombol yang diklik
        button.classList.add('active');

        // Update teks ukuran yang dipilih
        const selectedSize = button.getAttribute('data-size');
        const sizeLabel = document.getElementById('selected-size');
        const sizeInput = document.getElementById('size-input');

        sizeLabel.textContent = 
            selectedSize === 'S' ? 'Small' :
            selectedSize === 'M' ? 'Medium' :
            selectedSize === 'L' ? 'Large' : 'Extra Large';

        // Update nilai input tersembunyi
        sizeInput.value = selectedSize;
    }

    // Pilih ukuran default saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        const defaultOption = document.querySelector('.size-option[data-size="S"]');
        if (defaultOption) {
            selectSize(defaultOption);
        }
    });
</script>
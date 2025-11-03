function toggleInput(select) {
    const input = select.nextElementSibling;
    input.classList.toggle('hidden', select.value === "");
}

function validateStock(input, currentStock) {
    const action = input.previousElementSibling.value;
    if (action === "out" && parseInt(input.value) > currentStock) {
        alert('Jumlah keluar tidak boleh lebih besar dari stok yang ada.');
        input.value = '';
    }
}

document.getElementById('save-stock').addEventListener('click', function() {
    const stockData = {};
    let confirmationDetails = '';

    document.querySelectorAll('tr').forEach(row => {
        const productId = row.querySelector('input[data-product-id]')?.getAttribute('data-product-id');
        const quantityInput = row.querySelector('input[type="number"]');
        const actionSelect = row.querySelector('select');

        if (productId && quantityInput && actionSelect) {
            const quantity = parseInt(quantityInput.value);
            const action = actionSelect.value;

            if (quantity > 0) {
                const currentStock = parseInt(row.querySelector('.current-stock').textContent);
                const newStock = action === 'in' ? currentStock + quantity : currentStock - quantity;
                stockData[productId] = {
                    quantity: action === 'in' ? quantity : -quantity
                };
                confirmationDetails += `Produk: ${row.cells[0].textContent}, Stok: ${currentStock} -> ${newStock}<br>`;
            }
        }
    });

    if (Object.keys(stockData).length === 0) {
        alert('Tidak ada perubahan untuk disimpan.');
        return;
    }

    // Show confirmation popup
    document.getElementById('confirmation-details').innerHTML = confirmationDetails;
    document.getElementById('confirmation-popup').style.display = 'flex';

    // Confirm button action
    document.getElementById('confirm-button').onclick = function() {
    fetch('/products/updatestock', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(stockData)
    })
    .then(response => {
        console.log('Response:', response); // Tambahkan log untuk melihat respons
        return response.json();
    })
    .then(data => {
        console.log('Data:', data); // Tambahkan log untuk melihat data yang diterima
        if (data.success) {
            alert('Stok berhasil diperbarui!');
            location.reload(); // Refresh the page to see the updated stock
        } else {
            alert('Terjadi kesalahan saat memperbarui stok: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui stok.');
    });
    document.getElementById('confirmation-popup').style.display = 'none'; // Hide popup
    console.log('Stock data to be sent:', stockData);
};

    // Cancel button action
    document.getElementById('cancel-button').onclick = function() {
        document.getElementById('confirmation-popup').style.display = 'none'; // Hide popup
    };
});

document.getElementById('product-search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.table tbody tr');

    rows.forEach(row => {
        const productName = row.cells[0].textContent.toLowerCase();
        row.style.display = productName.includes(searchTerm) ? '' : 'none';
    });
});

document.getElementById('category-filter').addEventListener('change', updateFilters);
document.getElementById('location-filter').addEventListener('change', updateFilters);

function updateFilters() {
    const categoryId = document.getElementById('category-filter').value;
    const locationId = document.getElementById('location-filter').value;
    const rows = document.querySelectorAll('.table tbody tr');

    rows.forEach(row => {
        const rowCategoryId = row.cells[1].getAttribute('data-category-id');
        const rowLocationId = row.cells[2].getAttribute('data-location-id');
        
        const categoryMatch = categoryId === "" || rowCategoryId === categoryId;
        const locationMatch = locationId === "" || rowLocationId === locationId;
        
        row.style.display = (categoryMatch && locationMatch) ? '' : 'none';
    });
}

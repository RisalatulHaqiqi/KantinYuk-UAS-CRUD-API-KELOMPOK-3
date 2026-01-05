// Array untuk menyimpan item keranjang
let cartItems = [];

// Fungsi untuk menambah item ke keranjang
function addToCart(id, name, price) {
  let existingItem = cartItems.find((item) => item.id === id);

  if (existingItem) {
    // Item sudah ada di keranjang, tambahkan jumlahnya
    existingItem.quantity++;
  } else {
    // Item belum ada di keranjang, tambahkan baru
    cartItems.push({ id, name, price, quantity: 1 });
  }

  // Tampilkan ulang daftar keranjang
  displayCart();
}

// Fungsi untuk menampilkan daftar keranjang
function displayCart() {
  const cartList = document.getElementById("cartList");
  cartList.innerHTML = "";

  // Buat tabel
  const table = document.createElement("table");

  // Buat baris header tabel
  const headerRow = document.createElement("tr");

  const headerName = document.createElement("th");
  headerName.textContent = "Nama";
  headerRow.appendChild(headerName);

  const headerQuantity = document.createElement("th");
  headerQuantity.textContent = "Quantity";
  headerRow.appendChild(headerQuantity);

  const headerTotal = document.createElement("th");
  headerTotal.textContent = "Total";
  headerRow.appendChild(headerTotal);

  table.appendChild(headerRow);

  // Iterasi melalui setiap item di keranjang dan buat baris tabel untuk setiap item
  cartItems.forEach((item) => {
    const row = document.createElement("tr");

    // Kolom Nama
    const nameCell = document.createElement("td");
    nameCell.textContent = item.name;
    row.appendChild(nameCell);

    // Kolom Quantity
    const quantityCell = document.createElement("td");
    quantityCell.textContent = item.quantity;
    row.appendChild(quantityCell);

    // Kolom Total
    const totalCell = document.createElement("td");
    totalCell.textContent = item.quantity * item.price;
    row.appendChild(totalCell);

    // Tambahkan baris ke tabel
    table.appendChild(row);
  });

  // Tambahkan tabel ke dalam elemen keranjang
  cartList.appendChild(table);
}

// Darkmode
const darkModeToggle = document.getElementById("dark-mode-toggle");

const body = document.body;

darkModeToggle.addEventListener("click", () => {
  body.classList.toggle("dark-mode");
});

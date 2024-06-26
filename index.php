<?php include 'header.php'; ?>

<style>
  .product, .cart-item {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    display: inline-block;
    width: calc(33% - 22px);
}
</style>
<header id="home">
    <div class="container-fluid header-content">
      <div class="row">
        <div class="col">
          <div class="content-box text-center animated fadeInUp">
            <h1>BARÜ E-Ticaret</h1>
          </div>
        </div>
      </div>
    </div>
    
  </header>

  <div class="container mt-5">
    <h1 class="text-center">Ürünler</h1>
    <div class="service-border"></div>

    <div class="row">
    
  <?php 
   $uruncek = new Urunler($conn);

   $select = $uruncek->urun_listele();
  ?>
  </div>
  </div>

  <script>
// Local Storage'dan sepeti yükle ve ekrana getir
document.addEventListener('DOMContentLoaded', loadCart);

function addToCart(button) {
    const product = button.closest('.col-md-4');
    const productId = product.getAttribute('data-id');
    const productName = product.getAttribute('data-name');
    const productPrice = product.getAttribute('data-price');

    const cart = document.getElementById('cart');
    const cartItem = document.createElement('div');
    cartItem.className = 'cart-item';
    cartItem.setAttribute('data-id', productId);
    cartItem.innerHTML = `
           <p>${productName} - ${productPrice} TL</p>
        <a class="btn btn-primary" onclick="buyCart(this, '${productId}')" href="javascript:void(0)">Satın Al</a>
        <button class="btn btn-danger" onclick="removeFromCart(this)">Kaldır</button>
    `;
    cart.appendChild(cartItem);

    saveToLocalStorage(productId, productName, productPrice);
}

function removeFromCart(button) {
    const cartItem = button.parentElement;
    const productId = cartItem.getAttribute('data-id');
    cartItem.remove();
    removeFromLocalStorage(productId);
}

function buyCart(button, productId) {
    // Ürünü Local Storage'dan sil
    removeFromLocalStorage(productId);
    // basarili.php sayfasına yönlendir
    window.location.href = 'basarili.php';
}

function saveToLocalStorage(productId, productName, productPrice) {
    let cart = localStorage.getItem('cart');
    if (!cart) {
        cart = [];
    } else {
        cart = JSON.parse(cart);
    }
    
    cart.push({ id: productId, name: productName, price: productPrice });
    localStorage.setItem('cart', JSON.stringify(cart));
}

function removeFromLocalStorage(productId) {
    let cart = localStorage.getItem('cart');
    if (!cart) return;

    cart = JSON.parse(cart);
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    let cart = localStorage.getItem('cart');
    if (!cart) return;

    cart = JSON.parse(cart);
    const cartContainer = document.getElementById('cart');
    
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.setAttribute('data-id', item.id);
        cartItem.innerHTML = `
            <p>${item.name} - ${item.price} TL</p>
            <a class="btn btn-primary" onclick="buyCart(this, '${item.id}')" href="javascript:void(0)">Satın Al</a>
            <button class="btn btn-danger" onclick="removeFromCart(this)">Kaldır</button>
        `;
        cartContainer.appendChild(cartItem);
    });
}


  </script>

<?php include 'footer.php'; ?>
</body>
</html>

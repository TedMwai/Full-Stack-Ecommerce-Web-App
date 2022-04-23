const cartItems = document.querySelector(".cart-count");

async function loadItems() {
  try {
    const response = await fetch("./cart/cart_fetch.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const items = await response.json();
    cartItems.innerHTML = items.count;
  } catch (error) {
    console.error(error);
  }
}

loadItems();
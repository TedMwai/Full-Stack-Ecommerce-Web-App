const container = document.querySelector(".product-container");
const cartItems = document.querySelector(".cart-count");

async function loadItems() {
  try {
    const response = await fetch("../cart/cart_fetch.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const items = await response.json();
    cartItems.innerHTML = items.count;
  } catch (error) {
    console.error(error);
  }
}

async function getFavourites() {
  const xhr = new XMLHttpRequest();

  xhr.open("GET", "../wishlist/wishlist_details.php", true);

  xhr.onload = function () {
    if (this.status === 200) {
      let outputString = JSON.parse(xhr.responseText);
      container.innerHTML = outputString;
      const name = document.querySelector(".cart-product-content h3").innerHTML;
      const size = document.querySelector(".size").textContent.slice(7);
      const quantity = document
        .querySelector(".quantity")
        .textContent.slice(11);
      const prodId = document.querySelector(".prodID").value;
      const price = document
        .querySelector(".cart-product-price p")
        .textContent.slice(9, 11);
      const priceTwo = parseInt(price);
      const quantityTwo = parseInt(quantity);
      const sizeTwo = parseInt(size);
      const prodIdTwo = parseInt(prodId);
      const toSend = {
        name: name,
        price: priceTwo,
        id: prodIdTwo,
        quantity: quantityTwo,
        shoeSize: sizeTwo,
      };
      const jsonString = JSON.stringify(toSend);
      const deleteBtn = document.querySelectorAll(".btn-delete");
      deleteBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          let id = btn.getAttribute("data-id");
          params = "id=" + id;
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "../wishlist/wishlist_delete.php", true);
          xhr.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhr.onload = function () {
            if (this.status == 200) {
              getFavourites();
            } else {
              console.log("error");
            }
          };
          xhr.send(params);
        });
      });
      const cartBtn = document.querySelectorAll(".btn-bag");
      cartBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "../cart/cart_add.php", true);
          xhr.setRequestHeader("Content-Type", "application/json");

          xhr.onload = function () {
            if (this.status == 200) {
              getFavourites();
              loadItems();
            } else {
              console.log("error");
            }
          };
          xhr.send(jsonString);
        });
      });
      cartBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          let id = btn.getAttribute("data-id");
          params = "id=" + id;
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "../wishlist/wishlist_delete.php", true);
          xhr.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhr.onload = function () {
            if (this.status == 200) {
              getFavourites();
            } else {
              console.log("error");
            }
          };
          xhr.send(params);
        });
      });
    }
  };

  xhr.send();
}

getFavourites();
loadItems();

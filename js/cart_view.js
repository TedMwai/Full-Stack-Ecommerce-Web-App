const container = document.getElementById("cart-container");
const subtotal = document.querySelector(".summary span div");
const total = document.querySelector(".summary .span-total div");
const favouriteContainer = document.querySelector(".favourite-products");
const cartItems = document.querySelector(".cart-count");
const btnCheckout = document.querySelector(".btn-checkout");

// Functions

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

function getCart() {
  const xhr = new XMLHttpRequest();
  let bag = `<h1>Bag</h1>`;

  xhr.open("GET", "../cart/cart_details.php", true);

  xhr.onload = function () {
    if (this.status == 200) {
      var outputString = JSON.parse(xhr.responseText);
      var resultString = bag.concat(outputString);
      container.innerHTML = resultString;

      // Delete Btn Functionality
      const deleteBtn = document.querySelectorAll(".delete-btn");
      deleteBtn.forEach((btn) => {
        let id = btn.getAttribute("data-id");
        let idTwo = btn.getAttribute("value");
        const sendId = {
          id: id,
          idTwo: idTwo,
        };
        const params = JSON.stringify(sendId);
        btn.addEventListener("click", () => {
          const xhr = new XMLHttpRequest();
          xhr.open("POST", "../cart/cart_delete.php", true);
          xhr.setRequestHeader("Content-type", "application/json");
          xhr.onload = function () {
            if (this.status == 200) {
              getCart();
              getTotal();
              loadItems();
            } else {
              console.log("error");
            }
          };
          xhr.send(params);
        });
      });

      // Like Btn Functionality
      const likeBtn = document.querySelectorAll(".like-btn");
      likeBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          const cartId = btn.getAttribute("data-id");
          params = "id=" + cartId;

          const xhr = new XMLHttpRequest();
          xhr.open("POST", "../cart/cart_delete.php", true);
          xhr.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          xhr.onload = function () {
            if (this.status == 200) {
              getCart();
              getTotal();
            } else {
              console.log("error");
            }
          };
          xhr.send(params);
        });
      });
    } else {
      console.log("Error: " + xhr.responseText);
    }
  };

  xhr.send();
}

function getTotal() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "../cart/cart_total.php", true);
  xhr.onload = function () {
    if (this.status == 200) {
      let output = JSON.parse(xhr.responseText);
      let outputString = output + "$";
      subtotal.innerHTML = outputString;
      total.innerHTML = outputString;
    } else {
      console.log("error: " + xhr.responseText);
    }
  };
  xhr.send();
}

function getFavourites() {
  const xhr = new XMLHttpRequest();

  xhr.open("GET", "../wishlist/wishlist_details.php", true);

  xhr.onload = function () {
    if (this.status == 200) {
      let outputString = JSON.parse(xhr.responseText);
      favouriteContainer.innerHTML = outputString;

      const btnBag = document.querySelectorAll(".btn-bag");
      btnBag.forEach((btn) => {
        let id = btn.getAttribute("data-id");
        btn.addEventListener("click", () => {
          params = "id=" + id;
          console.log(params);
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
    } else {
      console.log("Error: " + xhr.responseText);
    }
  };

  xhr.send();
}

getCart();
getTotal();
getFavourites();
loadItems();

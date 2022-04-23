const bagBtn = document.querySelector(".bag-btn");
const favouriteBtn = document.querySelector(".heart-btn");
const sizeBtn = document.querySelectorAll(".size-popular");
const productForm = document.querySelector(".product-container-info");
const id = document.getElementById("productId").textContent;
const quantity = document.getElementById("quantity");
const quantityThree = document.getElementById("quantity");
const popup = document.querySelector(".copy-container");
const cartItems = document.querySelector(".cart-count");

// Getting Data To send
const shoeName = document.querySelector(".product-info-start h3").textContent;
const price = document
  .querySelector(".product-info-start span")
  .textContent.substring(0, 3);

// Event Listeners
let size;
sizeBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    var selected = document.getElementsByClassName("active");
    if (selected.length > 0) {
      selected[0].className = selected[0].className.replace(" active", "");
    }
    btn.className += " active";
    size = btn.innerHTML;
  });
});
popup.addEventListener("transitionend", () => {
  const popupBox = popup.children[0];
  popup.classList.remove("active");
  popupBox.classList.remove("active");
});

bagBtn.addEventListener("click", sendData);
favouriteBtn.addEventListener("click", sendFavouriteData);

let total = parseInt(price);
let productId = parseInt(id);
let totalQuantity = parseInt(quantity[quantity.selectedIndex].value);

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

loadItems();

function sendData() {
  const toSend = {
    name: shoeName,
    price: total,
    id: productId,
    quantity: quantity.value,
    shoeSize: size,
  };
  console.log(quantity.value);
  console.log(size);
  const jsonString = JSON.stringify(toSend);
  postProductData(jsonString);
}

function sendFavouriteData() {
  const toSend = {
    name: shoeName,
    price: total,
    id: productId,
    quantity: quantity.value,
    shoeSize: size,
  };
  console.log(quantity.value);
  console.log(size);
  const jsonString = JSON.stringify(toSend);
  postFavouriteData(jsonString);
}

function postProductData(jsonString) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../cart/cart_add.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onload = function () {
    const text = document.querySelector(".copy-popup");
    text.innerHTML = `
    <h3>Added To Bag</h3>
    <h4 style="font-size: 4rem;"><i class='bx bx-cart bx-spin' ></i></h4>`;
    const el = document.createElement("textarea");
    document.body.appendChild(el);
    el.select();
    document.body.removeChild(el);
    //Pop up animation
    const popupBox = popup.children[0];
    popup.classList.add("active");
    popupBox.classList.add("active");
  };

  xhr.send(jsonString);
  loadItems();
}

function postFavouriteData(jsonString) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../wishlist/wishlist_add.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onload = function () {
    const text = document.querySelector(".copy-popup");
    text.innerHTML = `
    <h3>Added To Favourites</h3>
    <h4 style="color : red;font-size: 5rem;"><i class='bx bxs-heart bx-tada' ></i></h4>`;
    const el = document.createElement("textarea");
    document.body.appendChild(el);
    el.select();
    document.body.removeChild(el);
    //Pop up animation
    const popupBox = popup.children[0];
    popup.classList.add("active");
    popupBox.classList.add("active");
  };
  xhr.send(jsonString);
}

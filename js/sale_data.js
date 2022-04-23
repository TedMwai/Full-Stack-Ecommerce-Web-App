const records = document.getElementById("records");
const topProduct = document.querySelector(".top-product");
const msg = "<h1>Top Selling Products</h1>";

async function loadSales() {
  try {
    const response = await fetch("/admin/recent_sales.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const users = await response.json();
    records.innerHTML += users;
  } catch (error) {
    console.error(error);
  }
}

async function topPicks() {
  try {
    const response = await fetch("/admin/favourite.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const data = await response.json();
    topProduct.innerHTML += msg;
    topProduct.innerHTML += data;
  } catch (Error) {
    console.error(Error);
  }
}

loadSales();
topPicks();

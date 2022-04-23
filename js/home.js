// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll("#sidebar .side-dropdown");
const sidebar = document.getElementById("sidebar");

allDropdown.forEach((item) => {
  const a = item.parentElement.querySelector("a:first-child");
  a.addEventListener("click", function (e) {
    e.preventDefault();

    if (!this.classList.contains("active")) {
      allDropdown.forEach((i) => {
        const aLink = i.parentElement.querySelector("a:first-child");

        aLink.classList.remove("active");
        i.classList.remove("show");
      });
    }

    this.classList.toggle("active");
    item.classList.toggle("show");
  });
});

// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector("nav .toggle-sidebar");
const allSideDivider = document.querySelectorAll("#sidebar .divider");

if (sidebar.classList.contains("hide")) {
  allSideDivider.forEach((item) => {
    item.textContent = "-";
  });
  allDropdown.forEach((item) => {
    const a = item.parentElement.querySelector("a:first-child");
    a.classList.remove("active");
    item.classList.remove("show");
  });
} else {
  allSideDivider.forEach((item) => {
    item.textContent = item.dataset.text;
  });
}

toggleSidebar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");

  if (sidebar.classList.contains("hide")) {
    allSideDivider.forEach((item) => {
      item.textContent = "-";
    });

    allDropdown.forEach((item) => {
      const a = item.parentElement.querySelector("a:first-child");
      a.classList.remove("active");
      item.classList.remove("show");
    });
  } else {
    allSideDivider.forEach((item) => {
      item.textContent = item.dataset.text;
    });
  }
});

sidebar.addEventListener("mouseleave", function () {
  if (this.classList.contains("hide")) {
    allDropdown.forEach((item) => {
      const a = item.parentElement.querySelector("a:first-child");
      a.classList.remove("active");
      item.classList.remove("show");
    });
    allSideDivider.forEach((item) => {
      item.textContent = "-";
    });
  }
});

sidebar.addEventListener("mouseenter", function () {
  if (this.classList.contains("hide")) {
    allDropdown.forEach((item) => {
      const a = item.parentElement.querySelector("a:first-child");
      a.classList.remove("active");
      item.classList.remove("show");
    });
    allSideDivider.forEach((item) => {
      item.textContent = item.dataset.text;
    });
  }
});

// PROFILE DROPDOWN
const profile = document.querySelector("nav .profile");
const imgProfile = profile.querySelector("img");
const dropdownProfile = profile.querySelector(".profile-link");

imgProfile.addEventListener("click", function () {
  dropdownProfile.classList.toggle("show");
});

// MENU
const allMenu = document.querySelectorAll("main .content-data .head .menu");

allMenu.forEach((item) => {
  const icon = item.querySelector(".icon");
  const menuLink = item.querySelector(".menu-link");

  icon.addEventListener("click", function () {
    menuLink.classList.toggle("show");
  });
});

window.addEventListener("click", function (e) {
  if (e.target !== imgProfile) {
    if (e.target !== dropdownProfile) {
      if (dropdownProfile.classList.contains("show")) {
        dropdownProfile.classList.remove("show");
      }
    }
  }

  allMenu.forEach((item) => {
    const icon = item.querySelector(".icon");
    const menuLink = item.querySelector(".menu-link");

    if (e.target !== icon) {
      if (e.target !== menuLink) {
        if (menuLink.classList.contains("show")) {
          menuLink.classList.remove("show");
        }
      }
    }
  });
});

// PROGRESSBAR
const allProgress = document.querySelectorAll("main .card .progress");

allProgress.forEach((item) => {
  item.style.setProperty("--value", item.dataset.value);
});

async function salesData() {
  try {
    const response = await fetch("/admin/chart_data.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(error);
  }
}

async function weeklyData() {
  try {
    const response = await fetch("/admin/weekly_data.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const data = await response.json();
    // console.log(data);
    return data;
  } catch (error) {
    console.error(error);
  }
}

async function weeklyChart() {
  const sales = await weeklyData();
  // console.log(sales);
  const dates = sales.map(function (subarray) {
    return subarray.filter(function (number) {
      return number.length > 3;
    });
  });
  const quantity = sales.map(function (subarray) {
    return subarray.filter(function (number) {
      return number.length < 3;
    });
  });
  const value = quantity.map(function (subarray) {
    return subarray.map(function (number) {
      return parseInt(number);
    });
  });
  const filteredDates = [...new Set(dates.flat())];
  console.log(filteredDates);
  var options = {
    series: [
      {
        name: "jordans",
        data: value[0],
      },
      {
        name: "nike",
        data: value[1],
      },
      {
        name: "adidas",
        data: value[2],
      },
      {
        name: "puma",
        data: value[3],
      },
    ],
    chart: {
      height: 400,
      type: "area",
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
    },
    xaxis: {
      type: "month",
      categories: filteredDates,
    },
    tooltip: {
      x: {
        format: "dd/MM/yy",
      },
    },
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
}

weeklyChart();

async function salesChart() {
  const sales = await salesData();
  console.log(sales);
  var options = {
    series: [
      {
        name: "Monthly Sale in $",
        data: [
          sales[0],
          sales[1],
          sales[2],
          sales[3],
          sales[4],
          sales[5],
          sales[6],
          sales[7],
          sales[8],
          sales[9],
          sales[10],
          sales[11],
        ],
      },
    ],
    chart: {
      height: 400,
      type: "line",
      zoom: {
        enabled: true,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "straight",
    },
    title: {
      text: "Jumpman's Monthly Sale$",
      align: "center",
    },
    grid: {
      row: {
        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
        opacity: 0.5,
      },
    },
    xaxis: {
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
    },
    colors: ["rgb(255, 99, 132)"],
  };

  var chart = new ApexCharts(document.querySelector("#monthly-sales"), options);
  chart.render();
}

salesChart();

async function monthlyCategoryData() {
  try {
    const response = await fetch("/admin/monthly_sales.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const data = await response.json();
    // console.log(data);
    return data;
  } catch (error) {
    console.error(error);
  }
}

async function donutChart() {
  const data = await monthlyCategoryData();
  const value = data.map(function (subarray) {
    return subarray.map(function (number) {
      return parseInt(number);
    });
  });
  // console.log(value[0][0]);
  var options = {
    series: [value[0][0], value[1][0], value[2][0], value[3][0]],
    labels: ["Jordans", "Nike", "Adidas", "Puma"],
    chart: {
      type: "donut",
    },
    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          labels: {
            show: true,
            total: {
              show: true,
              showAlways: true,
            },
          },
        },
      },
    },
    title: {
      text: "Shoes Sold This Month By Category",
      align: "center",
    },
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
          legend: {
            position: "bottom",
          },
        },
      },
    ],
  };

  var chart = new ApexCharts(document.querySelector("#donut-chart"), options);
  chart.render();
}

donutChart();

async function todaysSales() {
  try {
    const response = await fetch("/admin/todays_sales.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    const data = await response.json();
    // console.log(data);
    return data;
  } catch (error) {
    console.error(error);
  }
}

async function salesMadeToday() {
  const data = await todaysSales();
  const value = data.map(function (subarray) {
    return subarray.map(function (number) {
      return parseInt(number);
    });
  });
  console.log(value);
  var options = {
    series: [
      {
        name: "Amount In $",
        data: [value[0][0], value[1][0], value[2][0], value[3][0]],
      },
    ],
    chart: {
      height: 350,
      type: "line",
      zoom: {
        enabled: true,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "straight",
    },
    title: {
      text: "Products Sold Today",
      align: "center",
    },
    grid: {
      row: {
        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
        opacity: 0.5,
      },
    },
    xaxis: {
      categories: ["Jordans", "Nike", "Adidas", "Puma"],
    },
  };

  var chart = new ApexCharts(document.querySelector("#today-chart"), options);
  chart.render();
}

salesMadeToday();

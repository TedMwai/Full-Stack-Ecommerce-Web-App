async function loadItems() {
  try {
    const response = await fetch("../cart/cart_total.php");
    if (!response.ok) {
      throw Error(`${response.status} ${response.statusText}`);
    }
    var amount = await response.json();
    return amount;
  } catch (error) {
    console.error(error);
  }
}

const totalAmount = await loadItems();
console.log(totalAmount);

paypal
  .Buttons({
    style: {
      color: "silver",
      shape: "pill",
    },

    // Sets up the transaction when a payment button is clicked
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [
          {
            amount: {
              value: totalAmount,
            },
          },
        ],
      });
    },

    // Finalize the transaction after payer approval
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (orderData) {
        // Successful capture! For dev/demo purposes:
        console.log(
          "Capture result",
          orderData,
          JSON.stringify(orderData, null, 2)
        );
        var transaction = orderData.purchase_units[0].payments.captures[0];
        alert(
          "Transaction " +
            transaction.status +
            ": " +
            transaction.id +
            "\n\nSee console for all available details"
        );
        window.location = "../transactions.php?pay="+orderData.id;
      });
    },
  })
  .render("#paypal-button-container");

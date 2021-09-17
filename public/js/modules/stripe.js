/**
 *
 *
 *  stripe.js
 *
 *  purpose: ro provide the stripe api CLIENR SIDE CALLS
 *
 *
 */

export const initStripe = () => {
  let stripe = Stripe(
    "pk_test_51IoHyoHRqaEOzZ9RZq6i0d2ihbWG8yBH3PxhSvEofhmmSeQEjppK59csYsfl4zYGZzNUn9fRixEx6cIDiQv7Jw2600jPY1D52x"
  );
  // Stripe API Key
  let elements = stripe.elements();
  // Custom Styling
  let style = {
    base: {
      color: "#32325d",
      lineHeight: "24px",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4",
      },
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a",
    },
  };
  // Create an instance of the card Element
  let cardNumber = elements.create("cardNumber", { style: style });
  let cardCVC = elements.create("cardCvc", { style: style });
  let cardExpiry = elements.create("cardExpiry", { style: style });

  cardNumber.mount("#card-number");
  cardCVC.mount("#card-cvc");
  cardExpiry.mount("#card-expiry");

  // Handle real-time validation errors from the card Element.
  cardNumber.addEventListener("change", function (event) {
    let displayError = document.getElementById("card-errors");
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = "";
    }
  });

  cardCVC.addEventListener("change", function (event) {
    let displayError = document.getElementById("card-errors");
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = "";
    }
  });

  cardExpiry.addEventListener("change", function (event) {
    let displayError = document.getElementById("card-errors");
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = "";
    }
  });

  // Handle form submission
  let form = document.getElementById("payment-form");
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    stripe.createToken(cardNumber).then(function (result) {
      if (result.error) {
        // Inform the user if there was an error
        let errorElement = document.getElementById("card-errors");
        errorElement.textContent = result.error.message;
      } else {
        stripeTokenHandler(result.token);
      }
    });
  });
  // Send Stripe Token to Server
  function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    let form = document.getElementById("payment-form");
    // Add Stripe Token to hidden input
    let hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "stripeToken");
    hiddenInput.setAttribute("value", token.id);
    form.appendChild(hiddenInput);
    // Submit form
    form.submit();
  }
};

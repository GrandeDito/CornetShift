document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const input = document.querySelector("#password");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (input.value.length < 4) {
      alert("Il campo deve contenere almeno 8 caratteri.");
      return false;
    }

    form.submit();
  });
});
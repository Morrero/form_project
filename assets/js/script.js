document.addEventListener("DOMContentLoaded", function () {
  const birthDateInput = document.querySelector("#birth_date");
  if (birthDateInput) {
    flatpickr(birthDateInput, {
      dateFormat: "Y-m-d",
      locale: "pl",
      allowInput: true
    });
  }

  const form = document.querySelector(".custom-form");
  const submitBtn = form.querySelector(".submit-btn");
  const phoneRow = form.querySelector(".form-row.phone");
  const plusIcon = phoneRow.querySelector(".plus-icon");

  let phoneCount = 1;

  function showErrorInField(input, message, type = "input") {
    input.classList.add("error");
    if (type === "date") {
      input.value = "";
      input.placeholder = message;
    } else {
      input.value = "";
      input.placeholder = message;
    }
    input.dataset.error = "true";
  }

  function clearError(input, type = "input") {
    if (input.dataset.error === "true") {
      input.dataset.error = "false";
    }
    if (type === "date") {
      input.placeholder = "Twoja data urodzenia";
    }
    input.classList.remove("error");
  }


  function getPhoneInputs() {
    return form.querySelectorAll('input[type="tel"][name="phone[]"]');
  }

  function hasAnyPhone() {
    const phones = Array.from(getPhoneInputs());
    return phones.some(inp => inp.value.trim() && inp.dataset.error !== "true");
  }

  function validateAll() {
    const firstName = form.querySelector("[name='first_name']");
    const lastName = form.querySelector("[name='last_name']");
    const birthDate = form.querySelector("[name='birth_date']");
    const email = form.querySelector("[name='email']");
    const marital = form.querySelector("[name='marital_status']");
    const about = form.querySelector("[name='about']");
    const agree = form.querySelector("[name='agree']");

    let valid = true;

    if (!firstName.value.trim() || firstName.dataset.error === "true") valid = false;
    if (!lastName.value.trim() || lastName.dataset.error === "true") valid = false;
    if (!birthDate.value.trim() || birthDate.dataset.error === "true") valid = false;

    const hasContact = email.value.trim() || hasAnyPhone();
    if (!hasContact) valid = false;

    if (!marital.value.trim() || marital.dataset.error === "true") valid = false;
    if (!about.value.trim() || about.dataset.error === "true") valid = false;
    if (!agree.checked) valid = false;

    submitBtn.disabled = !valid;
  }

  function attachValidation(input, message, type = "input") {
    input.addEventListener("blur", () => {
      if (!input.value.trim()) {
        showErrorInField(input, message, type);
      }
      validateAll();
    });
    input.addEventListener("focus", () => {
      clearError(input, type);
    });
    input.addEventListener("input", validateAll);
  }


  attachValidation(form.querySelector("[name='first_name']"), "Wpisz imię");
  attachValidation(form.querySelector("[name='last_name']"), "Wpisz nazwisko");
  attachValidation(birthDateInput, "Wpisz datę urodzenia", "date");
  attachValidation(form.querySelector("[name='marital_status']"), "Wybierz stan cywilny", "select");
  attachValidation(form.querySelector("[name='about']"), "Wpisz coś o sobie");

  form.querySelector("[name='agree']").addEventListener("change", validateAll);

  const email = form.querySelector("[name='email']");
  const firstPhone = getPhoneInputs()[0];


  email.addEventListener("blur", () => {
    if (!email.value.trim() && !hasAnyPhone()) {
      showErrorInField(email, "Podaj e-mail lub telefon");
    }
    validateAll();
  });

  if (firstPhone) {
    attachValidation(firstPhone, "Podaj e-mail lub telefon");
  }

  form.addEventListener("keydown", function (e) {
    if (e.key === "Enter") e.preventDefault();
  });

  plusIcon.addEventListener("click", function () {
    if (phoneCount < 5) {
      phoneCount++;

      const wrapper = document.createElement("div");
      wrapper.classList.add("form-row");

      const newInput = document.createElement("input");
      newInput.type = "tel";
      newInput.name = "phone[]";
      newInput.placeholder = "Telefon " + phoneCount;

      attachValidation(newInput, "Podaj e-mail lub telefon");

      const removeBtn = document.createElement("button");
      removeBtn.type = "button";
      removeBtn.textContent = "Usuń";
      removeBtn.classList.add("remove-phone");

      removeBtn.addEventListener("click", function () {
        wrapper.remove();
        phoneCount--;
        validateAll();
      });

      wrapper.appendChild(newInput);
      wrapper.appendChild(removeBtn);

      phoneRow.parentNode.insertBefore(wrapper, phoneRow.nextSibling);

      validateAll();
    } else {
      alert("Możesz dodać maksymalnie 5 numerów telefonu");
    }
  });

  validateAll();
});

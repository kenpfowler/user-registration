document.getElementById("account_type").addEventListener("change", function () {
  const accountType = this.value;
  const nameLabel = document.getElementById("name-label");
  const contactTitleField = document.getElementById("contact-title-field");

  if (accountType === "company") {
    nameLabel.textContent = "Contact Name:";
    contactTitleField.style.display = "block";
  } else {
    nameLabel.textContent = "Full Name:";
    contactTitleField.style.display = "none";
  }
});

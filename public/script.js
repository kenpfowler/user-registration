    // Tab switching
    const tabs = document.querySelectorAll('.tab');
    const forms = {
      register: document.getElementById('registration-form'),
      login: document.getElementById('login-form')
    };

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        // Update tab UI
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        // Show the relevant form
        for (const formKey in forms) {
          forms[formKey].classList.remove('active');
        }
        forms[tab.dataset.tab].classList.add('active');
      });
    });

    // Show Contact Title only if company is selected
    const accountTypeSelect = document.getElementById('account_type');
    const contactTitleField = document.getElementById('contact-title-field');

    accountTypeSelect.addEventListener('change', () => {
      if (accountTypeSelect.value === 'company') {
        contactTitleField.style.display = 'block';
      } else {
        contactTitleField.style.display = 'none';
      }
    });



// Toggle between account type registrations
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

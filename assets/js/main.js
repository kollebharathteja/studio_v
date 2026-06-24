const navToggle = document.querySelector('.nav-toggle');
const siteNav = document.querySelector('.site-nav');

if (navToggle && siteNav) {
  navToggle.addEventListener('click', () => {
    const open = siteNav.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(open));
  });
}

const bookingType = document.querySelector('#bookingType');
const serviceSelect = document.querySelector('#serviceSelect');
const mobileFields = document.querySelector('.mobile-fields');

function syncBookingForm() {
  if (!bookingType || !serviceSelect) return;
  const type = bookingType.value;

  [...serviceSelect.options].forEach((option) => {
    const visible = option.dataset.category === type;
    option.hidden = !visible;
    option.disabled = !visible;
  });

  const selected = serviceSelect.selectedOptions[0];
  if (!selected || selected.dataset.category !== type) {
    const first = [...serviceSelect.options].find((option) => option.dataset.category === type);
    if (first) first.selected = true;
  }

  if (mobileFields) {
    mobileFields.classList.toggle('show', type === 'mobile');
  }
}

if (bookingType) {
  bookingType.addEventListener('change', syncBookingForm);
  syncBookingForm();
}

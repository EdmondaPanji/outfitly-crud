import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.quantity-control').forEach(control => {
      const minusBtn = control.querySelector('.minus');
      const plusBtn = control.querySelector('.plus');
      const qtyInput = control.querySelector('.qty');
  
      plusBtn.addEventListener('click', () => {
        let currentValue = parseInt(qtyInput.value);
        qtyInput.value = currentValue + 1;
      });
  
      minusBtn.addEventListener('click', () => {
        let currentValue = parseInt(qtyInput.value);
        if (currentValue > 1) {
          qtyInput.value = currentValue - 1;
        }
      });
    });
  });
  
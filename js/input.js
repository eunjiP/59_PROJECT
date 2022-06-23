function increaseValue() {
  var value = parseInt(document.querySelector('.number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.querySelector('.number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.querySelector('.number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? (value = 1) : '';
  value--;
  document.querySelector('.number').value = value;
}

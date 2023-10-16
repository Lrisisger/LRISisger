const inputCpfCnpj = document.querySelector('input[name="codEmp"]');

inputCpfCnpj.addEventListener("input", function () {
  const value = this.value.replace(/\D/g, "");

  
  if (value.length === 11) {
    this.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
  }
  else if (value.length === 14) {
    this.value = value.replace(
      /(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/,
      "$1.$2.$3/$4-$5"
    );
  }
  else {
    this.value = value;
  }
});

inputCpfCnpj.addEventListener("blur", function () {
  this.dispatchEvent(new Event("input")); // Dispara o evento de input para aplicar a formatação
});

// MODAL

function toggleModal() {
  var modal = document.getElementById('loginModal');
  modal.style.display = modal.style.display === 'none' || modal.style.display === '' ? 'flex' : 'none';
}

window.onclick = function(event) {
  var modal = document.getElementById('loginModal');
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}

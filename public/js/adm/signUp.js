const inputCpfCnpj = document.getElementById('cpfCnpj');


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
  this.dispatchEvent(new Event("input"));
});





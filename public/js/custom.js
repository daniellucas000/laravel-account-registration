let inputValue = document.getElementById("value");

inputValue.addEventListener("input", function () {
    let value = this.value.replace(/[^\d]/g, "");

    let formattedValue =
        value.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
        "" +
        value.slice(-2);

    formattedValue =
        formattedValue.slice(0, -2) + "," + formattedValue.slice(-2);

    this.value = formattedValue;
});

function confirmeDelete(event, contaId) {
    event.preventDefault();

    Swal.fire({
        title: "Tem certeza?",
        text: "Você não poderá reverter esta ação",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: "Sim, excluir!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`formDelete${contaId}`).submit();
        }
    });
}

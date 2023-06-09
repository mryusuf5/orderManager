const forms = document.querySelectorAll('.confirmForm');

forms.forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        sweetAlert(form);
    })
})

const sweetAlert = async (form) => {
    Swal.fire({
        title: 'Weet je zeker dat je dit wilt verwijderen?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ja',
        cancelButtonText: 'Nee'
    }).then(result => {
        if(result.isConfirmed)
        {
            form.submit();
        }
    });
}

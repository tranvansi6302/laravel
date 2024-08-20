// Confirm SweetAlert2
function showConfirm(event, text) {
    event.preventDefault();
    linkHref = event.target.getAttribute('href')
    if (linkHref) {
        Swal.fire({
            title: 'Bạn có chắc?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy',
            confirmButtonText: 'Có'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = linkHref
            }
        })
    }
}

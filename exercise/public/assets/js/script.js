const currentUrl = new URL(window.location.href);

// Lấy giá trị của tham số "search" từ URL
const keywordParam = currentUrl.searchParams.get("keyword");
const statusParam = currentUrl.searchParams.get("status");
const groupIdParam = currentUrl.searchParams.get("group_id");


// Nếu giá trị của tham số "search" là null hoặc rỗng, xóa tham số này khỏi URL
if (!keywordParam) {
    currentUrl.searchParams.delete("keyword");
}
// Nếu giá trị của tham số "role" là null hoặc rỗng, xóa tham số này khỏi URL
if (!statusParam) {
    currentUrl.searchParams.delete("status");
}
if (!groupIdParam) {
    currentUrl.searchParams.delete("group_id");
}

// Đặt lại URL sau khi xử lí
history.replaceState(null, "", currentUrl.toString());

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
            confirmButtonText: 'Có'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = linkHref
            }
        })
    }
}
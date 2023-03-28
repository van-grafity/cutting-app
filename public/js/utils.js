

async function delete_using_fetch(url = "", data = {}) {
    const response = await fetch(url, {
        method: "DELETE",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': data.token
        },
        redirect: "follow",
        referrerPolicy: "no-referrer",
    });
    return response.json();
}

async function get_using_fetch(url = "", data = {}) {
    const response = await fetch(url, {
        method: "GET",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
        },
        redirect: "follow",
        referrerPolicy: "no-referrer",
    });
    return response.json();
}

async function using_fetch(url = "", data = {}, method = "GET") {

    if(method === "GET") {
        query_string = new URLSearchParams(data).toString();
        url = url + "?" + query_string
        headers = {
            "Content-Type": "application/json",
        };
    }

    if(method === "DELETE") {
        headers = {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': data.token
        };
    }
    
    const response = await fetch(url, {
        method: method,
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: headers,
        redirect: "follow",
        referrerPolicy: "no-referrer",
    });
    return response.json();
}

// ## Sweetalert2 Manager
const swal_delete_confirm = (data = {}) => {
    const swalComponent = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-danger m-2",
            cancelButton: "btn btn-secondary m-2",
        },
        buttonsStyling: false,
    });

    let title = data.title ? data.title : "Are you sure?";
    let confirm_button = data.confirm_button ? data.confirm_button : "Delete";
    let success_message = data.success_message
        ? data.success_message
        : "Deleted!";
    let failed_message = data.failed_message
        ? data.failed_message
        : "Cancel Delete";

    return new Promise((resolve, reject) => {
        swalComponent
            .fire({
                title: title,
                text: data.text,
                confirmButtonText: confirm_button,
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    resolve(true);
                }
                resolve(false);
            })
            .catch((error) => {
                reject(error);
            });
    });
}

const swal_info = (data = { title: "Success", option: false }) => {
    const afterClose = () => {
        if( data.reload_option == true ) {
            location.reload();
        } else {
            return false;
        }
    }
    Swal.fire({
        icon: "success",
        title: data.title,
        showConfirmButton: false,
        timer: 3000,
        didClose: afterClose,
    });
};

const swal_failed = (data) => {
    Swal.fire({
        icon: "error",
        title: data.title ? data.title : "Something Error",
        text: 'Please contact the Administrator',
        showConfirmButton: false,
        timer: 2000,
    });
}

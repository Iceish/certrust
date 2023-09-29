import Swal from "sweetalert2";

export default {
     Confirm : Swal.mixin({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        heightAuto: false,
        showCancelButton: true,
        confirmButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--clr-secondary'),
        cancelButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--clr-danger'),
    }),

    Toast : Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        heightAuto: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    }),
}


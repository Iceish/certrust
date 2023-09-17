const Confirm = Swal.mixin({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    heightAuto: false,
    showCancelButton: true,
    confirmButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--clr-secondary'),
    cancelButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--clr-danger'),
});

$(document).ready(function () {
    $('#datatable').DataTable({
        order: [ [0, 'desc'] ]

    });
});
$(".delete").on("submit", function () {
    return confirm("Do you want to delete this item?");
});

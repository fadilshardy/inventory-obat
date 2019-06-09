$(document).ready(function () {
    $('#datatable').DataTable();
});
$(".delete").on("submit", function () {
    return confirm("Do you want to delete this item?");
});

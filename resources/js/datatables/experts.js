$(document).ready(function () {
    let table = $("#writerListTable");
    if (table.length > 0) {
        table.DataTable({
            serverSide: true,
            processing: true,
            autoWidth: false,
            dom: "tipr",
            ajax: {
                "url": "",
                "type": "GET",
                "data": function (data) {
                    data.discipline = $("#discipline").val();
                    data.rating = $("#writerRating").val();
                    data.orders = $("#orders").val();
                }
            },
            order: [[2, 'desc']],
            columns: [
                {data: "profile", className: "text-center border-right border-light ", orderable: false},
                {data: "rating", className: "text-center border-right border-light "},
                {data: "writer_orders_count", className: "text-center  border-right border-light"},
                {data: "action", className: "text-center ", orderable: false},
            ],
        });

        $("#discipline, #writerRating, #orders").change(function () {
            refreshTable();
        })
    }

    function refreshTable() {
        table.DataTable().ajax.reload();
    }
});

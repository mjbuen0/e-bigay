$(document).ready(function () {
    function showTable() {
        $.ajax({
            type: "GET",
            url: "./assets/php/fetch_total_amount.php",
            dataType: "JSON",
            success: function (data) {
                $("#total-amount").html(data.amount)
                // $("#list-amount").html(data.table);
            }
        });
    }
    setInterval(function () {
        showTable();
    }, 500);
});
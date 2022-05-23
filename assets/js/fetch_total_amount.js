$(document).ready(function () {
    function showTable() {
        $.ajax({
            type: "GET",
            url: "./assets/php/fetch_total_amount.php",
            dataType: "JSON",
            success: function (data) {
                $("#total-amount").html(data.amount);
                $("#time").html("As of: "+data.dateandtime);
            }
        });
    }
    setInterval(function () {
        showTable();
    }, 5000);
});
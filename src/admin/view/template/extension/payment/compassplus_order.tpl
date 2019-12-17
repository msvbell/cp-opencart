<table class="table table-striped table-bordered">
    <tr>
        <td>Date</td>
        <td><?php echo $date; ?></td>
    </tr>
    <tr>
        <td>Order ID</td>
        <td><?php echo $order_id; ?></td>
    </tr>
    <tr>
        <td>Order ID in Compassplus</td>
        <td><?php echo $order_id_compassplus; ?></td>
    </tr>
    <tr>
        <td>Amount</td>
        <td><input type="text" id="amount" value="<?php echo $amount; ?>" name="amount"></td>
    </tr>
    <tr>
        <td>Currency</td>
        <td><?php echo $currency; ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button id="compassplus-refund">Возврат</button>
        </td>
    </tr>
</table>
<script type="text/javascript">
    var url, data;
    url = 'index.php?route=extension/payment/compassplus/refund&token=<?php echo $token; ?>';
    data = {
        'order_id': <?php echo $order_id; ?>,
        'total': $('#amount').val(),
    };
    $('#compassplus-refund').on('click', function () {
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            method: 'POST',
            success: function (data) {

            }
        });
    });

</script>
<form action="<?php echo $host; ?>" method="POST">
    <input type="hidden" name="request_time_stamp" value="<?php echo $request_time_stamp; ?>">
    <input type="hidden" name="request_signature" value="<?php echo $request_signature; ?>">
    <input type="hidden" name="merchant_account_id" value="<?php echo $merchant_account_id; ?>">
    <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
    <input type="hidden" name="transaction_type" value="<?php echo $transaction_type; ?>">
    <input type="hidden" name="requested_amount" value="<?php echo $requested_amount; ?>">
    <input type="hidden" name="requested_amount_currency" value="<?php echo $requested_amount_currency; ?>">
    <input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
    <input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
    <input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>">
    <input type="hidden" name="ip_address" value="<?php echo $ip_address; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
    <input type="hidden" name="order_number" value="<?php echo $order_number; ?>">
    <input type="hidden" name="locale" value="<?php echo $locale; ?>">
    <input type="hidden" name="attempt_three_d" value="<?php echo $attempt_three_d; ?>">

    <div class="buttons">
        <div class="pull-right">
            <input type="submit" value="<?php echo $button_confirm; ?>" id="button-submit"
                   data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"/>
        </div>
    </div>
</form>
<form id="redirector" name="form1" method="post" action="https://testpti.payserv.net/webpaymentv2/Default.aspx">
<input type="hidden" name="paymentrequest" id="paymentrequest" value="<?php echo e($b64string); ?>">
<input type="submit">
</form>

<script type="text/javascript">
    document.getElementById('redirector').submit(); // SUBMIT FORM
</script>
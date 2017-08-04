<?php
/**
 * Created by PhpStorm.
 * User: Layby Cafe
 * Date: 2017/02/22
 * Time: 3:42 PM
 */


?>

<html>
<head>
    <body>
<form name="mygatewayform" method="post" action="http://app.laybycafe.com/process">
    <input type="hidden" name="m_payment_id"    value="">
    <input type="text" name="first_name"    value="">
    <input type="text" name="last_name"    value="">
    <input type="text" name="email"    value="">
    <input type="text" name="item_description"    value="">
    <input type="text" name="merchant_id"    value="">
    <input type="text" name="merchant_key"    value="">
    <input type="text" name="item_name"    value="">
    <input type="text" name="amount" value="">
    <input type="text" name="return_url"    value="">
    <input type="text" name="cancel_url"    value="">
    <input type="text" name="notify_url"    value="">
    <input type="text" name="user_agent"    value="My online Store">
</form>
<script type="text/javascript">
    document.mygatewayform.submit();
</script>
    </body>
</head>
</html>

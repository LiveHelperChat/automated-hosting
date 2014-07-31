Hello,

Here is your chat instance data:<?php echo "\n";?>
Address: http://<?php echo $instance->address?>.livehelperchat.com/site_admin/<?php echo "\n\n";?>

Login: <?php echo $email,"\n";?>
Password: <?php echo $password,"\n\n";?>

Number of purchased request:
<?php echo $instance->request,"\n\n";?>

Request expires:
<?php echo date('Y-m-d',$instance->expires),"\n\n";?>

Recommended embed code:<?php echo "\n";?>
<?php echo '<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:190,widget_width:300,popup_height:520,popup_width:500};
(function() {
var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
var refferer = (document.referrer) ? encodeURIComponent(document.referrer) : \'\';
var location  = (document.location) ? encodeURIComponent(document.location) : \'\';
po.src = \'//'.$instance->address.'.livehelperchat.com/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true?r=\'+refferer+\'&l=\'+location;
var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
})();
</script>',"\n\n"; ?>


Sincerely,
Live Helper Chat Team
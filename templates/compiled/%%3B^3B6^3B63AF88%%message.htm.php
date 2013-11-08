<?php /* Smarty version 2.6.19, created on 2008-03-31 07:19:00
         compiled from message.htm */ ?>
{include file="pageheader.htm"}
<div class="list-div">
  <div style="background:#FFF; padding: 20px 50px; margin: 2px;">
    <table align="center" width="400">
      <tr>
        <td width="50" valign="top">
          {if $msg_type==0}
          <img src="images/information.gif" width="32" height="32" border="0" alt="information" />
          {elseif $msg_type eq 1}
          <img src="images/warning.gif" width="32" height="32" border="0" alt="warning" />
          {else}
          <img src="images/confirm.gif" width="32" height="32" border="0" alt="confirm" />
          {/if}
        </td>
        <td style="font-size: 14px; font-weight: bold">{$msg_detail}</td>
      </tr>
      <tr>
        <td></td>
        <td id="redirectionMsg">
          {if $auto_redirect}{$lang.auto_redirection}{/if}
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <ul style="margin:0; padding:0 10px" class="msg-link">
            {foreach from=$links item=link}
            <li><a href="{$link.href}">{$link.text}</a></li>
            {/foreach}
          </ul>

        </td>
      </tr>
    </table>
  </div>
</div>
{if $auto_redirect}
<script language="JavaScript">
<!--
var seconds = 3;
var defaultUrl = "{$default_url}";

{literal}
onload = function()
{
  if (defaultUrl == 'javascript:history.go(-1)' && window.history.length == 0)
  {
    document.getElementById('redirectionMsg').innerHTML = '';
    return;
  }

  window.setInterval(redirection, 1000);
}
function redirection()
{
  if (seconds <= 0)
  {
    window.clearInterval();
    return;
  }

  seconds --;
  document.getElementById('spanSeconds').innerHTML = seconds;

  if (seconds == 0)
  {
    window.clearInterval();
    location.href = defaultUrl;
  }
}
//-->
</script>
{/literal}
{/if}
{include file="pagefooter.htm"}
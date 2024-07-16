<? if($_POST){ $getMsg = user_class::grant_privileges(); } ?>
<form id="form1" name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"></td>
    </tr>
    <tr>
      <td width="20%" align="left" valign="top"><fieldset>
        <legend>Role</legend>
        <div style="line-height:20px">
          <label>
            <select name="role" id="role"  onchange="load_priv('modules/user_group/index.php?CMD=Get Privileges&amp;val=' + this.options[this.selectedIndex].value)">
              <? user_class::get_roles_for_drop_down_menu(); ?>
            </select>
          </label>
        </div>
      </fieldset>
        <br />
        <input type="submit" name="button" id="button" value="Grant / Revoke" class="btn" onclick="grant_priv('modules/user_group/index.php?CMD=Grant Privileges')" />
        <br />
        <br />
        <span style="color:#F30"><? echo isset($getMsg) ? $getMsg : ""; ?></span></td>
      <td align="left" valign="top"><fieldset>
        <legend>Privileges</legend>
        <div id="sMsg" style="color:#F30"></div>
        <div style="line-height:20px" id="showPrivileges"></div>
      </fieldset></td>
    </tr>
  </table>
</form>
<script language="javascript">load_priv('modules/user_group/index.php?CMD=Get Privileges&val=Administrator');</script>

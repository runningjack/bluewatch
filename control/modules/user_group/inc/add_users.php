<? if(isset($_POST['button']) == "Add User"){ user_class::add_user(); }?>
<form id="form1" name="form1" method="post" action="" onsubmit="return validate_txt()">
  <table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">
    <tr>
      <td width="24%" align="left" valign="middle"><strong>Role</strong></td>
      <td colspan="3" align="left" valign="middle"><label>
        <select name="roleT" id="roleT">
          <? user_class::get_roles_for_drop_down_menu(); ?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>User Fullname</strong></td>
      <td colspan="3" align="left" valign="middle"><input name="fullnames" type="text" class="input" id="fullnames" size="50" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Username</strong></td>
      <td colspan="3" align="left" valign="middle"><input type="text" name="username" id="username"  class="input" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Email</strong></td>
      <td colspan="3" align="left" valign="middle"><input name="email" type="text" class="input" id="email" size="50" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Password</strong></td>
      <td colspan="3" align="left" valign="middle"><input type="password" name="password" id="password"  class="input" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Confirm Password</strong></td>
      <td colspan="3" align="left" valign="middle"><input type="password" name="password2" id="password2"  class="input" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;</td>
      <td width="7%" align="left" valign="middle"><input type="submit" name="button" id="button" value="Add User"  class="btn" onclick="validate_txt()" /></td>
      <td width="6%" align="left" valign="middle"><input type="reset" name="button2" id="button2" value="Reset"  class="btn" /></td>
      <td width="63%" align="left" valign="middle">&nbsp;
        <div id="showMsg" style="color:#F30"></div></td>
    </tr>
  </table>
</form>

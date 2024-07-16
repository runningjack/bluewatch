<? $val  = user_class::get_update_user($_GET['id']); ?>
<? if(isset($_POST['button']) == "Update User"){ user_class::update_user(); }?>
<form id="form1" name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="10" cellspacing="0">
    <tr>
      <td width="24%" align="left" valign="middle"><strong>Role</strong></td>
      <td colspan="3" align="left" valign="middle"><label>
        <select name="urole"  id="urole">
          <? user_class::get_roles_for_drop_down_menu(); ?>
          <option selected="selected">
            <?= $val['rol']; ?>
            </option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>User Fullname</strong></td>
      <td colspan="3" align="left" valign="middle"><input name="fullname" type="text" class="input" id="fullname" size="50" value="<?= $val['fname']; ?>" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Username</strong></td>
      <td colspan="3" align="left" valign="middle"><input type="text" name="user_name" id="user_name"  class="input" value="<?= $val['uid']; ?>" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Email</strong></td>
      <td colspan="3" align="left" valign="middle"><input name="email" type="text" class="input" id="email" size="50" value="<?= $val['email']; ?>" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><strong>Change Password</strong></td>
      <td colspan="3" align="left" valign="middle"><input name="c_pwd" type="checkbox" id="c_pwd" value="Yes" onclick="showPWD()" /></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle"><div id="showpwd" style="display:none"><strong>Password</strong> &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;
        <input type="password" name="password" id="pass_word"  class="input" />
        <br />
        <br />
        <strong>Confirm Password</strong> &nbsp;&nbsp;
        &nbsp;&nbsp;
        &nbsp;&nbsp;
        <input type="password" name="password2" id="pass_word2"  class="input" />
      </div></td>
    </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;</td>
      <td width="7%" align="left" valign="middle"><input type="submit" name="button" id="button" value="Update User"  class="btn"  onclick="return validate_upd()" /></td>
      <td width="6%" align="left" valign="middle"><input type="reset" name="button2" id="button2" value="Reset"  class="btn" /></td>
      <td width="63%" align="left" valign="middle">&nbsp;
        <div id="showupdMsg" style="color:#F30"></div></td>
    </tr>
  </table>
</form>

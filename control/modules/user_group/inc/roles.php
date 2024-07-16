<a href="javascript:;" onClick="showAddrole()"><img src="modules/user_group/images/add_group.png" border="0" /> Add Role </a>&nbsp; &nbsp; &nbsp; <a href="javascript:;" onClick="showDisablerole()"><img src="modules/user_group/images/disable_role.png" border="0" /> Disable Role </a>
<div id="addRole" style="display:none">
<br>
  <input type="text" name="role" id="role" class="input">
  <input type="submit" name="button" id="button" value="Add Role" class="btn" onClick="addRole()">
</div>
<div id="disableRole" style="display:none">
<br>
     <label>
        <select name="d_role" id="d_role">
          <? user_class::get_roles_for_drop_down_menu(); ?>
        </select>
    </label>
    <input type="submit" name="button" id="button" value="Enable / Disable Role" class="btn" onClick="disableRole()">
    
</div>
<br>
<div id="msgRole" style="color:#F30"></div><div id="msgRole2" style="color:#F30"></div>
<br />
<br />
<div style="width:100%; border:2px solid #F2F2F2">
<div id="showmsgRole"><script language="javascript">loadGridRole('modules/user_group/index.php?CMD=Show Roles')</script></div>
</div>
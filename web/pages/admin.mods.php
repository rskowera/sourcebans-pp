<?php
/*************************************************************************
This file is part of SourceBans++

Copyright � 2014-2019 SourceBans++ Dev Team <https://github.com/sbpp>

SourceBans++ is licensed under a
GNU GENERAL PUBLIC LICENSE Version 3.

You should have received a copy of the license along with this
work.  If not, see <https://www.gnu.org/licenses/gpl-3.0.txt>.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

This program is based off work covered by the following copyright(s):
SourceBans 1.4.11
Copyright � 2007-2014 SourceBans Team - Part of GameConnect
Licensed under GPLv3
Page: <http://www.sourcebans.net/> - <http://www.gameconnect.net/>
*************************************************************************/

if (!defined("IN_SB")) {
    echo "You should not be here. Only follow links!";
    die();
}
global $userbank, $theme;

new AdminTabs([
    ['name' => 'List MODs', 'permission' => ADMIN_OWNER|ADMIN_LIST_MODS],
    ['name' => 'Add new MOD', 'permission' => ADMIN_OWNER|ADMIN_ADD_MODS]
], $userbank);

$mod_list = $GLOBALS['db']->GetAll("SELECT * FROM `" . DB_PREFIX . "_mods` WHERE mid > 0 ORDER BY name ASC") ;
$query = $GLOBALS['db']->GetRow("SELECT COUNT(mid) AS cnt FROM `" . DB_PREFIX . "_mods`") ;
$mod_count = $query['cnt'];
?>
<div id="admin-page-content">
    <!-- List Mods -->
    <div class="tabcontent" id="List MODs">
<?php
$theme->assign('mod_count', $mod_count);
$theme->assign('permission_listmods', $userbank->HasAccess(ADMIN_OWNER | ADMIN_LIST_MODS));
$theme->assign('permission_editmods', $userbank->HasAccess(ADMIN_OWNER | ADMIN_EDIT_MODS));
$theme->assign('permission_deletemods', $userbank->HasAccess(ADMIN_OWNER | ADMIN_DELETE_MODS));
$theme->assign('mod_list', $mod_list);

$theme->display('page_admin_mods_list.tpl');
?>
    </div>
    <!-- Add Mods -->
    <div class="tabcontent" id="Add new MOD">
<?php
$theme->assign('permission_add', $userbank->HasAccess(ADMIN_OWNER | ADMIN_ADD_MODS));
$theme->display('page_admin_mods_add.tpl');
?>
    </div>
</div>

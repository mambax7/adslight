<{if $adslight_active_menu == 1 }>
<{include file='db:adslight_menu.tpl'}>
<{/if}>
<{include file='db:adslight_search.tpl'}>
<br />
<{$select_go_cats}>
<br /><br />
<h1><{$cat_title}><{$Feed_RSS_cat}></h1>
<{$category_path}><br /><br />
<table cellspacing="1" class="outer" style="width:100%;">
    <tr>
	<td class="odd" align="center">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<{if $lang_subcat}>
			<tr>
				<td colspan="3">
					<{$lang_subcat}>
				</td>
			</tr>
			<{else}>
			<tr>
				<td colspan="3">
				</td>
			</tr>
			<tr>
			<{/if}>
		<td colspan="2">
<table width="90%"><br />
<tr>
<{foreach item=subcat from=$subcategories}>
	<td align="left">
	<table cellspacing="2" cellpadding='0' align="left">
						<tr>
							<td rowspan="2" valign="top" align="left" width="50"></td>
							<td valign="top" align="left">
								<div align="left">
									<a class="catlist" href="viewcats.php?cid=<{$subcat.id}>"><strong><{$subcat.title}></strong></a>&nbsp;-&nbsp;[<{$subcat.totallisting}>]</div>
							</td>
						</tr>
						<tr>
							<td align="left">
							</td>
						</tr>
	</table>
</td>
	<{if $subcat.count is div by 1}>
</tr>
<tr>
<{/if}>
<{/foreach}>
</table>
</td>
<td align="right">
<{if $lang_subcat}>
<{if $adslight_use_catscode == 1}>
<{$adslight_cats_code}>
<{/if}>
<{else}>
<{/if}><br />
</td>
</tr>
		</table>
</td>
  </tr>
  <tr>
  <td>
<{if $show_nav == true}>
      <div align="center">
				<strong><{$lang_sortby}></strong>
				<{$lang_title}>
				<font color="#1d1d1d">: </font><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=titleA"><img src="assets/images/up.gif" align="top" alt="<{$lang_titleatoz}>" border="0" /></a><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=titleD"><img src="assets/images/down.gif" border="0" align="top" alt="<{$lang_titleztoa}>" /></a>&nbsp;
				<{$lang_price}>
				<span style="color: #1d1d1d; ">: </span><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=priceA"><img src="assets/images/up.gif" border="0" align="top" alt="<{$lang_pricelow}>" /></a><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=priceD"><img src="assets/images/down.gif" border="0" align="top" alt="<{$lang_pricehigh}>" /></a>&nbsp;
				<{$lang_date}>
				<font color="#1d1d1d">: </font><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=dateA"><img src="assets/images/up.gif" border="0" align="top" alt="<{$lang_dateold}>" /></a><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=dateD"><img src="assets/images/down.gif" border="0" align="top" alt="<{$lang_datenew}>" /></a>&nbsp;
				<{$lang_popularity}>
				<font color="#1d1d1d">: </font><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=hitsA"><img src="assets/images/up.gif" border="0" align="top" alt="<{$lang_popularityleast}>" /></a><a rel="nofollow" href="viewcats.php?cid=<{$cat}>&orderby=hitsD"><img src="assets/images/down.gif" border="0" align="top" alt="<{$lang_popularitymost}>" /></a><br />
				<br />
				<font color="#ff6203">
					<{$lang_cursortedby}>
				</font></div>
<{/if}>
<div align="center"><{$nav_page}><br /></div>
<{if $use_extra_code == 1}>
<{foreach from=$items item=item name=items}>
  <{if $smarty.foreach.items.iteration eq $index_code_place}>
  <{if $adslight_use_banner == 1}>
<table><tr><td align="center"><{$banner}></td></tr></table>
<{else}>
		<table><tr><td align="center"><{$index_extra_code}></td></tr></table>
				<{/if}><{/if}>
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
				<tr class=<{cycle values="odd,even"}>>
                    <{if $xoops_isadmin}>
					<td width="20">
					<{$item.admin}>
					</td>
					<{/if}>
					<td width="24" align="right">
					<{if $item.photo}>
					<{$item.photo}>
					<{else}>
					<{$item.no_photo}>
					<{/if}>
					</td>
					<td><strong>
					<{$item.title}>&nbsp;
					</strong><br />
					<{$item.type}><br />
					<{if $item.price!=""}><strong><{$item.price}></strong>&nbsp;-&nbsp;<{$item.price_typeprice}>
					<{else}>&nbsp;
					<{/if}><br />
					<{if $item.sold}><{$item.sold}><{/if}>
					</td>
					<td width="80" align="left">
					<{$item.local}>
					</td>
				</tr>
				</table><br />
				<{/foreach}><{else}>
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
			   <{foreach item=item from=$items}>
			   <tr class=<{cycle values="odd,even"}>>
                    <{if $xoops_isadmin}>
					<td width="20">
					<{$item.admin}>
					</td>
					<{/if}>
					<td width="24" align="right">
					<{if $item.photo}>
					<{$item.photo}>
					<{else}>
					<{$item.no_photo}>
					<{/if}>
					</td>
					<td><strong>
					<{$item.title}>&nbsp;
					</strong><br />
					<{$item.type}><br />
					<{if $item.price!=""}><strong><{$item.price}></strong>&nbsp;-&nbsp;<{$item.price_typeprice}>
					<{else}>&nbsp;
					<{/if}><br />
					<{if $item.sold}><{$item.sold}><{/if}>
					</td>
					<td align="center">
					<{$item.local}>
					</td>
				</tr>
				<{/foreach}>
			</table>
	<{/if}><{if !$lang_subcat}><{if !$item}><br /><center><{$not_adds_in_this_cat}></center><br /><br /><{/if}><{/if}>
		</td>
  </tr>
</table>
<br /><{$category_path}>
<div align="center"><br /><{$nav_page}></div>
<{include file='db:system_notification_select.html'}>
<br />
<br />
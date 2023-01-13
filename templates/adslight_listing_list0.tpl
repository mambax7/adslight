<{include file="db:adslight_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Listing</strong> </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                    <th><{$smarty.const.MD_ADSLIGHT_LISTING_LID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_CID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TITLE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_STATUS}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_EXPIRE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TYPE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_DESCTEXT}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TEL}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_PRICE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TYPEPRICE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TYPECONDITION}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_DATE_CREATED}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_EMAIL}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_SUBMITTER}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_USID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TOWN}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_COUNTRY}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_CONTACTBY}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_PREMIUM}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_VALID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_PHOTO}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_HITS}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_ITEM_RATING}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_ITEM_VOTES}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_USER_RATING}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_USER_VOTES}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_COMMENTS}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_REMIND}></th><th  width="80"><{$smarty.const.MD_ADSLIGHT_ACTION}></th>
            </tr>
            </thead>
        <{foreach item=listing from=$listing}>
            <tbody>
            <tr>

                             <td><{$listing.lid}></td>
                    <td><{$listing.cid}></td>
                    <td><{$listing.title}></td>
                    <td><{$listing.status}></td>
                    <td><{$listing.expire}></td>
                    <td><{$listing.type}></td>
                    <td><{$listing.desctext}></td>
                    <td><{$listing.tel}></td>
                    <td><{$listing.price}></td>
                    <td><{$listing.typeprice}></td>
                    <td><{$listing.typecondition}></td>
                    <td><{$listing.date_created}></td>
                    <td><{$listing.email}></td>
                    <td><{$listing.submitter}></td>
                    <td><{$listing.usid}></td>
                    <td><{$listing.town}></td>
                    <td><{$listing.country}></td>
                    <td><{$listing.contactby}></td>
                    <td><{$listing.premium}></td>
                    <td><{$listing.valid}></td>
                    <td><img src="<{$xoops_url}>/uploads/adslight/<{$listing.photo}>" style="max-width:100px" alt="listing"></td>
                   <td><{$listing.hits}></td>
                    <td><{$listing.item_rating}></td>
                    <td><{$listing.item_votes}></td>
                    <td><{$listing.user_rating}></td>
                    <td><{$listing.user_votes}></td>
                    <td><{$listing.comments}></td>
                    <td><{$listing.remind}></td>
                                <td>
                       <a href="listing.php?op=view&lid=<{$listing.lid}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>
                       <{if $xoops_isadmin === true}>
                       <a href="listing.php?op=edit&lid=<{$listing.lid}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" ></a>
                       <a href="admin/listing.php?op=delete&lid=<{$listing.lid}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                       <{/if}>
                   </td>
                </tr>
               </tbody>
        <{/foreach}>
    </table>
</div>
<{$pagenav|default:""}>
    <{$commentsnav|default:"" }> <{$lang_notice|default:"" }>
    <{if $comment_mode|default:""  == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode|default:""  == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode|default:""  == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:adslight_footer.tpl"}>

<{include file="db:adslight_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Listing</strong> </h2></div>

    <table class="table table-striped">
        <thead>
                <tr>
                    <th><{$smarty.const.MD_ADSLIGHT_LISTING_LID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_CID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TITLE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_STATUS}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_EXPIRE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TYPE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_DESCTEXT}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TEL}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_PRICE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TYPEPRICE}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TYPECONDITION}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_DATE_CREATED}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_EMAIL}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_SUBMITTER}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_USID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_TOWN}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_COUNTRY}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_CONTACTBY}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_PREMIUM}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_VALID}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_PHOTO}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_HITS}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_ITEM_RATING}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_ITEM_VOTES}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_USER_RATING}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_USER_VOTES}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_COMMENTS}></th>  <th><{$smarty.const.MD_ADSLIGHT_LISTING_REMIND}></th><th  width="80"><{$smarty.const.MD_ADSLIGHT_ACTION}></th>
            </tr>
            </thead>
        <{foreach item=listingitem from=$listing}>
            <tbody>
            <tr>

                    <td><{$listingitem.lid}></td>
                    <td><{$listingitem.cid}></td>
                    <td><{$listingitem.title}></td>
                    <td><{$listingitem.status}></td>
                    <td><{$listingitem.expire}></td>
                    <td><{$listingitem.type}></td>
                    <td><{$listingitem.desctext}></td>
                    <td><{$listingitem.tel}></td>
                    <td><{$listingitem.price}></td>
                    <td><{$listingitem.typeprice}></td>
                    <td><{$listingitem.typecondition}></td>
                    <td><{$listingitem.date_created}></td>
                    <td><{$listingitem.email}></td>
                    <td><{$listingitem.submitter}></td>
                    <td><{$listingitem.usid}></td>
                    <td><{$listingitem.town}></td>
                    <td><{$listingitem.country}></td>
                    <td><{$listingitem.contactby}></td>
                    <td><{$listingitem.premium}></td>
                    <td><{$listingitem.valid}></td>
                    <td><img src="<{$xoops_url}>/uploads/adslight/<{$listingitem.photo}>" style="max-width:100px" alt="listing"></td>
                   <td><{$listingitem.hits}></td>
                    <td><{$listingitem.item_rating}></td>
                    <td><{$listingitem.item_votes}></td>
                    <td><{$listingitem.user_rating}></td>
                    <td><{$listingitem.user_votes}></td>
                    <td><{$listingitem.comments}></td>
                    <td><{$listingitem.remind}></td>
                                <td>
                       <a href="listing.php?op=view&lid=<{$listingitem.lid}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 'search.png'}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>
                       <{if $xoops_isadmin === true}>
                       <a href="listing.php?op=edit&lid=<{$listingitem.lid}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>" ></a>
                       <a href="admin/listing.php?op=delete&lid=<{$listingitem.lid}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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

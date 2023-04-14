<{include file="db:adslight_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Listing </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_ADSLIGHT_LISTING_LID}></td>
            <td><{$listing.lid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_CID}></td>
            <td><{$listing.cid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_TITLE}></td>
            <td><{$listing.title}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_STATUS}></td>
            <td><{$listing.status}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_EXPIRE}></td>
            <td><{$listing.expire}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_TYPE}></td>
            <td><{$listing.type}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_DESCTEXT}></td>
            <td><{$listing.desctext}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_TEL}></td>
            <td><{$listing.tel}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_PRICE}></td>
            <td><{$listing.price}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_TYPEPRICE}></td>
            <td><{$listing.typeprice}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_TYPECONDITION}></td>
            <td><{$listing.typecondition}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_DATE_CREATED}></td>
            <td><{$listing.date_created}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_EMAIL}></td>
            <td><{$listing.email}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_SUBMITTER}></td>
            <td><{$listing.submitter}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_USID}></td>
            <td><{$listing.usid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_TOWN}></td>
            <td><{$listing.town}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_COUNTRY}></td>
            <td><{$listing.country}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_CONTACTBY}></td>
            <td><{$listing.contactby}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_PREMIUM}></td>
            <td><{$listing.premium}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_VALID}></td>
            <td><{$listing.valid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_PHOTO}></td>
            <td><img src="<{$xoops_url}>/uploads/adslight/<{$listing.photo}>" alt="listing" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_HITS}></td>
            <td><{$listing.hits}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_ITEM_RATING}></td>
            <td><{$listing.item_rating}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_ITEM_VOTES}></td>
            <td><{$listing.item_votes}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_USER_RATING}></td>
            <td><{$listing.user_rating}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_USER_VOTES}></td>
            <td><{$listing.user_votes}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_COMMENTS}></td>
            <td><{$listing.comments}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_LISTING_REMIND}></td>
            <td><{$listing.remind}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_ADSLIGHT_ACTION}></td>
            <td>
                <!--<a href="listing.php?op=view&lid=<{$listing.lid}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 'search.png'}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>&nbsp;-->
                <{if $xoops_isadmin === true}>
                    <a href="listing.php?op=edit&lid=<{$listing.lid}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    &nbsp;
                    <a href="admin/listing.php?op=delete&lid=<{$listing.lid}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                <{/if}>
            </td>
        </tr>
        </tbody>

    </table>
</div>
<div id="pagenav"><{$pagenav}></div>
<{$commentsnav|default:"" }> <{$lang_notice|default:"" }>
<{if $comment_mode|default:"" == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode|default:""  == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode|default:""  == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:adslight_footer.tpl"}>

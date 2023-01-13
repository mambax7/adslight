<{if $itemvotesRows > 0}>
    <div class="outer">
        <form name="select" action="itemvotes.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('itemvotesId[]');} else if (isOneChecked('itemvotesId[]')) {return true;} else {alert('<{$smarty.const.AM_ADSLIGHT_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1">
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const.AM_ADSLIGHT_SELECT}></option>
                    <option value="delete"><{$smarty.const.AM_ADSLIGHT_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>">
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav|default:''}></div>
            </div>

            <!-- pager -->
            <div id="pager" class="pager">
                <form>
                    <img src="<{$mod_url}>/assets/js/tablesorter/css/images/first.png" class="first">
                    <img src="<{$mod_url}>/assets/js/tablesorter/css/images/prev.png" class="prev">
                    <!-- the "pagedisplay" can be any element, including an input -->
                    <span class="pagedisplay" data-pager-output-filtered="{startRow:input} &ndash; {endRow} / {filteredRows} of {totalRows} total rows"></span>
                    <img src="<{$mod_url}>/assets/js/tablesorter/css/images/next.png" class="next">
                    <img src="<{$mod_url}>/assets/js/tablesorter/css/images/last.png" class="last">
                    <select class="pagesize">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="all">All Rows</option>
                    </select>
                </form>
            </div>

            <table id="sortTable" class="tablesorter-blue"  cellpadding="0" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorratingid}></th>
                    <th class="left"><{$selectorlid}></th>
                    <th class="left"><{$selectorratinguser}></th>
                    <th class="left"><{$selectorrating}></th>
                    <th class="left"><{$selectorratinghostname}></th>
                    <th class="left"><{$selectorratingtimestamp}></th>

                    <th class="center width5"><{$smarty.const.AM_ADSLIGHT_FORM_ACTION}></th>
                </tr>
                </thead>

                <tbody>
                <{foreach item=itemvotesArray from=$itemvotesArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="itemvotes_id[]" title="itemvotes_id[]" id="itemvotes_id[]" value="<{$itemvotesArray.itemvotes_id|default:''}>"></td>
                        <td class='left'><{$itemvotesArray.ratingid}></td>
                        <td class='left'><{$itemvotesArray.lid}></td>
                        <td class='left'><{$itemvotesArray.ratinguser}></td>
                        <td class='left'><{$itemvotesArray.rating}></td>
                        <td class='left'><{$itemvotesArray.ratinghostname}></td>
                        <td class='left'><{$itemvotesArray.ratingtimestamp}></td>


                        <td class="center width5"><{$itemvotesArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
                </tbody>
            </table>
            <br>
            <br>
            <{else}>
            <table class="tablesorter-blue" width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorratingid}></th>
                    <th class="left"><{$selectorlid}></th>
                    <th class="left"><{$selectorratinguser}></th>
                    <th class="left"><{$selectorrating}></th>
                    <th class="left"><{$selectorratinghostname}></th>
                    <th class="left"><{$selectorratingtimestamp}></th>

                    <th class="center width5"><{$smarty.const.AM_ADSLIGHT_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $itemvotes</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>

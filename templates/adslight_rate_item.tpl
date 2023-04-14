<br>
<table class="width80 bnone" cellpadding=1 cellspacing=0>
    <tr>
        <td>
            <h4><{$link.title|default:''}></h4>
            <ul>
                <li><{$lang_voteonce|default:''}>
                <li><{$lang_ratingscale|default:''}>
                <li><{$lang_beobjective|default:''}>
                <li><{$lang_donotvote|default:''}>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="center">
            <form method="post" action="rate-item.php">
                <{securityToken}><{*//mb*}>
                <input type="hidden" name="lid" value="<{$link.lid|default:''}>">
                <select name="rating">
                    <option>--</option>
                    <option>10</option>
                    <option>9</option>
                    <option>8</option>
                    <option>7</option>
                    <option>6</option>
                    <option>5</option>
                    <option>4</option>
                    <option>3</option>
                    <option>2</option>
                    <option>1</option>
                </select>&nbsp;&nbsp;
                <input type="submit" name="submit" value="<{$lang_rateit|default:''}>"><input type=button value="<{$lang_cancel|default:''}>" onclick="location='<{$xoops_url}>/modules/adslight/viewads.php?lid=<{$link.lid|default:''}>'">
            </form>
        </td>
    </tr>
</table>

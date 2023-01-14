<?php declare(strict_types=1);

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project (https://xoops.org)
 * @license      GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author       XOOPS Development Team
 * @author       Pascal Le Boustouller: original author (pascal.e-xoops@perso-search.com)
 * @author       Luc Bizet (www.frxoops.org)
 * @author       jlm69 (www.jlmzone.com)
 * @author       mamba (www.xoops.org)
 */
$rssContent = [];
/**
 * @param DOMDocument $item
 * @param string      $type
 * @return array
 */
function rssTags($item, $type): array
{
    $y                 = [];
    $tnl               = $item->getElementsByTagName('title');
    $tnl               = $tnl->item(0);
    $title             = $tnl->firstChild->textContent;
    $tnl               = $item->getElementsByTagName('link');
    $tnl               = $tnl->item(0);
    $link              = $tnl->firstChild->textContent;
    $tnl               = $item->getElementsByTagName('pubDate');
    $tnl               = $tnl->item(0);
    $date              = $tnl->firstChild->textContent;
    $tnl               = $item->getElementsByTagName('description');
    $tnl               = $tnl->item(0);
    $description       = $tnl->firstChild->textContent;
    $y['title']        = $title;
    $y['link']         = $link;
    $y['date_created'] = $date;
    $y['description']  = $description;
    $y['type']         = $type;

    return $y;
}

/**
 * @param DOMDocument $channel
 */
function rssChannel($channel): void
{
    global $rssContent;
    $items = $channel->getElementsByTagName('item');
    // Processing channel
    $y            = rssTags($channel, 0);        // get description of channel, type 0
    $rssContent[] = $y;
    // Processing articles
    foreach ($items as $item) {
        $y            = rssTags($item, 1);    // get description of article, type 1
        $rssContent[] = $y;
    }
}

/**
 * @param string $url
 */
function rssRetrieve($url): void
{
    global $rssContent;
    $doc = new DOMDocument();
    $doc->load($url);
    $channels   = $doc->getElementsByTagName('channel');
    $rssContent = [];
    foreach ($channels as $channel) {
        rssChannel($channel);
    }
}

/**
 * @param string $url
 */
function rssRetrieveLinks($url): void
{
    global $rssContent;
    $doc = new DOMDocument();
    $doc->load($url);
    $channels   = $doc->getElementsByTagName('channel');
    $rssContent = [];
    foreach ($channels as $channel) {
        $items = $channel->getElementsByTagName('item');
        foreach ($items as $item) {
            $y            = rssTags($item, 1);    // get description of article, type 1
            $rssContent[] = $y;
        }
    }
}

/**
 * @param string $url
 * @param int    $size
 * @return string
 */
function rssLinks($url, $size = 15): string
{
    global $rssContent;
    $recents = [];
    $page    = '<ul>';
    rssRetrieveLinks($url);
    if ($size > 0) {
        $recents = array_slice($rssContent, 0, $size + 1);
    }
    foreach ($recents as $article) {
        $type = $article['type'];
        if (0 === $type) {
            continue;
        }
        $title = $article['title'];
        $link  = $article['link'];
        $page  .= "<li><a href=\"{$link}\">{$title}</a></li>\n";
    }

    return $page . "</ul>\n";
}

/**
 * @param string $url
 * @param int    $size
 * @param int    $site
 * @return string
 */
function rssDisplay(
    $url,
    $size = 15,
    $site = 0
): string {
    global $rssContent;
    $recents = [];
    $opened  = false;
    $page    = '';
    $site    = 0 === (int)$site ? 1 : 0;
    rssRetrieve($url);
    if ($size > 0) {
        $recents = array_slice($rssContent, $site, $size + 1 - $site);
    }
    foreach ($recents as $article) {
        $type = $article['type'];
        if (0 === $type) {
            if ($opened) {
                $page   .= '</ul>';
                $opened = false;
            }
            $page .= '<b>';
        } elseif (!$opened) {
            $page   .= '<ul>';
            $opened = true;
        }

        $title       = $article['title'];
        $link        = $article['link'];
        $page        .= "<tr class=\"even\"><td width=\"300\"><img src=\"/assets/images/admin/info_button.png\" border=\"0\"> <a href=\"{$link}\">{$title}</a><br>";
        $description = $article['description'];
        if (false !== $description) {
            $page .= "{$description}<br><br></td></tr>";
        }
        $page .= '';
        if (0 === $type) {
            $page .= '</b>';
        }
    }
    if ($opened) {
        $page .= '</ul>';
    }

    return $page;
}

/**
 * @param string $url
 * @param int    $size
 * @param int    $site
 * @param int    $withdate
 * @return string
 */
function rssDisplayForum(
    $url,
    $size = 15,
    $site = 0,
    $withdate = 0
): string {
    global $rssContent;
    $recents = [];
    $opened  = false;
    $page    = '';
    $site    = 0 === (int)$site ? 1 : 0;
    rssRetrieve($url);
    if ($size > 0) {
        $recents = array_slice($rssContent, $site, $size + 1 - $site);
    }
    foreach ($recents as $article) {
        $type = $article['type'];
        if (0 === $type) {
            if ($opened) {
                $page   .= '</ul>';
                $opened = false;
            }
            $page .= '<b>';
        } elseif (!$opened) {
            $page   .= '<ul>';
            $opened = true;
        }

        $title = $article['title'];
        $link  = $article['link'];

        $page .= "<img src=\"../assets/images/admin/comment.png\" border=0 >&nbsp;&nbsp;&nbsp;<a href=\"{$link}\">{$title}</a><br><br>";

        if (0 === $type) {
            $page .= '</b>';
        }
    }
    if ($opened) {
        $page .= '</ul>';
    }

    return $page;
}

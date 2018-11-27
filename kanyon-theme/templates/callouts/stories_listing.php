<?php 
    $News = new TheCampaignNews;

    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    if (isset($_GET['filter']) && $_GET['filter']!="") {
        $filter_query = 'JOIN the_campaign_news_category 
        ON the_campaign_news.id = the_campaign_news_category.news
        WHERE the_campaign_news_category.category = '.$_GET['filter'];
    } else {
        $filter_query = '';
    }

    $total_records_per_page = 5;

    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

    $total_records  = '';
    $q = sqlquery("SELECT COUNT(*) As total_records FROM the_campaign_news $filter_query");
    while ($f = sqlfetch($q)) $total_records = $f['total_records'];

    $rows  = array();
    $q = sqlquery("SELECT id FROM the_campaign_news $filter_query LIMIT $offset, $total_records_per_page");
    while ($f = sqlfetch($q)) $rows[] = $f;

    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1
?>

<div class="stories_listing">
    <div class="fs-row">
        <div class="fs-cell fs-lg-10 fs-lg-push-1">
            <ul class="stories_listing_inner">
                <?php  foreach ($rows as $key => $row): ?>
                <?php  $news = $News->get($row['id']); ?>
                    <?php if ($key == 0) {
                        continue;
                    } ?>
                    <li class="stories_listing_item js-stories-item">
                        <article class="story_item_article" itemscope="itemscope" itemtype="http://schema.org/NewsArticle">
                            <a class="story_item_image_link" href="#">
                                <figure class="story_figure">
                                    <picture class="media_picture">
                                        <source media="(min-width: 500px)" srcset="<?= str_replace('{staticroot}', STATIC_ROOT, $news['image']) ?>" />
                                        <source media="(min-width: 0px)" srcset="<?= str_replace('{staticroot}', STATIC_ROOT, $news['image']) ?>" /> 
                                        <img class="media_image" src="<?= str_replace('{staticroot}', STATIC_ROOT, $news['image']) ?>" alt=""> 
                                    </picture>
                                </figure>
                            </a>
                            <div class="story_listing_item_inner">
                                <header class="story_header"> 
                                    <span class="story_tags">
                                        <?php $News->the_category($news['id']) ?>
                                    </span>
                                    <h3 class="story_title" itemprop="headline"> 
                                        <a class="story_title_link" href="<?= $news['detail_link'] ?>">
                                            <?= $news['title'] ?>
                                        </a>
                                    </h3>
                                </header>
                                <div class="story_body">
                                    <div class="story_description" itemprop="description">
                                        <?= $news['blurb'] ?>
                                    </div>
                                </div>
                                <footer class="story_footer"> 
                                    <a class="story_link" href="<?= $news['detail_link'] ?>" aria-label="<?= $news['title'] ?>" itemprop="url">
                                        <span class="news_item_link_label">Read The Story</span>
                                    </a> 
                                </footer>
                            </div>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="pagination">
                <div class="pagination_inner">
                    <nav class="pagination_nav"> 
                        <?php for ($i=1; $i <= $total_no_of_pages; $i++): ?>
                            <?php $active = ($page_no == $i) ? 'active' : '' ?>
                            <a href="?page_no=<?= $i ?>" class="pagination_link <?= $active ?>"><?= $i ?></a> 
                        <?php endfor ?>                                    
                    </nav>
                    <div class="pagination_arrows"> 
                        <?php $prev_disable = ($page_no <= 1 ) ? 'pagination_arrow_disabled' : '' ?>
                        <?php $next_disable = ($page_no >= $total_no_of_pages) ? 'pagination_arrow_disabled' : '' ?>
                        <?php $prev_link    = (($page_no - 1) <= 0) ? 1 : ($page_no - 1) ?>
                        <?php $next_link    = (($page_no + 1) >= $total_no_of_pages) ? $total_no_of_pages : ($page_no - 1) ?>
                        <a class="pagination_arrow pagination_arrow_left <?= $prev_disable ?>" aria-label="Previous" href="?page_no=<?= $prev_link ?>"></a> 
                        <a class="pagination_arrow pagination_arrow_right <?= $next_disable ?>" aria-label="Next" href="?page_no=<?= $next_link ?>"></a> 
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

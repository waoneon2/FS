<?
	class TheCampaignNews extends BigTreeModule {
		var $Table = "the_campaign_news";
        var $Module = "1";

        function __construct() {
            global $cms, $bigtree;
            $this->Link = $cms->getLink($bigtree['page']['id']);
        }

        function get($item) {
            $item = parent::get($item);
            $item["detail_link"]   = $this->Link."details/".$item["route"]."/";
            $item["listing_link"]  = $this->Link;
            return $item;
         }

        function get_category($id) {
            $categories = array();
            $q = sqlquery("SELECT the_campaign_category.* 
            FROM the_campaign_category 
            JOIN the_campaign_news_category 
            ON the_campaign_category.id = the_campaign_news_category.category 
            WHERE the_campaign_news_category.news = ' $id'");
            while ($f = sqlfetch($q)) $categories[] = $f;
            return $categories;
        }

        function the_category($id) {
            $categories = $this->get_category($id);
            foreach ($categories as $i => $cat) {
                if ($i == (count($categories)-1)) {
                    echo $cat['category'];
                } else {
                    echo "<a href='".$cat['link']."'>".$cat['category']."</a>";
                }
            }
        }

        function get_all_category() {
            $q = sqlquery("SELECT the_campaign_category.* FROM the_campaign_category");
            while ($f = sqlfetch($q)) $categories[] = $f;
            return $categories;
        }
	}
?>

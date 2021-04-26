<?PHP
    
namespace YouTube;

class Search{
  protected $query;
  protected $video_links;
  protected $main_link;
  
  public function search($query){
    $query .= " video site:youtube.com";
    $query = urlencode($query);
    $base = "http://www.google.com/search?safe=strict&q=";
    $url = $base.$query;
    $browser = new Browser;
    $result = $browser->get($url);
    return $result;
  }
  
  public function search_links($query){
    $search_results = $this->search($query);
    $links = $this->strip_links($search_results);
    return $links;
  }
  
  public function strip_links($document){	
    preg_match_all("#(?<tag><a[^>]+href=\"(?<link>.*?)\"[^>]*>(?<link_text>.*?)</a>)#",$document,$links);
    $links_filtered = array_filter($links, "is_string", ARRAY_FILTER_USE_KEY);
    return $links_filtered;
  }
  
  public function search_yt_links($query){
    $search_results = $this->search($query);
    $yt_links = $this->strip_yt_links($search_results);
    return $yt_links;
  }
  
  public function strip_yt_links($document){
    preg_match_all("#(?<tag><a[^>]+href=\".*?(?<yt_link>https?\://[w]{3}?\.?youtube.com/[^\"]*)\"[^>]*>(?<yt_link_text>.*?)</a>)#ix",$document,$yt_links);
    $yt_links_filtered = array_filter($yt_links, "is_string", ARRAY_FILTER_USE_KEY);
    return $yt_links_filtered;
  }
  
}
    
?>

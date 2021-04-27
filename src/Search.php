<?PHP
    
namespace YouTube;

class Search{
  protected $indexdir = "https://my-ytapp.herokuapp.com/index.php";
  protected $search_engine = "http://www.google.com/search?safe=strict&q=";
  protected $default_query = " video site:youtube.com";
  
  //set and get search engine URL to use in       
  //searches. Default is Google 
  public function set_search_engine_url($url)
  {
    $this->search_engine = $url;
  }
  
  public function get_search_engine_url(){
    return $this->search_engine;
  }
  
  //set and get query string to be added to 
  //every incoming search query in the 
  //current instanse of the class.
  public function set_default_query($query){
    $this->default_query = $query;
  }
  
  public function get_default_query(){
    return $this->default_query;
  }
  
  public function search($query){
    $query .= $this->default_query;
    $query = urlencode($query);
    $base = $this->search_engine;
    $url = $base.$query;
    $browser = new Browser;
    $result = $browser->get($url);
    return $result;
  }
  
  public function search_yt_links($query){
    $search_results = $this->search($query);
    preg_match_all("#(?<tag><a[^>]+href=\".*?(?<yt_link>https?\://(?:w{3}|m)?\.?youtube.com/watch[^\"]*)\"[^>]*>(?<yt_link_text>.*?)</a>)#ix",$search_results,$yt_links);
    $yt_links_filtered = array_filter($yt_links, "is_string", ARRAY_FILTER_USE_KEY);
    return $yt_links_filtered;
  }
  
  public function search_ready_download($query){
    $search_results = $this->search($query);
    preg_match_all("#(?<tag><a[^>]+href=\".*?(?<yt_link>https?\://(?:w{3}|m)?\.?youtube.com/watch[^\"]*)\"[^>]*>(?<yt_link_text>.*?)</a>)#ix",$search_results,$yt_links);
    
    //remove unnamed keys from array
    $yt_links_filtered = array_filter($yt_links, "is_string", ARRAY_FILTER_USE_KEY);
    //rewrite anchor tags to URL of 
    //downloader prefilled with YouTube link
    $regex = "#(<a[^>]+href=\").*?(https?\://(?:w{3}|m)?\.?youtube.com/watch[^\"]*\"[^>]*>.*?</a>)#i";
    $repstr ="$1".$this->indexdir."?url=$2";
    $ready_links = preg_replace($regex,
                                $repstr,
                         $yt_links_filtered);
    return $ready_links;
  }
  
  
  
}
    
?>

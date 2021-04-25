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
  
  public function strip_links($document)
	{	
		preg_match_all("#<a[^>]+href=\"(?<href>.*?)\"[^>]*>(?<link_text>.*?)</a>#",$document,$links);
		return $links;
	}
  
  public function search_yt_links($query){
    $links = $this->search_links($query);
    foreach($links as $key=>$val){
      if(preg_match("/^https?\/\/\:w{3}?\.?youtube\.com\/watch/",$val) !== 0){
        preg_match_all('/\b(([\w-]+:\/\/?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))/',$val,$matches);
        $links[$key] = $matches[0];
      }else{
        unset($links[$key]);
      }
    }
    return $links;
    
  }
  
}
    
?>

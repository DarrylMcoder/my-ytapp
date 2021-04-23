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
    echo $result;
    return $result;
  }
  
  public function search_links($query){
    $search_results = $this->search($query);
    $links = $this->strip_links($search_results);
  }
  
  public function strip_links($document)
	{	
		preg_match_all("'<\s*a\s.*?href\s*=\s*			# find <a href=
						([\"\'])?					# find single or double quote
						(?(1) (.*?)\\1 | ([^\s\>]+))		# if quote found, match up to next matching
													# quote, otherwise match up to next space
						'isx",$document,$links);
						

		// catenate the non-empty matches from the conditional subpattern

		while(list($key,$val) = each($links[2]))
		{
			if(!empty($val))
				$match[] = $val;
		}				
		
		while(list($key,$val) = each($links[3]))
		{
			if(!empty($val))
				$match[] = $val;
		}		
		
		// return the links
		return $match;
	}
  
}
    
?>

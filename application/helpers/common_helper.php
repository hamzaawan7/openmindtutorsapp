<?php
function resizeImg($img, $w, $h, $force="proportion")
	{

		// The file

		$filename = $img;

		// Set a maximum height and width

		$width = $w;

		$height = $h;

		// Get new dimensions

		list($width_orig, $height_orig) = getimagesize($filename);
		

		$size = getimagesize($filename);
		$filetype = $size['mime'];
		if ($width_orig > $width && $height_orig > $height)

		{

			if ($force=="fix")

			{

				$width = $w;

				$height = $h;

			}

			else if ($force=="proportion")

			{

				if ($width_orig > $height_orig){	// if width is bigger	/

					$height = ($width / $width_orig) * $height_orig;

				}else if ($width_orig < $height_orig){	// if height is bigger	/

					$width = ($height / $height_orig) * $width_orig;

				}

			}

			else if ($force=="width")

			{

				if ($width_orig > $w){	// if width is bigger	/

					$width = $w;

					$height = ($width / $width_orig) * $height_orig;

				}else{

					$width = $width_orig;

					$height = $height_orig;

				}

			}

			else if ($force=="height")

			{

				if ($height_orig > $h){	// if width is bigger	/

					$height = $h;

					$width = ($height / $height_orig) * $width_orig;

				}else{

					$width = $width_orig;

					$height = $height_orig;

				}

			}

			

			// Resample

			$image_p = imagecreatetruecolor($width, $height);

						
			if($filetype == "image/png")
				{
				$image = @imagecreatefrompng($filename); 		
				}
			elseif($filetype == "image/gif")
				{
				$image = @imagecreatefromgif($filename);		
				}	
			else{
				$image = @imagecreatefromjpeg($filename);
				
				}
			//$image = imagecreatefromjpeg($filename);

			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

			imagejpeg($image_p, $img, 80);  //Saving The Image.

		}		

	}
//**************************************************************************//
function sendmail($to, $subject, $body){
	$headers = 'From: '. FROM_EMAIL_ADDRESS . "\r\n" .
		'Reply-To: '. FROM_EMAIL_ADDRESS . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	mail($to, $subject, $body, $headers);
}
function is_admin_login($value){
	
	if ( isset($value) && $value ==true )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function pr($data)
{
	print '<pre>';
	print_r($data);
	print '<pre>';
}

function get_status($status_id){
    $ci =& get_instance();
    $ci->load->database();
    $sql = "select * from order_statuses where id=".$status_id;
    $q = $ci->db->query($sql);
    $row = $q->row_array();
    @$status_name = $row['name'];
    return $status_name;

}

function check_if_order_confirmed($order_id){

    $ci =& get_instance();
    $client_staff_id = $ci->session->userdata('hyatt_staff_id');
    $ci->load->database();
    $sql = "select * from orders left outer join order_items on
            order_items.id=orders.id where order_id=".$order_id." and add_product_status=0
            and orders.client_staff_id=".$client_staff_id;
    $q = $ci->db->query($sql);
    $row = $q->row_array();
    if(!empty($row)){
        $status_name = $row['add_product_status'];
    }else{
        $status_name = 'no_record';
    }

    return $status_name;

}

function check_if_order_has_items($order_id){

    $ci =& get_instance();
    $client_staff_id = $ci->session->userdata('hyatt_staff_id');
    $ci->load->database();
    $sql = "select * from order_items where order_id=".$order_id;
    $q = $ci->db->query($sql);
    $row = $q->row_array();
    if(empty($row)){
        return 0;
    }else{
        return 1;
    }

    return $status_name;

}

function exculde_words( $opt = '' )
{
	if ( $opt == '' )
	{
		$opt['type'] = 'stop_words';
	}
	
	if ( isset($opt['type']) && $opt['type'] == 'stop_words' )
	{
		$words_arr = array("'ll", "'twas", "'ve", "10", "39", "I", "a", "a's", "able", "about", "above", "abroad", "abst", "accordance", "according", "accordingly", "across", "act", "actually", "ad", "added", "adj", "adopted", "ae", "af", "affected", "affecting", "affects", "after", "afterwards", "ag", "again", "against", "ago", "ah", "ahead", "ai", "ain't", "al", "all", "allow", "allows", "almost", "alone", "along", "alongside", "already", "also", "although", "always", "am", "amid", "amidst", "among", "amongst", "amoungst", "amount", "an", "and", "announce", "another", "any", "anybody", "anyhow", "anymore", "anyone", "anything", "anyway", "anyways", "anywhere", "ao", "apart", "apparently", "appear", "appreciate", "appropriate", "approximately", "aq", "ar", "are", "area", "areas", "aren", "aren't", "arent", "arise", "around", "arpa", "as", "aside", "ask", "asked", "asking", "asks", "associated", "at", "au", "auth", "available", "aw", "away", "awfully", "az", "b", "ba", "back", "backed", "backing", "backs", "backward", "backwards", "bb", "bd", "be", "became", "because", "become", "becomes", "becoming", "been", "before", "beforehand", "began", "begin", "beginning", "beginnings", "begins", "behind", "being", "beings", "believe", "below", "beside", "besides", "best", "better", "between", "beyond", "bf", "bg", "bh", "bi", "big", "bill", "billion", "biol", "bj", "bm", "bn", "bo", "both", "bottom", "br", "brief", "briefly", "bs", "bt", "but", "buy", "bv", "bw", "by", "bz", "c", "c'mon", "c's", "ca", "call", "came", "can", "can't", "cannot", "cant", "caption", "case", "cases", "cause", "causes", "cc", "cd", "certain", "certainly", "cf", "cg", "ch", "changes", "ci", "ck", "cl", "clear", "clearly", "click", "cm", "cn", "co", "co.", "com", "come", "comes", "computer", "con", "concerning", "consequently", "consider", "considering", "contain", "containing", "contains", "copy", "corresponding", "could", "could've", "couldn", "couldn't", "couldnt", "course", "cr", "cry", "cs", "cu", "currently", "cv", "cx", "cy", "cz", "d", "dare", "daren't", "date", "de", "dear", "definitely", "describe", "described", "despite", "detail", "did", "didn", "didn't", "differ", "different", "differently", "directly", "dj", "dk", "dm", "do", "does", "doesn", "doesn't", "doing", "don", "don't", "done", "down", "downed", "downing", "downs", "downwards", "due", "during", "dz", "e", "each", "early", "ec", "ed", "edu", "ee", "effect", "eg", "eh", "eight", "eighty", "either", "eleven", "else", "elsewhere", "empty", "end", "ended", "ending", "ends", "enough", "entirely", "er", "es", "especially", "et", "et-al", "etc", "even", "evenly", "ever", "evermore", "every", "everybody", "everyone", "everything", "everywhere", "ex", "exactly", "example", "except", "f", "face", "faces", "fact", "facts", "fairly", "far", "farther", "felt", "few", "fewer", "ff", "fi", "fifteen", "fifth", "fifty", "fify", "fill", "find", "finds", "fire", "first", "five", "fix", "fj", "fk", "fm", "fo", "followed", "following", "follows", "for", "forever", "former", "formerly", "forth", "forty", "forward", "found", "four", "fr", "free", "from", "front", "full", "fully", "further", "furthered", "furthering", "furthermore", "furthers", "fx", "g", "ga", "gave", "gb", "gd", "ge", "general", "generally", "get", "gets", "getting", "gf", "gg", "gh", "gi", "give", "given", "gives", "giving", "gl", "gm", "gmt", "gn", "go", "goes", "going", "gone", "good", "goods", "got", "gotten", "gov", "gp", "gq", "gr", "great", "greater", "greatest", "greetings", "group", "grouped", "grouping", "groups", "gs", "gt", "gu", "gw", "gy", "h", "had", "hadn't", "half", "happens", "hardly", "has", "hasn", "hasn't", "hasnt", "have", "haven", "haven't", "having", "he", "he'd", "he'll", "he's", "hed", "hello", "help", "hence", "her", "here", "here's", "hereafter", "hereby", "herein", "heres", "hereupon", "hers", "herself", "herse”", "hes", "hi", "hid", "high", "higher", "highest", "him", "himself", "himse”", "his", "hither", "hk", "hm", "hn", "home", "homepage", "hopefully", "how", "how'd", "how'll", "how's", "howbeit", "however", "hr", "ht", "htm", "html", "http", "hu", "hundred", "i", "i'd", "i'll", "i'm", "i've", "i.e.", "id", "ie", "if", "ignored", "ii", "il", "im", "immediate", "immediately", "importance", "important", "in", "inasmuch", "inc", "inc.", "indeed", "index", "indicate", "indicated", "indicates", "information", "inner", "inside", "insofar", "instead", "int", "interest", "interested", "interesting", "interests", "into", "invention", "inward", "io", "iq", "ir", "is", "isn", "isn't", "it", "it'd", "it'll", "it's", "itd", "its", "itself", "itse”", "j", "je", "jm", "jo", "join", "jp", "just", "k", "ke", "keep", "keeps", "kept", "keys", "kg", "kh", "ki", "kind", "km", "kn", "knew", "know", "known", "knows", "kp", "kr", "kw", "ky", "kz", "l", "la", "large", "largely", "last", "lately", "later", "latest", "latter", "latterly", "lb", "lc", "least", "lengtha", "less", "lest", "let", "let's", "lets", "li", "like", "liked", "likely", "likewise", "line", "little", "lk", "ll", "long", "longer", "longest", "look", "looking", "looks", "low", "lower", "lr", "ls", "lt", "ltd", "lu", "lv", "ly", "m", "ma", "made", "mainly", "make", "makes", "making", "man", "many", "may", "maybe", "mayn't", "mc", "md", "me", "mean", "means", "meantime", "meanwhile", "member", "members", "men", "merely", "mg", "mh", "microsoft", "might", "might've", "mightn't", "mil", "mill", "million", "mine", "minus", "miss", "mk", "ml", "mm", "mn", "mo", "more", "moreover", "most", "mostly", "move", "mp", "mq", "mr", "mrs", "ms", "msie", "mt", "mu", "much", "mug", "must", "must've", "mustn't", "mv", "mw", "mx", "my", "myself", "myse”", "mz", "n", "na", "name", "namely", "nay", "nc", "nd", "ne", "near", "nearly", "necessarily", "necessary", "need", "needed", "needing", "needn't", "needs", "neither", "net", "netscape", "never", "neverf", "neverless", "nevertheless", "new", "newer", "newest", "next", "nf", "ng", "ni", "nine", "ninety", "nl", "no", "no-one", "nobody", "non", "none", "nonetheless", "noone", "nor", "normally", "nos", "not", "noted", "nothing", "notwithstanding", "novel", "now", "nowhere", "np", "nr", "nu", "number", "numbers", "nz", "o", "obtain", "obtained", "obviously", "of", "off", "often", "oh", "ok", "okay", "old", "older", "oldest", "om", "omitted", "on", "once", "one", "one's", "ones", "only", "onto", "open", "opened", "opening", "opens", "opposite", "or", "ord", "order", "ordered", "ordering", "orders", "org", "other", "others", "otherwise", "ought", "oughtn't", "our", "ours", "ourselves", "out", "outside", "over", "overall", "owing", "own", "p", "pa", "page", "pages", "part", "parted", "particular", "particularly", "parting", "parts", "past", "pe", "per", "perhaps", "pf", "pg", "ph", "pk", "pl", "place", "placed", "places", "please", "plus", "pm", "pn", "point", "pointed", "pointing", "points", "poorly", "possible", "possibly", "potentially", "pp", "pr", "predominantly", "present", "presented", "presenting", "presents", "presumably", "previously", "primarily", "probably", "problem", "problems", "promptly", "proud", "provided", "provides", "pt", "put", "puts", "pw", "py", "q", "qa", "que", "quickly", "quite", "qv", "r", "ran", "rather", "rd", "re", "readily", "really", "reasonably", "recent", "recently", "ref", "refs", "regarding", "regardless", "regards", "related", "relatively", "research", "reserved", "respectively", "resulted", "resulting", "results", "right", "ring", "ro", "room", "rooms", "round", "ru", "run", "rw", "s", "sa", "said", "same", "saw", "say", "saying", "says", "sb", "sc", "sd", "se", "sec", "second", "secondly", "seconds", "section", "see", "seeing", "seem", "seemed", "seeming", "seems", "seen", "sees", "self", "selves", "sensible", "sent", "serious", "seriously", "seven", "seventy", "several", "sg", "sh", "shall", "shan't", "she", "she'd", "she'll", "she's", "shed", "shes", "should", "should've", "shouldn", "shouldn't", "show", "showed", "showing", "shown", "showns", "shows", "si", "side", "sides", "significant", "significantly", "similar", "similarly", "since", "sincere", "site", "six", "sixty", "sj", "sk", "sl", "slightly", "sm", "small", "smaller", "smallest", "sn", "so", "some", "somebody", "someday", "somehow", "someone", "somethan", "something", "sometime", "sometimes", "somewhat", "somewhere", "soon", "sorry", "specifically", "specified", "specify", "specifying", "sr", "st", "state", "states", "still", "stop", "strongly", "su", "sub", "substantially", "successfully", "such", "sufficiently", "suggest", "sup", "sure", "sv", "sy", "system", "sz", "t", "t's", "take", "taken", "taking", "tc", "td", "tell", "ten", "tends", "test", "text", "tf", "tg", "th", "than", "thank", "thanks", "thanx", "that", "that'll", "that's", "that've", "thats", "the", "their", "theirs", "them", "themselves", "then", "thence", "there", "there'd", "there'll", "there're", "there's", "there've", "thereafter", "thereby", "thered", "therefore", "therein", "thereof", "therere", "theres", "thereto", "thereupon", "these", "they", "they'd", "they'll", "they're", "they've", "theyd", "theyre", "thick", "thin", "thing", "things", "think", "thinks", "third", "thirty", "this", "thorough", "thoroughly", "those", "thou", "though", "thoughh", "thought", "thoughts", "thousand", "three", "throug", "through", "throughout", "thru", "thus", "til", "till", "tip", "tis", "tj", "tk", "tm", "tn", "to", "today", "together", "too", "took", "top", "toward", "towards", "tp", "tr", "tried", "tries", "trillion", "truly", "try", "trying", "ts", "tt", "turn", "turned", "turning", "turns", "tv", "tw", "twas", "twelve", "twenty", "twice", "two", "tz", "u", "ua", "ug", "uk", "um", "un", "under", "underneath", "undoing", "unfortunately", "unless", "unlike", "unlikely", "until", "unto", "up", "upon", "ups", "upwards", "us", "use", "used", "useful", "usefully", "usefulness", "uses", "using", "usually", "uy", "uz", "v", "va", "value", "various", "vc", "ve", "versus", "very", "vg", "vi", "via", "viz", "vn", "vol", "vols", "vs", "vu", "w", "want", "wanted", "wanting", "wants", "was", "wasn", "wasn't", "way", "ways", "we", "we'd", "we'll", "we're", "we've", "web", "webpage", "website", "wed", "welcome", "well", "wells", "went", "were", "weren", "weren't", "wf", "what", "what'd", "what'll", "what's", "what've", "whatever", "whats", "when", "when'd", "when'll", "when's", "whence", "whenever", "where", "where'd", "where'll", "where's", "whereafter", "whereas", "whereby", "wherein", "wheres", "whereupon", "wherever", "whether", "which", "whichever", "while", "whilst", "whim", "whither", "who", "who'd", "who'll", "who's", "whod", "whoever", "whole", "whom", "whomever", "whos", "whose", "why", "why'd", "why'll", "why's", "widely", "width", "will", "willing", "wish", "with", "within", "without", "won", "won't", "wonder", "words", "work", "worked", "working", "works", "world", "would", "would've", "wouldn", "wouldn't", "ws", "www", "x", "y", "ye", "year", "years", "yes", "yet", "you", "you'd", "you'll", "you're", "you've", "youd", "young", "younger", "youngest", "your", "your'tis", "youra's", "yourable", "youre", "yours", "yourself", "yourselves", "yourselvesable", "yt", "yu", "z", "za", "zero", "zeroa", "zm", "zr" );

//		$stopwords = "a,able,about,across,after,all,almost,also,am,among,an,and,any,are,as,at,be,because,been,but,by,can,cannot,could,dear,did,do,does,either,else,ever,every,for,from,get,got,had,has,have,he,her,hers,him,his,how,however,i,if,in,into,is,it,its,just,least,let,like,likely,may,me,might,most,must,my,neither,no,nor,not,of,off,often,on,only,or,other,our,own,rather,said,say,says,she,should,since,so,some,than,that,the,their,them,then,there,these,they,this,tis,to,too,twas,us,wants,was,we,were,what,when,where,which,while,who,whom,why,will,with,would,yet,you,your";
//		$stopwords .= "'tis,'twas,a,able,about,across,after,ain't,all,almost,also,am,among,an,and,any,are,aren't,as,at,be,because,been,but,by,can,can't,cannot,could,could've,couldn't,dear,did,didn't,do,does,doesn't,don't,either,else,ever,every,for,from,get,got,had,has,hasn't,have,he,he'd,he'll,he's,her,hers,him,his,how,how'd,how'll,how's,however,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,just,least,let,like,likely,may,me,might,might've,mightn't,most,must,must've,mustn't,my,neither,no,nor,not,of,off,often,on,only,or,other,our,own,rather,said,say,says,shan't,she,she'd,she'll,she's,should,should've,shouldn't,since,so,some,than,that,that'll,that's,the,their,them,then,there,there's,these,they,they'd,they'll,they're,they've,this,tis,to,too,twas,us,wants,was,wasn't,we,we'd,we'll,we're,were,weren't,what,what'd,what's,when,when,when'd,when'll,when's,where,where'd,where'll,where's,which,while,who,who'd,who'll,who's,whom,why,why'd,why'll,why's,will,with,won't,would,would've,wouldn't,yet,you,you'd,you'll,you're,you've,your";
//		$stopwords .= "able,about,across,after,all,almost,also,among,and,any,are,because,been,but,can,cannot,could,dear,did,does,either,else,ever,every,for,from,get,got,had,has,have,her,hers,him,his,how,however,into,its,just,least,let,like,likely,may,might,most,must,neither,nor,not,off,often,only,other,our,own,rather,said,say,says,she,should,since,some,than,that,the,their,them,then,there,these,they,this,tis,too,twas,wants,was,were,what,when,where,which,while,who,whom,why,will,with,would,yet,you,your";
//		$stopwords .= "'tis,'twas,able,about,across,after,ain't,all,almost,also,among,and,any,are,aren't,because,been,but,can,can't,cannot,could,could've,couldn't,dear,did,didn't,does,doesn't,don't,either,else,ever,every,for,from,get,got,had,has,hasn't,have,he'd,he'll,he's,her,hers,him,his,how,how'd,how'll,how's,however,i'd,i'll,i'm,i've,into,isn't,it's,its,just,least,let,like,likely,may,might,might've,mightn't,most,must,must've,mustn't,neither,nor,not,off,often,only,other,our,own,rather,said,say,says,shan't,she,she'd,she'll,she's,should,should've,shouldn't,since,some,than,that,that'll,that's,the,their,them,then,there,there's,these,they,they'd,they'll,they're,they've,this,tis,too,twas,wants,was,wasn't,we'd,we'll,we're,were,weren't,what,what'd,what's,when,when,when'd,when'll,when's,where,where'd,where'll,where's,which,while,who,who'd,who'll,who's,whom,why,why'd,why'll,why's,will,with,won't,would,would've,wouldn't,yet,you,you'd,you'll,you're,you've,your";
//		$stopwords .= "a's, able, about, above, according, accordingly, across, actually, after, afterwards, again, against, ain't, all, allow, allows, almost, alone, along, already, also, although, always, am, among, amongst, an, and, another, any, anybody, anyhow, anyone, anything, anyway, anyways, anywhere, apart, appear, appreciate, appropriate, are, aren't, around, as, aside, ask, asking, associated, at, available, away, awfully, be, became, because, become, becomes, becoming, been, before, beforehand, behind, being, believe, below, beside, besides, best, better, between, beyond, both, brief, but, by, c'mon, c's, came, can, can't, cannot, cant, cause, causes, certain, certainly, changes, clearly, co, com, come, comes, concerning, consequently, consider, considering, contain, containing, contains, corresponding, could, couldn't, course, currently, definitely, described, despite, did, didn't, different, do, does, doesn't, doing, don't, done, down, downwards, during, each, edu, eg, eight, either, else, elsewhere, enough, entirely, especially, et, etc, even, ever, every, everybody, everyone, everything, everywhere, ex, exactly, example, except, far, few, fifth, first, five, followed, following, follows, for, former, formerly, forth, four, from, further, furthermore, get, gets, getting, given, gives, go, goes, going, gone, got, gotten, greetings, had, hadn't, happens, hardly, has, hasn't, have, haven't, having, he, he's, hello, help, hence, her, here, here's, hereafter, hereby, herein, hereupon, hers, herself, hi, him, himself, his, hither, hopefully, how, howbeit, however, i'd, i'll, i'm, i've, ie, if, ignored, immediate, in, inasmuch, inc, indeed, indicate, indicated, indicates, inner, insofar, instead, into, inward, is, isn't, it, it'd, it'll, it's, its, itself, just, keep, keeps, kept, know, knows, known, last, lately, later, latter, latterly, least, less, lest, let, let's, like, liked, likely, little, look, looking, looks, ltd, mainly, many, may, maybe, me, mean, meanwhile, merely, might, more, moreover, most, mostly, much, must, my, myself, name, namely, nd, near, nearly, necessary, need, needs, neither, never, nevertheless, new, next, nine, no, nobody, non, none, noone, nor, normally, not, nothing, novel, now, nowhere, obviously, of, off, often, oh, ok, okay, old, on, once, one, ones, only, onto, or, other, others, otherwise, ought, our, ours, ourselves, out, outside, over, overall, own, particular, particularly, per, perhaps, placed, please, plus, possible, presumably, probably, provides, que, quite, qv, rather, rd, re, really, reasonably, regarding, regardless, regards, relatively, respectively, right, said, same, saw, say, saying, says, second, secondly, see, seeing, seem, seemed, seeming, seems, seen, self, selves, sensible, sent, serious, seriously, seven, several, shall, she, should, shouldn't, since, six, so, some, somebody, somehow, someone, something, sometime, sometimes, somewhat, somewhere, soon, sorry, specified, specify, specifying, still, sub, such, sup, sure, t's, take, taken, tell, tends, th, than, thank, thanks, thanx, that, that's, thats, the, their, theirs, them, themselves, then, thence, there, there's, thereafter, thereby, therefore, therein, theres, thereupon, these, they, they'd, they'll, they're, they've, think, third, this, thorough, thoroughly, those, though, three, through, throughout, thru, thus, to, together, too, took, toward, towards, tried, tries, truly, try, trying, twice, two, un, under, unfortunately, unless, unlikely, until, unto, up, upon, us, use, used, useful, uses, using, usually, value, various, very, via, viz, vs, want, wants, was, wasn't, way, we, we'd, we'll, we're, we've, welcome, well, went, were, weren't, what, what's, whatever, when, whence, whenever, where, where's, whereafter, whereas, whereby, wherein, whereupon, wherever, whether, which, while, whither, who, who's, whoever, whole, whom, whose, why, will, willing, wish, with, within, without, won't, wonder, would, would, wouldn't, yes, yet, you, you'd, you'll, you're, you've, your, yours, yourself, yourselves, zero";
//		$stopwords .= "a,ii,about,above,according,across,39,actually,ad,adj,ae,af,after,afterwards,ag,again,against,ai,al,all,almost,alone,along,already,also,although,always,am,among,amongst,an,and,another,any,anyhow,anyone,anything,anywhere,ao,aq,ar,are,aren,aren't,around,arpa,as,at,au,aw,az,b,ba,bb,bd,be,became,because,become,becomes,becoming,been,before,beforehand,begin,beginning,behind,being,below,beside,besides,between,beyond,bf,bg,bh,bi,billion,bj,bm,bn,bo,both,br,bs,bt,but,buy,bv,bw,by,bz,c,ca,can,can't,cannot,caption,cc,cd,cf,cg,ch,ci,ck,cl,click,cm,cn,co,co.,com,copy,could,couldn,couldn't,cr,cs,cu,cv,cx,cy,cz,d,de,did,didn,didn't,dj,dk,dm,do,does,doesn,doesn't,don,don't,down,during,dz,e,each,ec,edu,ee,eg,eh,eight,eighty,either,else,elsewhere,end,ending,enough,er,es,et,etc,even,ever,every,everyone,everything,everywhere,except,f,few,fi,fifty,find,first,five,fj,fk,fm,fo,for,former,formerly,forty,found,four,fr,free,from,further,fx,g,ga,gb,gd,ge,get,gf,gg,gh,gi,gl,gm,gmt,gn,go,gov,gp,gq,gr,gs,gt,gu,gw,gy,h,had,has,hasn,hasn't,have,haven,haven't,he,he'd,he'll,he's,help,hence,her,here,here's,hereafter,hereby,herein,hereupon,hers,herself,him,himself,his,hk,hm,hn,home,homepage,how,however,hr,ht,htm,html,http,hu,hundred,i,i'd,i'll,i'm,i've,i.e.,id,ie,if,il,im,in,inc,inc.,indeed,information,instead,int,into,io,iq,ir,is,isn,isn't,it,it's,its,itself,j,je,jm,jo,join,jp,k,ke,kg,kh,ki,km,kn,kp,kr,kw,ky,kz,l,la,last,later,latter,lb,lc,least,less,let,let's,li,like,likely,lk,ll,lr,ls,lt,ltd,lu,lv,ly,m,ma,made,make,makes,many,maybe,mc,md,me,meantime,meanwhile,mg,mh,microsoft,might,mil,million,miss,mk,ml,mm,mn,mo,more,moreover,most,mostly,mp,mq,mr,mrs,ms,msie,mt,mu,much,must,mv,mw,mx,my,myself,mz,n,na,namely,nc,ne,neither,net,netscape,never,nevertheless,new,next,nf,ng,ni,nine,ninety,nl,no,nobody,none,nonetheless,noone,nor,not,nothing,now,nowhere,np,nr,nu,nz,o,of,off,often,om,on,once,one,one's,only,onto,or,org,other,others,otherwise,our,ours,ourselves,out,over,overall,own,p,pa,page,pe,per,perhaps,pf,pg,ph,pk,pl,pm,pn,pr,pt,pw,py,q,qa,r,rather,re,recent,recently,reserved,ring,ro,ru,rw,s,sa,same,sb,sc,sd,se,seem,seemed,seeming,seems,seven,seventy,several,sg,sh,she,she'd,she'll,she's,should,shouldn,shouldn't,si,since,site,six,sixty,sj,sk,sl,sm,sn,so,some,somehow,someone,something,sometime,sometimes,somewhere,sr,st,still,stop,su,such,sv,sy,sz,t,taking,tc,td,ten,text,tf,tg,test,th,than,that,that'll,that's,the,their,them,themselves,then,thence,there,there'll,there's,thereafter,thereby,therefore,therein,thereupon,these,they,they'd,they'll,they're,they've,thirty,this,those,though,thousand,three,through,throughout,thru,thus,tj,tk,tm,tn,to,together,too,toward,towards,tp,tr,trillion,tt,tv,tw,twenty,two,tz,u,ua,ug,uk,um,under,unless,unlike,unlikely,until,up,upon,us,use,used,using,uy,uz,v,va,vc,ve,very,vg,vi,via,vn,vu,w,was,wasn,wasn't,we,we'd,we'll,we're,we've,web,webpage,website,welcome,well,were,weren,weren't,wf,what,what'll,what's,whatever,when,whence,whenever,where,whereafter,whereas,whereby,wherein,whereupon,wherever,whether,which,while,whither,who,who'd,who'll,who's,whoever,NULL,whole,whom,whomever,whose,why,will,with,within,without,won,won't,would,wouldn,wouldn't,ws,www,x,y,ye,yes,yet,you,you'd,you'll,you're,you've,your,yours,yourself,yourselves,yt,yu,z,za,zm,zr,10,z,org,inc,width,length";
//		$stopwords .= "a,about,above,across,after,afterwards,again,against,all,almost,alone,along,already,also,although,always,am,among,amongst,amoungst,amount,an,and,another,any,anyhow,anyone,anything,anyway,anywhere,are,around,as,at,back,be,became,because,become,becomes,becoming,been,before,beforehand,behind,being,below,beside,besides,between,beyond,bill,both,bottom,but,by,call,can,cannot,cant,co,computer,con,could,couldnt,cry,de,describe,detail,do,done,down,due,during,each,eg,eight,either,eleven,else,elsewhere,empty,enough,etc,even,ever,every,everyone,everything,everywhere,except,few,fifteen,fify,fill,find,fire,first,five,for,former,formerly,forty,found,four,from,front,full,further,get,give,go,had,has,hasnt,have,he,hence,her,here,hereafter,hereby,herein,hereupon,hers,herse”,him,himse”,his,how,however,hundred,i,ie,if,in,inc,indeed,interest,into,is,it,its,itse”,keep,last,latter,latterly,least,less,ltd,made,many,may,me,meanwhile,might,mill,mine,more,moreover,most,mostly,move,much,must,my,myse”,name,namely,neither,never,nevertheless,next,nine,no,nobody,none,noone,nor,not,nothing,now,nowhere,of,off,often,on,once,one,only,onto,or,other,others,otherwise,our,ours,ourselves,out,over,own,part,per,perhaps,please,put,rather,re,same,see,seem,seemed,seeming,seems,serious,several,she,should,show,side,since,sincere,six,sixty,so,some,somehow,someone,something,sometime,sometimes,somewhere,still,such,system,take,ten,than,that,the,their,them,themselves,then,thence,there,thereafter,thereby,therefore,therein,thereupon,these,they,thick,thin,third,this,those,though,three,through,throughout,thru,thus,to,together,too,top,toward,towards,twelve,twenty,two,un,under,until,up,upon,us,very,via,was,we,well,were,what,whatever,when,whence,whenever,where,whereafter,whereas,whereby,wherein,whereupon,wherever,whether,which,while,whither,who,whoever,whole,whom,whose,why,will,with,within,without,would,yet,you,your,yours,yourself,yourselves";
//		$stopwords .= "able,about,above,abroad,according,accordingly,across,actually,adj,after,afterwards,again,against,ago,ahead,ain't,all,allow,allows,almost,alone,along,alongside,already,also,although,always,am,amid,amidst,among,amongst,an,and,another,any,anybody,anyhow,anyone,anything,anyway,anyways,anywhere,apart,appear,appreciate,appropriate,are,aren't,around,as,a's,aside,ask,asking,associated,at,available,away,awfully,back,backward,backwards,be,became,because,become,becomes,becoming,been,before,beforehand,begin,behind,being,believe,below,beside,besides,best,better,between,beyond,both,brief,but,by,came,can,cannot,cant,can't,caption,cause,causes,certain,certainly,changes,clearly,c'mon,co,co.,com,come,comes,concerning,consequently,consider,considering,contain,containing,contains,corresponding,could,couldn't,course,c's,currently,dare,daren't,definitely,described,despite,did,didn't,different,directly,do,does,doesn't,doing,done,don't,down,downwards,during,each,edu,eg,eight,eighty,either,else,elsewhere,end,ending,enough,entirely,especially,et,etc,even,ever,evermore,every,everybody,everyone,everything,everywhere,ex,exactly,example,except,fairly,far,farther,few,fewer,fifth,first,five,followed,following,follows,for,forever,former,formerly,forth,forward,found,four,from,further,furthermore,get,gets,getting,given,gives,go,goes,going,gone,got,gotten,greetings,had,hadn't,half,happens,hardly,has,hasn't,have,haven't,having,he,he'd,he'll,hello,help,hence,her,here,hereafter,hereby,herein,here's,hereupon,hers,herself,he's,hi,him,himself,his,hither,hopefully,how,howbeit,however,hundred,i'd,ie,if,ignored,i'll,i'm,immediate,in,inasmuch,inc,inc.,indeed,indicate,indicated,indicates,inner,inside,insofar,instead,into,inward,is,isn't,it,it'd,it'll,its,it's,itself,i've,just,k,keep,keeps,kept,know,known,knows,last,lately,later,latter,latterly,least,less,lest,let,let's,like,liked,likely,likewise,little,look,looking,looks,low,lower,ltd,made,mainly,make,makes,many,may,maybe,mayn't,me,mean,meantime,meanwhile,merely,might,mightn't,mine,minus,miss,more,moreover,most,mostly,mr,mrs,much,must,mustn't,my,myself,name,namely,nd,near,nearly,necessary,need,needn't,needs,neither,never,neverf,neverless,nevertheless,new,next,nine,ninety,no,nobody,non,none,nonetheless,noone,no-one,nor,normally,not,nothing,notwithstanding,novel,now,nowhere,obviously,of,off,often,oh,ok,okay,old,on,once,one,ones,one's,only,onto,opposite,or,other,others,otherwise,ought,oughtn't,our,ours,ourselves,out,outside,over,overall,own,particular,particularly,past,per,perhaps,placed,please,plus,possible,presumably,probably,provided,provides,que,quite,qv,rather,rd,re,really,reasonably,recent,recently,regarding,regardless,regards,relatively,respectively,right,round,said,same,saw,say,saying,says,second,secondly,see,seeing,seem,seemed,seeming,seems,seen,self,selves,sensible,sent,serious,seriously,seven,several,shall,shan't,she,she'd,she'll,she's,should,shouldn't,since,six,so,some,somebody,someday,somehow,someone,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specified,specify,specifying,still,sub,such,sup,sure,take,taken,taking,tell,tends,th,than,thank,thanks,thanx,that,that'll,thats,that's,that've,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,there'd,therefore,therein,there'll,there're,theres,there's,thereupon,there've,these,they,they'd,they'll,they're,they've,thing,things,think,third,thirty,this,thorough,thoroughly,those,though,three,through,throughout,thru,thus,till,to,together,too,took,toward,towards,tried,tries,truly,try,trying,t's,twice,two,un,under,underneath,undoing,unfortunately,unless,unlike,unlikely,until,unto,up,upon,upwards,us,use,used,useful,uses,using,usually,v,value,various,versus,very,via,viz,vs,want,wants,was,wasn't,way,we,we'd,welcome,well,we'll,went,were,we're,weren't,we've,what,whatever,what'll,what's,what've,when,whence,whenever,where,whereafter,whereas,whereby,wherein,where's,whereupon,wherever,whether,which,whichever,while,whilst,whither,who,who'd,whoever,whole,who'll,whom,whomever,who's,whose,why,will,willing,wish,with,within,without,wonder,won't,would,wouldn't,yes,yet,you,you'd,you'll,your,you're,yours,yourself,yourselves,you've,zero";
//		$stopwords .= "a,about,above,across,after,again,against,all,almost,alone,along,already,also,although,always,among,an,and,another,any,anybody,anyone,anything,anywhere,are,area,areas,around,as,ask,asked,asking,asks,at,away,b,back,backed,backing,backs,be,became,because,become,becomes,been,before,began,behind,being,beings,best,better,between,big,both,but,by,c,came,can,cannot,case,cases,certain,certainly,clear,clearly,come,could,d,did,differ,different,differently,do,does,done,down,down,downed,downing,downs,during,e,each,early,either,end,ended,ending,ends,enough,even,evenly,ever,every,everybody,everyone,everything,everywhere,f,face,faces,fact,facts,far,felt,few,find,finds,first,for,four,from,full,fully,further,furthered,furthering,furthers,g,gave,general,generally,get,gets,give,given,gives,go,going,good,goods,got,great,greater,greatest,group,grouped,grouping,groups,h,had,has,have,having,he,her,here,herself,high,high,high,higher,highest,him,himself,his,how,however,i,if,important,in,interest,interested,interesting,interests,into,is,it,its,itself,j,just,k,keep,keeps,kind,knew,know,known,knows,l,large,largely,last,later,latest,least,less,let,lets,like,likely,long,longer,longest,m,made,make,making,man,many,may,me,member,members,men,might,more,most,mostly,mr,mrs,much,must,my,myself,n,necessary,need,needed,needing,needs,never,new,new,newer,newest,next,no,nobody,non,noone,not,nothing,now,nowhere,number,numbers,o,of,off,often,old,older,oldest,on,once,one,only,open,opened,opening,opens,or,order,ordered,ordering,orders,other,others,our,out,over,p,part,parted,parting,parts,per,perhaps,place,places,point,pointed,pointing,points,possible,present,presented,presenting,presents,problem,problems,put,puts,q,quite,r,rather,really,right,right,room,rooms,s,said,same,saw,say,says,second,seconds,see,seem,seemed,seeming,seems,sees,several,shall,she,should,show,showed,showing,shows,side,sides,since,small,smaller,smallest,so,some,somebody,someone,something,somewhere,state,states,still,still,such,sure,t,take,taken,than,that,the,their,them,then,there,therefore,these,they,thing,things,think,thinks,this,those,though,thought,thoughts,three,through,thus,to,today,together,too,took,toward,turn,turned,turning,turns,two,u,under,until,up,upon,us,use,used,uses,v,very,w,want,wanted,wanting,wants,was,way,ways,we,well,wells,went,were,what,when,where,whether,which,while,who,whole,whose,why,will,with,within,without,work,worked,working,works,would,x,y,year,years,yet,you,young,younger,youngest,your,yours,z,";
//		$stopwords .= "a,about,above,after,again,against,all,am,an,and,any,are,aren't,as,at,be,because,been,before,being,below,between,both,but,by,can't,cannot,could,couldn't,did,didn't,do,does,doesn't,doing,don't,down,during,each,few,for,from,further,had,hadn't,has,hasn't,have,haven't,having,he,he'd,he'll,he's,her,here,here's,hers,herself,him,himself,his,how,how's,i,i'd,i'll,i'm,i've,if,in,into,is,isn't,it,it's,its,itself,let's,me,more,most,mustn't,my,myself,no,nor,not,of,off,on,once,only,or,other,ought,our,ours,ourselves,out,over,own,same,shan't,she,she'd,she'll,she's,should,shouldn't,so,some,such,than,that,that's,the,their,theirs,them,themselves,then,there,there's,these,they,they'd,they'll,they're,they've,this,those,through,to,too,under,until,up,very,was,wasn't,we,we'd,we'll,we're,we've,were,weren't,what,what's,when,when's,where,where's,which,while,who,who's,whom,why,why's,with,won't,would,wouldn't,you,you'd,you'll,you're,you've,your,yours,yourself,yourselves,I,a,about,an,are,as,at,be,by,com,for,from,how,in,is,it,of,on,or,that,the,this,to,was,what,when,where,who,will,with,the,www,a,able,about,above,abst,accordance,according,accordingly,across,act,actually,added,adj,adopted,affected,affecting,affects,after,afterwards,again,against,ah,all,almost,alone,along,already,also,although,always,am,among,amongst,an,and,announce,another,any,anybody,anyhow,anymore,anyone,anything,anyway,anyways,anywhere,apparently,approximately,are,aren,arent,arise,around,as,aside,ask,asking,at,auth,available,away,awfully,b,back,be,became,because,become,becomes,becoming,been,before,beforehand,begin,beginning,beginnings,begins,behind,being,believe,below,beside,besides,between,beyond,biol,both,brief,briefly,but,by,c,ca,came,can,cannot,can't,cause,causes,certain,certainly,co,com,come,comes,contain,containing,contains,could,couldnt,d,date,did,didn't,different,do,does,doesn't,doing,done,don't,down,downwards,due,during,e,each,ed,edu,effect,eg,eight,eighty,either,else,elsewhere,end,ending,enough,especially,et,et-al,etc,even,ever,every,everybody,everyone,everything,everywhere,ex,except,f,far,few,ff,fifth,first,five,fix,followed,following,follows,for,former,formerly,forth,found,four,from,further,furthermore,g,gave,get,gets,getting,give,given,gives,giving,go,goes,gone,got,gotten,h,had,happens,hardly,has,hasn't,have,haven't,having,he,hed,hence,her,here,hereafter,hereby,herein,heres,hereupon,hers,herself,hes,hi,hid,him,himself,his,hither,home,how,howbeit,however,hundred,i,id,ie,if,i'll,im,immediate,immediately,importance,important,in,inc,indeed,index,information,instead,into,invention,inward,is,isn't,it,itd,it'll,its,itself,i've,j,just,k,keep,keeps,kept,keys,kg,km,know,known,knows,l,largely,last,lately,later,latter,latterly,least,less,lest,let,lets,like,liked,likely,line,little,'ll,look,looking,looks,ltd,m,made,mainly,make,makes,many,may,maybe,me,mean,means,meantime,meanwhile,merely,mg,might,million,miss,ml,more,moreover,most,mostly,mr,mrs,much,mug,must,my,myself,n,na,name,namely,nay,nd,near,nearly,necessarily,necessary,need,needs,neither,never,nevertheless,new,next,nine,ninety,no,nobody,non,none,nonetheless,noone,nor,normally,nos,not,noted,nothing,now,nowhere,o,obtain,obtained,obviously,of,off,often,oh,ok,okay,old,omitted,on,once,one,ones,only,onto,or,ord,other,others,otherwise,ought,our,ours,ourselves,out,outside,over,overall,owing,own,p,page,pages,part,particular,particularly,past,per,perhaps,placed,please,plus,poorly,possible,possibly,potentially,pp,predominantly,present,previously,primarily,probably,promptly,proud,provides,put,q,que,quickly,quite,qv,r,ran,rather,rd,re,readily,really,recent,recently,ref,refs,regarding,regardless,regards,related,relatively,research,respectively,resulted,resulting,results,right,run,s,said,same,saw,say,saying,says,sec,section,see,seeing,seem,seemed,seeming,seems,seen,self,selves,sent,seven,several,shall,she,shed,she'll,shes,should,shouldn't,show,showed,shown,showns,shows,significant,significantly,similar,similarly,since,six,slightly,so,some,somebody,somehow,someone,somethan,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specifically,specified,specify,specifying,state,states,still,stop,strongly,sub,substantially,successfully,such,sufficiently,suggest,sup,sure,t,take,taken,taking,tell,tends,th,than,thank,thanks,thanx,that,that'll,thats,that've,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,thered,therefore,therein,there'll,thereof,therere,theres,thereto,thereupon,there've,these,they,theyd,they'll,theyre,they've,think,this,those,thou,though,thoughh,thousand,throug,through,throughout,thru,thus,til,tip,to,together,too,took,toward,towards,tried,tries,truly,try,trying,ts,twice,two,u,un,under,unfortunately,unless,unlike,unlikely,until,unto,up,upon,ups,us,use,used,useful,usefully,usefulness,uses,using,usually,v,value,various,'ve,very,via,viz,vol,vols,vs,w,want,wants,was,wasn't,way,we,wed,welcome,we'll,went,were,weren't,we've,what,whatever,what'll,whats,when,whence,whenever,where,whereafter,whereas,whereby,wherein,wheres,whereupon,wherever,whether,which,while,whim,whither,who,whod,whoever,whole,who'll,whom,whomever,whos,whose,why,widely,willing,wish,with,within,without,won't,words,world,would,wouldn't,www,x,y,yes,yet,you,youd,you'll,your,youre,yours,yourself,yourselves,you've,z,zero,";
	}
	else if ( isset($opt['type']) && $opt['type'] == 'bad_keywords' )
	{
		$words_arr = array( "" );
	}
	else
	{
		$words_arr = array( "" );
	}

	$words_arr_str = implode('|', $words_arr);

	$final_str = preg_replace("/\b($words_arr_str)\b/ie", 'str_repeat("", strlen("\\1")) ', $opt['data']);

	if ( isset($opt['slug']) && $opt['slug'] == true )
	{
		$final_str = create_friendly_urls( $final_str );
	}

	if ( isset($opt['tags']) && $opt['tags'] == true )
	{
		$final_arr = explode(' ', $final_str );
		$final_arr = array_unique($final_arr);

		$final_str = implode(', ', $final_arr);

		$final_str = str_replace(',,', ',',$final_str);

		$final_str = trim(trim( trim($final_str), ','));

		$final_str = strtolower( str_replace( ', ,', ',', $final_str ) );
	}

	return $final_str;
}

function my_get_browser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

function reserved_words( $string )
{
	$reserved_words = array('account', 'admin', 'api', 'blog', 'cache', 'changelog', 'enterprise', 'gist', 'help', 'jobs', 'lists', 'login', 'logout', 'mine', 'news', 'plans', 'popular', 'projects', 'security', 'shop', 'jobs', 'translations', 'signup', 'status', 'styleguide', 'tour', 'wiki', 'stories', 'organizations', 'codereview', 'better', 'compare', 'hosting url', 'about', 'account', 'add', 'admin', 'api', 'app', 'apps', 'archive', 'archives', 'auth', 'blog', 'config', 'connect', 'contact', 'create', 'delete', 'direct_messages', 'downloads', 'edit', 'email', 'faq', 'favorites', 'feed', 'feeds', 'follow', 'followers', 'following', 'help', 'home', 'invitations', 'invite', 'jobs', 'login', 'logout', 'logs', 'map', 'maps', 'oauth', 'oauth_clients', 'openid', 'privacy', 'register', 'remove', 'replies', 'rss', 'save', 'search', 'sessions', 'settings', 'signup', 'sitemap', 'ssl', 'subscribe', 'terms', 'trends', 'unfollow', 'unsubscribe', 'url', 'user', 'widget', 'widgets', 'xfn', 'xmpp', 'about', 'account', 'activate', 'add', 'admin', 'administrator', 'api', 'app', 'apps', 'archive', 'archives', 'auth', 'better', 'blog', 'cache', 'cancel', 'careers', 'cart', 'changelog', 'checkout', 'codereview', 'compare', 'config', 'configuration', 'connect', 'contact', 'create', 'delete', 'direct_messages', 'documentation', 'download', 'downloads', 'edit', 'email', 'employment', 'enterprise', 'facebook', 'faq', 'favorites', 'feed', 'feedback', 'feeds', 'fleet', 'fleets', 'follow', 'followers', 'following', 'friend', 'friends', 'group', 'groups', 'gist', 'help', 'home', 'hosting', 'hostmaster', 'idea', 'ideas', 'index', 'info', 'invitations', 'invite', 'is', 'it', 'json', 'job', 'jobs', 'lists', 'login', 'logout', 'logs', 'mail', 'map', 'maps', 'mine', 'mis', 'news', 'oauth', 'oauth_clients', 'offers', 'openid', 'order', 'orders', 'organizations', 'plans', 'popular', 'privacy', 'projects', 'put', 'post', 'recruitment', 'register', 'remove', 'replies', 'root', 'rss', 'sales', 'save', 'search', 'security', 'sessions', 'settings', 'shop', 'signup', 'sitemap', 'ssl', 'ssladmin', 'ssladministrator', 'sslwebmaster', 'status', 'stories', 'styleguide', 'subscribe', 'subscriptions', 'support', 'sysadmin', 'sysadministrator', 'terms', 'tour', 'translations', 'trends', 'twitter', 'twittr', 'update', 'unfollow', 'unsubscribe', 'url', 'user', 'weather', 'widget', 'widgets', 'wiki', 'ww', 'www', 'wwww', 'xfn', 'xml', 'xmpp', 'yml', 'yaml', 'admin', 'administrator', 'hostmaster', 'root', 'ssladmin', 'sysadmin', 'webmaster', 'info', 'is', 'it', 'mis', 'ssladministrator', 'sslwebmaster', 'postmaster', 'about', 'account', 'add', 'admin', 'api', 'app', 'apps', 'archive', 'archives', 'auth', 'better', 'blog', 'cache', 'changelog', 'codereview', 'compare', 'config', 'connect', 'contact', 'create', 'delete', 'direct_messages', 'downloads', 'edit', 'email', 'enterprise', 'faq', 'favorites', 'feed', 'feeds', 'follow', 'followers', 'following', 'gist', 'help', 'home', 'hosting', 'invitations', 'invite', 'jobs', 'lists', 'login', 'logout', 'logs', 'map', 'maps', 'mine', 'news', 'oauth', 'oauth_clients', 'openid', 'organizations', 'plans', 'popular', 'privacy', 'projects', 'register', 'remove', 'replies', 'rss', 'save', 'search', 'security', 'sessions', 'settings', 'shop', 'signup', 'sitemap', 'ssl', 'status', 'stories', 'styleguide', 'subscribe', 'terms', 'tour', 'translations', 'trends', 'unfollow', 'unsubscribe', 'url', 'user', 'widget', 'widgets', 'wiki', 'xfn', 'xmpp');

	if (in_array($string, $reserved_words ))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function cmp($a, $b) {
	if ($a['date'] == $b['date']) {
		return 0;
	}
	return ($a['date'] < $b['date']) ? -1 : 1;
}

function sendEmail($sender,$receiver,$msg,$subject){
 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_API_KEY);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/beta.appstersinc.com/messages');
	curl_setopt($ch, CURLOPT_POSTFIELDS, array(
	'from' => 'Open Mind Tutors <'.$sender.'>',
	'to' => $receiver,
	'subject' => $subject,
	'html' => $msg
	));
	$response = curl_exec($ch);
	curl_close($ch);
	return ($response ? 1:2);
}

function encrypt_url($string) {
  $key = ENCRYPTION_KEY; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }
   return str_replace("%2F", "stop" ,urlencode(base64_encode($result)));
}

function decrypt_url($string) {
    $key = ENCRYPTION_KEY; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode(str_replace("stop", "%2F" , $string)));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}
function dateDiff_ago($time)
{
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $difference     =  $now - $time;
    $tense         = "ago";

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] ago ";
}
function import_excel($Filepath){

	/**
 * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
 */
	//header('Content-Type: text/plain');
	// Excel reader from http://code.google.com/p/php-excel-reader/
	require('excel_import/php-excel-reader/excel_reader2.php');
	require('excel_import/SpreadsheetReader.php');

	date_default_timezone_set('UTC');
	//$Filepath = $_GET['File'];
	try
	{
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$all_data = array();
		$flag = false;
		$Sheets = $Spreadsheet -> Sheets();
		foreach ($Sheets as $Index => $Name)
		{
			$Spreadsheet -> ChangeSheet($Index);

			foreach ($Spreadsheet as $Key => $Row)
			{
				//echo $Key.': ';
				if ($Row)
				{
					if($flag==true && !empty($Row[0]) && !empty($Row[1])){
					$all_data[] = $Row;
					}
					else{
						$flag=true;
						if(!isset($Row[4])){
							$all_data[] = 1;
						}else if ($Row[0] != "Name"){
							$all_data[] = 1;
						}else if ($Row[1] != "Country Code(123)"){
							$all_data[] = 1;
						}else if ($Row[2] != "Phone(Unique)"){
							$all_data[] = 1;
						}else if ($Row[3] != "Email(Unique)"){
							$all_data[] = 1;
						}else if ($Row[4] != "Gender(1=male,2=female)"){
							$all_data[] = 1;
						}else if ($Row[5] != "DOB(mm/dd/YYYY)"){
							$all_data[] = 1;
						}
					}
				}
				else
				{
					//var_dump($Row);
				}
			}
		
		}
		
	}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}
	return $all_data;
}


//------------ Random Code Generator <Start> -----------------//
function generate_code( $length = 4 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
//------------ Random Code Generator <End> -----------------//

//------------ Random Password Generator <Start> -----------------//
function generate_password( $length = 8 ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}
//------------ Random Password Generator <End> -----------------//

function sendMessage($receiver_number,$message){
	$client = new Services_Twilio(TWILIO_SID, TWILIO_TOKEN);
	try{
		$client->account->messages->sendMessage(TWILIO_PHONE_NUMBER, $receiver_number, $message);
		return true;
// FOR MESSAGE STATUS	$info = $client->account->messages->sendMessage(TWILIO_PHONE_NUMBER, $receiver_number, $message, array('StatusCallback'=>'http://localhost/stoptype2/tg_web_stoptype2/code/beta/admin/appointment'));
//		return $info;
	}catch (Exception $e) {
		echo 'Error: ' . $e->getMessage();
	}
}function replaceContactInfo($message){	$keywords  = array('@', '.com');	$patterns = array();	$patterns[0] = "/(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/";	$patterns[1]= "/(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)/";	$patterns[2] = "/(((\+92\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+92\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+92\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/";	$s = explode(" ", $message);	foreach ($s as $k=>$v)	{		foreach($keywords as $keyword) {			if (strpos($v,$keyword) !== FALSE)			{				$s[$k]= '<b>(Invalid Info)</b>';			}		}	}	print_r(preg_replace($patterns, '<b>(Invalid Info)</b>', implode(" ", $s)));}
//------------ Multiple Image Uploader<Start> -----------------//

?>
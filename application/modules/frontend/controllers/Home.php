<?php
class Home extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$current_lang = $this->session->userdata('my_lang');
		if(!$current_lang) {
			$current_lang = 'english';
			$this->session->set_userdata('my_lang','english');
		}
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper('mylang');
		$this->lang->load($current_lang.'_home_page_lang', $current_lang);
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	public function index() {
		$this->load->library('zyk/OfferLib');
		$this->load->library('zyk/SearchLib');
		$this->load->library('zyk/BrandLib');
		//$restaurants = $this->searchlib->getNewRestaurants();
		if(!empty(get_cookie('zyksgeocode',true))) {
			$geocode = get_cookie('zyksgeocode',true);
			$latlng = explode(",",$geocode);
			$latitude = $latlng[0];
			$longitude = $latlng[1];
			$location = get_cookie('zykslocation',true);
		} else {
			$latitude = "";
			$longitude = "";
			$location = "";
		}
		$restaurants = array();
		$citybrands = $this->brandlib->getCityBrands();
		$cuisinebrands = $this->brandlib->getCuisineBrands();
		$restaurantbrands = $this->brandlib->getRestaurantBrands();
		$otherbrands = $this->brandlib->getOtherBrands();
		$offer = $this->offerlib->getOfferHome();
		$this->template->set ( 'page', 'home' );
		$this->template->set('title','Order Food Online | We Deliver, What You Love To Eat - Zaykedaar');
		$this->template->set ( 'meta_key', 'Order food online, order online food, food order online, online order food, order food, order Chinese food online, deliver food, chinese food order online, Zaykedaar, Zaykedaar.com' );
		$this->template->set ( 'meta_description', 'Order food online from 600+ home delivery & takeaway restaurants in Pune. Home delivery up to 15 km, Great Deals, Pay Cash, Online or via App' );
		$this->template->set ( 'restaurants', $restaurants );
		$this->template->set ( 'offers', $offer );
		$this->template->set ( 'citybrands', $citybrands );
		$this->template->set ( 'cuisinebrands', $cuisinebrands );
		$this->template->set ( 'restaurantbrands', $restaurantbrands );
		$this->template->set ( 'otherbrands', $otherbrands );
		$this->template->set ( 'latitude', $latitude );
		$this->template->set ( 'longitude', $longitude );
		$this->template->set ( 'location', $location );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
			
			 ->set_partial ( 'header', 'partials/header_home' )
			 ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('home');
	}
	
	public function restMenu($restid) {
		$this->load->library('zyk/SearchLib');
		$restaurant = $this->searchlib->getNewRestaurantDetails($restid);
		$geocookie= array(
				'name'   => 'zyksgeocode',
				'value'  => $restaurant[0]['latitude'].",".$restaurant[0]['longitude'],
				'expire' => '86500',
		);
		$geoloccookie= array(
				'name'   => 'zykslocation',
				'value'  => $restaurant[0]['locality'],
				'expire' => '86500',
		);
		$this->input->set_cookie($geocookie);
		$this->input->set_cookie($geoloccookie);
		$cityname =   preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$restaurant[0]['cityname'])));
		$localityname = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$restaurant[0]['locality'])));
		$restname = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$restaurant[0]['name'])));
		$url = base_url().$cityname."/".$localityname."/restaurant/".$restname."-".$restid;
		redirect($url);
	}
	
	public function sponsoredMenu($restid) {
		$this->load->library('zyk/SearchLib');
		$this->load->library('zyk/BannerLib');
		$restaurant = $this->searchlib->getNewRestaurantDetails($restid);
		$geocookie= array(
				'name'   => 'zyksgeocode',
				'value'  => $restaurant[0]['latitude'].",".$restaurant[0]['longitude'],
				'expire' => '86500',
		);
		$geoloccookie= array(
				'name'   => 'zykslocation',
				'value'  => $restaurant[0]['locality'],
				'expire' => '86500',
		);
		$ba_session = 'ba_'.md5(date(DATE_RFC822).time().$restid);
		$adcookie= array(
				'name'   => 'ba_session',
				'value'  => $ba_session.'#'.$restid,
				'expire' => '18000',
		);
		$this->input->set_cookie($geocookie);
		$this->input->set_cookie($geoloccookie);
		$this->input->set_cookie($adcookie);
		$params = array();
		$params['restid'] = $restid;
		$params['userid'] = $this->session->userdata('userId');
		$params['ba_session'] = $ba_session;
		$params['created_time'] = date('Y-m-d H:i:s');
		$params['session_ip'] = $this->input->ip_address();
		$this->bannerlib->recordAdResponse($params);
		$cityname =   preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$restaurant[0]['cityname'])));
		$localityname = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$restaurant[0]['locality'])));
		$restname = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$restaurant[0]['name'])));
		$url = base_url().$cityname."/".$localityname."/".$restname."-".$restid;
		redirect($url);
	}
	
	public function faq() {
		$this->template->set ( 'page', 'FAQ' );
		$this->template->set('title','FAQ | Zaykedaar.com');
		$this->template->set ( 'meta_key', 'What is Zaykedaar.com, order food online, zaykedaar, zaykedaar.com, home delivery, home delivery upto 15km, Food, order online food, food order online, online order food' );
		$this->template->set ( 'meta_description', 'What is Zaykedaar.com? Zaykedaar.com is a online food ordering portal in Pune and plans to slowly expand in other major cities in India' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
	
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('Faq');
	}
	
	public function about() {
		$this->template->set ( 'page', 'About Us' );
		$this->template->set('title','About Us | Zaykedaar.com');
		$this->template->set ( 'meta_key', 'About us, Order food online, home delivery, Food, zaykedaar, zaykedaar.com, home delivery upto 15km, order online food, food order online, online order food' );
		$this->template->set ( 'meta_description', 'We are a small but enthusiastic team and we are out to ensure that our customers get maximum benefits out of their online food orders!' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('AboutUs');
	}
	
	public function contactUs() {
		$dirPath = FCPATH . "assets/invoices/";
		$dirFolder = "custom_invoices_Weekly_2016-06-30";
		exec ( 'zip -r ' . $dirPath . $dirFolder . ' ' . $dirPath . $dirFolder );
		$this->template->set ( 'page', 'Contact Us' );
		$this->template->set('title','Contact Us | Zaykedaar.com');
		$this->template->set ( 'meta_key', 'Zaykedaar, Contact Us, Zaykedaar.com, Order food online, home delivery, restaurants,Customer Support, home delivery upto 15km, food order online, online order food' );
		$this->template->set ( 'meta_description', 'Do you want to list your restaurant with us? or want to recommend any restaurant. Please fill a short form our team will get in touch with you soon' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('ContactUs');
	}
	
	public function privacyPolicy() {
		$this->template->set ( 'page', 'home' );
		$this->template->set('title','Privacy Policy | Zaykedaar.com');
		$this->template->set ( 'meta_key', 'customer information privacy, Privacy Policy, Order food online, home delivery, Food, zaykedaar. zaykedaar.com, home delivery upto 15km, order online food, food order online' );
		$this->template->set ( 'meta_description', "We value the trust you place in www.zaykedaar.com. That's why we insist upon the highest standards for secure transactions and customer information privacy" );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('PrivacyPolicy');
	}
	
	public function refundPolicy() {
		$this->template->set ( 'page', 'Refund Policy' );
		$this->template->set('title','Refund Policy | Zaykedaar.com');
		$this->template->set ( 'meta_key', 'Zaykedaar, Refund Policy, Zaykedaar.com, Order food online, home delivery upto 15km , food order online, online order food , order online food,  restaurants, food' );
		$this->template->set ( 'meta_description', "In case transaction fails and money has been deducted from your account, then we will refund your amount within 7 working days" );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('RefundPolicy');
	}
	
	public function product() {
		$this->template->set ( 'page', 'home' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Order food online | Home Delivery | Takeaway, Dine In' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('Product');
	}
	
	public function team() {
		$details = array();
		$details['otp'] = '4566788';
		$sms_msg = 'Please Use This OTP ' . $details ['otp'] . ' (system generated one time password) Your Otp is valid only for 15 mins.';
		$this->load->library ( 'Fbsms' );
		$map = array ();
		$map ['mobile'] = '9021609385';
		$map ['message'] = $sms_msg;
		$this->fbsms->sendSms ( $map );
	}
	
	public function create_captcha() {
		$this->load->library('fb/general');
		$form_id = $this->input->get('form_id');
		$data = $this->general->createCaptcha($form_id);
		echo json_encode($data);
	}
	
   	public function offer() {
   		$this->load->library('zyk/OfferLib');
   		$offers = $this->offerlib->getOffer();
   		$this->template->set ( 'offer', $offers );
       $this->template->set ( 'page', 'Offer' );
       	$this->template->set('title','Offer | Zaykedaar.com');
       	$this->template->set ( 'meta_key', 'food deals,  Offer, food offer, Apply Zaykedaar Coupon code, Order food online, zaykedaar, zaykedaar.com, home delivery upto 15km, order online food, Discount' );
       	$this->template->set ( 'meta_description', "Explore the best food deals near you & order food online via Zaykedaar" );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('Offer'); 
  	}   
  	public function copyCoupon($code)
  	{
       	$cookie_name = "couponCode";
       	$cookie_value = $code;
       	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
   	}
   	public function hireMe($alert=0)
   	{
   		$this->load->library('zyk/JobLib');
   		$jobs = $this->joblib->getAllActiveJob();
   		$this->template->set('job',$jobs);
   		$this->template->set('alert',$alert);
   		$this->template->set ( 'page', 'home' );
   		$this->template->set_theme('default_theme');
   		$this->template->set('title',' We are Hiring | zaykedaar.com');
   		$this->template->set ( 'meta_key','Order food online, We are Hiring, home delivery, home delivery upto 15km, Food, zaykedaar, zaykedaar.com, order online food, food order online, online order food' );
   		$this->template->set ( 'meta_description','We are Hiring-  Hi! We are a young team looking for fresh, enthusiastic and talented individuals who are willing to work with dedication.' );
   		$this->template->set_layout ('default')
   		->set_partial ( 'header', 'partials/header' )
   		->set_partial ( 'footer', 'partials/footer' );
   		$this->template->build ('hireme');
   	}
   	public function jobListing( $jobid)
   	{
   		$this->load->library('zyk/JobLib');
   		$jobs = $this->joblib->getJobById($jobid);
   		$this->template->set('job',$jobs);
   		$position = $this->joblib->getPosition();
   		$this->template->set('position',$position);
   		$this->template->set ( 'page', 'home' );
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout ('default')
   		->title ( 'Opening is Marketing' )
   		->set_partial ( 'header', 'partials/header' )
   		->set_partial ( 'footer', 'partials/footer' );
   		$this->template->build ('joblisting');
   	}
   	public function serviceguarantee()
   	{
   		
   		$this->template->set ( 'page', 'Service Guarantee' );
   		$this->template->set('title','Service Guarantee | Zaykedaar.com');
   		$this->template->set ( 'meta_key', 'Service Guarantee, Zaykedaar.com, Zaykedaar, Order food online, home delivery, home delivery upto 15km, Food, order online food, food order online, online order food' );
   		$this->template->set ( 'meta_description', "Service Guarantee is not valid for the orders coming above 4km radius from restaurant. Service guarantee should not be applied on discounted orders" );
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout ('default')
   		->set_partial ( 'header', 'partials/header' )
   		->set_partial ( 'footer', 'partials/footer' );
   		$this->template->build ('serviceguarantee');
   	}
   	
   	public function serviceguaranteeapp()
   	{
   		$this->template->set ( 'page', 'home' );
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout (false)
   					   ->title ( 'Zaykedaar' );
   		$this->template->build ('serviceguarantee');
   	}
   	
   	public function aboutapp() {
   		$this->template->set ( 'page', 'home' );
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout (false)
   		->title ( 'Order food online | Home Delivery | Takeaway, Dine In' );
   		$this->template->build ('AboutUsAPP');
   	}
   	
   	public function couponPartner()
   	{
   		$this->template->set ( 'page', 'home' );
   		$this->template->set('title','Coupon partner | Zaykedaar.com');
   		$this->template->set ( 'meta_key', 'Couponzguru, Order food online, home delivery, Food, zaykedaar, zaykedaar.com, home delivery upto 15km, order online food, food order online, online order food' );
   		$this->template->set ( 'meta_description', "Couponzguru is one of the first coupon websites to start in India" );
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout ('default')
   		->set_partial ( 'header', 'partials/header' )
   		->set_partial ( 'footer', 'partials/footer' );
   		$this->template->build ('CouponPartner');
   	}
   	public function restaurantByCusines($cuisine,$cuisineid)
   	{
   		$key = explode("-",$cuisine);
   		$str = '';
   		$count = count($key);
   		if($count>1)
   		{
   			$str = ucfirst($key[0]);
   			$str = $str.' '. ucfirst($key[1]);
   		}
   		else{$str = ucfirst($cuisine);}
   		$this->load->library('zyk/SearchLib');
   		$restaurant = $this->searchlib->getAllRestaurantByCuisine($cuisineid);
   		$cuisine = $this->searchlib->getCuisineByCuisineId($cuisineid);
   		$this->template->set('cuisine',$cuisine);
   		$this->template->set('restaurants',$restaurant);
   		$this->template->set ( 'page', 'home' );
   		$this->template->set('title','Order ' .$str.' food online | Home Delivery upto 15 km');
   		$this->template->set ( 'meta_key', 'Order '.$str.' food online, '.$str.' food, '.$str.' food delivery, best '.$str.' food, '.$str.' dishes, '.$str.' restaurant, '.$str.' snacks, order food online, home delivery upto 15km, zaykedaar.com' );
   		$this->template->set ( 'meta_description','Order ' .$str.' food online with discounts and know customer menus, reviews, rating about restaurant at Zaykedaar.com and we are provide home delivery upto 15 km' );   		
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout ('default')
   		->title ( 'Cuisines Wise Restaurant' )
   		->set_partial ( 'header', 'partials/header' )
   		->set_partial ( 'footer', 'partials/footer' );
   		$this->template->build ('cuisinesPage');
   	}
   	public function topRestaurant()
   	{
   		$this->load->library('zyk/SearchLib');
   		$restaurant = $this->searchlib->topRestaurant();
   		$data = array();
   		$i=0;
   		foreach ($restaurant as $item)
   		{
   			
   			$data[$i]['city'] = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$item['city'])));
   			$data[$i]['name'] = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$item['name'])));
   			$data[$i]['locality'] = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$item['locality'])));
   			$data[$i]['name1'] = $item['name'];
   			$data[$i]['id'] = $item['id'];
   			$i++;
   		}
   		echo json_encode($data);
   	}
   	public function topArea()
   	{
   		$this->load->library('zyk/SearchLib');
   		$area = $this->searchlib->topArea();
   		echo json_encode($area);
   	}
   	public function topCuisine()
   	{
   		$this->load->library('zyk/SearchLib');
   		$cuisines = $this->searchlib->topCuisine();
   		foreach ($cuisines as $key=>$cuisine) {
   			$cperm = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(" ","-",$cuisine['name'])));
   			$cuisines[$key]['cperm'] = $cperm;
   		}
   		echo json_encode($cuisines);
   	}
   	public function getAllRestaurantByCuisine()
   	{
   		$this->load->library('zyk/SearchLib');
   		$restaurant = $this->searchlib->getAllRestaurantByCuisine($this->input->get('cuisineid'));
   		echo json_encode($restaurant);
   	}
   	
   	public function saveRating() {
   		$this->load->library('zyk/general');
   		$ratings = array();
   		$ratings['restid'] = $this->input->post("restid");
   		$ratings['userid'] = $this->input->post("userid");
   		$ratings['rating'] = $this->input->post("rating");
   		$ratings['rated_on'] = date('Y-m-d H:i:s');
   		$data = $this->general->saveRating($ratings);
   		if(!empty($this->input->post("review"))) {
   			$reviews = array();
   			$reviews['restid'] = $this->input->post("restid");
   			$reviews['userid'] = $this->input->post("userid");
   			$reviews['review'] = $this->input->post("review");
   			$reviews['review_on'] = date('Y-m-d H:i:s');
   			$data = $this->general->saveReview($reviews);
   		}
		echo json_encode(array('status'=>1));
   	}
   	public function test($userid,$restid)
   	{
   		$this->load->library('zyk/UserLoginLib');
   		$da = $this->userloginlib->getRestaurantDetailByid($restid);
   		$data['userid'] = $userid;
   		$data['restid'] = $restid;
   		$data['rname'] = $da[0]['name'];
   		$this->template->set ( 'data', $data );
   		$this->template->set ( 'page', 'test' );
   		$this->template->set_theme('default_theme');
   		$this->template->set_layout ('default')
   		->title ( 'Cuisines Wise Restaurant' );
   		$this->template->build ('emailtemplate');
   		//$this->load->library('zyk/UserLoginLib');
   		//$this->userloginlib->reviewEmail();
   	}
   	public function reviewEmail()
   	{
   		$this->load->library('zyk/UserLoginLib');
   		$this->userloginlib->reviewEmail();
   	}
   	
	public function blogDetail($a,$id)
	{

		$this->load->library('zyk/BlogLib');
		$blog = $this->bloglib->getBlogById($id);
		$comment = $this->bloglib->getComment($id);
		$allblog = $this->bloglib->getAllBlog();
		$this->template->set('allblog',$allblog);
		$this->template->set('comment',$comment);
		$this->template->set('blog',$blog);
		$this->template->set ( 'page', 'Blog' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Zaykedaar Blog' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('blog');
	}
	public function blogList()
	{
		$this->load->library('zyk/BlogLib');
		$blog = $this->bloglib->getAllBlog();
		$this->template->set('blog',$blog);
		$this->template->set ( 'page', 'Blog' );
		$this->template->set('title','Blogs | zaykedaar.com');
		$this->template->set ( 'meta_key', 'Blogs, Order food online, home delivery, home delivery upto 15km, Food, zaykedaar. zaykedaar.com, order online food, food order online, online order food' );
		$this->template->set ( 'meta_description', "Seeing as food cannot be eaten without some chatter or something to read along in these busy times of lunch takeaways, we bring you a host of weird, straight from the heart posts for you to chew on." );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Zaykedaar Blog' ) 
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('bloglist');
	}
	public function appLanding()
	{
		$this->template->set ( 'page', 'Landing app' );
		$this->template->set_theme('landing');
		$this->template->set_layout ('default')
		->title ( ' Zaykedaar App Landing' );
		$this->template->build ('applanding');
	}
	public function onlineFoodOrderingPage()
	{
		$this->template->set ( 'page', 'Landing app' );
		$this->template->set_theme('landing');
		$this->template->set_layout ('default')
		->title ( ' Zaykedaar App Landing' );
		$this->template->build ('online-food-ordering');
	}
	public function sendAppLink($number)
	{
		$this->load->library('zyk/UserLoginLib');
		$this->userloginlib->sendAppLink($number);
	}
}
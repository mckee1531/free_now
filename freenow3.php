<?php
//session_start();
/*
echo '<table>';
echo '<tr><th>NO</th><th>名前</th><th>開始</th><th>終了</th><th>場所</th>';
foreach($r['data'] as $v){
	if(date('Y/m/d') == date('Y/m/d', strtotime($r['data'][$c]['start_time']))){
		echo '<tr><td>'.$c.'</td><td>'.$r['data'][$c]['name'].'</td><td>'.date('Y/m/d', strtotime($r['data'][$c]['start_time'])).'</td><td>'.$endtime=date('Y/m/d', strtotime($r['data'][$c]['end_time']))<date('Y/m/d')? '設定なし':date('Y/m/d', strtotime($r['data'][$c]['end_time'])).'</td><td>'.$r['data'][$c]['location'].'</td></tr>';	
	}
	$c++;
}
echo '</table>';
$phpJson = $r['data'];
var_dump($uid);
*/
/*
require_once('src/facebook.php');
$appId = '680286438710250';
$secret = '4031f912f3f36c30c8f005b29a9af0d0';
$access_token = '680286438710250|b6Xxqi2GL9Usj6624Im5gU2vZX8';
$facebook = new Facebook(array(
     'appId' => $appId,
     'secret' => $secret,
     'cookie' => true
));
try
{
     //ウォールへ投稿
     $result = $facebook->api("/me/feed", "post", array(
                    "message" => "test",
                    "posix_ctermid(oid)ure" => "test",
                    "link" => "test",
                    "name" => "test",
                    "caption" => "test",
                    "description" => "test",
                    "source" => "test",
                    "action" => json_encode(array(
                                  "name" => "test",
                                  "link" => "test"))
     ));
}
catch(FacebookApiException $e)
{
     //エラー処理がうんたらかんたら
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>free now!!</title>
<meta name="keywords" content="今暇？" />
<meta name="description" content="今暇なら暇つぶしの情報教えます。" />
<link href="freenow3.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
	<?php
	//ここにFB情報取得のAPIを記述
	//$dataにオブジェクト形式で情報が入る
	//$countに$dataの要素数が居れる
	//maxを$countにして乱数を5つ作成
	?>
	<div class="section_fa">
		<h2>あなたにおすすめのイベント</h2>
	</div>
<?php
require_once('../facebook-php-sdk-master/src/facebook.php');
$facebook = new Facebook(array(
  'appId' => '1509407719273845',
  'secret' => 'a272e9b8e425a436a429308a7bb2a84e'));
$uid = $facebook->getUser();
 if(!empty($_GET['error_code'])){
   echo 'facebook認証エラー';
   exit;
 }elseif(!$uid){
   $params = array(
     'redirect_uri' => "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"],
     'scope' => 'publish_stream'
   );
   $fb_login_url = $facebook->getLoginUrl($params);
   //$fb_logout_url = $facebook->getLogoutUrl($params);
   header("Location: " . $fb_login_url);
   exit;
 }
$word='東京';
try{
	$r = $facebook->api("/search?q=$word&type=event&locate=jp_JP");
}catch(Exception $e){
	echo $e->getMessage();
}
$c = 0;
$j=0;
foreach($r['data'] as $v){
	if($j >= 5){
		break;
	}else{
		if(date('Y/m/d') == date('Y/m/d', strtotime($r['data'][$c]['start_time']))){
			echo '<div class="event">';
				echo'<div class="aaa clearfix">';
					echo '<div class="jikann">';
						echo '<h3>'.$endtime=date('Y/m/d', strtotime(date('Y/m/d H', $r['data'][$c]['start_time'])))<strtotime(date('Y/m/d H'), strtotime("+1 day"))? '設定なし':date('Y/m/d H:i:s', strtotime($r['data'][$c]['start_time'])).'~'.date('H:i:s',strtotime($r['data'][$c]['end_time'])).'</h3>';
					echo '</div>';
					echo '<div class="gazou">';
						//echo '<img src="" width="" alt="'.date('Y/m/d', strtotime($r['data'][$c]['start_time'])).'" />';
					echo '</div>';
					echo '<div class="naiyou">';
						echo '<h2><a href="http://www.facebook.com/events/'.$r['data'][$c]['id'].'" target="_blank">'.$r['data'][$c]['name'].'</a></h2>';
						echo '<p>'.$r['data'][$c]['location'].'</p>';
					echo '</div>';
				echo '</div>';
			echo'</div>';
			$j++;
		}
		$c++;
	}
}
?>
<!--
	<a id="event1" href="" onClick="event_view()">
		<div class="aaa clearfix">
			<div class="jikann">
				<h2>13:00~15:00</h2>
			</div>
			<div class="gazou">
				<img src="" width="50" height="50" alt="セミナー画像">
			</div>
			<div class="naiyou">
				<h2>セミナー題名:</h2>
				<p>内容</p>
			</div>
		</div>
	</a>

	<a id="event2"  href="">
		<div class="aaa clearfix">
			<div class="jikann">
				<h2>13:00~15:00</h2>
			</div>
			<div class="gazou">
				<img src="" width="50" height="50" alt="セミナー画像">
			</div>
			<div class="naiyou">
				<h2>セミナー題名</h2>
				<p>内容</p>
			</div>
		</div>
	</a>

	<a id="event3" href="">
		<div class="aaa clearfix">
			<div class="jikann">
				<h2>13:00~15:00</h2>
			</div>
			<div class="gazou">
				<img src="" width="50" height="50" alt="セミナー画像">
			</div>
			<div class="naiyou">
				<h2>セミナー題名</h2>
				<p>内容</p>
			</div>
		</div>
	</a>

	<a id="event4" href="">
		<div class="aaa clearfix">
			<div class="jikann">
				<h2>13:00~15:00</h2>
			</div>
			<div class="gazou">
				<img src="" width="50" height="50" alt="セミナー画像">
			</div>
			<div class="naiyou">
				<h2>セミナー題名</h2>
				<p>内容</p>
			</div>
		</div>
	</a>

	<a id="event5" href="">
		<div class="aaa clearfix">
			<div class="jikann">
				<h2>13:00~15:00</h2>
			</div>
			<div class="gazou">
				<img src="" width="50" height="50" alt="セミナー画像">
			</div>
			<div class="naiyou">
				<h2>セミナー題名</h2>
				<p>内容</p>
			</div>
		</div>
	</a>
-->
</body>
</html>
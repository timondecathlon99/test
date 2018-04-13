<? include_once(__DIR__ . '/global_pass.php');?>
<? include_once(__DIR__ . '/classes/autoload.php');?>
<?

$member = new Member(0, $pdo);
$member->create($_POST['title'], $_POST['email']);

$member_id = $member->findByEmail($_POST['email']);

$comment = new Comment(0, $pdo);
$comment->create($member_id, $_POST['description']);

header("Location: ".$_SERVER['HTTP_REFERER']);

?>
# radynsade/php-templates
Simple PHP templating library.
## Usage
Setup root directory to search templates:
```
\Radynsade\PhpTemplates\Template::$root = '../templates';
```
Render template immediately with variables.

**immediately.php:**
```
\Radynsade\PhpTemplates\Template::render(
	'/folder/with/templates/template',
	[
		'title' => 'Home page',
		'message' => 'Hello world!'
	]
);
```
Or store render result into a variable.

**store.php:**
```
$content = \Radynsade\PhpTemplates\Template::read(
	'/folder/with/templates/template',
	[
		'title' => 'Home page',
		'message' => 'Hello world!'
	]
);
```
**/folder/with/templates/template.phtml (or .php):**
```
<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?></title>
	</head>
	<body>
		<?= $message ?>
	</body>
</html>
```
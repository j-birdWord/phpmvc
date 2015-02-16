<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

// Set a new theme config
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Set urls to clean
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Add routes
$app->router->add('', function() use ($app) {
	$app->theme->setTitle('Välkommen till me-sidan');

	$content = $app->fileContent->get('me.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	$byline = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

	$app->views->add('me/page', [
		'content'		=> $content,
		'byline'		=> $byline,
	]);
});

// Save all contents from kmom
$contentKmom = null;

$kmomDir = 'kmom/';
// Exclude . and ..
$kmomFiles = array_diff(scandir($app->fileContent->getBasePath() . $kmomDir), array('..', '.'));

foreach ($kmomFiles as $file) {
	//$file = Ex. kmom01.md, $filename = Ex. kmom01, $title = Ex. Kmom01
	$filename = pathinfo($file, PATHINFO_FILENAME);
	$title = ucfirst($filename);
	
	$content = $app->fileContent->get($kmomDir . $file);
	$contentKmom .= $content;

	$app->router->add('redovisning/' . $filename, function() use ($app, $title, $content) {
		$app->theme->setTitle($title);

		$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

		$byline = $app->fileContent->get('byline.md');
		$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

		$app->views->add('me/page', [
			'content'		=> $content,
			'byline'		=> $byline,
		]);
	});
}

$app->router->add('redovisning', function() use ($app, $contentKmom) {
	$app->theme->setTitle('Redovisning');

	$content = $app->fileContent->get('redovisning.md');
	$content .= $contentKmom; // Add all kmom
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	$byline = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

	$app->views->add('me/page', [
		'content'		=> $content,
		'byline'		=> $byline,
	]);
});

$app->router->add('source', function() use ($app) {
	$app->theme->addStyleSheet('css/source.css');
	$app->theme->setTitle('Källkod');

	$source = new \Mos\Source\CSource([
		'secure_dir'	=> '..',
		'base_dir'		=> '..',
		'add_ignore'	=> ['.htaccess'],
	]);

	$app->views->add('me/source', [
		'content'		=> $source->View(),
	]);
});

$app->router->handle();
// Set a new navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

$app->theme->render();

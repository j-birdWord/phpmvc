<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

// Set a new theme config
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Add a navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Set urls to clean
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

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

$app->router->add('redovisning', function() use ($app) {
	$app->theme->setTitle('Redovisning');

	$content = $app->fileContent->get('redovisning.md');
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
$app->theme->render();

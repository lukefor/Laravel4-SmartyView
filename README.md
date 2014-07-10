Smarty for Laravel 4
====================

Implementation of Smarty for Laravel 4.x.

Unlike Twig and other template engines for Laravel (other than raw PHP and Blade), this supports [View Composers](http://laravel.com/docs/responses#view-composers).

Undefined variables (and other E_NOTICE errors) are also silently allowed, as a matter of personal preference and because it's generally the Smarty way of doing things.

Smarty itself has been included because file edits were required for View Composer support. It should not be upgraded without these being merged, unless you don't care about View Composers.

Installation
----------------

You can install this through composer with:

	"dark/smarty-view": "dev-master"
	
in composer.json -> "require".

If you're using Laravel 4.0, swap "dev-master" for "dev-laravel-4.0"
If you're using Laravel 4.1, swap "dev-master" for "dev-laravel-4.1"
If you're sticking with Laravel 4.2, swap "dev-master" for "dev-laravel-4.2"

Usage
----------

To use, add to config/app.php -> providers:

	'Dark\SmartyView\SmartyViewServiceProvider',
	
Then simply reference templates using the normal dot syntax of Laravel. 

For example to load smarty template ``views/blog/post.tpl``, you would use ``View::make('blog.post')``. 

In Smarty {include} or {extends} tags, you should continue to use the full directory syntax, e.g. ``{extends file="blog/post.tpl"}``.
Smarty for Laravel 4
====================

Very hacky implementation of Smarty for Laravel 4.

Unlike Twig and basically anything besides raw PHP and Blade, this mostly supports View Composers (at least when the events are used to define variables and when smarty {extends} or {include} tags are used).

Undefined variables (and other E_NOTICE errors) are also silently allowed, as a matter of personal preference.

Smarty itself has been included because file edits were required for View Composer support. It should not be upgraded without these being merged, unless you don't care about View Composers.

You can install this through composer with:
	"dark/smarty-view": "dev-master"
in composer.json>"require"

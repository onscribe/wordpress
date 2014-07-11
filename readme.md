# Onscribe: Wordpress plugin

Simple integration of Onscribeto for any Wordpress site. Allows you to connect to your account, view products and create subscription buttons on any page.


## Dependencies

* [Onscribe account](http://onscri.be) ( free registration )
* [Wordpress](http://wordpress.org/) ( > v3.9 )


## Install

1. Download
2. Copy the ```onscribe``` folder to your ```/wp-contents/plugins/``` directory.
3. Activate the plugin _Onscribe_ through the 'Plugins' menu in WordPress.


## Usage

Login to your Wordpress admin and visit the Onsctibe settings from the side-menu.

Use your API key and secret from Onscibe to establish a secure connection.

You can then review your products straight from the administration:

/wp-admin.php...

You can add subscription buttons on your blog in three ways:

* Using the php method ```onscribe_buttons``` in the templates. Best used if you want the buttons everywhere and you're only using one product.
* Using the shortcode ```[onscribe product='1234567890']``` inside a post.
* Using the options box _Subscriptions_, available for all posts and pages. You can simply select a product and the buttons will be automatically generated before and after the post body.


## Credits

Initiated by Makis Tracend ( [@tracend](http://github.com/tracend) )

Part of the [Onscribe](http://onscri.be/docs#developers) developer tools

Distributed by [K&D Interactive](http://kdi.co)


## License

Released under the [GPL license v3 or later](http://www.gnu.org/licenses/gpl.txt)
